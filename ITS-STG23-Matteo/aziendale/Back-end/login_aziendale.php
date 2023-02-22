<?php
##non ultimato 

##chiamata al database 
$host = "10.9.1.218";
$user = "ITS-STG2023";
$password = "ITS-STG2023";
$db = "ITS-STG2023";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione === false){
    die("errore di connesione:" . $connessione->connect_error);

}
##richiesta campi del login 
$mail = $connessione->real_escape_string($_POST['mail']);
$password = $connessione->real_escape_string($_POST['password']);

if($_SERVER["REQUEST_METHOD"] === "POST"){
 ## query della tabella aziende in cui verifica se la mail è dentro la tabella, nelle seguenti righe verifica se la password hashata è giusta
 ## successivamente esegue session_start in cui abilita la sessione 
    $sql_select = "SELECT * FROM aziende WHERE mail = '$mail'";

    if($result = $connessione->query($sql_select)){

        if($result->num_rows == 1){       
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if(password_verify($password, $row['password'])){

                session_start();

                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['mail'] = $row['mail'];
                ## qua esegue una selezione in cui chiede se alla riga di ruolo è uguale ad 1 per entrare come admin se falso entra come azienda
                if ($row['ruolo'] == 1 ) {
                    $_SESSION['is_admin'] = true;
                    header("location: "); ## da aggiungere 
                } else {
                    header("location: "); ##da aggiungere
                }

            } else {
                printf("password errata");
                header('Refresh: 2; URL=../Front-end/login_register.html');


            }
    
        } else {
            printf("account non esiste");
            header('Refresh: 2; URL=../Front-end/login_register.html');


        }
    }
    $connessione->close();
}

?>