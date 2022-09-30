<?php
try {
    include('../functions.php');
    include('../database.php');
    echo "<link rel='stylesheet' href='./style/edit-page.css'>";
    if (isset($_GET['data'])) {

        global $db_connection;
        $image_id = $_GET['edit'];
        $query = "SELECT * FROM images WHERE image_id=$image_id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $image_id = $row['image_id'];
            $image_caption = $row['image_caption'];
            $image_category = $row['image_category'];
            $upload_date = $row['upload_date'];
        }
    }

    if (isset($_POST['update-image'])) {
        $image_caption = $_POST['image-caption'];
        $path = $_FILES['image']['name'];
        $path_temp = $_FILES['image']['tmp_name'];
        $image_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $image_category = $_POST['image-category'];
        $allowed_files = array('jpg', 'jpeg', 'png');
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $message = [
            'extension_error' => "",
            'empty_error' => ""
        ];


        if (empty($image_caption) || empty($path) || empty($image_category)) {
            echo "<script>alert('if checked')</script>";
            $message['empty_error'] = "<script language='javascript' type='text/javascript'>
            alert('File format not supported! Supported Files(jpg, jpeg, png)');
                </script> ";
            echo $message['empty_error'];
        } else if (!empty($path) && !in_array($ext, $allowed_files)) {
            $message['extension_error'] = "  <script language='javascript' type='text/javascript'>
            alert('File format not supported! Supported Files(jpg, jpeg, png)');
                </script> ";
            echo $message['extension_error'];
        }

        foreach ($message as $key => $value) {
            if (empty($value)) {
                unset($message[$key]);
            }
        }


        if (empty($message)) {
            move_uploaded_file($path_temp, 'uploads/' . $path);
            echo $image_id, $path, $image_caption, $image_category, $image_date;
            if (update_images($image_id, $path, $image_caption, $image_category, $image_date)) {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Image successfully updated');
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
    <title>Edit Image Details</title>
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
    <!--image update form-->
    <form action='' method='post' enctype='multipart/form-data' class="image-form">
        <h3>Update image details</h3>
        <input type='text' name='image-caption' value='<?php echo $image_caption ?>'>
        <input type='file' name='image' placeholder='Choose image'>
        <select name='image-category' id=''>
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
        </select>
        <button type='submit' name='update-image'>Update</button>
    </form>
</body>

</html>