<?php
//importing necessary file
require './emailHandler/emailHandler.php';

//function to send confirmation to user attempting registration
function signUpConfirmation($user_email){
    //generating confirmation code, setting up email body and subject
    $confirmation_code = random_int(0, 10000);
    $email_subject="Dear User, Confirm you registration !";
    $email_body=`The confirmation code is: $confirmation_code`;

    //calling the function to send email with essential parameters
    sendMail($user_email, $email_subject, $email_body);
}


