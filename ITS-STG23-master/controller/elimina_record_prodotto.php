<?php
    require_once("./config_connessione_db.php");
    // Eliminazione del commento dal database
    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_prodotto = $_POST['id_prodotto'];
    $sql = "DELETE from prodotti WHERE id_prodotto=$id_prodotto ON DELETE CASCADE ";
  
    if ($conn->query($sql) === TRUE) {
      echo ("Prodotto eliminato correttamente");
      header("Location:../dashboard/admin/tables_admin.php");
  
    } else {
    echo "Prodotto non eliminato: " . $conn->error;
    }
  }
$conn->close();
?> 