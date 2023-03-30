<!DOCTYPE html>
<html>
<head>
	<title>Caroselli per sottocartelle</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
</head>
<body>
	<div class="container">
		<h1>Caroselli per sottocartelle</h1>
			<?php
				// connessione al database
				$conn = mysqli_connect("localhost", "finsoft", "finsoft", "finsoft");
				// Verifica la connessione
				if (!$conn) {
				die("Connessione al database fallita: " . mysqli_connect_error());
				}
				// // ottenere l'ID del prodotto dal parametro dell'URL
				// $id_prodotto = 14;
				
				// ottenere il nome della cartella delle immagini dal database
				$sql = "SELECT immagini FROM prodotti WHERE id_prodotto = 14";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$image_folder = $row['immagini'];
				} else {
				echo "Nessun prodotto trovato con questo ID.";
				exit;
				}

				// ottenere un array di tutti i nomi dei file di immagine nella cartella
				$image_files = glob("uploads/$image_folder/*");

				// creare il markup HTML per il carosello di immagini
				if (count($image_files) > 1) {
					echo '<div class="carousel">';
					foreach ($image_files as $image_file) {
					echo '<div><img src="' . $image_file . '" alt="Product Image"></div>';
					}
					echo '</div>';
					echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
					echo '<script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>';
					echo '<script>';
					echo '$(".carousel").slick({';
					echo 'dots: true,';
					echo 'infinite: true,';
					echo 'speed: 500,';
					echo 'fade: true,';
					echo 'cssEase: "linear"';
					echo '});';
					echo '</script>';
				} else {
					echo '<img src="' . $image_files[0] . '" alt="Product Image">';
				}
  ?>

	</div>
	<a href="index.html">home</a>;
</body>
</html>
