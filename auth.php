<?php

include('database.php');
include('emailHandler.php');



function signUpConfirmation($email, $confirmationCode)
{
    
    //setting up email subject and body
    $emailSubject = "Dear User, Confirm you registration !";
    $emailBody = "The confirmation code is: $confirmationCode";

    sendMail($email, $emailSubject, $emailBody);
}


//function to register user
function registerUser(
    $fullName,
    $email,
    $country,
    $phoneNumber,
    $password,
    $securityQuestion,
    $answer,
    $securityPin
) {

    global $db_connection;
    $fullName = mysqli_real_escape_string($db_connection, trim($fullName));
    $email = mysqli_real_escape_string($db_connection, trim($email));
    $country = mysqli_real_escape_string($db_connection, trim($country));
    $phoneNumber = mysqli_real_escape_string($db_connection, trim($phoneNumber));
    $password = mysqli_real_escape_string($db_connection, trim($password));
    $securityQuestion = mysqli_real_escape_string($db_connection, trim($securityQuestion));
    $answer = mysqli_real_escape_string($db_connection, trim($answer));
    $phoneNumber = mysqli_real_escape_string($db_connection, trim($securityPin));
    

    //performing hashing on password
    $user_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));

    //executing statments
    $stmt = mysqli_prepare($db_connection, "INSERT INTO user_information(full_name, email, username, user_password) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $full_name, $email, $username, $user_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

