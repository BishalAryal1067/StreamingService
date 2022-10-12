<?php
try {
    include('./database.php');
    include('./functions.php');
    echo "<link rel='stylesheet' href='./style/view-video.css'>";
    $id = $_GET['data'];
    $email = $_SESSION['email'];
    $fullname = $_SESSION['fullname'];


    if (isset($_POST['like'])) {
        $action = 'liked';
        $query = "INSERT into likes(video_id,email,action) VALUES($id, '$email','$action')";
        $result = mysqli_query($db_connection, $query);
    }
} catch (\Throwable $th) {
    throw $th;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>View Live</title>
</head>

<body>

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
                <a href="live.php">Live</a>
            </div>
        </div>

        <!--btns-->
        <div class="nav-btns">
            <!--profile-->
            <a href="profile.php" id='profile'><?php echo $fullname ?>
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

    <div class="main-container">
        <?php
        global $db_connection;
        $query =  "SELECT * FROM live WHERE live_id=$id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $url = $row['url'];
            $title = $row['live_title'];
            echo "<iframe src='$url?modestbranding=1&showinfo=0&fs=0&autoplay=1&controls=0' title='$title'  frameborder=0 allowfullscreen style='width:100%; height:80vh;' autoplay></iframe>";
        }
        ?>
    </div>
</body>

</html>