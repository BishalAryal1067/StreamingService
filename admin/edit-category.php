<?php
try {
    include('../functions.php');
    include('../database.php');
    echo "<link rel='stylesheet' href='../style/edit-page.css'>";

    if (isset($_GET['data'])) {
        global $db_connection;
        $category_id = $_GET['edit'];
        $query = "SELECT * FROM category WHERE category_id=$category_id";
        $result = mysqli_query($db_connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_title = $row['category_name'];
        }
    }



    if (isset($_POST['update-category'])) {
        $category_name = $_POST['category-title'];


        $error = [
            'empty' => ''
        ];

        if (empty($category_name)) {
            $error['empty'] = "<script>alert('No field can be empty!')</script>";
        }

        foreach ($error as $key => $value) {
            if (empty($value)) {
                unset($error[$key]);
            }
        }

        if (empty($error)) {
            if (update_category($category_id, $category_name)) {
                echo "
             <script language='javascript' type='text/javascript'>
               alert('Category successfully added');
             </script>
             ";
                header("Location:admin-dashboard.php");
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
    <title>Edit category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <form action="" method="post">
        <h3>Edit category</h3>
        <input type="text" name="category-title" id="" placeholder="Category.." value="<?php echo $category_title ?>">
        <button type="submit" name="update-category">Update</button>
    </form>
</body>

</html>