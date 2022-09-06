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

//a function to redirect to desired pages
function redirect($url){
    header('Location'.$url, true);
}

//a function to login user
function loginUser($email, $password){
    global $db_connection;

    $query = "SELECT * FROM users WHERE email = '{$email}'  AND status = 'active'";
    $selectUser = mysqli_query($db_connection, $query);
    
    while ($row = mysqli_fetch_array($selectUser)) {
    $registeredEmail = $row ['email'];
    $db_password = $row ['password'];
    $role = strtolower($row['role']);
        if (password_verify($password, $db_password)) {
        $_SESSION['email'] = $registeredEmail;
        $_SESSION['logged_in'] = "logged_in";
        if($role == 'user'){
            redirect("home.php");
        }
        else{
            redirect("admin/admin-dashboard.html"); 
        }
        
        }
    }
}

