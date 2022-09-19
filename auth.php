<?php

include('database.php');
include('emailHandler.php');

function confirm_query($result)
{
    global $db_connection;
    if (!$result) {
        die('Query Failed' . mysqli_error($db_connection));
    }
}

function signUpConfirmation($email, $confirmationCode)
{

    //setting up email subject and body
    $emailSubject = "Dear User, Confirm you registration !";
    $emailBody = "The confirmation code is: $confirmationCode";

    if (sendMail($email, $emailSubject, $emailBody)) {
        return true;
    }
    return true;
}
function insertSecurityDetail($email, $securityQuestion, $answer, $securityPin)
{
    global $db_connection;
    $query = "INSERT INTO user_security VALUES('$email', '$securityQuestion', '$answer', '$securityPin')";
    $result = mysqli_query($db_connection, $query);
    if ($result) {
        return true;
    }
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

    //performing hashing on password
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));
    $status = 'active';
    $role = 'user';

    //writing and executing query
    $query = "INSERT INTO user_information(full_name, email, country, phone_number, password, status, role) 
    VALUES('$fullName', '$email', '$country', '$phoneNumber', '$password', '$status', '$role')";

    $q1 = mysqli_query($db_connection, $query);
    if ($q1) {
        insertSecurityDetail($email, $securityQuestion, $answer, $securityPin);
        return true;
    }
}


//a function to login user
function loginUser($email, $password)
{
    global $db_connection;

    $query = "SELECT * FROM user_information WHERE email = '{$email}'  AND status = 'active'";
    $selectUser = mysqli_query($db_connection, $query);

    while ($row = mysqli_fetch_array($selectUser)) {
        $registeredEmail = $row['email'];
        $db_password = $row['password'];
        $role = strtolower($row['role']);
        if (password_verify($password, $db_password)) {
            $_SESSION['email'] = $registeredEmail;
            return true;
        }
    }
}

//function to log user out of the system
function logoutUser()
{
    session_start();
    session_destroy();
    header("Location:login.php");
}
