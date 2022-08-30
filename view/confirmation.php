<?php

include __DIR__.("../controllers/auth.php");

try {
    
} catch (Error $err) {
    echo $err;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css file-->
    <link rel="stylesheet" href="../style/confirmation.css">
    <title>Confirm</title>
</head>

<body>
    <form action="" method="post">
        <h2>Confirm your registration !</h2>
        <p>Check your email for confirmation code</p>
        <input type="text" placeholder="Confirmation code">
        <p name='resend_confirmation' id="resend-confirmation">Resend confirmation code</p>
        <!--security question block-->
        <div class="question-block" style="display:flex; flex-direction:column">
            <select name="" id="">
                <option value="default">Select a security question</option>
                <option value="">What is the nam of you favorite pet?</option>
                <option value="">Is nabin bhandari a landari?</option>
                <option value="">Does attey eat Kera?</option>
            </select>
            <input type="text" placeholder="secuiry answer">
        </div>
        <input type="text" placeholder="security pin">
        <input type="submit" value="Confirm">
    </form>

    <?php echo $fullname ?>
</body>

</html>