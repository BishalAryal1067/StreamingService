<?php
require './functions/functions.php';

$user_email = $_POST['email'];
$password = $_POST['password'];
$country = $_POST['country'];

if (isset($_POST['signup'])) {
    if (signUpConfirmation($user_email)) {
        $location = 'confirmation.php';
        header('Location:'.$location);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/signup.css">
    <title>FunOlympic</title>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="./images/medals.jpg" alt="">
        </div>
        <div class="right-section">
            <h3>Create an account</h3>
            <!--Registration form-->
            <form action="" method="post">
                <input type="text" name="email" id="email" placeholder="Email">
                <select name="country" id="country-dropdown" v-disabled="Select a country">
                </select>
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" name="signup" value="Sign In">
            </form>
            <a href="login.php">Sign in with your account</a>
            <p> </p>
        </div>
    </div>

    <!--external javascript file-->
    <script src="./js/signup.js"></script>
</body>

</html>++++