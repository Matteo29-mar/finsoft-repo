<?php
$echo("ciao");
$host = "localhost";
$user = "finsoft";
$password = "finsoft";
$db = "finsoft";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione === false){
    die("errore di connesione:" . $connessione->connect_error);

}

$email = $connessione->real_escape_string($_POST['email']);
$name = $connessione->real_escape_string($_POST['name']);
$password = $connessione->real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserisci i dati del nuovo utente nel database
  $sql = "INSERT INTO utenti (email, name, password) VALUES ('$email','$name','$password')";

  if($connessione->query($sql) === true){
    echo "Registrazione avvenuta con successo.";

   
  }else {
    echo "Errore durante la registrazione. Riprova $sql.  " . $connessione->error;
  }

?> 
