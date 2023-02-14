<?php
    $host = "localhost";
    $user = "finsoft";
    $password = "finsoft";
    $db = "finsoft";

    // Connessione al database
    $connessione = new mysqli($host, $user, $password, $db);

    // Verifica della connessione
    if (!$connessione) {
        die("Connessione fallita: " . mysqli_error());
    }

    // Ricezione dei dati dal modulo di modifica commento
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];

    // Aggiornamento dei dati nel database
    $sql = "UPDATE comments SET name='$name', email='$email', comment='$comment' WHERE id=$id";
    $result = mysqli_query($connessione, $sql);

    // Verifica del risultato dell'aggiornamento
    if ($result) {
        echo "Commento aggiornato con successo.";
        echo "<script>window.close();</script>";

    } else {
        echo "Errore durante l'aggiornamento del commento: " . mysqli_error();
    }

    // Chiusura della connessione
    mysqli_close($connessione);
?>
