<?php
include('./auth.php');
include('./functions.php');
echo "<link rel='stylesheet' href='./style/confirmation.css'>";

echo  "<script>alert('Confirmation code is sent to your email !')</script>";

$confirmation_code = $_SESSION['code'];
$fullName = $_SESSION['fullname'];
$email = $_SESSION['email'];
$country = $_SESSION['country'];
$phoneNumber = $_SESSION['phone'];
$password = $_SESSION['password'];

if (isset($_POST['confirm'])) {
    $input_code = (int) $_POST['input-code'];
    $security_question = $_POST['question'];
    $answer = $_POST['answer'];
    $security_pin = $_POST['pin'];

    $erorr = [
        'empty' => '',
        'different_codes' => '',
        'pin' => ''
    ];

    if ($input_code || $answer || $security_pin) {
        $erorr['empty'] = "<script>alert('No fields can be empty!')</script>";
        echo $erorr['empty'];
    } else if ($input_code != $confirmation_code) {
        $erorr['different_codes'] = "<script>alert('Wrong confirmation code !')</script>";
        echo $erorr['different_codes'];
    } else if (strlen($security_pin) > 4) {
        $error['pin'] = "<script>alert('Pin must be 4 characters long!')<script>";
        $erorr['pin'];
    }

    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }

    if (empty($error)) {
        if (registerUser($fullName, $email, $country, $phoneNumber, $password, $security_question, $answer, $security_pin)) {
            $success_message = "<script>alert('Account Registration Successful !')</script>";
            $_SESSION['success_message'] = $success_message;
            return header('Location:home.php');
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
    <title>Confirm</title>
</head>

<body>
    <form action="" method="post">
        <h2>Confirm your registration !</h2>
        <p>Check your email for confirmation code</p>
        <input type="text" placeholder="Confirmation code" name="input-code">
        <!--security question block-->
        <div class="question-block" style="display:flex; flex-direction:column">
            <select name="question" id="">
                <option value="default">Select a security question</option>
                <option value="What is the name of you favorite pet?">What is the name of you favorite pet?</option>
                <option value="Where do you live?">Where do you live?</option>
                <option value="Where do you go for vacation?">Where do you go for vacation?</option>
            </select>
            <input type="text" placeholder="secuiry answer" name="answer">
        </div>
        <input type="text" placeholder="security pin" name="pin">
        <input type="submit" name="confirm" value="Confirm">
    </form>
</body>

</html>