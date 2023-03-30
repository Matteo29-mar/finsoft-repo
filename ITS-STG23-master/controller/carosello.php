<?php
require_once "config_connessione_db.php";

if (isset($_REQUEST['id_prodotto'])) {
    // ottenere il nome della cartella delle immagini dal database
    $sql = "SELECT immagini FROM prodotti WHERE id_prodotto = " . $_REQUEST['id_prodotto'];
    $result = $conn->query($sql);
//in questo scandir viene usato row per cercare in base all id_prodotto arraivato dalla richiesta della fetch il nome della cartella chiamata immagini
//con glob guardo dentro a image_folder e viene assegnata a image_files successivamente usao un foreach per l'iterazione se indice è 0 (perchè è tutto un'array)
// metti in active per renderlo prima se no metti il resto senza active usando in tutte e due i casi le variabili idicators e inner che verranno inniettati nell'html

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_folder = $row['immagini'];
    } else {
        echo json_encode("Nessun prodotto trovato con questo ID.");
        exit;
    }
    // ottenere un array di tutti i nomi dei file di immagine nella cartella
    $image_files = glob("../immagini/uploads/$image_folder/*");
    // è una stringa vuota per creare il markup HTML per il carosello di immagini , sono i componenti del carosello 
    $indicators ="";
    $inner = "";
    //$index = indice corrente $image_file il valore di ogni elemento dell'array  durante il for
    //questo foreach serve per creare un div con la class... e un 'immagine all'interno scorrendo l'array
    foreach ($image_files as $index => $image_file) {
        if($index == 0){
            
            $indicators.= '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="'.$index.'" class="active" aria-current="true" aria-label="Slide '.($index+1).'"></button>';
            $inner.='<div class="carousel-item active"><img src="../'.$image_file.'" class="d-block w-100" alt="..."></div>';
        }else{
            
            $indicators.='<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="'.$index.'" aria-label="Slide '.($index+1).'"></button>';
            $inner.='<div class="carousel-item "><img src="../'.$image_file.'" class="d-block w-100" alt="..."></div>';
        }
      
    }

    mysqli_close($conn);
    echo json_encode(['inner' => $inner, 'image' => $image_files , "indicators"=>$indicators]);
} else {
    echo json_encode("Nessun prodotto trovato");
}
?>