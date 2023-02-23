<?php
// $host = "localhost";
// $user = "finsoft";
// $password = "finsoft";
// $db = "finsoft";

// $connessione = new mysqli($host, $user, $password, $db);

// if($connessione === false){
//     die("errore di connesione:" . $connessione->connect_error);

// }
if(isset($_FILES["image"])){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
    echo "L'immagine ". basename( $_FILES["image"]["name"]). " è stata caricata.";
  }else{
    echo "Si è verificato un errore durante il caricamento dell'immagine.";
  }
}
  

//   $nome = $_POST["nome"];
//   $cognome = $_POST["cognome"];
//   $email = $_POST["email"];
//   $telefono = $_POST["telefono"];
//   $titolo = $_POST["titolo"];
//   $descrizione = $_POST["descrizione"];

//   // Prepara la query SQL per l'inserimento dei dati nel database
//   $sql = "INSERT INTO privati (nome, cognome, email, telefono, titolo, descrizione, immagine)
//           VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione', '$nome_file')";

//   // Esegui la query SQL
//   if (mysqli_query($conn, $sql)) {
//     echo "Dati inseriti correttamente.";
//     header('Refresh: 2; URL=index.html');

//   } else {
//     echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
//     //header('Refresh: 2; URL=index.html');
    
//   }

  // Chiudi la connessione al database
 // mysqli_close($conn);

?> 
