<?php

try {
    include('../functions.php');
    include('../database.php');
    echo "<link rel='stylesheet' href='../style/edit-page.css'>";

    if (isset($_GET['data'])) {
        global $db_connection;
        $news_id = $_GET['edit'];
        $query = "SELECT * FROM news WHERE news_id=$news_id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $news_title = $row['news_title'];
            $path = $row['image_path'];
            $description = $row['news_description'];
        }
    }

    if (isset($_POST['update-news'])) {
        $news_title = $_POST['news-title'];
        $news_path = $_FILES['news-image']['name'];
        $path_temp_news = $_FILES['news-image']['tmp_name'];
        $news_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $news_description = $_POST['news-description'];
        $news_category = $_POST['news-category'];
        $allowed_files = array('jpg', 'png', 'jpeg');
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $message = [
            'extension_error' => "",
            'empty_error' => ""
        ];

        if (empty($news_title)) {
            $message['empty_error'] = "<script language='javascript' type='text/javascript'>
            alert('No field can be empty');
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

            if (update_news($news_id, $news_title, $news_path, $news_description, $news_date, $news_category)) {
                move_uploaded_file($path_temp_news, 'uploads/' . $path_temp_news);
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('News successfully added');
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit News</title>
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
        <h3>Edit News</h3>
        <input type="text" name="news-title" id="" placeholder="News title.." value="<?php echo $news_title ?>">
        <textarea name="news-description" id="" cols="36" rows="7" placeholder="News description..." id="news-description"></textarea>
        <?php
        echo "
               <script>
                let description = document.querySelector('#news-description');
                description.value = $description;
               </script>
            ";
        ?>
        <input type="file" name="news-image" id="" placeholder="Choose image">
        <select name="news-category" id="">
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
        </select>
        <button type="submit" name="update-news">Update</button>
    </form>
</body>

</html>