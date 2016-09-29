<?php 
require_once ( __DIR__ . '/vendor/autoload.php');




$mail = new PHPMailer;
$mail->SMTPDebug = 3;                               // Enable verbose debug output


$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient

$mail->addReplyTo('info@example.com', 'Information');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    saveMailLog( json_encode($mail) );

    echo 'Message has been sent';
}

