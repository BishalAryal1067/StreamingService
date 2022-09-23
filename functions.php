<?php

include('../database.php');
session_start();
date_default_timezone_set('Asia/Kathmandu');

/*----------------------------------------------------------------------------------------*/

//a function to redirect to desired pages
function redirect($url)
{
  return header('Location' . $url);
  exit();
}

/*----------------------------------------------------------------------------------------*/

//function to add fixtures
function add_fixtures($fixtureTitle, $fixtureDate, $category)
{
  global $db_connection;
  $query = "INSERT INTO fixtures(fixture_title, fixture_date, fixture_category) VALUES('$fixtureTitle', '$fixtureDate', '$category')";
  $insertQuery = mysqli_query($db_connection, $query);
  return true;
}

function delete_fixtures($id)
{
  global $db_connection;
  $query = "DELETE FROM fixtures WHERE fixture_id=$id";
  $update = "SELECT * FROM fixtures";
  $delete_result = mysqli_query($db_connection, $query);
  $update_result = mysqli_query($db_connection, $update);
  if ($delete_result && $update_result) {
    return true;
    header("refresh");
  } else {
    echo "Query Failed";
    return false;
  }
}



//function to add videos----------------------------------------------------------
function add_videos($path, $video_title, $video_description, $video_date, $video_category)
{

  global $db_connection;
  $view_count = 0;

  $query = "INSERT INTO videos(video_path, video_title, video_description,video_date, video_category, view_count) 
  VALUES('$path','$video_title','$video_description','$video_date', '$video_category', $view_count)";
  $insertQuery = mysqli_query($db_connection, $query);

  if ($insertQuery) {
    return true;
  } else {
    echo "<script>alert('Query Failed')<script>";
    return false;
  }
}

//function to fetch videos
function fetch_videos()
{
  global $db_connection;
  $query = "SELECT * FROM videos";
  $result = mysqli_query($db_connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $video_id = $row['video_id'];
      $video_path = $row['video_path'];
      $video_title = $row['video_title'];
      $video_category = $row['video_category'];
      $upload_date = $row['upload_date'];

      $video_file_path = "admin/uploads/" . $video_path;
  

      echo "
                   <div class='video-card'>
                               <div class='card-header'>
                                <video controls='controls'>
                                 <source src = 'uploads/$video_path' type='video/mp4/'>
                                </video>
                               <h4>$video_title</h4>
                               <p>$upload_date</p>
                               </div>
                               <div class='card-footer'>
                                  <form method='post'>
                                      <a  name='update-video'><i class='fa-solid fa-pen'></i></button>
                                      <a  name='delete-video'><i class='fa-solid fa-trash'></i></button>
                                  </form>
                               </div>
                          </div>
        ";
    }
  }
}

/*----------------------------------------------------------------------------------------*/

//function to add images
function add_images($path, $image_caption, $category, $upload_date)
{
  global $db_connection;
  $query = "INSERT INTO images(image_path, image_caption, image_category, upload_date) 
   VALUES('$path', '$image_caption', '$category', '$upload_date')";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}

function fetch_images()
{
  global $db_connection;
  $query = "SELECT * FROM images";
  $result = mysqli_query($db_connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $image_id = $row['image_id'];
      $image_path = $row['image_path'];
      $image_caption = $row['image_caption'];
      $image_category = $row['image_category'];
      $upload_date = $row['upload_date'];

      echo "
                   <div class='image-card'>
                               <div class='card-header'>
                               <img src='uploads/$image_path'>
                               <h4>$image_caption</h4>
                               </div>
                               <div class='card-footer'>
                                  <form>
                                      <a href='../edit-page.php?edit=$image_id&data=image' name='update-image'><i class='fa-solid fa-pen'></i></a>
                                      <a href='admin-dashboard.php?delete=$image_id' name='delete-image'><i class='fa-solid fa-trash'></i></a>
                                  </form>
                               </div>
                          </div>
        ";
    }
  }
}

function delete_images($image_id)
{
  global $db_connection;
  $query = "DELETE FROM images WHERE image_id=$image_id";
  $update = "SELECT * FROM fixtures";
  $delete_result = mysqli_query($db_connection, $query);
  $update_result = mysqli_query($db_connection, $update);
  if ($delete_result && $update_result) {
    return true;
    header('refresh:3;url=admin-dashboard.php');
  } else {
    echo "Query Failed";
    return false;
  }
}

