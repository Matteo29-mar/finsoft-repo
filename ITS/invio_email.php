<!--questo file php serve pe mandare un email con i campi che l'utente scrive nel form e che vengono caricate nel db --!
<?php
// Connessione al database
$conn = mysqli_connect("localhost", "finsoft", "finsoft", "finsoft");
// Verifica la connessione
if (!$conn) {
  die("Connessione al database fallita: " . mysqli_connect_error());
}
require_once "upload.php";
require_once "mailer/mailer.php";
// Query per recuperare gli indirizzi email delle aziende dal database
$sql = "SELECT email FROM aziende";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Recupera tutti i titoli e le descrizioni dalla tabella 'privati'
  $sql_privati = "SELECT email,titolo, descrizione FROM privati ORDER BY id_privato DESC LIMIT 1"; //seleziona l'ultima riga creata 
  $result_privati = $conn->query($sql_privati);
  $rows_privati = $result_privati->fetch_all(MYSQLI_ASSOC); 
  /*utilizza la funzione fetch_all all'oggetto mysqli_assoc 
  per recuperare tutte le righe di una query 
  e un array associativo contentente tutti i record*/
  // Ciclo su ogni riga di risultati della query per recuperare gli indirizzi email delle aziende
  while($row = $result->fetch_assoc()) {
    // Recupera l'email dell'azienda corrente
        $email = $row["email"];
        $template = file_get_contents("recover.html");
        $search = ["{{NAME}}","{{RESET_URL}}"];
        $replace =["azienda",HTTP_BASEURL. "ITS/azienda.php"];
        $body =str_replace($search, $replace, $template);
        send_mail($email, "Nuovo messaggio dall'azienda",  $body);
  }
} else {
  echo "Nessun risultato trovato.";
}
// Chiudi la connessione al database
mysqli_close($conn);
?>


