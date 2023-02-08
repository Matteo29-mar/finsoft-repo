<?php

    $name = $_GET['name'];
    $email = $_GET['email'];
    $message = $_GET['message'];

    $to = "matteomarziano.mm42@gmail.com";
    $subject = "Nuovo messaggio dal sito";
    $headers = "Da: $email\r\n";
    $headers .= "Rispondi a: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message = "<p>Nome: $name</p><p>Email: $email</p><p>Messaggio: $message</p>";

    mail($to, $subject, $message, $headers);

  
?>
