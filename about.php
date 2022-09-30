<?php
 try {
     if(isset($_POST['send-message'])){
        global $db_connection;
        $fullname = $_POST['full_name'];
        $email =$_POST['email'];
        $message =$_POST['message'];
        $staus ='unread';
        $query = "INSERT INTO messages(full_name,email,message, status) VALUES('$fullname', '$email', '$message', '$status')";
        $result = mysqli_query($db_connection,$query);
        if($result){
            echo "<script>alert('Your message has been delivered')</script>";
        }
        else{
            echo "<script>alert('Something went wrong !')</script>";
        }

     }
 } catch (\Throwable $th) {

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
    <form action="" method="post">
        <input type="text" name="full_name" id="" placeholder="Enter your full name..">
        <input type="text" name="email" id="" placeholder="Enter your email..">
        <textarea name="message" id="" cols="36" rows="7" placeholder="Enter your message.."></textarea>
        <input type="submit" value="send-message">
    </form>
</body>
</html>