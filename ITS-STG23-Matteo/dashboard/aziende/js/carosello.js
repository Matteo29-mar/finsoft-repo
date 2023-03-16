// Attiva il carosello
$('myCarousel').carousel();

// Avanza al prossimo elemento del carosello quando si clicca sul pulsante "Next"
$('.carousel-control-next').click(function() {
  $('.carousel').carousel('next');
});

// Torna all'elemento precedente del carosello quando si clicca sul pulsante "Previous"
$('.carousel-control-prev').click(function() {
  $('.carousel').carousel('prev');
});

// Ferma la riproduzione automatica del carosello quando si passa il mouse sopra di esso
$('.carousel').mouseenter(function() {
  $(this).carousel('pause');
});

// Riprende la riproduzione automatica del carosello quando si toglie il mouse dal carosello
$('.carousel').mouseleave(function() {
  $(this).carousel('cycle');
});