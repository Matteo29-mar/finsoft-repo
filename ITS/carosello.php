<!DOCTYPE html>
<html>
<head>
	<title>Caroselli per sottocartelle</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Caroselli per sottocartelle</h1>
		<?php
		$dir = "uploads/";
		$directories = array_filter(glob($dir . '*'), 'is_dir');

		foreach ($directories as $index => $directory) {
			// Ottieni il nome della sottocartella
			$dirname = basename($directory);

			// Ottieni un elenco di tutti i file nella sottocartella
			$files = glob($directory . '/*');

			// Crea un id univoco per il carosello
			$carousel_id = 'carousel-' . $index;

			// Crea il markup HTML per il carosello
			$carousel_html = '<div id="' . $carousel_id . '" class="carousel">';
			foreach ($files as $file) {
				$carousel_html .= '<div><img src="' . $file . '"></div>';
			}
			$carousel_html .= '</div>';

			// Stampa il markup HTML del carosello specifico per la sottocartella
			echo '<h2>' . $dirname . '</h2>' . $carousel_html;

			// Aggiungi lo script JavaScript per inizializzare il carosello
			echo '<script>$("#' . $carousel_id . '").slick();</script>';
		}
		?>
	</div>
</body>
</html>
