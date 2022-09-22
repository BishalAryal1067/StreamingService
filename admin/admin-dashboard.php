<?php

try {
    include("../functions.php");
    include("../auth.php");
    echo "<link rel='stylesheet' href='../style/admin-dashboard.css'>";
} catch (\Throwable $th) {
    //throw $th;
}

//adding video from modal-------------------------------------------
try {
    if (isset($_POST['add-video'])) {
        $video_title = $_POST['video-title'];
        $path = $_FILES['video']['name'];
        $path_temp = $_FILES['video']['tmp_name'];
        $video_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $video_description = $_POST['video-description'];
        $video_category = $_POST['video-category'];
        $allowed_files = array('mp4', 'mov', 'avi');
        $ext = pathinfo($path, PATHINFO_EXTENSION);

                
        $message = [
            'extension_error' => "",
            'empty_error' => ""
        ];


        if (empty($video_title) || empty($path) || empty($video_category)) {
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
            if (add_videos($path, $video_title, $video_description, $video_date, $video_category)) {
                move_uploaded_file($path_temp, 'uploads/' . $path);
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Video successfully added');
                </script>
              ";
            } else {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Something went wrong');
                </script>
              ";
            }
        }
    }
} catch (Error $err) {
    echo $err;
}

//adding category from modal-------------------------------------------------
try {
    if (isset($_POST['add-category'])) {
        $categoryTitle = $_POST['category-title'];
        if (add_category($categoryTitle)) {
            echo "
             <script language='javascript' type='text/javascript'>
               alert('Category successfully added');
             </script>
           ";
        } else {
            echo "
            <script language='javascript' type='text/javascript'>
              alert('Something went wrong!');
            </script>
          ";
        }
    }
} catch (Error $err) {
    echo $err;
}

//adding news from modal------------------------------------------------------------
try {
    if (isset($_POST['add-news'])) {
        $video_title = $_POST['news-title'];
        $path = $_FILES['video']['name'];
        $path_temp = $_FILES['video']['tmp_name'];
        $video_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $video_description = $_POST['video-description'];
        $video_category = $_POST['video-category'];
        $allowed_files = array('mp4', 'mov', 'avi');
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $message = [
            'extension_error' => "",
            'empty_error' => ""
        ];


        if (empty($video_title) || empty($path) || empty($video_category)) {
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
            copy($_FILES['video']['name'], "../../uploads/" . time() . $path);
            if (add_videos($path, $video_title, $video_description, $video_date, $video_category)) {
                echo ("here");

                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Image successfully added');
                </script>
              ";
            } else {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Something went wrong');
                </script>
              ";
            }
        }
    }
} catch (Error $err) {
    echo $err;
}

//adding fixture from modal
try {
    if (isset($_POST['add-fixture'])) {
        $fixtureTitle = $_POST['fixture-title'];
        $fixtureDate = $_POST['fixture-date'];
        $category = $_POST['fixture-category'];

        if (add_fixtures($fixtureTitle, $fixtureDate, $category)) {
            echo "
         <script language='javascript' type='text/javascript'>
           alert('Fixture successfully added');
         </script>
       ";
        } else {
            echo "
            <script language='javascript' type='text/javascript'>
              alert('Something went wrong!');
            </script>
          ";
        }
    }
} catch (Error $err) {
    $error = $err;
    echo $error;
}


//-------------------------------------------------------------------------------------

