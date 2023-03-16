<?php
    require_once("config_connessione_db.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$mail = $_POST['mail'];
	$password = $_POST['password'];

	// Verificare se l'email e la password sono corretti nel database
	$query = "SELECT * FROM aziende WHERE mail = '$mail'";

	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$hashed_password = $row['password'];
	$id_azienda = $row['id_azienda'];
	$ruolo = $row['ruolo'];
	$ragione_sociale = $row['ragione_sociale'];

	if (password_verify($password, $hashed_password)) {
	    session_start();
	    $_SESSION['ragione_sociale'] = $ragione_sociale;
		$_SESSION['id_azienda'] = $id_azienda;
		$_SESSION['ruolo'] = $ruolo;
		$_SESSION['password'] = $password;
	    header("Location:../dashboard/aziende/dashboard_azienda.php");
		//fare un controllo sul ruolo (se ha valore 2 oppure 1) e fare la redirect su azienda o admin
	} else {
	    // Login fallito
	    echo "Email o password errati";
		header("Refresh: 5; URL=../view/login_register/login_register.html");

	}
}


// Chiusura della connessione
$conn->close();
?>
