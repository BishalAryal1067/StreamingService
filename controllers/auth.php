<?php

include("../emailHandler/emailHandler.php");


function signUpConfirmation($email, $confirmationCode)
{
    
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
