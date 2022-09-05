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
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));
    $status = 'active';
    $role = 'user';

    //executing statments
    $stmt = mysqli_prepare($db_connection, "INSERT INTO 
    user_information(full_name, email, country,phone_number,password,status,role,user_password) 
    VALUES(?, ?, ?, ?,?, ?, ?, ?)");

    $stmt2 = mysqli_prepare($db_connection, "INSERT INTO 
     user_security(email, security_question,answer,security_pin) 
     VALUES(?, ?, ?, ?)");


    mysqli_stmt_bind_param($stmt, 'ssssssss', $fullName, $email, $country, $phoneNumber, $password, $status, $role);
    mysqli_stmt_bind_param($stmt2, 'ssss', $email, $securityQuestion, $answer, $securityPin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
}
