<?php

include('./database.php');



function Query_execution($result){
  global $db_connection;
  if(!$result){
    die ('Query failed !'. mysqli_error($db_connection));
  }
}


//function to add fixtures
function addFixtures($fixtureTitle, $fixtureDate, $category)
{
    global $db_connection;
    // $fixtureTitle = mysqli_real_escape_string($db_connection, trim($fixtureTitle));
    // $fixtureDate = mysqli_real_escape_string($db_connection, trim($fixtureDate));
    // $category = mysqli_real_escape_string($db_connection, $category);

    // $stmt = mysqli_prepare($db_connection, "INSERT INTO 
    //  fixture(fixture_title, fixture_date, category) 
    // VALUES(?, ?, ?)");

    // mysqli_stmt_bind_param($stmt, 'sss', $fixtureTitle, $fixtureDate, $category);
    // mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);
    $query = "INSERT INTO fixtures(fixture_id,fixture_title, fixtre_date, fixture_category) VALUES ('1','$fixtureTitle', '$fixtureDate', '$category')";
    $queryInsert = mysqli_query($db_connection, $query);
    Query_execution($queryInsert);
    // if($queryInsert){
    //   return true;
    // }
}

//function to add videos
function addVideos($videoTitle, $videoDescription){
  global $db_connection;

}

//function to add category
function addCategory($categoryTitle){
  global $db_connection;

  $categoryTitle = mysqli_real_escape_string($db_connection, $categoryTitle);
  $stmt = mysqli_prepare($db_connection, "INSERT INTO category(category_name) VALUES(?)");
  mysqli_stmt_bind_param($stmt, 's', $categoryTitle);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  if($stmt){
    return true;
  }
  else{
    echo "Kera vaihalyo ni";
  }
}


?>

