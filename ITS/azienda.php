<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
        header("location: index.html");

    }

    // Selezione dei dati dal database
    $sql = "SELECT * FROM privati ";
    $result = mysqli_query($connessione, $sql);

    // Visualizzazione dei dati
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
              <th>nome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>cognome&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>telefono&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>titolo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>descrizione&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>immagine&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["nome"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>" . $row["cognome"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>" . $row["email"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>" . $row["telefono"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>" . $row["titolo"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>" . $row["descrizione"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><img src=\"uploads/" . $row["nome_immagine"] . "\" alt=\"Immagine\" height=\"100\" width=\"100\"></td>
                    <td>" . $row["data"] . "&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>";

        }//aggiunta elimina
        echo "</table>";
    } else {
        printf("Nessun risultato trovato nel database");

    }

    // Chiusura della connessione
    mysqli_close($connessione);
?>
      <a href="index.html">home</a>


</body>
</html>