<?php
   $conn = mysqli_connect("localhost", "finsoft", "finsoft", "finsoft");
   // Verifica la connessione
   if (!$conn) {
     die("Connessione al database fallita: " . mysqli_connect_error());
   }
?>
