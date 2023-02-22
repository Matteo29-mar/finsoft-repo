<?php
$host = "localhost";
$user = "finsoft";
$password = "finsoft";
$db = "finsoft";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione === false){
    die("errore di connesione:" . $connessione->connect_error);

}
//printf("ciao<br>");
// Processa i dati inviati dal form
if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){

    $este_perm = array("png" => "image/png", "jpg" => "image/jpeg");
  
    $tipo_file = $_FILES["img"]["type"];
    $nome_file = $_FILES["img"]["name"];
  
    // verifica estensione file
    $estensione = pathinfo($nome_file, PATHINFO_EXTENSION);
    if(!array_key_exists($estensione, $este_perm)) { die ("errore, formato non valido");} 
  
    // verifica il tipo di file
    if(!in_array($tipo_file, $este_perm)) { die ("errore, tipo di file non permesso");} 
  
    // verifica la grandezza del file
    $dimensione_file = $_FILES["img"]["size"];
    $dimensione_max = 5 * 1024 * 1024 ;
    if($dimensione_file > $dimensione_max) { die ("errore file troppo grande"); }
    if (!is_dir('./img')) {
        mkdir('./img', 0777, true);
    }
    // controllo se esiste già il file
    if(file_exists("./img/" . $nome_file)){
      echo $nome_file . "esiste già, provare con un altra immagine";
    }else{
      move_uploaded_file($_FILES["img"]["tmp_name"], "./img/" . $nome_file);
      echo "file caricato con successo";
    }
  
  }
  

//   $nome = $_POST["nome"];
//   $cognome = $_POST["cognome"];
//   $email = $_POST["email"];
//   $telefono = $_POST["telefono"];
//   $titolo = $_POST["titolo"];
//   $descrizione = $_POST["descrizione"];

//   // Prepara la query SQL per l'inserimento dei dati nel database
//   $sql = "INSERT INTO privati (nome, cognome, email, telefono, titolo, descrizione, immagine)
//           VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione', '$nome_file')";

//   // Esegui la query SQL
//   if (mysqli_query($conn, $sql)) {
//     echo "Dati inseriti correttamente.";
//     header('Refresh: 2; URL=index.html');

//   } else {
//     echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
//     //header('Refresh: 2; URL=index.html');
    
//   }

  // Chiudi la connessione al database
 // mysqli_close($conn);

?> 
