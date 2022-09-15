<?php
$host ='localhost';
$username='root';
$password='';
$db_name='streaming_service';
$db_connection = mysqli_connect($host, $username, $password, $db_name);

if($db_connection){
    $message = 'connected';
}

else{
    $message = "kera jasto connect hudaina";
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
   
</body>
</html>