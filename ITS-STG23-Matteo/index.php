<!DOCTYPE HTML>
<HTML>

<head>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-SlD6eCdiY+edkN/BGxetHJusfhm+ubvxjZ/6zn0i9XHFXJF8j+YUnIgOGzumcQRwE/OHsQjKsT//Z2Q9pr3qgw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header class="navbar">
        <div class="navbar-logo">
            <a href="index.php">
                <img src="./immagini/img_sito/logo_progetto.png" alt="Logo">
            </a>
        </div>
        <div class="navbar-links">
            <ul>
                <li><a href="./view/servizio/servizio.html">SERVIZIO</a></li>
                <li><a href="./view/chi_siamo/chi_siamo.html">CHI SIAMO</a></li>
            </ul>
        </div>
        <div class="navbar-user">
            <div class="dropdown">
                <button class="dropdown-btn"><img src="./immagini/img_sito/user_icon.png" alt="User Icon"></button>
                <div class="dropdown-wrapper">
                    <div class="dropdown-content">
                        <a href="#">Profilo</a>
                        <a href="../../controller/log-out.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="controller/upload.php" method="post" enctype="multipart/form-data">
                <h1>Inserisci i dati</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome*" required />
                <input type="text" name="cognome" id="cognome" placeholder="Cognome*" required />
                <input type="email" name="email" id="email" placeholder="Email*" required />
                <input type="telefono" name="telefono" id="telefono" placeholder="Telefono*" required />
                <input type="text" name="titolo" id="titolo" placeholder="Titolo*" />
                <textarea class="txtarea" type="text" name="descrizione" id="descrizione" placeholder="Descrizione*" required></textarea>
                <label class="upload" for="image" style="font-family: 'Montserrat', sans-serif;">Seleziona
                    una o piu immagini del prodotto da caricare</label>
                <input type="file" id="image" name="image[]" placeholder="carica l'immagine qui" multiple>

                <button type="submit">Invio</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form>
                <h1>Sei un'azienda?</h1>
                <p>Accedi all'area aziendale tramite il pusante qua sotto.</p>
                <button><a href="./view/login_register/login_register.html">Area Aziendale</a></button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Sei un Utente?</h1>
                    <p>Inserisci i dati del tuo prodotto, una delle nostre aziende ti farà una proposta.</p>
                    <button class="ghost" id="signIn">Torna indietro</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Per iniziare &#8595</h1>
                    <p>Inserisci i dati del tuo prodotto per ricevere una proposta</p>
                    <button class="ghost" id="signUp">Clicca qui</button>
                </div>
            </div>
        </div>

    <footer>
        Copyright © 2023-<?= date('Y') ?> - Alineri Alberto - Carena Paolo - De Fano Alessandro - Marziano Matteo - All rights reserved.
        <!--<script type="text/javascript">
            copyright = new Date();
            update = copyright.getFullYear();
            document.write("Copyright © 2023-" + update + " - Alineri Alberto - Carena Paolo - De Fano Alessandro - Marziano Matteo - All rights reserved.");
        </script>-->
    </footer>
    </div>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</HTML>