<?php
include('./functions.php');
include('./auth.php');
include('./database.php');

$fullname = $_SESSION['fullname'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css-->
    <link rel="stylesheet" href="./style/news.css">

    <title>News</title>

    <style>

    </style>

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

    <!--main section-->
    <div class="main-section">
        <div class="heading">
            <h2>News</h2>
        </div>
        <div class="news-section">
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
</body>

</html>