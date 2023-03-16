<?php
require_once "../../controller/config_connessione_db.php";


// Imposta l'ordine di visualizzazione dei prodotti
$ordine = "data_creazione DESC"; // Default: dal più recente al meno recente
if (isset($_GET["ordine"])) {
  if ($_GET["ordine"] == "vecchi") {
    $ordine = "data_creazione ASC"; // Ordine dal più vecchio al più recente
  }
}

// Query per recuperare i dati dei prodotti
$query = "SELECT * FROM prodotti ORDER BY $ordine";
$result = mysqli_query($conn, $query);

// Recupera l'id_prodotto e la data di pubblicazione dal risultato della query
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$datiProdotti = array();
echo ("
<div class=\"vecchio_nuovo\">
  <p>Orina per</p>
  <button onclick=\"mostraProdotti('nuovi')\">Più recenti</button>
  <button onclick=\"mostraProdotti('vecchi')\">Meno recenti</button>
</div>");
for ($i = 0; $i < count($row); $i++) {
  $id_prodotto = $row[$i]['id_prodotto'];
  $data_creazione = date('Y-m-d', strtotime($row[$i]['data_creazione']));
  $giorni_restanti = 10 - floor((time() - strtotime($data_creazione)) / 86400);
  $titolo = $row[$i]['titolo'];
  $descrizione = $row[$i]['descrizione'];
  $datiProdotti[$i] = array(
    'data_creazione' => $data_creazione,
    'bar_id' => "bar-$id_prodotto",
    'id_prodotto' => $id_prodotto
  );

$scandir = glob("../../immagini/uploads/" .$row[$i]['immagini']."/*");
foreach ($scandir as $index => $image_file) {
$img = $image_file;
break;
}

  echo (" 
    <article class=\"postcard dark blue\" id=\"card_$id_prodotto\">
      <a href=\"#myModal\" data-bs-toggle=\"modal\" data-bs-target=\"#myModal\">
        <img class=\"postcard__img\" src=\"$img\" alt=\"Img\" id_prodotto=\"$id_prodotto\" onclick=\"riempiInput(event)\" />
      </a>
      <div class=\"postcard__text\">
        <h1 class=\"postcard__title blue\">$titolo</h1>
        <div class=\"postcard__subtitle small\">");
  if ($giorni_restanti > 1) {
    echo ("
          <time id=\"dataOra\">
            <i class=\"fas fa-calendar-alt mr-2\"></i>
            <span>Rimangono ancora " . $giorni_restanti . " giorni prima che questo annuncio scada.</span>
          </time>");
  } else {
    echo ("
          <time id=\"dataOra\">
            <i class=\"fas fa-calendar-alt mr-2\"></i>
            <span>Rimane solo " . $giorni_restanti . " giorno prima che questo annuncio scada.</span>
          </time>");
  }

  echo ("
        </div>
        <div class=\"postcard__bar\" id=\"bar-$id_prodotto\"></div>
        <span>DESCRIZIONE:</span>
        <div class=\"postcard__preview-txt\">$descrizione</div>
        <ul class=\"postcard__tagbox\">
          <li class=\"tag__item play green\">
            <a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#ModalProposta\" id_prodotto=\"$id_prodotto\" onclick=\"riempiInput()\">Fai una proposta</a></li>
          <li class=\"tag__item play red\"><a href=\"#\">Elimina</a></li>
        </ul>
      </div>
    </article>"
  );
}
?>

<script>
  function animateProgressBar(dataCreazione, barId, id) {
    const dataPubblicazione = new Date(dataCreazione);

    const differenzaTempo = new Date() - dataPubblicazione;

    const giorniTrascorsi = Math.floor(differenzaTempo / (1000 * 60 * 60 * 24));

    let valoreBarra = 100 - (giorniTrascorsi * 10);
    console.log(valoreBarra <= 0);

    if (valoreBarra <= 0) {

      console.log("card_" + id);
      const article = document.getElementById("card_" + id);
      article.style.display = "none";
    } else {
      const barra = document.getElementById(barId);
      barra.style.width = `${valoreBarra}%`;
      if (valoreBarra >= 60) {
        barra.style.backgroundColor = "green";
      } else if (valoreBarra >= 30) {
        barra.style.backgroundColor = "yellow";
      } else {
        barra.style.backgroundColor = "red";
      }
    }
  }

  <?php
  // Avvio la funzione di animazione della barra di avanzamento per ogni prodotto
  foreach ($datiProdotti as $prod) {
    echo "animateProgressBar('{$prod['data_creazione']}', '{$prod['bar_id']}', '{$prod['id_prodotto']}');";
  }
  ?>

  function mostraProdotti(ordine) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("elencoProdotti").innerHTML = this.responseText;
      }
    };
    xhr.open("GET", "./barra.php?ordine=" + ordine, true);
    xhr.send();
    setTimeout(() => {
      <?php
      // Avvio la funzione di animazione della barra di avanzamento per ogni prodotto
      foreach ($datiProdotti as $prod) {
        echo "animateProgressBar('{$prod['data_creazione']}', '{$prod['bar_id']}', '{$prod['id_prodotto']}');";
      }
      ?>
    }, 100);
  }
</script>