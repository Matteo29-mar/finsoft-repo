<?php
// Connessione al database
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

// Salva l'immagine nella cartella uploads
$target_dir = "uploads/";
$target_file = $target_dir . basename($image_file["name"]);
if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
  echo "L'immagine " . basename($image_file["name"]) . " è stata caricata.";

  // Salva le informazioni relative all'immagine nel database
  $data = date('Y-m-d H:i:s');

  $sql = "INSERT INTO privati (nome, cognome, email, telefono, titolo, descrizione, nome_immagine, data)
          VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione', '$target_file', '$data')";
  if (mysqli_query($conn, $sql)) {
    echo "Le informazioni relative all'immagine sono state salvate nel database.";
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
  }
} else {
  echo "Si è verificato un errore durante il caricamento dell'immagine.";
}

// Chiudi la connessione al database
mysqli_close($conn);
?>
