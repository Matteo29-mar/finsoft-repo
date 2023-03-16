<?php
    require_once("config_connessione_db.php");


   /* tabella aziende */                
    $result = mysqli_query($conn, "SELECT * FROM aziende");
    echo "<table id=\"datatablesSimple\">";

    echo "<thead>";
        echo "<tr>";
            echo "<th>ragione_sociale</th>";
            echo "<th>piva</th>";  
            echo "<th>codice_fiscale</th>";
            echo "<th>nome</th>";
            echo "<th>cognome</th>";
            echo "<th>telefono</th>";
            echo "<th>maill</th>";
            echo "<th>indirizzo_azienda</th>";
            echo "<th>data_creazione_profilo</th>";
            echo "<th>data_eliminazione_profilo</th>";
            echo "<th>abilitato</th>";
            echo "<th>cancellato</th>";  
        echo "</tr>";
    echo "</thead>";

    echo "<tfoot>";
        echo "<tr>";
            echo "<th>ragione_sociale</th>";
            echo "<th>piva</th>";  
            echo "<th>codice_fiscale</th>";
            echo "<th>nome</th>";
            echo "<th>cognome</th>";
            echo "<th>telefono</th>";
            echo "<th>maill</th>";
            echo "<th>indirizzo_azienda</th>";
            echo "<th>data_creazione_profilo</th>";
            echo "<th>data_eliminazione_profilo</th>";
            echo "<th>abilitato</th>";
            echo "<th>cancellato</th>";
        echo "</tr>";
    echo "</tfoot>"; 
           
    echo "<tbody>";   
   

    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
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
        </tr>
        ';     
      }
    
    echo "</tbody>";
    echo "</table>";
    
     

    
            
//$conn->close(); 
?> 