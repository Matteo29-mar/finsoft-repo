<?php
    require_once("./config_connessione_db.php");
    // Eliminazione del commento dal database
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_azienda = $_POST['id_azienda'];
    $sql = "DELETE from aziende WHERE id_azienda=$id_azienda";
  
    if ($conn->query($sql) === TRUE) {
      echo ("Azienda eliminata correttamente");
      header("Location:../dashboard/admin/tables_admin.php");
  
    } else {
    echo "Azienda non eliminata: " . $conn->error;
    }
  }

?> 