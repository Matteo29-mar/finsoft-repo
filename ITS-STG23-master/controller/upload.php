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
//qui controllo che ci sia effetivamente qualcosa dentro all'array e controllo se oltre ad unaa certa grandezza
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
  //qui sto passando l'array delle immagini in for per controllarli uno ad uno e controllare se fanno parte di quei formati elencati
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    $file_extension = strtolower(pathinfo($image_file["name"][$i], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_types)) {
      echo ("Errore: L'immagine deve essere in formato PNG, JPEG, GIF, JPG o SVG.");
      header("location:../index.php");
    }
  }

  // Controlla che l'immagine non superi i 5 MB di dimensione(ovviamente si può aumentare come diminuire)
  $max_size = 5 * 1024 * 1024; // 5 MB in byte
  //stessa cosa di riga 33 controllo però che la grandezza di ogni sia sotto il tetto massimo
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
  //qua viene assegnato il nome randomico 
  for ($i = 0; $i <= count($image_file["name"]); $i++) {
    $new_filename = uniqid() . '_' . $image_file["name"][$i];
    $target_file = $target_dir . basename($new_filename);
    while (file_exists($target_file)) {
      $new_filename = uniqid() . '_' . $image_file["name"][$i];
      $target_file = $target_dir . basename($new_filename);
    }

    // Salva l'immagine nella cartella uploads(l'unione di $target_file = $target_dir . basename($new_filename))
    if (move_uploaded_file($image_file["tmp_name"][$i], $target_file)) {
      echo "L'immagine " . basename($new_filename) . " è stata caricata.";
    } else {
      echo "Si è verificato un errore durante il caricamento dell'immagine.";
      header("location:../index.php");
    }
  }


  // Salva le informazioni relative all'immagine nel database per i minuti mettere i, i dati vengono salvati per evitare sql injection   
  $data = date('Y-m-d H:i:s');
  $stmt = $conn->prepare("INSERT INTO privati (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $nome, $cognome, $email, $telefono);
  if ($stmt->execute()) {
    // Ottieni l'id generato automaticamente per il nuovo record
    $id_privato = mysqli_insert_id($conn);

    // Utilizza i prepared statements anche per la seconda query
    $stmt2 = $conn->prepare("INSERT INTO prodotti (titolo, descrizione, immagini, data_creazione, id_privato) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("ssssi", $titolo, $descrizione, $folder_name, $data, $id_privato);
    if ($stmt2->execute()) {
      // Ottieni l'id generato automaticamente per il nuovo record nella tabella prodotti
      $id_prodotto = mysqli_insert_id($conn);

      // Aggiornamento della tabella privati con l'id del prodotto appena creato
      $sql3 = "UPDATE privati SET id_prodotto = '$id_prodotto' WHERE id_privato = '$id_privato'";
      if (!$conn->query($sql3)) {
        echo "Si è verificato un errore durante l'aggiornamento della tabella privati: " . mysqli_error($conn);
      }
    } else {
      echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
      header("location:../index.php");
    }
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni personali dell'utente nel database: " . mysqli_error($conn);
    header("location:../index.php");
  }
}

// Chiudi la connessione al database
mysqli_close($conn);
