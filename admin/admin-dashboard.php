<?php

try {
    include("../functions.php");
    include("../auth.php");
    echo "<link rel='stylesheet' href='../style/admin-dashboard.css'>";
} catch (\Throwable $th) {
    //throw $th;
}

//blocking, unblocking user or deleting user
try {
    if (isset($_GET['action'])) {
        $email = $_GET['email'];
        $action = strtolower($_GET['action']);
        if ($action == 'block') {
            if (block_user($email)) {
                echo "<script>alert('User has been blocked')</script>";
            }
        } elseif ($action == 'delete') {
            if (delete_user($email)) {
                echo "<script>('User has been deleted')</script>";
            }
        } elseif ($action == 'unblock') {
            if (unblock_user($email)) {
                echo "<script>('User has been unblocked')</script>";
            }
        }
    }
} catch (\Throwable $th) {
    throw $th;
}



//adding video from modal-------------------------------------------
try {
    if (isset($_POST['add-video'])) {
        $video_title = $_POST['video-title'];
        $path = $_POST['path'];
        $video_date = date('Y-m-d') . ' / ' . date('H:i:sa');
        $video_description = $_POST['video-description'];
        $video_category = $_POST['video-category'];

        $message = [
            'empty_error' => ""
        ];


        if (empty($video_title) || empty($path) || empty($video_category)) {
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
            if (add_videos($path, $video_title, $video_description, $video_date, $video_category)) {
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


//adding fixture from modal
try {
    if (isset($_POST['add-fixture'])) {
        $fixtureTitle = $_POST['fixture-title'];
        $fixtureDate = $_POST['fixture-date'] . ' ' . $_POST['fixture-time'];
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

//adding news from modal
try {
    if (isset($_POST['add-news'])) {
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

            if (add_news($news_title, $news_path, $news_description, $news_date, $news_category)) {
                move_uploaded_file($path_temp_news, 'uploads/' . $path_temp_news);
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('News successfully added');
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
} catch (\Throwable $th) {
    throw $th;
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
            move_uploaded_file($path_temp, 'uploads/' . $path);
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

//adding live 
try {
    if (isset($_POST['add-live'])) {
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
            if (add_live($live_title, $live_url, $live_category)) {
                echo "
                <script language='javascript' type='text/javascript'>
                  alert('Live video successfully added');
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
                <a href="../home.php" target='_blank'>Home</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-radio"></i>
                <a href="../news.php" target='_blank'>News</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tv"></i>
                <a href="../videos.php" target='_blank'>Videos</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-images"></i>
                <a href="../gallery.php" target='_blank'>Gallery</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-ranking-star"></i>
                <a href="../fixtures.php" target='_blank'>Fixtures</a>
            </div>
            <div class="nav-link">
                <i class="fa-solid fa-tower-broadcast"></i>
                <a href="../live.php" target='_blank'>Live</a>
            </div>
        </div>
        <div class="nav-btns">
            <a href="../requests.php" target='_blank'><i class="fa-solid fa-bell"></i></a>
            <a href='../logout.php' class="login-btn">
                Sign Out
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
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
                <!--add images-->
                <button class="add-image-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <!--list/table of images-->
            <div class="image-card-section">
                <?php
                try {
                    if (isset($_GET['delete'])) {
                        if ($_GET['data'] == 'image') {
                            $image_id = $_GET['delete'];
                            if (delete_images($image_id)) {
                                echo "<script>alert('Image deleted successfully');</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
                <?php fetch_images(); ?>
            </div>
        </div>
        <!--video section---------------------------------------------------------->
        <div class="video-section">
            <!--video searcha and filter options-->
            <div class="top-section">
                <!--add fixtures-->
                <button class="add-video-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <!--list/table of videos-->
            <div class="video-card-section">
                <?php
                try {
                    if (isset($_GET['data'])) {
                        if ($_GET['data'] == 'video') {
                            $video_id = $_GET['delete'];
                            if(delete_videos($video_id)){
                                echo "<script>alert('Video deleted successfully');</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
                <?php fetch_videos(); ?>
            </div>
        </div>
        <!--fixtures section-->
        <div class="fixture-section">
            <!--fixture search and filter section-->
            <div class="top-section">
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
                    if (isset($_GET['data'])) {
                        if ($_GET['data'] == 'fixture') {
                            $fixture_id = $_GET['delete'];
                            if (delete_fixtures($fixture_id)) {
                                echo "<script>alert('Fixture deleted successfully')</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
                <?php
                try {
                    fetch_fixtures();
                } catch (\Throwable $th) {
                    //throw $th;
                }
                ?>
            </div>
        </div>

        <!--category section-->
        <div class="category-section">
            <div class="top-section">
                <button class="add-category-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="category-card-section">
                <?php
                try {
                    if (isset($_GET['data'])) {
                        if ($_GET['data'] == 'category') {
                            $category_id = $_GET['delete'];
                            if (delete_category($category_id)) {
                                echo "<script>alert('Category deleted successfully')</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
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
                <button class="add-news-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <!--list of news-->
            <div class="news-card-section">
                <?php
                try {
                    if (isset($_GET['data'])) {
                        if ($_GET['data'] == 'news') {
                            $news_id = $_GET['delete'];
                            if (delete_news($news_id)) {
                                echo "<script>alert('News deleted successfully')</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
                <?php fetch_news(); ?>
            </div>

        </div>
        <!--news section------------------------------------------------------>
        <div class="live-section">
            <div class="top-section">
                <button class="add-live-btn">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </button>
            </div>
            <div class="live-card-section">
                <?php
                try {
                    if (isset($_GET['data'])) {
                        if ($_GET['data'] == 'live') {
                            $live_id = $_GET['delete'];
                            if (delete_live($live_id)) {
                                echo "<script>alert('Live video deleted successfully')</script>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
                <?php fetch_live(); ?>
            </div>
        </div>
    </div>


    <!--Modals--------------------------------------------------------------------------------------------------->

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
                <?php
                try {
                    fetch_options();
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
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
            <input type="text" name='path' placeholder="Enter video url / link...">
            <textarea name="video-description" id="" cols="37" rows="6"></textarea>
            <select name="video-category" id="">
                <?php
                try {
                    fetch_options();
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
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
            <h3>Add Fixture</h3>
            <input type="text" name="fixture-title" placeholder="Fixture Title...">
            <input type="date" name="fixture-date">
            <input type="time" name="fixture-time">
            <select name="fixture-category" id="">
                <?php
                try {
                    fetch_options();
                } catch (\Throwable $th) {
                    throw $th;
                }
                ?>
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
    </div>

    <!-- Add live modal -->
    <div class="add-live-modal" id="modal">
        <form action="" method="post">
            <div class="close-btn" id="close-live-modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Add Live</h3>
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
    </div>

    <!--javascript-->
    <script type="text/javascript" src="../js/admin-dashboard.js"></script>
</body>

</html>