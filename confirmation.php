<?php

try {
    include('./auth.php');

    if (isset($_POST['Confirm'])) {
        $confirmationCode = $_SESSION['code'];
        $fullname = $_SESSION['fullname'];
        $email = $_SESSION['email'];
        $country = $_SESSION['country'];
        $phoneNumber = $_SESSION['phone'];
        $password = $_SESSION['password'];

        $inputCode = $_POST['input-code'];
        $securityQuestion = $_POST['question'];
        $answer = $_POST['answer'];
        $securityPin = $_POST['pin'];

        if ($confirmationCode == $inputCode) {
            registerUser($fullname, $email, $country, $phoneNumber, $password, $securityQuestion, $answer, $securityPin);
        }
    }
} catch (Error $err) {
    echo "<script>alert($err)</script>";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css file-->
    <link rel="stylesheet" href="./style/confirmation.css">
    <title>Confirm</title>
</head>

<body>
    <form action="" method="post">
        <h2>Confirm your registration !</h2>
        <p>Check your email for confirmation code</p>
        <input type="text" placeholder="Confirmation code" name="input-code">
        <p name='resend_confirmation' id="resend-confirmation">Resend confirmation code</p>
        <!--security question block-->
        <div class="question-block" style="display:flex; flex-direction:column">
            <select name="question" id="">
                <option value="default">Select a security question</option>
                <option value="">What is the name of you favorite pet?</option>
                <option value="">Where do you live?</option>
                <option value="">Where do you go for vacation?</option>
            </select>
            <input type="text" placeholder="secuiry answer" name="answer">
        </div>
        <input type="text" placeholder="security pin" name="pin">
        <input type="submit" value="Confirm">
    </form>
</body>

</html>