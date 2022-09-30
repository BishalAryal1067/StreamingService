<?php
try {
    include('../functions.php');
    include('../database.php');
    echo "<link rel='stylesheet' href='./style/edit-page.css'>";
    if (isset($_GET['data'])) {
        global $db_connection;
        $live_id = $_GET['edit'];
        $query = "SELECT * FROM live WHERE live_id=$live_id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $url = $row['url'];
        }
    }

    if (isset($_POST['update-live'])) {
        $live_title = $_POST['live-title'];
        $live_url = $_POST['url'];
        $live_category = $_POST['live-category'];

        $message = [
            'empty_error' => ""
        ];

        if (empty($live_title) || empty($live_url) || empty($live_category)) {
            echo "<script>alert('if checked')</script>";
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
            if (update_live($live_id, $live_title, $live_url, $live_category)) {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Live video successfully updated');
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
    //throw $th;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Live Video</title>
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
    <form action="" method="post">
        <h3>Edit Live Video</h3>
        <input type="text" name="live-title" id="" placeholder="Live Match Title..." value="<?php echo $title?>">
        <input type="text" name="url" id="" placeholder="URL..." value="<?php echo $url?>">
        <select name="live-category" id="">
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }

            ?>
        </select>
        <button type="submit" name="update-live">Update</button>
    </form>
</body>

</html>