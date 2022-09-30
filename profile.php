<!DOCTYPE html>
<html lang="en">

<?php
try {
    
    include('./functions.php');
    include('./auth.php');
    $fullname = $_SESSION['fullname'];
    echo "<link rel='stylesheet' href='./style/profile.css'>";

    if (isset($_POST['request'])) {
        $email = $_SESSION['email'];
        if (request_password_change($email)) {
            echo "<script>alert('A request has been submitted')</script>";
        }
    }
} catch (\Throwable $th) {
    throw $th;
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title><?php echo $_SESSION['fullname'] ?></title>
</head>

<body>
    <!--navigation bar-->
    <div class="navbar">
        <div class="logo">
            <img src="./images/medals.jpg" alt="">
        </div>
        <div class="nav-items">
            <div class="nav-link">
                <i class="fa-solid fa-house"></i>
                <a href="./home.php">Home</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-radio"></i>
                <a href="./news.php">News</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tv"></i>
                <a href="./videos.php">Videos</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-images"></i>
                <a href="./gallery.php">Gallery</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-ranking-star"></i>
                <a href="./fixtures.php">Fixtures</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tower-broadcast"></i>
                <a href="live.php" target='_blank'>Live</a>
            </div>
        </div>

        <!--btns-->
        <div class="nav-btns">
            <!--profile-->
            <a href="profile.php" id='profile'><?php echo $fullname?>
                <i class="fa-solid fa-circle"></i>
            </a>

            <form action="" method="post" style="align-self: center;">
                <a href="./logout.php" class="login-btn" type="submit" name="sign-out">
                    Sign Out
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </form>
        </div>
    </div>

    <div class="container">
        <?php
        global $db_connection;
        $email = $_SESSION['email'];
        $query = "SELECT * FROM user_information where email='$email'";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $fullname = $row['full_name'];
            $email = $row['email'];
            $country = $row['country'];
            $phone_number = $row['phone_number'];
        }
        ?>
        <h2>User Details</h2>
        <div class="display-block">
            <p>Full Name</p>
            <p><?php echo $fullname ?></p>
        </div>
        <div class="display-block">
            <p>Email</p>
            <p><?php echo $email ?></p>
        </div>
        <div class="display-block">
            <p>Country</p>
            <p><?php echo $country ?></p>
        </div>
        <div class="display-block">
            <p>Phone Number</p>
            <p><?php echo $phone_number ?></p>
        </div>

        <form action="" method="post">
            <button type="submit" name="request">Request password reset</button>
        </form>
    </div>


</body>

</html>