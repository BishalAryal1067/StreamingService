<?php
try {
    include('./functions.php');
    include('./database.php');
    echo "<link rel='stylesheet' href='./style/edit-page.css'>";
} catch (\Throwable $th) {
    throw $th;
}


if (isset($_GET['data']) == 'image') {
    global $db_connection;
    $image_id = $_GET['edit'];
    $result = mysqli_query($db_connection, "SELECT * FROM images WHERE image_id=$image_id");
    while ($row = mysqli_fetch_assoc($result)) {
        $image_caption = $row['image_caption'];
    }
}

if(isset($_POST['update-image'])){
  
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
    <!--image update form-->
    <form action='' method='post' enctype='multipart/form-data' class="image-form">
        <h3>Update image details</h3>
        <input type='text' name='image-caption' value='<?php $image_caption ?>'>
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