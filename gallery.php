<?php
try {
    include('./functions.php');
    include('./database.php');
    echo "<link rel='stylesheet' href='./style/gallery.css'>";
    echo "<link rel='icon' type='image/x-icon' href='./images/icon.ico'>";
    $fullname = $_SESSION['fullname'];
} catch (\Throwable $th) {
    throw $th;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
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

    <!--gallery section-->
    <div class="gallery">
        <div class="heading">
            <h2>Images</h2>
        </div>
        <div class="images-section">
            <?php
            global $db_connection;
            $query = "SELECT * FROM images";
            $result = mysqli_query($db_connection, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $image_id = $row['image_id'];
                    $image_path = $row['image_path'];
                    $image_caption = $row['image_caption'];
                    $image_category = $row['image_category'];
                    $upload_date = $row['upload_date'];

                    echo "
                    <img src='./admin/uploads/$image_path'>
                      ";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>