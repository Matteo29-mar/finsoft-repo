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

  // Eliminazione del commento dal database
  if (isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];

    $sql = "DELETE FROM comments WHERE id=$delete_id";
    $result = mysqli_query($connessione, $sql);

    // Verifica del risultato dell'eliminazione
    if ($result) {
        echo "Commento eliminato con successo.";
    } else {
        echo "Errore durante l'eliminazione del commento: " . mysqli_error();
    }
}


    // Chiusura della connessione
    mysqli_close($connessione);
?>
