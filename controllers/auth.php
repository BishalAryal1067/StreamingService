<?php

include("../emailHandler/emailHandler.php");

function signUpConfirmation($email)
{
    //generating confirmation code, setting up email body and subject
    $confirmationCode = random_int(0, 10000);
    //setting up email subject and body
    $emailSubject = "Dear User, Confirm you registration !";
    $emailBody = `The confirmation code is: $confirmationCode`;

    sendMail($email, $emailSubject, $emailBody);
}

function registerUser(
    $fullName,
    $email,
    $country,
    $phoneNumber,
    $password,
    $securityQuestion,
    $securityPin
) {

    
}
