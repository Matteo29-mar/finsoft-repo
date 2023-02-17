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
  if (isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM comments WHERE id=$id";
    $result = mysqli_query($connessione, $sql);

    // Verifica del risultato dell'eliminazione
    if ($result) {
        echo "Commento eliminato con successo.";
        header('URL=list_comments_root.php');

    } else {
        echo "Errore durante l'eliminazione del commento: " . mysqli_error();
        header('URL=list_comments_root.php');

    }
}


    // Chiusura della connessione
    mysqli_close($connessione);
?>
