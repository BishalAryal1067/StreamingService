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

function delete_fixtures($id){
   global $db_connection;
   $query = "DELETE FROM fixtures WHERE fixture_id=$id";
   $update = "SELECT * FROM fixtures";
   $delete_result=mysqli_query($db_connection,$query);
   $update_result =mysqli_query($db_connection, $query);
   if($delete_result && $update_result){
    return true;
   }

   else{
    echo "Query Failed";
    return false;
   }
   
}

//function fetch fixtures
// class fixtureDetail
// {
//   public $fixtureTitle, $fixtureDate, $fixtureCategory;
// }

// function fetch_fixtures()
// {
  
// }

/*----------------------------------------------------------------------------------------*/

//function to add videos
function add_videos($path, $videoTitle, $videoDescription, $videoDate, $videoCategory)
{
  global $db_connection;
  $viewCount = 0;
  $query = "INSERT INTO videos(path, video_title, video_description,video_date, video_category, view_count) VALUES('$path','$videoTitle','$videoDescription','$videoDate', '$videoCategory', $viewCount)";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}

//function to add images
function add_images($path, $imageCaption, $category, $uploadDate)
{
  global $db_connection;
  $query = "INSERT INTO images(path, image_caption, category, upload_date) 
   VALUES('$path', '$imageCaption', '$category', '$uploadDate')";
  $insertQuery = mysqli_query($db_connection, $query);
  if ($insertQuery) {
    return true;
  }
}

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
}
