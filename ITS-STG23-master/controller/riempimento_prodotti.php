<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

<?php
require_once("config_connessione_db.php");

/* tabella prodotti + privati */

$result = mysqli_query($conn, "SELECT * FROM prodotti");
/* $result2 = mysqli_query($conn, "SELECT * FROM prodotti "); */ /* LEFT JOIN privati ON prodotti.id_privato = privati.id_privato */

while ($row = mysqli_fetch_assoc($result)) {
  $data_creazione = date('Y-m-d', strtotime($row['data_creazione']));
  $giorni_restanti = 10 - floor((time() - strtotime($data_creazione)) / 86400);

  if ($giorni_restanti > 0) {
    echo '
        <tr>  
        <td class="nascosto">' . $row['id_prodotto'] . '</td>   
        <td>' . $row['titolo'] . '</td>
        <td>' . $row['descrizione'] . '</td>
        <td>' . $row['immagini'] . '</td>
        <td>' . $row['data_creazione'] . '</td>
        <td></td>
        <td><a class="bottone-elimina" data-bs-toggle="modal" data-bs-target="#EliminaRecord"  id_prodotto="' . $row['id_prodotto'] . '" onclick="riempiElimina2(event)"><i class="fa-sharp fa-solid fa-xmark"></i></a></td> 
        </tr>
        ';
  } else {
    echo '
        <tr>  
        <td class="nascosto">' . $row['id_prodotto'] . '</td>   
        <td>' . $row['titolo'] . '</td>
        <td>' . $row['descrizione'] . '</td>
        <td>' . $row['immagini'] . '</td>
        <td>' . $row['data_creazione'] . '</td>
        <td><i class="fa-solid fa-check"></i></td>
        <td><a class="bottone-elimina" data-bs-toggle="modal" data-bs-target="#EliminaRecord" id_prodotto="' . $row['id_prodotto'] . '" onclick="riempiElimina2(event)"><i class="fa-sharp fa-solid fa-xmark"></i></a></td> 
        </tr>
        ';
  }
}

$conn->close();
?>

