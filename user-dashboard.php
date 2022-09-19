<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--external css-->
    <link rel="stylesheet" href="./style/user-dashboard.css">
    <title>Dashboard : username</title>
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
        <!--profile-->
        <div class="profile">
            <a href="profile.php">Username</a>
            <i class="fa-solid fa-circle"></i>
        </div>
        <!--btns-->
        <div class="nav-btns">
            <button class="login-btn" type="submit">
                Sign Out
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </div>
    </div>

    <!--mid-section-->
    <div class="mid-section">
        <input type="search" name="search" id="" placeholder="Search">
    </div>
    <!--landing section-->
    <div class="landing-section">
        
    </div>
</body>

</html>