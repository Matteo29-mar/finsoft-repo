<?php
require_once "config_test.php";
require_once "mailer/mailer.php";

// Connessione al database
$servername = "localhost";
$username = "finsoft";
$password = "finsoft";
$dbname = "finsoft";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Seleziona l'indirizzo email dalla tabella "privati"
$sql = "SELECT email FROM privati ORDER BY id_privato DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $to_email = $row["email"];
} else {
    echo "Nessun risultato trovato.";
    exit;
}

// Prendi il testo dal modulo HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $testo = $_POST["testo"];
} else {
  $testo = "";
}

// Costruisci il corpo dell'email, includendo il testo inserito dall'utente
//$template = file_get_contents("modale.html");
// $search = ["{{NAME}}","{{RESET_URL}}", "{{TESTO}}"];
// $replace =["pippo", HTTP_BASEURL . "ITS/azienda.php", $testo];
// $body = str_replace($search, $replace, $template);

// Invia l'email
send_mail($to_email, 'prova', $testo);

$conn->close();
?>