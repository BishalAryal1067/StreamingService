<!DOCTYPE html>
<html lang="en">

<?php
include('./functions.php');
include('./database.php');

if(isset($_GET['edit'])){
    $image_id=$_GET['edit'];
}


if (isset($_POST['update-image'])) {
    $image_path = $_FILES['image']['name'];
    $path_temp = $_FILES['image']['tmp_name'];
    $image_caption = $_POST['image-caption'];
    $image_category = $_POST['image-category'];
    $upload_date = date('Y:m:d') . ' / '. date('H:i:sa');

    $result = update_images($image_id, $image_path, $image_caption, $image_category, $upload_date);
    if ($result) {
          
        return header('Location:admin/admin-dashboard.php');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

    <?php
    if (isset($_GET['data']) == 'image') {
        global $db_connection;
        $image_id = $_GET['edit'];
        $result = mysqli_query($db_connection, "SELECT * FROM images WHERE image_id=$image_id");
        while ($row = mysqli_fetch_assoc($result)) {
            $image_caption = $row['image_caption'];
        }
        echo "  
      <form action='' method='post' enctype='multipart/form-data'>
    <h3>Update image details</h3>
    <input type='text' name='image-caption' value='$image_caption'>
    <input type='file' name='image'  placeholder='Choose image'>
    <select name='image-category' id=''>
        <option value='Football'>Football</option>
        <option value='Marathon'>Marathon</option>
        <option value='Gymnastics'>Gymnastics</option>
    </select>
    <button type='submit' name='update-image'>Update</button>
</form>       
      ";
    }



    ?>
</body>

</html>