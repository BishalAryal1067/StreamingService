<?php

include('../functions.php');

try {
    if (isset($_POST['add-fixture'])) {
        $fixtureTitle = $_POST['fixture-title'];
        $fixtureDate = $_POST['fixture-date'];
        $category = $_POST['fixture-category'];
    
        if (addFixtures($fixtureTitle, $fixtureDate, $category)) {
            echo "<script>
              alert('Fixture added successfully');
            </script>";
        } else {
            echo "<script>
            alert('Something went wrong');
          </script>";
        }
    }
} catch (Error $err) {
    $error = $err;
    echo $error;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css link-->
    <link rel="stylesheet" href="../style/admin-dashboard.css">
    <title>Admin Dashboard</title>
</head>

<body>


    <!--navigation bar-->
    <div class="navbar">
        <div class="logo">
            <img src="../images/medals.jpg" alt="">
        </div>
        <div class="nav-items">
            <div class="nav-link">
                <i class="fa-solid fa-house"></i>
                <a href="#Home">Home</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-radio"></i>
                <a href="News">News</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tv"></i>
                <a href="">Videos</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-images"></i>
                <a href="">Gallery</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-circle-info"></i>
                <a href="">About Us</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-mobile"></i>
                <a href="">Contact</a>
            </div>
        </div>
        <div class="nav-btns">
            <button class="login-btn">
                Sign Out
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </div>
    </div>
    <!--mid-section-->
    <div class="mid-section">
        <button class="user-btn"><i class="fa-solid fa-users"></i>Users</button>
        <button class="image-btn"><i class="fa-solid fa-image"></i>Images</button>
        <button class="video-btn"><i class="fa-solid fa-video"></i>Videos</button>
        <button class="fixture-btn"><i class="fa-solid fa-ranking-star"></i>Fixtures</button>
        <button class="category-btn"><i class="fa-solid fa-list"></i>Categories</button>
    </div>
    <div class="bottom-section">
        <!--users section-->
        <div class="users-section">
            <!--user search and filter section-->
            <div class="top-section">
                <input type="search" name="search-users" id="" placeholder="Search users...">
                <div class="filter-section">
                    <i class="fa-solid fa-filter"></i>
                    <p>Filter users :</p>
                    <select name="users-select" id="">
                        <option value="default">Select</option>
                        <option value="">Active</option>
                        <option value="">Blocked</option>
                        <option value="">Admin</option>
                    </select>
                </div>
            </div>
            <!--list /table of users-->

        </div>
        <!--image section-->
        <div class="images-section">
            <!--image search and filter options-->
            <div class="top-section">
                <input type="search" name="search-images" id="" placeholder="Search images...">
                <div class="filter-section">
                    <i class="fa-solid fa-filter"></i>
                    <p>Filter images :</p>
                    <select name="users-select" id="">
                        <option value="default">Select</option>
                        <option value="">Active</option>
                        <option value="">Blocked</option>
                        <option value="">Admin</option>
                    </select>
                </div>
                <!--add fixtures-->
                <button class="add-image-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>

            <!--list/table of images-->
        </div>
        <!--video section-->
        <div class="video-section">
            <!--video searcha and filter options-->
            <div class="top-section">
                <input type="search" name="search-videos" id="" placeholder="Search videos...">
                <div class="filter-section">
                    <i class="fa-solid fa-filter"></i>
                    <p>Filter videos:</p>
                    <select name="users-select" id="">
                        <option value="default">Select</option>
                        <option value="">Active</option>
                        <option value="">Blocked</option>
                        <option value="">Admin</option>
                    </select>
                </div>
                <!--add fixtures-->
                <button class="add-video-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <!--list/table of videos-->
        </div>
        <!--fixtures section-->
        <div class="fixture-section">
            <!--fixture search and filter section-->
            <div class="top-section">
                <input type="search" name="search-fixtures" id="" placeholder="Search fixtures...">
                <div class="filter-section">
                    <i class="fa-solid fa-filter"></i>
                    <p>Filter fixtures:</p>
                    <select name="users-select" id="">
                        <option value="default">Select</option>
                        <option value="">Active</option>
                        <option value="">Blocked</option>
                        <option value="">Admin</option>
                    </select>
                </div>
                <!--add fixtures-->
                <button class="add-fixture-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <!--list-table of fixtures-->
        </div>

        <!--category section-->
        <div class="category-section">
            <div class="top-section">
                <input type="search" name="search-category" id="" placeholder="Search category...">
                <button class="add-category-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
        </div>
    </div>

    <!--add image modal-->
    <div class="add-image-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-image-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add image</h3>
            <input type="text" name="image-title" id="" placeholder="Image title..">
            <input type="file" name="" id="" placeholder="Choose image">
            <button type="submit">Add</button>
        </form>
    </div>

    <!-- Add category modal -->
    <div class="add-category-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-category-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add Category</h3>
            <input type="text" name="category-title" id="" placeholder="Category..">
            <button type="submit" name="add-category">Add</button>
        </form>
    </div>

    <!--Add video modal-->
    <div class="add-video-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-video-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add Video</h3>
            <input type="text" name="video-title" id="" placeholder="Video title..">
            <textarea name="video-description" id="" cols="37" rows="6" placeholder="Video Description.."></textarea>
            <input type="file" name="" id="" placeholder="Choose an video file to upload">
            <select name="video-cateogry" id="">
                <option value="">Football</option>
                <option value="">Marathon</option>
                <option value="">Gymnastics</option>
            </select>
            <button type="submit" name="add-video">Add</button>
        </form>
    </div>

    <!--Add fixture Modal-->
    <div class="add-fixture-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-fixture-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add Video</h3>
            <input type="text" name="fixture-title" id="" placeholder="Fixture Title...">
            <input type="date" name="fixture-date" id="">
            <select name="fixture-category" id="">
                <option value="football">Football</option>
                <option value="marathon">Marathon</option>
                <option value="Gymnastics">Gymnastics</option>
            </select>
            <button type="submit" name="add-fixture">Add</button>
        </form>
    </div>


    <!--javascript-->
    <script src="../js/admin-dashboard.js"></script>
</body>

</html>