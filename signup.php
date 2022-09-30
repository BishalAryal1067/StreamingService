<?php

try {
    include('./database.php');
    include('./auth.php');
    include('./functions.php');
    echo "<link rel='stylesheet' href='./style/signup.css'>";


    $strongRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";


    if (isset($_POST['signup'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $phone_number = $_POST['phone-number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $code = random_int(1000, 9999);

        $error = [
            'empty_error' => '',
            'password_strength' => '',
            'different_passwords' => ''
        ];

        if (empty($fullname) || empty($email) || empty($country) || empty($phone_number) || empty($password) || empty($confirm_password)) {
            $error['empty_error'] = "<script>alert('No feild can be empty')</script>";
            echo $error['empty_error'];
        } else if ($password != $confirm_password) {
            $error['different_passwords'] = "<script>alert('Passwords don't match !')</script>";
            echo $error['different_passwords'];
        } 
        
        
        else if (!preg_match($strongRegex, $password)) {
            $error['password_strength'] = "<script>alert('Password is not strong enough')</script>";
            echo $error['password_strength'];
        }

        foreach ($error as $key => $value) {
            if (empty($value)) {
                unset($error[$key]);
            }
        }

        echo $error[$key];

        if (empty($error)) {
            if (signUpConfirmation($email, $code)) {
                $_SESSION['code'] = $code;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                $_SESSION['country'] = $country;
                $_SESSION['phone'] = $phone_number;
                $_SESSION['password'] = $password;
                return header('Location: confirmation.php', true);
                exit();
            }
        }
    }
} catch (\Throwable $th) {
    throw $th;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                <input type="text" name="fullname" id="" placeholder="Full Name">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <select name="country" id="country-dropdown">
                    <option value="default">Select a country</option>
                </select>
                <input type="text" name="phone-number" id="phone-number" placeholder="Phone Number">
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="password" name="confirm-password" placeholder="Confirm password">
                <input type="submit" name="signup" value="Sign Up">
            </form>
            <a href="login.php">Sign in with your account</a>
        </div>
    </div>

    <!--external javascript file-->
    <script src="./js/signup.js"></script>
</body>

</html>