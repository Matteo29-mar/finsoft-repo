<?php
// Connessione al database
$conn = mysqli_connect("localhost", "finsoft", "finsoft", "finsoft");

// Verifica la connessione
if (!$conn) {
  die("Connessione al database fallita: " . mysqli_connect_error());
}

// Ottieni i dati dal form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$titolo = $_POST['titolo'];
$descrizione = $_POST['descrizione'];
$image_file = $_FILES["image"];

// Controlla se è stata caricata un'immagine
if(!isset($image_file) || empty($image_file["name"])) {
  die("Errore: Nessuna immagine caricata.");
}

// Controlla che l'immagine sia di un formato supportato (png, jpeg, gif o svg)
$allowed_types = array('png', 'jpeg', 'gif', 'svg', 'jpg');
$file_extension = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
if(!in_array($file_extension, $allowed_types)) {
  die("Errore: L'immagine deve essere in formato PNG, JPEG, GIF, JPG o SVG.");
}

// Controlla che l'immagine non superi i 5 MB di dimensione
$max_size = 5 * 1024 * 1024; // 5 MB in byte
if($image_file["size"] > $max_size) {
  die("Errore: L'immagine non può superare i 5 MB di dimensione.");
}
print_r($image_file);
// Genera un nome randomico per il file e controlla che non esista già un file con lo stesso nome
$target_dir = "uploads/"; //questa variabile sta dicendo che in che cartella salvare
$new_filename = uniqid() . '_' . $image_file["name"];
$target_file = $target_dir . basename($new_filename);
while(file_exists($target_file)) {
  $new_filename = uniqid() . '_' . $image_file["name"];
  $target_file = $target_dir . basename($new_filename);
}

// Salva l'immagine nella cartella uploads
if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
  echo "L'immagine " . basename($new_filename) . " è stata caricata.";

  // Salva le informazioni relative all'immagine nel database
  $data = date('Y-m-d H:i:s');

  $sql = "INSERT INTO privati (nome, cognome, email, telefono, titolo, descrizione, nome_immagine, data)
          VALUES ('$nome', '$cognome', '$email', '$telefono', '$titolo', '$descrizione', '$new_filename', '$data')";
  if (mysqli_query($conn, $sql)) {
    echo "Le informazioni relative all'immagine sono state salvate nel database.";
  } else {
    echo "Si è verificato un errore durante il salvataggio delle informazioni relative all'immagine nel database: " . mysqli_error($conn);
  }
} else {
  echo "Si è verificato un errore durante il caricamento dell'immagine.";
}
require_once "mailer/mailer.php";

// Query per recuperare gli indirizzi email delle aziende dal database
require_once "mailer/mailer.php";

// Query per recuperare gli indirizzi email delle aziende dal database
$sql = "SELECT email FROM aziende";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// Ciclo su ogni riga di risultati
while($row = $result->fetch_assoc()) {
// Recupera il titolo e la descrizione dalla tabella 'privati' basandosi su un identificatore univoco come l'email
$email = $row["email"];
$sql_privati = "SELECT titolo, descrizione FROM privati ";
$result_privati = $conn->query($sql_privati);
$row_privati = $result_privati->fetch_assoc();
$titolo = $row_privati["titolo"];
$descrizione = $row_privati["descrizione"];
    // Invio dell'email contenente il titolo e la descrizione
    $message = "Titolo: " . $titolo . "\nDescrizione: " . $descrizione;
    send_mail($email, "Nuovo messaggio dall'azienda", $message);
    } }else {
    echo "Nessun risultato trovato.";
}





// Chiudi la connessione al database
mysqli_close($conn);
?>
