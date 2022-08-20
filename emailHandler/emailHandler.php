<?php
//importing necessary handlers from phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//loading necessary files from phpmailer
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';

//function to send a mail
function sendMail($email_address, $email_subject, $email_body)
{
    try {
        //creating an instance
        $mail = new PHPMailer(true);

        //setting up SMTP 
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bslbsal10@gmail.com';
        $mail->Password = 'wkuskukbptfzmhhn';
        $mail->SMTPSecure = 'tls'; //enabling tls encryption
        $mail->Port = 587;

        //specifying sender and reciever
        $mail->setFrom('bslbsal10@gmail.com', 'Olympic Streaming Service');
        $mail->addAddress($email_address);

        //setting email format to HTML
        $mail->isHTML(true);

        //specifying email subject and body
        $mail->Subject = $email_subject;
        $mail->Body = $email_body;

        $mail->send();
    } catch (Exception $ex) {
        echo $ex;
    }
}
