<?php

include("./functions.php");
include("./auth.php");

if (isset($_POST['change'])) {
  global $db_connection;
  $email = $_GET['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));
  $query = "UPDATE user_information SET password='$password' WHERE email ='$email'";
  $result = mysqli_query($db_connection, $query);
  if ($result) {
    $_SESSION['reset_message'] = "<script>alert('Your password has been reset!')</script>";
    header("Location:login.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>


  <style>
    body {
      width: 100%;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    input {
      width: 15em;
      height: 2.75em;
      margin: 0.75em 0;
      padding: 0 1.75em;
      border: none;
      border-radius: 1.75em;
      font-size: 1em;
      background-color: rgb(240, 240, 240);
      outline: none;
    }
    h2{
      color: #16A6F1;
    }

    input[type=submit] {
      width: 7.5em;
      height: 2.75em;
      background:#16A6F1;
      color:white;
      border:none;
      border-radius: 1.75em;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <form action="" method="post">
    <h2>Create a new password</h2>
    <input type="password" placeholder="New Password..." name="password">
    <input type="password" name="Confirm new password" id="" name='confirm-password' placeholder="Confirm New Password..">
    <input type="submit" value="Submit" name="change">
  </form>
</body>

</html>