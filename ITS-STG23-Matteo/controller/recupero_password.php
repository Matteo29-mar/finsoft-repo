<?php
// Verifica che l'utente sia loggato e che sia un'azienda
session_start();
require_once("config_connessione_db.php");


// Controllo se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero i valori dei campi dal form
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Controllo se le password coincidono
    if ($new_password !== $confirm_password) {
        echo "Le password non coincidono";
    } else {
        // Aggiornamento del database con la nuova password
        $id_azienda = $_SESSION["id_azienda"];
        $sql = "UPDATE aziende SET password='$new_password' WHERE id=$id_azienda";
        if (mysqli_query($conn, $sql)) {
            echo "Password aggiornata con successo";
        } else {
            echo "Errore nell'aggiornamento della password: " . mysqli_error($conn);
        }
    }
}

// Chiusura della connessione al database
mysqli_close($conn);
?>
