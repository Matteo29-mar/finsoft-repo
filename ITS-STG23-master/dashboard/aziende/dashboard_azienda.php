<?php
include '../../controller/permessi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>-Dashboard Aziendale-</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="./css/dashboard_azienda.css" rel="stylesheet" />
    <link href="./css/card.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard_azienda.php"><img src="../../immagini/img_sito/logo_progetto.png" class="logo"></img></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <div>
                <h5 class="benvenuto">Benvenuto:
                    <?php
                    echo ($_SESSION['ragione_sociale']); ?>
                </h5>
            </div>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Impostazioni</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Cambia Password
                    </button>
                    <li><a class="dropdown-item" href="../../controller/log-out.php">Disconnettiti</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Servizio</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Bacheca
                        </a>
                        <div class="sb-sidenav-menu-heading">Interfaccia</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pagine
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Errori
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">
                            Componenti Aggiuntivi</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Grafici
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tabelle
                        </a>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <section class="dark">
                    <div class="container py-4" id="elencoProdotti">
                        <?php
                        require_once('./barra.php');
                        ?>
                    </div>
                </section>
            </main>
            <footer class="py-4 bg-dark mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <script type="text/javascript">
                            copyright = new Date();
                            update = copyright.getFullYear();
                            document.write("Copyright © 2023-" + update + " - Alineri Alberto - Carena Paolo - De Fano Alessandro - Marziano Matteo - All rights reserved.");
                        </script>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal change password -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Cambia Password</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/cambio_password.php" method="post" name="change_password" id="change_password">

                        <div class="distanza">
                            <label class="inputLabel" for="current_password">Vecchia Password</label>
                            <input class="modaleInput" type="password" id="current_password" name="current_password" required>
                        </div>
                        <div class="distanza">
                            <label class="inputLabel" for="new_password">Nuova Password</label>
                            <input class="modaleInput" type="password" id="new_password" name="new_password" required>
                        </div>
                        <div class="distanza">
                            <label class="inputLabel" for="confirm_password">Conferma Password</label>
                            <input class="modaleInput" type="password" id="confirm_password" name="confirm_password">
                        </div>
                        <div class="buttonWrapper contBottoni">
                            <button type="submit" id="submitButton" class="btn btn-primary">
                                <span>Salva</span>
                                <span id="loader"></span>
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal proposta -->
    <div class="modal fade" id="ModalProposta">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Immetti una cifra in Euro</h3>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/money_form.php" method="post">
                        <div class="form-group">
                            <br>
                            <div class="input-group mb-3">
                                <input type="hidden" id="prodotto_id" name="prodotto_id" value="">
                                <script>
                                    function riempiInput1(event) {
                                        var input = document.getElementById('prodotto_id');
                                        var bottone = event.currentTarget;

                                        var id_prodotto = bottone.getAttribute('id_prodotto');
                                        //console.log(id_prodotto);
                                        input.value = id_prodotto;
                                    }

                                    var bottoni = document.querySelectorAll('[id_prodotto]');
                                    bottoni.forEach(function (bottone) {
                                        bottone.addEventListener('click', riempiInput1);
                                    });
                                </script>
                                <span class="input-group-text">&euro;</span>
                                <input type="number" class="form-control" name="proposta_euro" id="proposta_euro" placeholder="0,00" min="0" step="0.1">
                            </div>
                        </div>
                </div>
                <div class="modal-footer contBottoni">
                    <button type="submit" id="salva_proposta" onclick="validateSignupForm()" class="btn btn-primary">
                        <span>Salva</span>
                        <span id="loader"></span>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Modale di avviso successo  -->
    <div class="modal fade" id="modale_successo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title">La tua proposta ha avuto successo!</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale di avviso fallimento  -->
    <div class="modal fade" id="modale_fallimento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title">La tua proposta non è andata a buon fine :(</h3>
                </div>
                <div class="modal-footer contBottoni">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProposta">
                        Riprova
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale immagini qui in questo modale viene preso id_prodotto per identificare le immagini da barra.php viene fatta una fetch in post a carosello.php 
dove vengono create due variabili inicators e inner che sono in carosello.php-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Titolo del modale</h4>
                    <script>
                        function riempiInput(event) {
                            var bottone = event.currentTarget;
                            var id_prodotto = bottone.getAttribute('id_prodotto');

                            let data = new FormData();
                            data.append('id_prodotto', id_prodotto);

                            fetch('../../controller/carosello.php', {
                                    method: "POST",
                                    body: data
                                })
                                .then(data => {
                                    console.log(data)
                                    if (data.status !== 200) {
                                        alert('Qualcosa è andato storto...');
                                        throw new Error(`Error ${data.status}`);
                                    }
                                    data.json().then(data => {
                                        let indicators = document.getElementById("tab_indicators")
                                        let tab = document.getElementById("tab_inner")
                                        indicators.innerHTML = data.indicators
                                        tab.innerHTML = data.inner
                                    })
                                })
                                .catch(err => {
                                    console.error(err)
                                })
                        }

                        var bottoni = document.querySelectorAll('[id_prodotto]');
                        bottoni.forEach(function(bottone) {
                            bottone.addEventListener('click', riempiInput);
                        });
                    </script>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Carosello di immagini -->
                    <div id="carouselExampleCaptions" class="carousel slide"> 
                        <div class="carousel-indicators" id="tab_indicators">
                        </div>
                        <div class="carousel-inner">
                            <span id="tab_inner"></span>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="py-4 bg-dark mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-center small">
                <script type="text/javascript">
                    copyright = new Date();
                    update = copyright.getFullYear();
                    document.write("Copyright © 2023-" + update + " - Alineri Alberto - Carena Paolo - De Fano Alessandro - Marziano Matteo - All rights reserved.");
                </script>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-5.3.0.min.js"></script>
    <script src="./js/scripts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../aziende/assets/demo/chart-area-demo.js"></script>
    <script src="../aziende/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="./js/datatables-simple-demo.min.js"></script>

</body>

</html>