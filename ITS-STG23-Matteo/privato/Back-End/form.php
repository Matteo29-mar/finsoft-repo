<?php
// Connessione al database
$servername = "10.9.1.218";
$username = "ITS-STG2023";
$password = "ITS-STG2023";
$dbname = "ITSSTG2023";

$conn = new mysqli($servername, $username, $password, $dbname);

// Definizione delle variabili
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$titolo = $_POST['titolo'];
$descrizione = $_POST['descrizione'];


// Validazione dei dati
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Indirizzo email non valido";
  exit;
}

// Verifica che l'azienda non sia già registrato
$sql = "SELECT * FROM aziende WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  echo "Questo indirizzo email è già stato utilizzato per la registrazione";
  exit;
}

// Inserimento dei dati nel database
$sql = "INSERT INTO aziende (nome, cognome, email, telefono, titolo, descrizione) VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione')";
if (mysqli_query($conn, $sql)) {
  echo "Registrazione effettuata con successo";
} else {
  echo "Errore durante la registrazione: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
