<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Tabella dati</title>
</head>
<body>
    <table>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Titolo</th>
            <th>Descrizione</th>
            <th>Immagine</th>
            <th>Data</th>
            <th>Interessato al prodotto</th>
            <th>Non interessato</th>
        </tr>
        <?php
            $host = "localhost";
            $user = "finsoft";
            $password = "finsoft";
            $db = "finsoft";

            // Connessione al database
            $connessione = new mysqli($host, $user, $password, $db);

            // Verifica della connessione
            if (!$connessione) {
                die("Connessione fallita: " . mysqli_connect_error());
                header("location: index.html");
            }

            // Selezione dei dati dal database
            $sql = "SELECT * FROM privati";
            $result = mysqli_query($connessione, $sql);

            // Visualizzazione dei dati
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='d-none'>" . $row["id_privato"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["cognome"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>" . $row["titolo"] . "</td>";
                    echo "<td>" . $row["descrizione"] . "</td>";
                    echo "<td><img src=\"uploads/" . $row["nome_immagine"] . "\" alt=\"Immagine\" height=\"100\" width=\"100\"></td>";
                    echo "<td>" . $row["data"] . "</td>";
                    echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#interessato" data-bs-whatever="@mdo" data-id-target="'.$row["id_privato"].'">✔</button></td>';
                    echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#non_interessato">✖</button></td>';
                    echo "</tr>";
                }
            } else {
                printf("Nessun risultato trovato nel database");
            }

            // Chiusura della connessione
            mysqli_close($connessione);
        ?>
    </table>
    <a href="index.html">Home</a>

<!-- Modal non interessato-->
<div class="modal fade" id="non_interessato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modale interessato -->

<div class="modal fade" id="interessato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Quale è la tua proposta al cliente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Ricevente:</label>
            <input type="text" class="form-control" id="email_ricevente">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Messaggio:</label>
            <textarea class="form-control" id="messaggio"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        <button type="button" class="btn btn-primary">Invio</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
