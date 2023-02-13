<?php

$host = "localhost";
$user = "finsoft";
$password = "finsoft";
$db = "finsoft";
$connessione = new mysqli($host, $user, $password, $db);
if($connessione === false){
 
    die("errore di connesione:" . $connessione->connect_error);

}

$name = $connessione->real_escape_string($_POST['name']);
$password = $connessione->real_escape_string($_POST['password']);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //printf('%s', $name);
$sql_select = "SELECT * FROM utenti WHERE name = '$name'";

if($result = $connessione->query($sql_select)){
    if($result->num_rows == 1){       
        $row = $result->fetch_array(MYSQLI_ASSOC);

    //     //print_r( $rows );
    //     printf("ID: %s Name: %s", $row["id"], $row["name"]); 
        
    // }else{
    //     printf("errore, riprova!");
    // }
        if(password_verify($password, $row['password'])){
            session_start();

            $_SESSION['loggato'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            header("location: private.php");
        }else{
            printf("password errata");
        }
    
    }else{
        printf("account non esiste");
        
    }
}
$connessione->close();
}
?>
