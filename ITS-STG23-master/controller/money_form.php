<?php
// Step 1: Connetti al database MySQL
require_once("config_connessione_db.php");
require_once "../mailer/mailer.php";
session_start();
date_default_timezone_set('Europe/Rome');

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $proposta_euro = $_POST['proposta_euro'];
  $id_azienda = $_SESSION['id_azienda'];
  $id_prodotto = $_POST['prodotto_id'];
  $data = date('Y-m-d H:i:s');

  // utilizzo dei prepared statements e dei placeholder
  $stmt = $conn->prepare("INSERT INTO offerte (proposta_euro, id_azienda, id_prodotto, data_offerta) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("siis", $proposta_euro, $id_azienda, $id_prodotto, $data);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {

    $sql = $conn->prepare("SELECT email, nome FROM privati where id_prodotto=?");
    $sql->bind_param("i", $id_prodotto);
    $sql->execute();
    $result = $sql->get_result();
    //qui in money_form verrà iniviata email quando viene fatta una proposta
    if ($sql->affected_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $email = $row["email"];
      $template = file_get_contents("../risposta.html");
      $search = ["{{NAME}}", "{{RESET_URL}}"];
      //matteo = {{NAME}}
      $replace = [$row["nome"], 'HTTP_BASEURL' . "finsoft-repo/finsoft-repo/ITS-STG23-Matteo/dashboard/aziende/dashboard_azienda.php"];
      $body = str_replace($search, $replace, $template);
      send_mail($email, "Nuovo messaggio dall'azienda",  $body);
      echo ("Proposta inserita con successo");
      header("Location:../dashboard/aziende/dashboard_azienda.php");
    }
  } else {
    echo "Errore nell'inserimento della proposta: " . $conn->error;
  }
}

$conn->close();
