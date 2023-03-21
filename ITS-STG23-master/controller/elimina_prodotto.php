<?php
$servername = "10.9.1.218";
$username = "ITS-STG2023";
$password = "ITS-STG2023";
$dbname = "ITSSTG2023";

$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();

if (!$conn) {
  die("Connessione fallita: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_prodotto = $_POST['id_prodotto'];
  $id_azienda = $_SESSION['id_azienda'];
  $sql = "INSERT INTO proposte_eliminate (id_prodotto, id_azienda) VALUES ('$id_prodotto', '$id_azienda')";

  if ($conn->query($sql) === TRUE) {
    echo ("Prodotto nascosto correttamente");
    header("Location:../dashboard/aziende/dashboard_azienda.php");

  } else {
  echo "Errore nel nascondere il prodotto: " . $conn->error;
  }
}

mysqli_close($conn);
