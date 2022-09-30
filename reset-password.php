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
</head>

<body>
  <form action="" method="post">
    <h2>Create a new password</h2>
    <input type="password" placeholder="New Password..." name="password">
    <input type="password" name="Confirm new password" id="" name='confirm-password'>
    <input type="submit" value="Submit" name="change">
  </form>
</body>

</html>