function update_images($image_id,$image_path, $image_caption, $image_category, $upload_date)
{
  global $db_connection;
  $query = $query = "UPDATE images SET ";
  $query .= "image_caption = '{$image_caption}', ";
  $query .= "image_category = '{$image_category}', ";
  $query .= "image_path = '{$image_path}', ";
  $query .= "upload_date = '{$upload_date}' ";
  $query .= " WHERE image_id = {$image_id}";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}


/*----------------------------------------------------------------------------------------*/

//function to add category
function add_category($title)
{
  global $db_connection;
  $query = "INSERT INTO category(category_name) VALUES('{$title}')";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}

//function to fetch category
function fetch_category()
{
  global $db_connection;
  $query = "SELECT * FROM category";
  $result = mysqli_query($db_connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $category_name = $row['category_name'];

    echo "
                   <div class='category-card'>
                               <div class='card-header'>
                               <h4>$category_name</h4>
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
}


function delete_category($category_id)
{
  global $db_connection;
  $query = "DELETE FROM fixtures WHERE fixture_id=$category_id";
  $update = "SELECT * FROM fixtures";
  $delete_result = mysqli_query($db_connection, $query);
  $update_result = mysqli_query($db_connection, $update);
  if ($delete_result && $update_result) {
    return true;
    header('refresh:3;url=admin-dashboard.php');
  } else {
    echo "Query Failed";
    return false;
  }
}


/*----------------------------------------------------------------------------------------*/
function add_news($title, $path, $description, $date, $category)
{
  global $db_connection;
  $query = "INSERT INTO news(news_title, image_path, news_description, news_date, news_category)
   VALUES('$title', '$path', '$description', '$date', '$category')";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    echo "<script>alert($title, $path, $description, $date, $category)</script>";
    return true;
  }
}

function fetch_news()
{
  global $db_connection;
  $query = "SELECT * FROM news";
  $result = mysqli_query($db_connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $news_id = $row['news_id'];
    $news_title = $row['news_title'];
    $path = $row['image_path'];
    $description = $row['news_description'];
    $date = $row['news_date'];
    $category = $row['news_category'];

    echo "
                   <div class='news-card'>
                               <div class='card-header'>
                               <img src='uploads/$path'>
                               <h4>$news_title</h4>
                               <p>$date</p>
                               </div>
                               <div class='card-footer'>
                                  <form method='post'>
                                      <button type='submit' name='update-news'><i class='fa-solid fa-pen'></i></button>
                                      <button type='submit' name='delete-news'><i class='fa-solid fa-trash'></i></button>
                                  </form>
                               </div>
                          </div>
    
       ";
  }
}

function delete_news($news_id)
{
  global $db_connection;
  $query = "DELETE FROM fixtures WHERE news_id=$news_id";
  $update = "SELECT * FROM fixtures";
  $delete_result = mysqli_query($db_connection, $query);
  $update_result = mysqli_query($db_connection, $update);
  if ($delete_result && $update_result) {
    return true;
    header('refresh:3;url=admin-dashboard.php');
  } else {
    echo "Query Failed";
    return false;
  }
}


/*----------------------------------------------------------------------------------------*/
function add_live($title, $url, $category)
{
  global $db_connection;
  $query = "INSERT INTO live(title, url, category)
   VALUES('$title', '$url', '$category')";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}

function fetch_live()
{
  global $db_connection;
  $query = "SELECT * FROM live";
  $result = mysqli_query($db_connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $live_id = $row['live_id'];
    $live_title = $row['title'];
    $url = $row['url'];
    $category = $row['category'];

    echo "
    <div class='live-card'>
                <div class='card-header'>
                <h4>$live_title</h4>
                <p style='color:green;'>Live <i class='fa-solid fa-podcast'></i></p>
                </div>
                <div class='card-footer'>
                   <form method='post'>
                       <button type='submit' name='update-news'><i class='fa-solid fa-pen'></i></button>
                       <button type='submit' name='delete-news'><i class='fa-solid fa-trash'></i></button>
                   </form>
                </div>
           </div>

    ";
  }
}

function delete_live($live_id)
{
  global $db_connection;
  $query = "DELETE FROM fixtures WHERE live_id=$live_id";
  $update = "SELECT * FROM fixtures";
  $delete_result = mysqli_query($db_connection, $query);
  $update_result = mysqli_query($db_connection, $update);
  if ($delete_result && $update_result) {
    return true;
    header('refresh:3;url=admin-dashboard.php');
  } else {
    echo "Query Failed";
    return false;
  }
}
