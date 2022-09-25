<?php
echo '<link rel="stylesheet" type="text/css" href="./style/login.css">';

include('./functions.php');
include('./auth.php');




if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (loginUser($email, $password)) {
        global $db_connection;
        $email = $_POST['email'];
        $result = mysqli_query($db_connection, "SELECT full_name FROM user_information WHERE email='$email'");
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['fullname'] = $row['full_name'];
            echo $_SESSION['fullname'];
        }
        return header('Location: confirm_login.php');
    } else {
        echo "<script>alert('Something went wrong !')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css">
    <!-- <PHP> echo '<link rel="stylesheet" type="text/css" href="style.css"></head>'; <PHP> -->
    <title>FunOlympic</title>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="./images/medals.jpg" alt="">
        </div>
        <div class="right-section">
            <h3>Sign in with your account</h3>
            <form action="" method="post">
                <input type="text" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" name="login" value="Sign In">
            </form>
            <a href="signup.php">Create an account</a>
        </div>
    </div>
</body>

</html>