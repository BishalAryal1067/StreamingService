<?php

include('./database.php');


//function to add fixtures
function addFixtures($fixtureTitle, $fixtureDate, $category)
{
    global $db_connection;
    $fixtureTitle = mysqli_real_escape_string($db_connection, trim($fixtureTitle));
    $fixtureDate = mysqli_real_escape_string($db_connection, trim($fixtureDate));
    $category = mysqli_real_escape_string($db_connection, $category);

    $stmt = mysqli_prepare($db_connection, "INSERT INTO 
     fixture(fixture_title, fixture_date, category) 
    VALUES(?, ?, ?)");

    mysqli_stmt_bind_param($stmt, 'sss', $fixtureTitle, $fixtureDate, $category);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

//function to add videos
function addVideos($videoTitle, $videoDescription){
  global $db_connection;

}


