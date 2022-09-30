<?php

try {
    include('./functions.php');
    include('./database.php');
    $fullname = $_SESSION['fullname'];
    echo "<link rel='stylesheet' href='./style/search-results.css'>";
} catch (\Throwable $th) {
    throw $th;
}

if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Search Results</title>
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
        <h1>Search results for: <?php echo $search_query ?></h1>
        <div class="video-results">
            <h2>Videos</h2>
            <div class="card-section">
                <?php
                global $db_connection;
                $query = "SELECT * FROM videos WHERE video_description LIKE '%$search_query%' OR video_title LIKE '%$search_query%'";
                $search_video = mysqli_query($db_connection, $query);
                $total_video_count = mysqli_num_rows($search_video);
                if ($total_video_count == 0) {
                    echo "<h3>No matching videos found</h3>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_video)) {
                        $id = $row['video_id'];
                        $video_path = $row['video_path'];
                        $video_title = $row['video_title'];
                        $video_description = $row['video_description'];
                        $upload_date = $row['upload_date'];
                        echo "
                     <div class= 'video-card'>
                        <iframe src='$video_path' frameborder=0 allowfullscreen></iframe>
                        <div class='card-heading'>
                           <p>$video_title</p>
                           <p>Uploaded on: $upload_date</p>
                        </div>
                        <div class='footer'>
                          <a href='./view-video.php?data=$id&title=$video_title' id='view'>View</a>
                        </div>
                     </div>
                     ";
                    }
                }
                ?>
            </div>
        </div>


        <div class="news-results">
            <h2>News</h2>
            <div class="card-section">
                <?php
                global $db_connection;
                $query = "SELECT * FROM news WHERE news_description LIKE '%$search_query%' OR news_title LIKE '%$search_query%'";
                $search_news = mysqli_query($db_connection, $query);
                $total_news_count = mysqli_num_rows($search_news);
                if ($total_news_count == 0) {
                    echo "<h3>No matching news found</h3>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_news)) {
                        $news_id = $row['news_id'];
                        $image_path = $row['image_path'];
                        $news_title = $row['news_title'];
                        $news_description = $row['news_description'];
                        $news_date = $row['news_date'];

                        echo "
                           <div class='news'>
                             <img src='admin/uploads/$image_path'>
                              <h3>$news_title</h3>
                              <p>$news_date</p>
                              <div class='footer'>
                              <a href='./view-news.php?data=$news_id&title=$news_title' id='view'>View</a>
                              </div> 
                           </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
        <div class="fixture-results">
            <h2>Fixtures</h2>
            <div class="card-section">
                <?php
                global $db_connection;
                $query = "SELECT * FROM fixtures WHERE fixture_title LIKE '%$search_query%'";
                $search_fixture = mysqli_query($db_connection, $query);
                $total_fixture_count = mysqli_num_rows($search_fixture);
                if ($total_fixture_count == 0) {
                    echo "<h3>No matching fixtures found</h3>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_fixture)) {
                        $fixture_id = $row['fixture_id'];
                        $fixture_title = $row['fixture_title'];
                        $fixture_date = $row['fixture_date'];
                        echo "
                        <div class='fixture-card'>
                        <div class='card-header'>
                        <h4>$fixture_title</h4>
                        <p>$fixture_date</p>
                        </div>
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