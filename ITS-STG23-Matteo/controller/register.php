<?php
    require_once("config_connessione_db.php");


date_default_timezone_set('Europe/Rome');

$ragione_sociale = $_POST['ragione_sociale'];
$codice_fiscale = $_POST['codice_fiscale'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$indirizzo_azienda = $_POST['indirizzo_azienda'];
$data_creazione_profilo = date('Ymd');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $piva = $_POST['piva'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificare se l'azienda esiste già nel database
    $query = "SELECT id_azienda FROM aziende WHERE piva = '$piva'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "L'azienda esiste già nei nostri sistemi";
    } else {
        // Inserimento dell'azienda nel database
        $sql = "INSERT INTO aziende (ragione_sociale, piva, codice_fiscale, nome, cognome, telefono, mail, indirizzo_azienda, password, data_creazione_profilo) VALUES ('$ragione_sociale', '$piva', '$codice_fiscale', '$nome', '$cognome', '$telefono', '$mail', '$indirizzo_azienda', '$password', $data_creazione_profilo)";
        if ($conn->query($sql) === TRUE) {
            echo "Nuova azienda inserita con successo";
            // Reindirizzare l'azienda alla pagina di accesso
            header('Location: ../view/login_register_login_register.html');
            exit();
        } else {
            echo "Errore durante l'inserimento dell'azienda: " . $conn->error;
        }
    }
}

// Chiusura della connessione
$conn->close();

?>