<?php
$host = "10.9.1.218";
$user = "ITS-STG2023";
$password = "ITS-STG2023";
$db = "ITS-STG2023";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione === false){
    die("errore di connesione:" . $connessione->connect_error);

}
$ragione_sociale = $connessione->real_escape_string($_POST['ragione_sociale']);
$piva = $connessione->real_escape_string($_POST['piva']);
$codice_fiscale = $connessione->real_escape_string($_POST['codice_fiscale']);
$nome = $connessione->real_escape_string($_POST['nome']);
$cognome = $connessione->real_escape_string($_POST['cognome']);
$telefono = $connessione->real_escape_string($_POST['telefono']);
$mail = $connessione->real_escape_string($_POST['mail']);
$indirizzo_azienda = $connessione->real_escape_string($_POST['indirizzo_mail']);
$data_creazione_profilo = $connessione->real_escape_string($_POST['data_creazione_profilo']);
$ruolo = $connessione->real_escape_string($_POST['ruolo']);
$password = $connessione->real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserisci i dati del nuovo utente nel database
  $sql = "INSERT INTO aziende (ragione_sociale, piva, codice_fiscale, nome, cognome, telefono, mail, indirizzo_azienda, data_creazione_profilo, ruolo, password) 
  VALUES ('$ragione_sociale','$piva','$codice_fiscale','$nome','$cognome','$telefono','$mail','$indirizzo_azienda','$data_creazione_profilo','$ruolo','$hashed_password')";

  if($connessione->query($sql) === true){
    echo "Registrazione avvenuta con successo.";
    header('Refresh: 2; URL=../Front-end/login_register.html');
   
  }else {
    echo "Errore durante la registrazione. Riprova $sql.  " . $connessione->error;
    header('Refresh: 2; URL=../Front-end/login_register.html');

  }

  $connessione->close();
?> 