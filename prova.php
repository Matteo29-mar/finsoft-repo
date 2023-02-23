<?php
if(isset($_FILES["image"])){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
    echo "L'immagine ". basename( $_FILES["image"]["name"]). " è stata caricata.";
  }else{
    echo "Si è verificato un errore durante il caricamento dell'immagine.";
  }
}
?>
