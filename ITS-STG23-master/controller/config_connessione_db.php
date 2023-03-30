<?php
    //  $servername = "10.9.1.218";
    //  $username = "ITS-STG2023";
    //  $password = "ITS-STG2023";
    //  $dbname = "ITSSTG2023";
     
    
    $servername = "localhost";
    $username = "finsoft";
    $password = "finsoft";
    $dbname = "finsoft";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }
?>
