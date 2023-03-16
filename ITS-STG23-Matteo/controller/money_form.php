<?php
// Step 1: Connetti al database MySQL
require_once("config_connessione_db.php");

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

    $sql = "INSERT INTO offerte (proposta_euro, id_azienda, id_prodotto, data_offerta) VALUES ('$proposta_euro', '$id_azienda', '$id_prodotto', '$data')";

    if ($conn->query($sql) === TRUE) {
        echo ("Proposta inserita con successo");
        header("Location:../dashboard/aziende/dashboard_azienda.php");
        require_once "risposta_email.php";

    } else {
    echo "Errore nell'inserimento della proposta: " . $conn->error;
    }
}

$conn->close();
