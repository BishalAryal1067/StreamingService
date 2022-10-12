<?php

try {
    include('./database.php');
    include('./functions.php');
    echo "<link rel='stylesheet' href='./style/view-video.css'>";
    $id = $_GET['data'];
    $email = $_SESSION['email'];
    $fullname = $_SESSION['fullname'];

    if (isset($_POST['like'])) {
        $action = 'liked';
        $query = "INSERT into likes(video_id,email,action) VALUES($id, '$email','$action')";
        $result = mysqli_query($db_connection, $query);
    }

    if (isset($_POST['unlike'])) {
        $query = "DELETE FROM likes WHERE email='$email'";
        mysqli_query($db_connection, $query);
    }
} catch (\Throwable $th) {
    throw $th;
}

try {
    if (isset($_POST['add-comment'])) {
        $comment = $_POST['comment'];
        global $db_connection;
        $comment_date = date('Y-m-d') . ' ' . date('H:i:sa');
        $query = "INSERT INTO comment(video_id, user_email, comment, comment_date) 
                 VALUES($id, '$email', '$comment', '$comment_date')";
        $result = mysqli_query($db_connection, $query);
    }
} catch (\Throwable $th) {
    throw $th;
}

try {
    global $db_connection;
    $query = "SELECT * FROM likes WHERE video_id=$id AND action='liked'";
    $result = mysqli_query($db_connection, $query);
    $likes_count = mysqli_num_rows($result);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $_GET['title'] ?></title>
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
                <a href="live.php">Live</a>
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
        $query =  "SELECT * FROM videos WHERE video_id=$id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $path = $row['video_path'];
            $title = $row['video_title'];
            $upload_date = $row['video_date'];
            $description = $row['video_description'];
            $views = $row['view_count'];
            echo "<iframe src='$path?autoplay=1' frameborder=0 allowfullscreen style='width:100%; height:60vh;' autoplay></iframe>";
        }

        ?>
        <div class="description">
            <h3><?php echo $title ?></h3>
            <p class='upload-date'>Uploaded on: <?php echo $upload_date; ?> </p>
            <p class='video-description'><?php echo $description ?></p>
        </div>
        <div class="interaction-section">
            <div class="info">
                <p><?php echo $views . ' ' ?> Views</p>
                <p><?php echo $likes_count . ' ' ?>Likes</p>
            </div>

            <?php
            if ($likes_count == 0) {
                echo "<form method='post' style='height:100%; display:flex; align-items:center; margin:0; padding:0'>
                <button type='submit' name='like' class='like-btn'><i class='fa-regular fa-thumbs-up'></i>Like</button>
              </form>";
            } else {
                echo "<form method='post' style='height:100%; display:flex; align-items:center; margin:0; padding:0'>
                <button type='submit' name='unlike' class='unlike-btn'><i class='fa-regular fa-thumbs-up' style='background-color:#16A6F1; color:white;'></i>Liked</button>
              </form>";
            }
            ?>
            <button type="submit" name='share' class="share-btn"><i class="fa-solid fa-share"></i>Share</button>
        </div>
        <?php update_view($id, $views); ?>
        <div class="comment-section">
            <form action="" method="post">
                <input type="text" name='comment' placeholder="Add a comment">
                <button type="submit" name='add-comment'>Comment</button>
            </form>
        </div>
        <div class="display-comments" style="overflow-y:scroll;">
            <?php
            global $db_connection;
            $query = "SELECT * FROM comment WHERE video_id=$id ORDER BY comment_id DESC";
            $result = mysqli_query($db_connection, $query);
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                global $db_connection;
                $user = $row['user_email'];
                $comment = $row['comment'];

                $user_select = mysqli_query($db_connection, "SELECT * FROM user_information WHERE email='$user'");
                while ($row = mysqli_fetch_assoc($user_select)) {

                    $user_name = $row['full_name'];
                    echo "<div id='comment-box'>
                    <p id='username'>$user_name :</p> <p id='comment'>$comment</p>'
                    </div>'";
                }
            }

            ?>
        </div>
    </div>

    <!--share popup-->
    <div class="pop-up">
        <i class="fa-solid fa-circle-xmark" id="close"></i>
        <?php
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <p>Copy this link to share the video</p>
        <input type="text" name="" id="" value="<?php echo $url ?>" disabled>
    </div>

    


    <script>
        let shareBtn = document.querySelector('.share-btn');
        let pop_up = document.querySelector('.pop-up');
        let closeBtn = document.querySelector('#close');
        shareBtn.addEventListener('click', () => {
            pop_up.classList.add('active-pop-up');
        });

        closeBtn.addEventListener('click', ()=>{
            pop_up.classList.remove('active-pop-up');
        })
    </script>


</body>

</html>