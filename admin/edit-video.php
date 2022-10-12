<?php

try {
    include('../functions.php');
    include('../database.php');
    echo "<link rel='stylesheet' href='../style/edit-page.css'>";


    if (isset($_GET['data'])) {
        $video_id = $_GET['edit'];
        $query = "SELECT * FROM videos where video_id=$video_id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $video_title = $row['video_title'];
            $video_description = $row['video_description'];
            $video_url = $row['video_path'];
        }
    }

    if (isset($_POST['update-video'])) {
        $video_title = $_POST['video-title'];
        $path = $_POST['path'];
        $video_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $video_description = $_POST['video-description'];
        $video_category = $_POST['video-category'];

        $message = [
            'empty_error' => ""
        ];


        if (empty($video_title) || empty($path) || empty($video_category)) {
            $message['empty_error'] = "<script language='javascript' type='text/javascript'>
            alert('No field can be empty');
                </script> ";
            echo $message['empty_error'];
        }

        foreach ($message as $key => $value) {
            if (empty($value)) {
                unset($message[$key]);
            }
        }

        if (empty($message)) {
            if (update_videos($video_id, $path, $video_title, $video_description, $video_date, $video_category)) {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Video successfully updated');
                </script>
              ";
                header("Location:admin-dashboard.php");
            } else {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Something went wrong');
                </script>
              ";
            }
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit video</title>
</head>

<body>
    <!--navigation bar-->
    <!--navigation bar-->
    <div class="navbar">
        <div class="logo">
            <img src="./images/medals.jpg" alt="">
        </div>
        <div class="nav-items">
            <div class="nav-link">
                <i class="fa-solid fa-house"></i>
                <a href="admin-dashboard.php">Home</a>
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

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Edit video details</h3>
        <input type="text" name="video-title" id="" placeholder="Video Title.." value="<?php echo $video_title ?>">
        <input type="text" name='path' placeholder="Enter video url / link..." value="<?php echo $video_url ?>">
        <textarea name="video-description" id="textarea" cols="37" rows="6" value="<?php echo $video_description ?>"></textarea>
        <?php
        echo "<script>
            let textarea = document.querySelector('#textarea');
            textarea.value = '$video_description';
         </script>";
        ?>
        <select name="video-category" id="">
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
        </select>
        <button type="submit" name="update-video">Update</button>
    </form>
</body>

</html>