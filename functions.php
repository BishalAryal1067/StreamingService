<?php

include('../database.php');
session_start();

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
  $query = "INSERT INTO videos(path, video_title, video_description,video_date, video_category, view_count) 
  VALUES('$path','$video_title','$video_description','$video_date', '$video_category', $view_count)";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }

  else{
    echo "<script>alert('Query Failed')<script>";
    return false;
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
      $image_category = $row['image-category'];
      $upload_date = $row['upload_date'];
    }
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
