<?php

use Symfony\Component\Mime\Header\Headers;

require_once "config_connessione_db.php";

// Ottieni i dati dal form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$titolo = $_POST['titolo'];
$descrizione = $_POST['descrizione'];
if (isset($_FILES['image'])) {
  $image_file = $_FILES["image"];
  if (empty($image_file["name"]) || count($image_file["name"]) > 6) {
    echo ("Errore: Nessuna immagine caricata o troppe immagini.");
    header("location:../index.php");
  }

  //controllo che non ci siano errori nei file arrivati
  for ($i = 0; $i < count($image_file["error"]); $i++) {
    if ($image_file["error"][$i]) {
      echo ("Errore ");
      header("location:../index.php");
      die();
    } else echo ("ok");
  }

  // Controlla che l'immagine sia di un formato supportato (png, jpeg, gif o svg)
  $allowed_types = array('png', 'jpeg', 'gif', 'svg', 'jpg');
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    $file_extension = strtolower(pathinfo($image_file["name"][$i], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_types)) {
      echo ("Errore: L'immagine deve essere in formato PNG, JPEG, GIF, JPG o SVG.");
      header("location:../index.php");
    }
  }

  // Controlla che l'immagine non superi i 5 MB di dimensione
  $max_size = 5 * 1024 * 1024; // 5 MB in byte
  for ($i = 0; $i <= count($image_file["size"]); $i++) {
    if ($image_file["size"][$i] > $max_size) {
      echo ("Errore: L'immagine non può superare i 5 MB di dimensione.");
      header("location:../index.php");
    }
  }
  //creazione cartella in caso non ci fosse 
  if (!is_dir("../immagini/uploads")) mkdir("../immagini/uploads");

  // Genera un nome randomico per il file e controlla che non esista già un file con lo stesso nome
  $length = 16;
  $folder_name = bin2hex(random_bytes($length));
  $target_dir = "../immagini/uploads/" . $folder_name . "/";
  mkdir($target_dir);
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    $new_filename = uniqid() . '_' . $image_file["name"][$i];
    $target_file = $target_dir . basename($new_filename);
    while (file_exists($target_file)) {
      $new_filename = uniqid() . '_' . $image_file["name"][$i];
      $target_file = $target_dir . basename($new_filename);
    }

    // Salva l'immagine nella cartella uploads
    if (move_uploaded_file($image_file["tmp_name"][$i], $target_file)) {
      echo "L'immagine " . basename($new_filename) . " è stata caricata.";
    } else {
      echo "Si è verificato un errore durante il caricamento dell'immagine.";
      header("location:../index.php");
    }
  }


  // Salva le informazioni relative all'immagine nel database per i minuti mettere i 
  $data = date('Y-m-d H:i:s');
  /* Inserimento dati database, inzio con iserimento di privati poi dopo aver fatto if che controlla che la connesione è andata con successo 
  dopo qello fa crea la variabile $id_privato e la prende con la funzione mysqli_insert_id dopo fa la seconda query $sql2 e fa la stessa cosa della prima
  dopo aver fatto l'inserimento faccio update della tabella privati e aggiungo $id_prodotto nella colonna della tabella poi chiudo tutto*/
  $sql = "INSERT INTO privati (nome, cognome, email, telefono) VALUES ('$nome', '$cognome', '$email', '$telefono')";
  if ($conn->query($sql) === TRUE) {
    // Ottieni l'id generato automaticamente per il nuovo record
    $id_privato = mysqli_insert_id($conn);
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
    header("location:../index.php");
  }
  $sql2 = "INSERT INTO prodotti (titolo, descrizione, immagini, data_creazione, id_privato) VALUES ('$titolo', '$descrizione', '$folder_name', '$data', '$id_privato')";
  if ($conn->query($sql2) === TRUE) {
    // Ottieni l'id generato automaticamente per il nuovo record nella tabella prodotti
    $id_prodotto = mysqli_insert_id($conn);

    // Aggiornamento della tabella privati con l'id del prodotto
    $update_sql = "UPDATE privati SET id_prodotto='$id_prodotto' WHERE id_privato='$id_privato'";
    if ($conn->query($update_sql) === TRUE) {
      echo "Le informazioni relative all'immagine sono state salvate nel database.";
      header("location:../index.php");
      
      require_once "invio_email.php";
    } else {
      echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
      header("location:../index.php");
    }
  } else {
    header("location:../index.php");
  }
}

// Chiudi la connessione al database
mysqli_close($conn);
?>