//adding images from modal
try {
    if (isset($_POST['add-image'])) {
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
            copy($path_temp, './uploads', time() . $path);
            if (add_images($path, $image_caption, $image_category, $image_date)) {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Image successfully added');
                </script>
              ";
            } else {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Something went wrong');
                </script>
              ";
            }
        }
    }
} catch (Error $err) {
    echo $err;
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
    <link rel='stylesheet' href='../style/admin-dashboard.css'>
    <title>Admin Dashboard</title>
</head>

<body>

    <p><?php echo $err; ?></p>

    <!--navigation bar------------------------------------------------------------->
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
    <!--mid-section------------------------------------------------------------------>
    <div class="mid-section">
        <button class="user-btn"><i class="fa-solid fa-users"></i>Users</button>
        <button class="image-btn"><i class="fa-solid fa-image"></i>Images</button>
        <button class="video-btn"><i class="fa-solid fa-video"></i>Videos</button>
        <button class="fixture-btn"><i class="fa-solid fa-ranking-star"></i>Fixtures</button>
        <button class="news-btn"><i class="fa-solid fa-newspaper"></i></i>News</button>
        <button class="live-btn"><i class="fa-solid fa-tower-broadcast"></i></i>Live</button>
        <button class="category-btn"><i class="fa-solid fa-list"></i>Categories</button>
    </div>
    <div class="bottom-section">
        <!--users section----------------------------------------------------------->
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
            <div class="table-section">
                <table class="users-table">
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <?php fetch_users(); ?>
                </table>
            </div>
        </div>
        <!--image section---------------------------------------------------------->
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
                <!--add images-->
                <button class="add-image-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>

            <!--list/table of images-->
        </div>
        <!--video section---------------------------------------------------------->
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
            <div class="fixture-card-section">
                <!--loading data from php-->
                <?php
                try {
                    global $db_connection;
                    $query = "SELECT * FROM fixtures";
                    $query_result = mysqli_query($db_connection, $query);
                    while ($row = mysqli_fetch_assoc($query_result)) {
                        $db_id = $row['fixture_id'];
                        $db_title = $row['fixture_title'];
                        $db_date = $row['fixture_date'];

                        echo "
                          <div class='fixture-card'>
                               <div class='card-header'>
                               <h4>$db_title</h4>
                               <p>$db_date</p>
                               </div>
                               <div class='card-footer'>
                                  <form method='post'>
                                      <button type='submit' name='update-fixture'><i class='fa-solid fa-pen'></i></button>
                                      <button type='submit' name='delete-fixture'><i class='fa-solid fa-trash'></i></button>
                                  </form>
                               </div>
                          </div>
                        ";
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
                ?>
            </div>
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
            <div class="category-card-section">
                <?php
                try {
                    fetch_category();
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
            </div>
        </div>


        <!--news section------------------------------------------------------>
        <div class="news-section">
            <div class="top-section">
                <input type="search" name="search-news" id="" placeholder="Search news...">
                <button class="add-news-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="news-card-section">
            </div>
        </div>

        <div class="live-section">
            <div class="top-section">
                <input type="search" name="search-news" id="" placeholder="Search news...">
                <button class="add-live-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="live-card-section">
            </div>
        </div>
    </div>

    <!--add image modal-->
    <div class="add-image-modal" id="modal">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="close-btn" id="close-image-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add image</h3>
            <input type="text" name="image-caption" id="" placeholder="Image caption..">
            <input type="file" name="image" id="" placeholder="Choose image">
            <select name="image-category" id="">
                <option value="Football">Football</option>
                <option value="Marathon">Marathon</option>
                <option value="Gymnastics">Gymnastics</option>
            </select>
            <button type="submit" name="add-image">Add</button>
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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="close-btn" id="close-video-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add video</h3>
            <input type="text" name="video-title" id="" placeholder="Video Title..">
            <textarea name="video-description" id="" cols="37" rows="6"></textarea>
            <input type="file" name="video" id="" placeholder="Choose image...">
            <select name="video-category" id="">
                <option value="Football">Football</option>
                <option value="Marathon">Marathon</option>
                <option value="Gymnastics">Gymnastics</option>
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

    <!--add news modal-->
    <div class="add-news-modal" id="modal">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="close-btn" id="close-news-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add News</h3>
            <input type="text" name="image-caption" id="" placeholder="News title..">
            <textarea name="" id="" cols="36" rows="7"></textarea>
            <input type="file" name="image" id="" placeholder="Choose image">
            <select name="image-category" id="">
                <option value="Football">Football</option>
                <option value="Marathon">Marathon</option>
                <option value="Gymnastics">Gymnastics</option>
            </select>
            <button type="submit" name="add-news">Add</button>
        </form>
    </div>

    <!-- Add live modal -->
    <div class="add-live-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-live-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add Live</h3>
            <input type="text" name="live-title" id="" placeholder="Live Match Title...">
            <input type="text" name="category-title" id="" placeholder="URL...">
            <button type="submit" name="add-live">Add</button>
        </form>
    </div>





    <!--javascript-->
    <script type="text/javascript" src="../js/admin-dashboard.js"></script>
</body>

</html>