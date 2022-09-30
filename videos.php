<?php
include('./functions.php');
include('./database.php');
echo "<link rel='stylesheet' href='./style/video.css'>";
echo "<link rel='icon' type='image/x-icon' href='./images/icon.ico'>";
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    
    <title>Videos</title>
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

    <div class="main-section">
        <div class="heading">
           <h2>Videos</h2>
        </div>
        <div class="video-section">
            <?php
            global $db_connection;
            $result = mysqli_query($db_connection, "SELECT * FROM videos ORDER BY video_id");
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['video_id'];
                $path = $row['video_path'];
                $title = $row['video_title'];
                $upload_date = $row['video_date'];

                echo "
                   <div class='video-card'>
                      <iframe src='$path' frameborder=0 allowfullscreen></iframe>
                      <div class='card-heading'>
                         <h3>$title</h3>
                         <p>Uploaded on: $upload_date</p>
                      </div>
                      <div class='footer'>
                        <a href='./view-video.php?data=$id&title=$title' id='view'>View</a>
                      </div>
                   </div>
                 ";
            }
            ?>
        </div>

    </div>

</body>



</html>