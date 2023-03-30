<!-- questo file  php serve per caricare le informazione che arrivano da un form html e li carica sul db di mysql, in aggiunta permette di caricare l'immagine 
nella cartella del server web --!
<?php
// Connessione al database

use Symfony\Component\Mime\Header\Headers;

$conn = mysqli_connect("localhost", "finsoft", "finsoft", "finsoft");
// Verifica la connessione
if (!$conn) {
  die("Connessione al database fallita: " . mysqli_connect_error());
}
// Ottieni i dati dal form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$titolo = $_POST['titolo'];
$descrizione = $_POST['descrizione'];

echo (json_encode([$_POST, $_FILES["image"]]));
//riga 23 viene controllato se è statta impostata, ovvero se è stata fatta una richiesta di upload del'immagine
if (isset($_FILES['image'])) {
  $image_file = $_FILES["image"];
  // Controlla se è stata caricata un'immagine, funzione count restituisce il numero di elementi presenti in un array o in un oggetto che implementa l'interfaccia Countable
  if (empty($image_file["name"]) || count($image_file["name"]) > 7) { // controlla se è stata inserita almeno un'immagine nel form o se il campo array è vuoto
    echo ("Errore: Nessuna immagine caricata o troppe immagini.");
    header("location:index.html");
  }
  //controllo che non ci siano errori nei file arrivati
  // if (is_array($image_file["error"])) {
  for ($i = 0; $i < count($image_file["error"]); $i++) { //restituisce il numero di elementi presetni nell'array, in questo caso contiene gli eventuali errori verificatosi durante upload dei file
    if ($image_file["error"][$i]) { // vai indice $i del file image_file di error 
      echo ("Errore ");
      header("location:index.html");
      die();
    } else echo ("ok");
  }
  // }else if ($image_file["error"]) {
  //   echo ("Errore ");
  //   header("location:index.html");
  //   die();
  // }
  // Controlla che l'immagine sia di un formato supportato (png, jpeg, gif o svg)
  $allowed_types = array('png', 'jpeg', 'gif', 'svg', 'jpg');
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    $file_extension = strtolower(pathinfo($image_file["name"][$i], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_types)) {
      echo ("Errore: L'immagine deve essere in formato PNG, JPEG, GIF, JPG o SVG.");
      header("location:index.html");
    }
  }

  // Controlla che l'immagine non superi i 5 MB di dimensione
  $max_size = 5 * 1024 * 1024; // 5 MB in byte
  for ($i = 0; $i <= count($image_file["size"]); $i++) {
    if ($image_file["size"][$i] > $max_size) {
      echo ("Errore: L'immagine non può superare i 5 MB di dimensione.");
      header("location:index.html");
    }
  }
  $folder_name = uniqid($email . $_FILES);
  // Genera un nome randomico per il file e controlla che non esista già un file con lo stesso nome
  $target_dir = "uploads/" . $folder_name . "/"; //questa variabile sta dicendo che in che cartella salvare nella cartella folder_name 
  mkdir($target_dir);
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    // print_r($image_file);
    $new_filename = uniqid() . '_' . $image_file["name"][$i];
    $target_file = $target_dir . basename($new_filename);
    while (file_exists($target_file)) {
      $new_filename = uniqid() . '_' . $image_file["name"][$i];
      $target_file = $target_dir . basename($new_filename);
    }
    // Salva l'immagine nella cartella uploads
    if (move_uploaded_file($image_file["tmp_name"][$i], $target_file)) {
      echo "L'immagine " . basename($new_filename) . " è stata caricata.";
    } else {
      echo "Si è verificato un errore durante il caricamento dell'immagine.";
      header("location:index.html");
    }
  }
  // Salva le informazioni relative all'immagine nel database
  $data = date('Y-m-d H:m:s');
  $sql = "INSERT INTO privati (nome, cognome, email, telefono) VALUES ('$nome', '$cognome', '$email', '$telefono')";
  $sql2 = "INSERT INTO prodotti (titolo, descrizione, immagini, data_creazione) VALUES ('$titolo', '$descrizione', '$folder_name', '$data')";
  if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
    echo "Le informazioni relative all'immagine sono state salvate nel database.";
    header("location:index.html");
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
    header("location:index.html");
  }
} else {
  header("location:index.html");
}


// Chiudi la connessione al database
mysqli_close($conn);
?>