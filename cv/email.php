<?php


$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
//die(var_dump ($_POST));
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "matteomarziano.mm42@gmail.com";
$mail->Password = "Igriffin9@Mm20022906:)";

$mail->setFrom($email, $name);
$mail->addAddress("matteomarziano.mm42@gmail.com", "matteo");

$mail->Subject = $subject;
$mail->Body = $message;

if(!$mail->send()) {
    echo 'L\'email non è stata inviata.';
    echo 'Errore: ' . $mail->ErrorInfo;
} else {
    echo 'L\'email è stata inviata correttamente.';
}


header("Location: contatti.html");
?>
