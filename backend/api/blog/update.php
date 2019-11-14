<?php
// http://localhost/PHP-master/phpAngularBlog/backend/api/blog/update.php

require '../database.php';

$databaseService = new DatabaseService();
$con = $databaseService->mysqlConnect();

// Get the posted data.
// file_get_contents — Reads entire file into a string
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
  // Extract the data.
  // Takes a JSON encoded string and converts it into a PHP variable.
  $request = json_decode($postdata);

  // Validate.
  // if ((int) $request->id < 1 || trim($request->number) == '' || (float) $request->amount < 0) {
  //   return http_response_code(400);
  // }

  // UPDATE blog SET content='testi' WHERE `Blogid` = 1;
  
  // Update.
  $sql = "UPDATE `blog` SET `content`='$request->content' WHERE `Blogid` = '{$request->Blogid}'";

  if (mysqli_query($con, $sql)) {
    print 'Successfully updated!';
  } else {
    return http_response_code(422);
  }
  mysqli_close($con);
}


// {
//   "Blogid": "1",
//   "content": "Posti testi vain"
//   }
