<!--questo file php serve pe mandare un email con i campi che l'utente scrive nel form e che vengono caricate nel db --!
<?php
require_once "config_connessione_db.php";

require_once "../mailer/mailer.php";
// Query per recuperare gli indirizzi email delle aziende dal database
$sql = "SELECT ragione_sociale, mail FROM aziende";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Ciclo su ogni riga di risultati della query per recuperare gli indirizzi email delle aziende
  while($row = $result->fetch_assoc()) {
    // Recupera l'email dell'azienda corrente
        $email = $row["mail"];
        $template = file_get_contents("../recover.html");
        $search = ["{{NAME}}","{{RESET_URL}}"];
        //nella riga row["ragione_sociale] viene messo il nome dell'azienda che verra visualizzato nell'email inviata
        $replace =[$row["ragione_sociale"],HTTP_BASEURL. "finsoft-repo/finsoft-repo/ITS-STG23-Matteo/view/login_register/login_register.html"];
        $body =str_replace($search, $replace, $template);
        send_mail($email, "Nuovo messaggio da un privato",  $body);
  }
} else {
  echo "Nessun risultato trovato.";
}
// Chiudi la connessione al database
mysqli_close($conn);
?>


