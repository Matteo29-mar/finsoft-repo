<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once "../../controller/config_connessione_db.php";

// Imposta l'ordine di visualizzazione dei prodotti
$ordine = "data_creazione DESC"; // Default: dal più recente al meno recente
if (isset($_GET["ordine"])) {
  if ($_GET["ordine"] == "vecchi") {
    $ordine = "data_creazione ASC"; // Ordine dal più vecchio al più recente
  }
}


// Query per recuperare i dati dei prodotti
$query = "SELECT * FROM prodotti WHERE id_prodotto NOT IN (SELECT id_prodotto FROM proposte_eliminate WHERE id_azienda = '$_SESSION[id_azienda]') ORDER BY $ordine";
$result = mysqli_query($conn, $query);

// Recupera l'id_prodotto e la data di pubblicazione dal risultato della query
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$datiProdotti = array();
echo ("
<div class=\"vecchio_nuovo\" style=\"
padding-bottom: 15px;\">

  <p>Orina per</p>
  <button type=button class=\"btn btn-primary btn-sm\" onclick=\"mostraProdotti('nuovi')\">Più recenti</button>
  <button type=button class=\"btn btn-primary btn-sm\" onclick=\"mostraProdotti('vecchi')\">Meno recenti</button>
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
    'id_prodotto' => $id_prodotto,
  );
//questa funzione fa lo scandir in base all'indice per avere l'immagine di vista del prodotto
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
          <button class=\"tag__item btn btn-success\" data-bs-toggle=\"modal\" data-bs-target=\"#ModalProposta\" id_prodotto=\"$id_prodotto\" onclick=\"riempiInput()\">
             Fai una proposta</button>
          <button class=\"tag__item btn btn-danger\" data-bs-toggle=\"modal\" data-bs-target=\"#ModalElimina\" id_prodotto=\"$id_prodotto\" id=\"bottone_esterno\" >Elimina</button>
        </ul>
      </div>
    </article>"
  );
}
?>
<!-- Modal Elimina -->
<div class="modal fade" id="ModalElimina" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../../controller/elimina_prodotto.php" method="post">
        <div class="modal-header">
          <input type="" id="input_elimina" name="id_prodotto" value=""></input>
          <script>
            var id_prodotto;

            function riempiElimina(event) {
              console.log({
                t: this
              });
              console.log({
                event
              });
              var input = document.getElementById('input_elimina');
              var bottone1 = event.target;
              console.log({
                bottone1
              });
              var bottone = event.currentTarget;
              console.log({
                bottone
              });

              id_prodotto = bottone.getAttribute('id_prodotto'); // assegnazione valore variabile globale
              console.log(id_prodotto);
              input.value = id_prodotto;
            }

            var bottoni = document.querySelectorAll('[id_prodotto]');
            bottoni.forEach(function(bottone) {
              bottone.addEventListener('click', riempiElimina);
            });

            function EliminaProdotto() {
              var input = document.getElementById("input_elimina");
              input.value = id_prodotto; // aggiornamento valore input con variabile globale
            }
          </script>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3 class="modal-title">Sei sicuro di voler eliminare questo annuncio?</h3>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" id="elimina_button" onclick="EliminaProdotto()">Elimina</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </form>
    </div>
  </div>
</div>

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

        var bottoni = document.querySelectorAll('[id_prodotto]');
        bottoni.forEach(function(bottone) {
          bottone.addEventListener('click', riempiElimina);
        });
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