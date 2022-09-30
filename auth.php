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

function is_blocked($email){
    global $db_connection;
    $query = "SELECT * FROM user_information WHERE email='$email' AND status='blocked'";
    $result =mysqli_query($db_connection, $query);
    if(mysqli_num_rows($result)>0){
       return true;
    }
}

//function to check if user exists
function check_user($email)
{
    global $db_connection;
    $query = "SELECT * FROM user_information WHERE email = '$email'";
    $result = mysqli_query($db_connection, $query);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}

function signUpConfirmation($email, $confirmationCode)
{

    //setting up email subject and body
    $emailSubject = "Dear User, Confirm you registration !";
    $emailBody = "<html><body><h2>The confirmation code is: $confirmationCode</h2></body></html>";

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






function fetch_users()
{
    global $db_connection;
    $query = "SELECT * FROM user_information WHERE role='user'";
    $result = mysqli_query($db_connection, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $full_name = $row['full_name'];
            $email = $row['email'];
            $country = $row['country'];
            $phone_number = $row['phone_number'];
            $status = $row['status'];

            echo "
           <tr>
               <td> $full_name </td>
               <td> $email</td>
               <td> $country</td>
               <td> $phone_number</td>
               <td> $status</td>";
               if($status== 'active'){
                echo "<td><a href='admin-dashboard.php?action=block&email=$email' id='block-btn'>Block</a>";
               }
               else{
                echo "<td><a href='admin-dashboard.php?action=unblock&email=$email' id='unblock-btn'>Unblock</a>";
               }
               
              echo" <a href='admin-dashboard.php?action=delete&email=$email' id='delete-btn'>Delete</a></td>
           </tr>
          ";
        }
    }
}

//function to block user
function block_user($email){
   global $db_connection;
   $block_query = "UPDATE user_information SET status='blocked' WHERE email='$email'";
   $block_result = mysqli_query($db_connection, $block_query);
   if($block_result){
    return true;
   }
}

//function to unblock user
function unblock_user($email){
    global $db_connection;
    $query = "UPDATE user_information SET status='active' WHERE email='$email'";
    $result = mysqli_query($db_connection, $query);
    if($result){
     return true;
    } 
}
//function to delete user
function delete_user($email){
    global $db_connection;
    $query = "DELETE FROM user_information WHERE email='$email'";
    $result = mysqli_query($db_connection, $query);
    if($result){
        return true;
    }
}
