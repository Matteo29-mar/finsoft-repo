<?php

require_once "config_connessione_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    
    // Verifica se l'utente è un'azienda
    $azienda_query = "SELECT * FROM aziende WHERE mail = '$mail'";
    $azienda_result = mysqli_query($conn, $azienda_query);
    
    if (mysqli_num_rows($azienda_result) == 1) {
        // L'utente è un'azienda
        $row = mysqli_fetch_assoc($azienda_result);
        $hashed_password = $row['password'];
        $id_azienda = $row['id_azienda'];
        $ruoli = $row['ruoli'];
        $ragione_sociale = $row['ragione_sociale'];
        
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['ragione_sociale'] = $ragione_sociale;
            $_SESSION['id_azienda'] = $id_azienda;
            $_SESSION['ruoli'] = $ruoli;
            header("Location: ../dashboard/aziende/dashboard_azienda.php");
            exit();
        } else {
            // Login fallitof
            echo "Mail o password errati";
            //header("Refresh: 5; URL=../view/login_register/login_register.html");
        }
    }
    
    // Verifica se l'utente è un amministratore
    $admin_query = "SELECT * FROM amministrazione WHERE mail = '$mail'";
    $admin_result = mysqli_query($conn, $admin_query);

    if (mysqli_num_rows($admin_result) == 1) {
        // L'utente è un amministratore
        $row = mysqli_fetch_assoc($admin_result);
        $hashed_password = $row['password'];
        $ruoli = $row['ruoli'];

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['ruoli'] = $ruoli;
            header("Location: ../dashboard/admin/dashboard_admin.php");
            exit();
        } else {
            // Login fallito
            echo "Mail o password errati";
            //header("Refresh: 5; URL=../view/login_register/login_register.html");
        }
    } else {
        // Login fallito
        echo "Mail o password errati";
        //header("Refresh: 5; URL=../view/login_register/login_register.html");
    }
} else {
    // L'utente non è loggato, redirect alla pagina di login
    header("Location: ../view/login_register/login_register.php");
    exit();
}
?>

   
