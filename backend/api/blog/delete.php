<?php
// param   http://localhost/PHP-master/phpAngularBlog/backend/api/blog/delete.php?blogid=2

require '../database.php';

$databaseService = new DatabaseService();
$con = $databaseService->mysqlConnect();

// extract param id
$blogid = $_GET['blogid'];

if (!$blogid) {
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `blog` WHERE `Blogid` ='{$blogid}' LIMIT 1";


// FIND WAY TO CHECK IF QUERY WAS SUCCESFULL
if (mysqli_query($con, $sql)) {
  print 'row deleted with blogid: ' . $blogid;
} else {
  return http_response_code(422);
}

mysqli_close($con);
