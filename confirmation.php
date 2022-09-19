<?php


    include('./auth.php');
    include('./functions.php');
    echo "<link rel='stylesheet' href='./style/confirmation.css'>";
    


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

        if ($confirmation_code == $input_code) {
            echo $security_pin.$answer.$security_question;
            registerUser($fullName, $email, $country, $phoneNumber, $password, $security_question, $answer, $security_pin);
        }
        else{

        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css file-->
    <!-- <link rel="stylesheet" href="./style/confirmation.css"> -->
    <title>Confirm</title>
</head>

<body>
    <?php echo
    $_SESSION['code']
        . $_SESSION['fullname']
        . $_SESSION['email']
        . $_SESSION['country']
        . $_SESSION['phone']
        . $_SESSION['password'];
    ?>
    <?php echo $security_question?>
    <form action="" method="post">
        <h2>Confirm your registration !</h2>
        <p>Check your email for confirmation code</p>
        <input type="text" placeholder="Confirmation code" name="input-code">
        <p name='resend_confirmation' id="resend-confirmation">Resend confirmation code</p>
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