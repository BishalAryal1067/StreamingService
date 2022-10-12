<?php 
 include('./functions.php');
 include('./auth.php');
 include('./database.php');
 if(isset($_POST['change-password'])){
    global $db_connection;
    $email = $_POST['email'];
    $pin = $_POST['pin'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $check_email = "SELECT * FROM user_information WHERE email = '$email'";
    $user_check = mysqli_query($db_connection, $check_email);
    $count = mysqli_num_rows($user_check);
    if($count>0){
        while($row = mysqli_fetch_assoc($user_check)){
            $find_pin = "SELECT * FROM user_security WHERE email='$email'";
            $result = mysqli_query($db_connection, $find_pin);   
            while($row=mysqli_fetch_assoc($result)){
                $actual_pin = $row['security_pin'];
            }
        }
        if($actual_pin==$pin){
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));
            $query ="UPDATE user_information SET password='$password'";
            $result = mysqli_query($db_connection, $query);
            if($result){
                echo "<script>alert('Password has been changed')</script>";
                echo "<script>
                setTimeout(function(){
                    window.location.href='login.php'
                }, 2500);
                </script>";
            }
        }

        else{
            echo "<script>alert('Incorrect Pin!')</script>";
        }
    }
    else{
        echo "<script>alert('Wrong email')<script>"; 
    }
    

    if($pin == $actual_pin){
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11));
        $update_password = "UPDATE user_information SET password='$password' WHERE email='$email'";
        $query_result = mysqli_query($db_connection, $update_password);
        if($query_result){
            header("Location:login.php");
        }
        else{
            echo "<script>alert('Something went wrong')<script>";
        }
    }
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href='./style/forgot-password.css'>
    <title>Forgot Password</title>
</head>

<body>
    <form action="" method="POST">
        <h4>Enter you details</h4>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="text" name='pin' placeholder="Enter your pin" required>
        <h4>Set up New Password</h4>
        <input type="password" name='new-password' placeholder="Enter password.." required>
        <input type="password" name='confirm-password' placeholder="Confirm password.." required>
        <input type="submit" value="Change Password" name='change-password'>
    </form>
</body>

</html>