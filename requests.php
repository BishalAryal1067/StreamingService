<?php
include('./auth.php');
include('./functions.php');
include('./database.php');
echo "<link rel='stylesheet' href='./style/requests.css'>";


if(isset($_GET['action'])){
    $email = $_GET['email'];
    $subject="Regarding password reset request";
    $body = "<h3>To reset your password <a style='width:auto; height:auto; padding:.75em 1.5em; margin:0 2.5em; background-color:navy; color:white;' href='http://localhost:3500/StreamingService/reset-password.php?email=$email'>Click here</a></h3>";

    function delete($email){
        global $db_connection;
        $query = "DELETE FROM password_requests WHERE requested_by='$email'";
        mysqli_query($db_connection,$query);  
    }

    if(sendMail($email, $subject,$body)){
        echo "<script>alert('An email has been sent to the user!')</script>";
        delete($email);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='./style/requests.css'>
    <title>Document</title>
</head>
<body>
   <!--navigation bar------------------------------------------------------------->
   <div class="navbar">
        <div class="logo">
            <img src="../images/medals.jpg" alt="">
        </div>
        <div class="nav-items">
            <div class="nav-link">
                <i class="fa-solid fa-house"></i>
                <a href="../home.php" target='_blank'>Home</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-radio"></i>
                <a href="../news.php" target='_blank'>News</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tv"></i>
                <a href="../videos.php" target='_blank'>Videos</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-images"></i>
                <a href="../gallery.php" target='_blank'>Gallery</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-ranking-star"></i>
                <a href="../fixtures.php" target='_blank'>Fixtures</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tower-broadcast"></i>
                <a href="../live.php" target='_blank'>Live</a>
            </div>
        </div>
        <div class="nav-btns">
            <a href="../requests.php" target='_blank'><i class="fa-solid fa-bell"></i></a>
            <a href='../logout.php' class="login-btn">
                Sign Out
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>

    <div class="container">
        <h2>Password Reset Requests</h2>
        <table>
        <th>Requested By</th>
        <th>Requesed Date</th>
        <th>Action</th>

        <?php
           global $db_connection;
           $query = "SELECT * FROM password_requests";
           $result = mysqli_query($db_connection,$query);
           while($row= mysqli_fetch_assoc($result)){
             $requested_by = $row['requested_by'];
             $request_date =$row['request_date'];

             echo "
               <tr>
                  <td>$requested_by</td>
                  <td>$request_date</td>
                  <td><a href='requests.php?action=reset&email=$requested_by'?>Reset</a></td>
               </tr>
             ";
           }

         ?>
    </table>
    </div>

    
</body>
</html>