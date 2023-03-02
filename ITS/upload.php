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
$image_file = $_FILES["image"];
// Controlla se è stata caricata un'immagine
if(!isset($image_file) || empty($image_file["name"])) {
  die("Errore: Nessuna immagine caricata.");
}
// Controlla che l'immagine sia di un formato supportato (png, jpeg, gif o svg)
$allowed_types = array('png', 'jpeg', 'gif', 'svg', 'jpg');
$file_extension = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
if(!in_array($file_extension, $allowed_types)) {
  die("Errore: L'immagine deve essere in formato PNG, JPEG, GIF, JPG o SVG.");
}
// Controlla che l'immagine non superi i 5 MB di dimensione
$max_size = 5 * 1024 * 1024; // 5 MB in byte
if($image_file["size"] > $max_size) {
  die("Errore: L'immagine non può superare i 5 MB di dimensione.");
}
print_r($image_file);
// Genera un nome randomico per il file e controlla che non esista già un file con lo stesso nome
$target_dir = "uploads/"; //questa variabile sta dicendo che in che cartella salvare
$new_filename = uniqid() . '_' . $image_file["name"];
$target_file = $target_dir . basename($new_filename);
while(file_exists($target_file)) {
  $new_filename = uniqid() . '_' . $image_file["name"];
  $target_file = $target_dir . basename($new_filename);
}
// Salva l'immagine nella cartella uploads
if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
  echo "L'immagine " . basename($new_filename) . " è stata caricata.";
  // Salva le informazioni relative all'immagine nel database
  $data = date('Y-m-d H:i:s');
  $sql = "INSERT INTO privati (nome, cognome, email, telefono, titolo, descrizione, nome_immagine, data)
          VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione', '$new_filename', '$data')";
  if (mysqli_query($conn, $sql)) {
    echo "Le informazioni relative all'immagine sono state salvate nel database.";
    header("location:index.html");
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
  }
} else {
  echo "Si è verificato un errore durante il caricamento dell'immagine.";
}
require_once "mailer/mailer.php";
require_once "email.php";
// Chiudi la connessione al database
mysqli_close($conn);
?>


