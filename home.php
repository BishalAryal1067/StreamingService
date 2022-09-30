<?php
include('./functions.php');
include('./auth.php');
include('./database.php');
echo "<link rel='stylesheet' href='./style/user-dashboard.css'>";
echo "<link rel='icon' type='image/x-icon' href='./images/icon.ico'>";
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
try {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
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
    <!--font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--external css-->
    <title>Home</title>
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

    <!--mid-section-->
    <div class="mid-section">
        <form action="search-results.php" method="post">
            <input type="search" name="search" id="" placeholder="Search">
        </form>
        <form action="filter-results.php" method="post" id="category-select">
            <i class="fa-solid fa-filter"></i>
            <p>Filter By:</p>
            <select name="filter-option" id="category_filter" onchange="changeCategory()">
                <option value="default">Select a category</option>
                <?php echo fetch_options(); ?>
            </select>
        </form>
    </div>
    <!--landing section-->
    <div class="landing-section">
        <!--video section-->
        <div class="video-section">
            <div class="heading">
                <h2>Videos</h2>
                <a href="./videos.php">More Videos</a>
            </div>
            <!--video cards-->
            <div class="card-section">
                <?php
                global $db_connection;
                $result = mysqli_query($db_connection, "SELECT * FROM videos limit 3");
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['video_id'];
                    $path = $row['video_path'];
                    $title = $row['video_title'];
                    $upload_date = $row['video_date'];

                    echo "
                   <div class= 'video-card'>
                      <iframe src='$path' frameborder=0 allowfullscreen></iframe>
                      <div class='card-heading'>
                         <p>$title</p>
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
        <!--fixture section-->
        <div class="fixture-section">
            <div class="heading">
                <h2>Fixtures</h2>
                <a href="./fixtures.php">More Fixtures</a>
            </div>
            <div class="card-section">
                <!--fixture cards-->
                <?php

                global $db_connection;

                $query = "SELECT * FROM fixtures ORDER BY fixture_id DESC limit 4";
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
        </div>
        <!--news section-->
        <div class="news-section">
            <div class="heading">
                <h2>News</h2>
                <a href="./news.php">More News</a>
            </div>
            <div class="card-section">
                <!--fixture cards-->
                <?php
                global $db_connection;

                $query = "SELECT * FROM news ORDER BY news_id DESC limit 4";
                $result = mysqli_query($db_connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $news_id = $row['news_id'];
                    $path = $row['image_path'];
                    $news_title = $row['news_title'];
                    $description = $row['news_description'];
                    $uploaded_date = $row['news_date'];
                    echo "
                        <div class='news-card'>
                        <img src='./admin/uploads/$path'>
                         <div class='news-info'>
                          <h3>$news_title</h3>
                          <p>$uploaded_date</p>
                          <p>$description</p>
                         </div>
                         <div class='footer'>
                           <a href='./view-news.php?data=$news_id&title=$news_title' id='view'>View</a>
                         </div>
                        </div>
                        ";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function changeCategory() {
            document.getElementById('category-select').submit();
        }
    </script>
</body>

</html>