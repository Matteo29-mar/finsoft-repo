<?php
// Connessione al database
$servername = "localhost";
$username = "finsoft";
$password = "finsoft";
$dbname = "finsoft";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

// Controlla che sia stato inviato il modulo HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Prendi il testo dal modulo HTML
  $testo = $_POST["testo"];

  // Controlla che il testo non sia vuoto
  if (empty($testo)) {
    echo "Il campo di testo è vuoto";
  } else {
    // Salva il testo nel database
    $sql = "INSERT INTO prova (testo) VALUES ('$testo')";
    if ($conn->query($sql) === TRUE) {
      echo "Testo salvato con successo";
    } else {
      echo "Errore durante il salvataggio del testo: " . $conn->error;
    }
    header("location:azienda.php");

  }
}

$conn->close();

require_once('invio_modale.php');
?>
