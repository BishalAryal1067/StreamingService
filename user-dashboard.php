<?php
include('./functions.php');
include('./database.php');
echo "<link rel='stylesheet' href='./style/user-dashboard.css'>";
$fullname = $_SESSION['fullname'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--external css-->
    <title>Home</title>
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
        
        <!--btns-->
        <div class="nav-btns">
            <!--profile-->
            <a href="profile.php?fullname=<?php echo $fullname?>" id='profile'><?php echo $fullname ?>
                <i class="fa-solid fa-circle"></i>
            </a>
            
            <form action="" method="post" style="align-self: center;">
                <button class="login-btn" type="submit">
                    Sign Out
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>

    <!--mid-section-->
    <div class="mid-section">
        <input type="search" name="search" id="" placeholder="Search">
    </div>
    <!--landing section-->
    <div class="landing-section">
        <!--video section-->
      <div class="video-section">
        <div class="heading">
            <h5>Videos</h5>
        </div>
         <!--video cards-->
        <div class="card-section">
        <?php 
           global $db_connection;
           $result = mysqli_query($db_connection, "SELECT * FROM videos limit 3");
           while($row = mysqli_fetch_assoc($result)){
            $id = $row['video_id'];
            $path = $row['video_path'];
            $title = $row['video_title'];
            $upload_date = $row['video_date'];
          
             echo "
                   <div class= 'video-card'>
                      <iframe src='$path'></iframe>
                      <div class='heading'>
                         <p>$title</p>
                         <p>Uploaded on: $upload_date</p>
                      </div>
                      <div class='footer'>
                        <a href='./view-video.php?data=$id&title=$title'>View</a>
                      </div>
                   </div>
             
                 ";
           }
         ?>
        </div>
        
      </div>
    </div>

    <script>

    </script>
</body>

</html>