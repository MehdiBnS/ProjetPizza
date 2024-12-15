<?php

//Importation de la classPHP mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


// RECUPERATION
$nom = $_POST['nom'] ?? null;
$prenom = $_POST['prenom'] ?? null;
$tel = $_POST['tel'] ?? null;
$email = $_POST['email'] ?? null;
$sujet = $_POST['checkbox'] ?? null;
$message = $_POST['message'] ?? null;
// Il manque un test ici


try {
    // Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    //$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    //$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //$mail->Username   = 'user@example.com';                     //SMTP username
    //$mail->Password   = 'secret';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom($email, 'Mailer');
    $mail->addAddress('bns.mehdi@outlook.fr');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sujet;
    $mail->Body = "Nom : " . $nom . "<br>Prénom : " . $prenom . "<br>Téléphone : " . $tel . "<br>Message : ". $message ;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<p style=" padding-left: 25px; color: white ; font-size:20px;">Message envoyée</p>';
} catch (Exception $e) {
    echo "Une erreur est survenue : {$mail->ErrorInfo}";
}