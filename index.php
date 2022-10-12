<?php
try {
    include('./database.php');
    include('./functions.php');
    echo "<link rel='stylesheet' href='../StreamingService/style/index.css'>";
    $_SESSION['index'] = "<script>alert('Please register/ login to procced')</script>";
} catch (\Throwable $th) {
    throw $th;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->

    <title>Bajiyang Olympic 2022</title>
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
                <a href="index.php">Home</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-radio"></i>
                <a href="signup.php">News</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tv"></i>
                <a href="signup.php">Videos</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-images"></i>
                <a href="signup.php">Gallery</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-ranking-star"></i>
                <a href="signup.php">Fixtures</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tower-broadcast"></i>
                <a href="signup.php">Live</a>
            </div>
        </div>
        <div class="nav-btns">
            <a href="signup.php" id="#register">Sign Up <i class="fa-solid fa-user-plus"></i></a>
            <a href="login.php" id="#login">Sign In<i class="fa-solid fa-right-to-bracket"></i></a>
        </div>
    </div>

    <!--landing section-->
    <div class="main-container">
        <video src="./admin/uploads/background-video.mp4" autoplay muted loop></video>
        <div class="background"></div>
        <div class="redirect">
            <h1>Bayjing FunOlympic</h1>
            <p>A streaming service for Bajiyang FunOlympic games 2022</p>
            <a href="#offer">Explore</a>
        </div>
    </div>

    <!--offer-->
    <div class="offer" id="offer">
        <h1>What do we offer ?</h5>
            <div class="offer-section">
                <div class="card">
                    <i class="fa-solid fa-tower-broadcast"></i>
                    <h3>Live Stream</h3>
                </div>
                <div class="card">
                    <i class="fa-solid fa-tv"></i>
                    <h3>Videos</h3>
                </div>
                <div class="card">
                <i class="fa-solid fa-ranking-star"></i>
                    <h3>Fixtures</h3>
                </div>
                <div class="card">
                    <i class="fa-solid fa-radio"></i>
                    <h3>News</h3>
                </div>
                <div class="card">
                <i class="fa-solid fa-radio"></i>
                    <h3>Gallery</h3>
                </div>
            </div>
    </div>

    <!--news section-->
    <div class="news-container" id="latest-container">
        <h1>Latest about FunOlympic 2022</h1>

        <div class="card-section">
            <?php
            global $db_connection;
            $query = "SELECT * FROM news ORDER BY news_id DESC limit 3";
            $result = mysqli_query($db_connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $news_title = $row['news_title'];
                $uploaded_date = $row['news_date'];
                $description = $row['news_description'];
                $path = $row['image_path'];

                echo "
            <div class='card'>
            <img src='./admin/uploads/$path'>
             <div class='news-info'>
              <h3>$news_title</h3>
              <p>$uploaded_date</p>
              <p>$description</p>
             </div>
            </div>
            ";
            }
            ?>
        </div>

        <div class="fixtures-section">
            <?php
            $query = "SELECT * FROM fixtures ORDER BY fixture_id DESC limit 5";
            $result = mysqli_query($db_connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $fixture_title = $row['fixture_title'];
                $fixture_date = $row['fixture_date'];
                echo "        
                   <div class='fixture-card'>
                    <p id='title'>$fixture_title</p>
                    <p id='date'>$fixture_date</p>
                    </div>
                     ";
            }
            ?>
        </div>

        <a href="./signup.php" id="more-news">More News</a>
    </div>
    <div class="contact-us">
        <!--social media-->
        <div class="social-media">
            <i class="fa-brands fa-facebook" title="Facebook"></i>
            <i class="fa-brands fa-instagram" title="Instagram"></i>
            <i class="fa-brands fa-tiktok" title="Tiktok"></i>
            <i class="fa-brands fa-twitter" title="Twitter"></i>
        </div>
        <!--copyright-->
        <div class="copyright">
            <p>All right reserved @ Fun Olympic Comittee &copy;</p>
        </div>
        <!--contact info-->
        <div class="contact-info">
            <i class="fa-solid fa-envelope"></i>
            <p>olympicComittee@gmail.com</p>
        </div>
    </div>

    <script src="../js/index.js"></script>
</body>

</html>