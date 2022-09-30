<?php

include('./database.php');
include('./functions.php');
$id = $_GET['data'];
$email = $_SESSION['email'];
echo "<link rel='stylesheet' href='./style/view-news.css'>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View News</title>
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
                <i class="fa-solid fa-circle-info"></i>
                <a href="./about.php">About Us</a>
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
        <?php
        global $db_connection;
        $query =  "SELECT * FROM news WHERE news_id=$id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $news_id = $row['news_id'];
            $news_title = $row['news_title'];
            $path = $row['image_path'];
            $description = $row['news_description'];
            $date = $row['news_date'];
            $category = $row['news_category'];
        }
        ?>

        <div class="news">
            <img src="./admin/uploads/<?php echo $path ?>" alt="" width="400" height="400">
            <h2><?php echo $news_title ?></h2>
            <p><?php echo $date ?></p>
            <p><?php echo $description ?></p>
        </div>
    </div>
</body>

</html>