<?php

// require_once "mailer/mailer.php";

// $x = file_get_contents("index.html");
// send_mail ("matteomarziano.mm42@gmail.com", "ciao", $x);
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

// Query per recuperare gli indirizzi email delle aziende dal database
// $sql = "SELECT email FROM aziende";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Ciclo su ogni riga di risultati
//     while($row = $result->fetch_assoc()) {
        // Invio dell'email di prova
        // $email = $row["email"];
        // $titolo = $row["titolo"];
        $template = file_get_contents("recover.html");
        $search = ["{{NAME}}","{{RESET_URL}}"];
        $replace =["pippo",HTTP_BASEURL. "ITS/azienda.php"];
        $body =str_replace($search, $replace, $template);
        send_mail('matteomarziano.mm42@gmail.com', 'prova ',  $body);
//     //}
// } else {
//     echo "Nessun risultato trovato.";
// }

$conn->close();

?>

