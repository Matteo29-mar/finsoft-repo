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
    <title>Charts - SB Admin</title>
    <link href="./css/dashboard_azienda.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard_azienda.php"><img src="../../immagini/img_sito/logo_progetto.png"
                class="logo"></img></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
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
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Impostazioni</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
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
                        <a class="nav-link" href="dashboard_azienda.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Bacheca
                        </a>
                        <div class="sb-sidenav-menu-heading">Interfaccia</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pagine
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Errori
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">
                            componenti aggiuntivi</div>
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
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Grafici</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./dashboard_azienda.php">Bacheca</a></li>
                        <li class="breadcrumb-item active">Grafici</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Istogramma Lineare
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                        <div class="card-footer small text-muted"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Istogramma
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Diagramma a Torta
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-dark mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small testo">
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
                    <form action="" method="post" name="signupForm" id="signupForm">

                        <div class="distanza">
                            <label class="inputLabel" for="password">Vecchia Password</label>
                            <input class="modaleInput" type="password" id="password" name="password" required>
                        </div>
                        <div class="distanza">
                            <label class="inputLabel" for="nuova_password">Nuova Password</label>
                            <input class="modaleInput" type="password" id="nuova_password" name="nuova_password"
                                required>
                        </div>
                        <div class="distanza">
                            <label class="inputLabel" for="confirmPassword">Conferma Password</label>
                            <input class="modaleInput" type="password" id="confirmPassword" name="confirmPassword">
                        </div>
                        <div class="buttonWrapper contBottoni">
                            <button type="submit" id="submitButton" onclick="validateSignupForm()"
                                class="btn btn-primary">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../aziende/assets/demo/chart-area-demo.js"></script>
    <script src="../aziende/assets/demo/chart-bar-demo.js"></script>
    <script src="../aziende/assets/demo/chart-pie-demo.js"></script>
</body>

</html>