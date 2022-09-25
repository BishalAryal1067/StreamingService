<?php
try {
    include('./database.php');
    include('./functions.php');
    $id = $_GET['data'];
    $email = $_SESSION['email'];
    echo $email;
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['title'] ?></title>
</head>

<body>
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
            echo "<iframe src='$path' frameborder=0 allowfullscreen style='width:75%; height:60vh;'></iframe>";
        }
        ?>
        <div class="description">
            <h3><?php echo $title ?></h3>
            <p class='upload-date'>Uploaded on: <?php echo $upload_date; ?> </p>
            <p class='video-description'><?php echo $description ?></p>
        </div>
        <div class="interaction-section">
            <div class="info">
                <p><?php echo $views . ' views' ?></p>
                <p><?php echo $likes_count . ' likes' ?></p>
                <p><?php echo $comment_count . ' comments' ?></p>
            </div>
            <button type="submit">Like</button>
            <button type="submit">Share</button>
        </div>
        <div class="comment-section">
            <form action="" method="post">
                <p><?php echo $fullname; ?></p>
                <input type="text" name='comment' placeholder="Add a comment">
                <button type="submit" name='add-comment'>Comment</button>
            </form>
        </div>
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
                echo "<p style='margin: '>$user_name : $comment</p>";
            }
        }

        ?>
    </div>

</body>

</html>