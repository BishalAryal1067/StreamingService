<?php
 require './emailHandler/emailHandler.php';
 if(isset($_POST['send'])){
    $status = sendMail('bsl33bsal@gmail.com', 'Hello', 'Hi');
    echo $status;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <form action="" method="post">
    <button type="submit" name="send">Send</button>
    </form>
</body>
</html>