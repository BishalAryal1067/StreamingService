<?php
include('./auth.php');
include('./functions.php');
include('./database.php');

if(isset($_GET['action'])){
    $email = $_GET['email'];
    $subject="Regarding password reset request";
    $body = "<p>To reset your password <a href='http://localhost:3500/StreamingService/reset-password.php?email=$email'>Click here</a></p>";

    if(sendMail($email, $subject,$body)){
        echo "<script>alert('An email has been sent to the user!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2>Password Reset Requests</h2>
    </div>

    <table>
        <th>Requested By</th>
        <th>Requesed Date</th>
        <th>Action</th>

        <?php
           global $db_connection;
           $query = "SELECT * FROM password_requests";
           $result = mysqli_query($db_connection,$query);
           while($row= mysqli_fetch_assoc($result)){
             $requested_by = $row['requested_by'];
             $request_date =$row['request_date'];

             echo "
               <tr>
                  <td>$requested_by</td>
                  <td>$request_date</td>
                  <td><a href='requests.php?action=reset&email=$requested_by'?>Reset</a></td>
               </tr>
             ";
           }

         ?>
    </table>
</body>
</html>