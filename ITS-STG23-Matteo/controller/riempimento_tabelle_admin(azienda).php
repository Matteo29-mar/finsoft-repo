<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<?php
    require_once("config_connessione_db.php");
     
   /* tabella aziende */                
    $result = mysqli_query($conn, "SELECT * FROM aziende");
       
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
        <td class="nascosto">' .$row['id_azienda'] .'</td>
        <td>' .$row['ragione_sociale'] .'</td>
        <td>' .$row['piva'] .'</td>
        <td>' .$row['codice_fiscale'] .'</td>
        <td>' .$row['nome'] .'</td>
        <td>' .$row['cognome'] .'</td>
        <td>' .$row['telefono'] .'</td>
        <td>' .$row['mail'] .'</td>
        <td>' .$row['indirizzo_azienda'] .'</td>
        <td>' .$row['data_creazione_profilo'] .'</td>
        <td>' .$row['data_eliminazione_profilo'] .'</td>
        <td>' .'<a href="elimina_riga.php" class="bottone-elimina"><i class="fa-sharp fa-solid fa-xmark"></i></a></td>            
        </tr>
        ';     
      }      
//$conn->close(); 
?> 