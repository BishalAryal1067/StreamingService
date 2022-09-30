<?php

include('./functions.php');
include('./auth.php');

$email = $_SESSION['email'];
$query = "SELECT * FROM user_security WHERE email ='$email'";
$result = mysqli_query($db_connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $question = $row['security_question'];
    $db_answer = $row['answer'];
}






if (isset($_POST['confirm'])) {
    $answer = strtolower($_POST['answer']);
    if ($answer == strtolower($db_answer)) {
        return header('Location: home.php');
        exit();
    } else {
        echo "Wrong answer! Try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='./style/confirm-login.css'>
    <title>Confirm Login</title>
</head>

<body>
    <form action="" method="post">
        <h3>Enter your answer to login !</h3>
        <?php echo "<p>$question</p>"?>
        <input type="text" name="answer" id="" placeholder="Answer.." autocomplete="off">
        <input type="submit" value="Confirm" name="confirm">
    </form>
</body>

</html>