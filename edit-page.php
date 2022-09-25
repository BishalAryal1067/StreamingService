<!DOCTYPE html>
<html lang="en">

<?php
try {
    include('./functions.php');
    include('./database.php');
    echo "<link rel='stylesheet' href='./style/edit-page.css'>";
} catch (\Throwable $th) {
    throw $th;
}

if (isset($_GET['edit'])) {
    $item_to_be_edited = $_GET['data'];
    switch ($item_to_be_edited) {
        case 'image':
            
            break;

        case 'video':
            $video_id = $_GET['data'];
            break;

        case 'fixture':
            $fixture_id = $_GET['data'];
            break;

        case 'news':
            $news_id = $_GET['data'];
            break;

        case 'category':
            $category_id = $_GET['data'];
            break;

        case 'live':
            $live_id = $_GET['data'];
            break;
    }
}

//updating image
if (isset($_POST['update-image'])) {
    $image_path = $_FILES['image']['name'];
    $path_temp = $_FILES['image']['tmp_name'];
    $image_caption = $_POST['image-caption'];
    $image_category = $_POST['image-category'];
    $upload_date = date('Y:m:d') . ' / ' . date('H:i:sa');

    $result = update_images($image_id, $image_path, $image_caption, $image_category, $upload_date);
    if ($result) {
        move_uploaded_file($image_path, 'uploads/' . $path_temp . date('H:i:sa'));
        return header('Location:admin/admin-dashboard.php');
    }
}

//updating videos
if (isset($_POST['update-video'])) {
    $video_title = $_POST['video-title'];
    $path = $_POST['path'];
    $video_date = date('Y-m-d') . ' / ' . date('H:i:sa');
    $video_description = $_POST['video-description'];
    $video_category = $_POST['video-category'];

    $result = update_videos($video_id, $video_path, $video_title, $video_description, $video_category, $video_date);
    if ($result) {
        return header('Location:admin/admin-dashboard.php');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $_GET['data'] ?></title>
</head>

<body>

    <?php
    //showing image form if image is to be edited
    

    //showing video edit form
    if (isset($_GET['data']) == 'video') {
        global $db_connection;
        // $video_id = $_GET['edit'];
        $result = mysqli_query($db_connection, "SELECT * FROM videos WHERE video_id=$video_id");
        while ($row = mysqli_fetch_assoc($result)) {
            $video_title = $row['video_title'];
            $video_path = $row['video_path'];
            $video_description = $row['video_description'];
        }
        echo "  
         
           ";
    }

    //showing fixture edit form
    if (isset($_GET['data']) == 'fixture') {
        global $db_connection;
        $result  = mysqli_query($db_connection, "SELECT * FROM fixture WHERE fixture_id=$fixture_id");
        while ($row = mysqli_fetch_assoc($result)) {
            $fixture_title = $row['fixture_tile'];
            $fixture_date = $row['fixture_date'];
            // $fixtue_time = $row['fxiture_time'];
        }
    }

    ?>


    <!--forms-------------------------------------------------->
    <!--fixture update form-->
    <form method='post' class="fixture-form">
        <div class='close-btn' id='close-fixture-modal'>
            <i class='fa-solid fa-circle-xmark'></i>
        </div>
        <h3>Update fixture</h3>
        <input type='text' name='fixture-title' placeholder='Fixture Title...'>
        <input type='date' name='fixture-date'>
        <input type='time' name='fixture-time'>
        <select name='fixture-category'>
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
        </select>
        <button type='submit' name='update-fixture'>update</button>
    </form>


    <!--video update form-->
    <form method='post' enctype='multipart/form-data' class="video-form">
        <div class='close-btn' id='close-video-modal'>
            <i class='fa-solid fa-circle-xmark'></i>
        </div>
        <h3>Add video</h3>
        <input type='text' name='video-title' value='<?php $video_title ?>' placeholder='Video Title..'>
        <input type='text' name='path' value='<?php $video_path ?>' placeholder='Enter video url / link...'>
        <textarea name='video-description' value='$video_description' cols='37' rows='6'></textarea>
        <select name='video-category'>
            <?php
            fetch_options();
            ?>
        </select>
        <button type='submit' name='update-video'>Update</button>
    </form>


    <!--live streaming update form-->
    <form action="" method="post" class="live-form">
        <div class="close-btn" id="close-live-modal">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <h3>Update live stream details</h3>
        <input type="text" name="live-title" id="" placeholder="Live Match Title...">
        <input type="text" name="url" id="" placeholder="URL...">
        <select name="live-category" id="">
            <?php
            try {
                fetch_options();
            } catch (\Throwable $th) {
                throw $th;
            }

            ?>
        </select>
        <button type="submit" name="add-live">Add</button>
    </form>

    <!--news update form-->
    <form action="" method="post" enctype="multipart/form-data" class="news-form">
        <div class="close-btn" id="close-news-modal">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <h3>Add News</h3>
        <input type="text" name="news-title" id="" placeholder="News title..">
        <textarea name="news-description" id="" cols="36" rows="7" placeholder="News description..."></textarea>
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
        <button type="submit" name="add-news">Add</button>
    </form>

    <!--category update form-->
    <form method="post" class="category-form">
        <div class="close-btn" id="close-category-modal">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <h3>Add Category</h3>
        <input type="text" name="category-title" id="" placeholder="Category..">
        <button type="submit" name="add-category">Add</button>
    </form>

    <script>
        let fixtureForm = document.querySelector('.fixture-form');
        let imageForm = document.querySelector('.image-form');
        let videoForm = document.querySelector('.video-form');
        let newsForm = document.querySelector('.news-form');
        let categoryForm = document.querySelector('.category-form');
        let liveForm = document.querySelector('.live-form');

        console.log(imageForm, liveForm);

        let toggleView = (f1, f2, f3, f4, f5, f6) => {
            f1.classList.add('active-form');
            f2.classList.remove('active-form');
            f3.classList.remove('active-form');
            f4.classList.remove('active-form');
            f5.classList.remove('active-form');
            f6.classList.remove('active-form');
        }

        let showImageForm = (toggleView(imageForm, videoForm, fixtureForm, newsForm, liveForm, categoryForm));
        // let showVideoForm = ();
       </script>

</body>

</html>