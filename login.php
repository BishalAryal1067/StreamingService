<?php
try {
    echo "<link rel='stylesheet' href='./style/login.css'>";
    include('./functions.php');
    include('./auth.php');
    include('./database.php');

    if(isset($_SESSION['reset_message'])){
        echo $_SESSION['reset_message'];
        unset($_SESSION['reset_message']);
    }
} catch (\Throwable $th) {
    throw $th;
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];
    global $db_connection;
    $result = mysqli_query($db_connection, "SELECT * FROM user_information WHERE email='$email'");
    $user_exists = mysqli_num_rows($result);
    if($user_exists>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $role = strtolower($row['role']);
            $db_password = $row['password'];
            if (!is_blocked($email)) {
                $match_password = password_verify($password, $db_password);
                if ($match_password) {
                    $_SESSION['fullname'] = $row['full_name'];
                    $_SESSION['email'] = $row['email'];
                    if ($role == 'user') {
                        echo $role;
                        if (!empty($remember)) {
                            setcookie('email', $_POST['email'], time() + 86400);
                            setcookie('password', $_POST['password'], time() + 86400);
                        }
                        if (empty($remember)) {
                            setcookie('email', '', time() - 86400);
                            setcookie('password', '', time() - 86400);
                        }
                        $_SESSION['email'] = $email;
                        return header('Location: confirm_login.php');
                    } elseif ($role == 'admin') {
                        return header('Location: admin/admin-dashboard.php');
                    }
                } else {
                    echo "<script>alert('Invalid email or password')</script>";
                }
            } else {
                echo "<script>alert('Your account is blocked !')</script>";
            }
        }
    }
    else{
        echo "<script>alert('User does not exist')</script>";
    }
   
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
            <h3>Sign in with your account</h3>
            <form action="" method="post">
                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>">
                <input type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : '' ?>">
                <div class="memory">
                    <input type="checkbox" name="remember" id="check" placeholder="Remember Me" <?php if (isset($_COOKIE['email'])) {
                                                                                                    echo "checked";
                                                                                                } ?>>
                    <label for="check">Remember Me</label>
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                <input type="submit" name="login" value="Sign In">
            </form>
            <a href="signup.php" id="register">Create an account</a>
        </div>
    </div>
</body>

</html>