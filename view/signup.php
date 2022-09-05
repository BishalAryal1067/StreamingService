<?php

include __DIR__ . ("../controllers/auth.php");


try {
    //generating confirmation code, setting up email body and subject
    $confirmationCode = random_int(0, 10000);
    if (isset($_POST['signup'])) {
        $email = $_POST['email'];
        $isSent = signUpConfirmation($email, $confirmationCode);

        if ($isSent) {
            $_SESSION['code'] =
                $_SESSION['fullname'] = $_POST['fullname'];
            $_SESSION['email'] = $email;
            $_SESSION['country'] = $_POST['country'];
            $_SESSION['phone'] = $_POST['phone-number'];
            $_SESSION['password'] = $_POST['password'];
        }
    }
} catch (Error $err) {
    echo $err;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/signup.css">
    <title>FunOlympic</title>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="../images/medals.jpg" alt="">
        </div>
        <div class="right-section">
            <h3>Create an account</h3>
            <!--Registration form-->
            <form action="confirmation.php" method="post">
                <input type="text" name="fullname" id="" placeholder="Full Name">
                <input type="text" name="email" id="email" placeholder="Email">
                <select name="country" id="country-dropdown">
                    <option value="default">Select a country</option>
                </select>
                <!-- <div class="phone-number"> -->
                <!-- <span class="country-code"></span> -->
                <input type="text" name="phone-number" id="phone-number" placeholder="Phone Number">
                <!-- </div> -->
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" name="signup" value="Sign In">
            </form>
            <a href="login.php">Sign in with your account</a>
            <p> </p>
        </div>
    </div>

    <!--external javascript file-->
    <script src="../js/signup.js"></script>
</body>

</html>