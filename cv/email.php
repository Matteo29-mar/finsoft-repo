<?php
$servername = "localhost";
$username = "finsoft";
$password = "finsoft";
$dbname = "finsoft";

// Crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
  die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $comment = $_POST['comment'];
//die(var_dump ($_POST));
  $sql = "INSERT INTO comments (name, email, comment)
  VALUES ('$name', '$email', '$comment')";

  if ($conn->query($sql) === TRUE) {
    echo "Commento salvato con successo";
    header("location: commenti.html");

  } else {
    echo "Errore durante il salvataggio del commento: " . $conn->error;
  }
}

// Chiudi la connessione
$conn->close();

?>
