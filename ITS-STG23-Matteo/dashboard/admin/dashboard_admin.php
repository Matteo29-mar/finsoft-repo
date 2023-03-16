<?php
include '../../controller////permessi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="./css/dashboard_admin.css" rel="stylesheet" />
    <link href="./css/card.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.php"><img src="../../immagini/img_sito/logo_progetto.png" class="logo"></img></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
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
                    <li><a class="dropdown-item" href="../../log-out.php">Disconnettiti</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard.php">
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
                            Componenti Aggiuntivi</div>
                        <a class="nav-link" href="charts_admin.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Grafici
                        </a>
                        <a class="nav-link" href="tables_admin.php">
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
                    <div class="container py-4">
                        <h1 class="h1 text-center" id="pageHeaderTitle">PRODOTTI</h1>

                        <article class="postcard dark blue">
                            <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                            <div class="postcard__text">
                                <h1 class="postcard__title blue">Computer Portatile Hp Pavillion</h1>
                                <div class="postcard__subtitle small">
                                    <time id="dataOra">
                                        <i class="fas fa-calendar-alt mr-2"></i>Data del post
                                    </time>
                                </div>
                                <div class="postcard__bar"></div>
                                <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit.
                                    Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi
                                    quia, doloribus
                                    eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae
                                    repellat
                                    vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum
                                    dolores nobis
                                    enim quidem excepturi, illum quos!</div>
                                <ul class="postcard__tagbox">
                                    <li class="tag__item play green"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#ModalProposta">Fai una proposta</a></li>
                                    <li class="tag__item play red"><a href="#">Elimina</a></li>
                                </ul>
                            </div>
                        </article>
                        <article class="postcard dark red">
                            <img class="postcard__img" src="https://picsum.photos/501/500" alt="Image Title" />
                            <div class="postcard__text">
                                <h1 class="postcard__title red">Podcast Title</h1>
                                <div class="postcard__subtitle small">
                                    <time id="dataOra">
                                        <i class="fas fa-calendar-alt mr-2"></i>Data del post
                                    </time>
                                </div>
                                <div class="postcard__bar"></div>
                                <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit.
                                    Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi
                                    quia, doloribus
                                    eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae
                                    repellat
                                    vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum
                                    dolores nobis
                                    enim quidem excepturi, illum quos!</div>
                                <ul class="postcard__tagbox">
                                    <li class="tag__item play green"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#ModalProposta">Fai una proposta</a></li>
                                    <li class="tag__item play red"><a href="#">Elimina</a></li>
                                </ul>
                            </div>
                        </article>
                        <article class="postcard dark green">
                            <img class="postcard__img" src="https://picsum.photos/500/501" alt="Image Title" />

                            <div class="postcard__text">
                                <h1 class="postcard__title green">Podcast Title</h1>
                                <div class="postcard__subtitle small">
                                    <time id="dataOra">
                                        <i class="fas fa-calendar-alt mr-2"></i>Data del post
                                    </time>
                                </div>
                                <div class="postcard__bar"></div>
                                <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit.
                                    Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi
                                    quia, doloribus
                                    eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae
                                    repellat
                                    vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum
                                    dolores nobis
                                    enim quidem excepturi, illum quos!</div>
                                <ul class="postcard__tagbox">
                                    <li class="tag__item play green"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#ModalProposta">Fai una proposta</a></li>
                                    <li class="tag__item play red"><a href="#">Elimina</a></li>
                                </ul>
                            </div>
                        </article>
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

    <!-- Modal proposta -->
    <div class="modal fade" id="ModalProposta">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Immetti una cifra in Euro</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="inputAmount">Cifra:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">&euro;</span>
                                <input type="number" class="form-control" id="inputAmount" placeholder="0,00" min="0"
                                    step="0.01">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer contBottoni">
                    <button type="submit" id="submitButton" onclick="validateSignupForm()" class="btn btn-primary">
                        <span>Salva</span>
                        <span id="loader"></span>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../aziende/assets/demo/chart-area-demo.js"></script>
    <script src="../aziende/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="./js/datatables-simple-demo.js"></script>
</body>

</html>