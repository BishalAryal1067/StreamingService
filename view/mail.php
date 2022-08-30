<?php


include "../functions/authentication.php";

$email = 'bsl33bsal@gmail.com';

if(isset($_POST['btn'])){
    signUpConfirmation($email);
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
    hello
    <form action="" method="post">
        <button name="btn">Send Mail</button>
    </form>
</body>
</html>