<?php

session_start();
// Verifica se l'azienda ha fatto clic sul pulsante "Cambia password"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i valori inviati dal form
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Connessione al database MySQL
    $servername = "localhost";
    $username = "finsoft";
    $password = "finsoft";
    $dbname = "finsoft";
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Verifica se la nuova password e la conferma sono uguali
    if ($new_password != $confirm_password) {
        
        $error = "Le due password non corrispondono. Verrai reindirizzato alla tua dashboard";
        //echo($error);
        echo("<html><head> <link rel=\"stylesheet\" href=\"./errore.css\">
        </head><body><div class=\"noise\"></div>
        <div class=\"overlay\"></div>
        <div class=\"terminal\">
          <h1>Errore</h1>
          <p class=\"output\">Le due password non corrispondono.</p>
          <p class=\"output\">Si prega di provare a <a href=\"../dashboard/aziende/dashboard_azienda.php\">tornare indietro</a>
          <p class=\"output\">Verrai reindirizzato automaticamente tra 10 secondi</p>
        </div></body></html>");
        header("Refresh: 10; URL=../dashboard/aziende/dashboard_azienda.php");
    }

    // Verifica se la password corrente è corretta per l'azienda corrente
    $stmt = $pdo->prepare("SELECT password FROM aziende WHERE id_azienda = :id_azienda");
    $stmt->execute(["id_azienda" => $_SESSION["id_azienda"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!password_verify($current_password, $row["password"])) {
        $error = "La password corrente non è corretta. Verrai reindirizzato alla tua dashboard";
        echo($error);
        header("Refresh: 5; URL=../dashboard/aziende/dashboard_azienda.php");
    }

    // Verifica che la nuova password contenga sia lettere che numeri e che sia lunga almeno 8 caratteri
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/', $new_password)) {
        $error = "La nuova password deve contenere almeno una lettera e un numero e deve essere lunga almeno 8 caratteri. Verrai reindirizzato alla tua dashboard";
        echo($error);
        header("Refresh: 5; URL=../dashboard/aziende/dashboard_azienda.php");
    }

    // Aggiorna la password dell'azienda con la nuova password crittografata
    if (!isset($error)) {
        $stmt = $pdo->prepare("UPDATE aziende SET password = :password WHERE id_azienda = :id_azienda");
        $stmt->execute(["password" => password_hash($new_password, PASSWORD_DEFAULT), "id_azienda" => $_SESSION["id_azienda"]]);
        $success = "La password è stata cambiata con successo. Verrai reindirizzato alla tua dashboard";
        echo($success);
        header("Refresh: 5; URL=../dashboard/aziende/dashboard_azienda.php");
    }
}
?>
