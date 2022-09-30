<?php
try {
    include('./functions.php');
    include('./database.php');
    echo"  <link rel='stylesheet' href='./style/filter-results.css'>";
    $fullname = $_SESSION['fullname'];

    if (isset($_POST['filter-option'])) {
        $category = $_POST['filter-option'];
    }
} catch (\Throwable $th) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Filter Results</title>
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


    <div class="container">
        <div class="video-section">
            <div class="heading">
                <h2>Video</h2>
            </div>

            <div class="card-section">
                <?php
                $video_query = "SELECT * FROM videos WHERE video_category='$category'";
                $video_filter = mysqli_query($db_connection, $video_query);
                while ($row = mysqli_fetch_assoc($video_filter)) {
                    $video_id = $row['video_id'];
                    $video_path = $row['video_path'];
                    $video_title = $row['video_title'];
                    $video_category = $row['video_category'];
                    $upload_date = $row['video_date'];
                    $iframe_options = 'rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0';
                    $new_path = $video_path . $iframe_options;


                    echo "
                <div class= 'video-card'>
                   <iframe src='$video_path' frameborder=0 allowfullscreen></iframe>
                   <div class='card-heading'>
                      <h4>$video_title</h4>
                      <p>Uploaded on: $upload_date</p>
                   </div>
                   <div class='footer'>
                     <a href='./view-video.php?data=$video_id&title=$video_title' id='view'>View</a>
                   </div>
                </div>
              ";
                }
                ?>
            </div>



        </div>


        <div class="news-section">
            <div class="heading">
                <h2>News</h2>
            </div>
            <div class="card-section">
                <?php
                global $db_connection;
                $query = "SELECT * FROM news WHERE news_category='$category'";
                $result = mysqli_query($db_connection, $query);
                $total_news = mysqli_num_rows($result);
                if($total_news==0){
                    echo "<h3>No matching news found</h3>";
                }
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
                      <h4>$news_title</h4>
                      <p>$uploaded_date</p>
                      <p>$description</p>
                     </div>
                     <div class='footer'>
                       <a href='./view-news.php?data=$news_id&title=$title' id='view'>View</a>
                     </div>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
        <div class="fixture-section">
            <div class="heading">
                <h2>Fixtures</h2>
            </div>

            <div class="card-section">
                <?php
                global $db_connection;
                $query = "SELECT * FROM fixtures WHERE fixture_category='$category'";
                $result = mysqli_query($db_connection, $query);
                $total_fixtures = mysqli_num_rows($result);
                if ($total_fixtures == 0) {
                    echo "<p>No matching fixtures found</p>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $fixture_title = $row['fixture_title'];
                        $fixture_date = $row['fixture_date'];
                        echo "        
                        <div class='fixture-card'>
                         <h4 id='title'>$fixture_title</h4>
                         <p id='date'>$fixture_date</p>
                         </div>
                        ";
                    }
                }

                ?>
            </div>

        </div>
    </div>
</body>

</html>