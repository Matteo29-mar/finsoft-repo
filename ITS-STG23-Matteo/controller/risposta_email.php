<!--questo file php serve pe mandare un email con i campi che l'utente scrive nel form e che vengono caricate nel db --!
<?php
require_once "config_connessione_db.php";

require_once "../mailer/mailer.php";
// Query per recuperare gli indirizzi email delle aziende dal database
$sql = "SELECT email FROM privati";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Ciclo su ogni riga di risultati della query per recuperare gli indirizzi email delle aziende
  while($row = $result->fetch_assoc()) {
    // Recupera l'email dell'azienda corrente
        $email = $row["email"];
        $template = file_get_contents("../risposta.html");
        $search = ["{{NAME}}","{{RESET_URL}}"];
        //matteo = {{NAME}}
        $replace =["{{NAME}}",HTTP_BASEURL. "finsoft-repo/finsoft-repo/ITS-STG23-Matteo/dashboard/aziende/dashboard_azienda.php"];
        $body =str_replace($search, $replace, $template);
        send_mail($email, "Nuovo messaggio dall'azienda",  $body);
  }
} else {
  echo "Nessun risultato trovato.";
}
// Chiudi la connessione al database
mysqli_close($conn);
?>


