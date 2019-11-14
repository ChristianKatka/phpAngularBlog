<?php
require '../database.php';
// http://localhost/PHP-master/phpAngularBlog/backend/api/blog/create.php

$databaseService = new DatabaseService();
$con = $databaseService->mysqlConnect();

// Get the posted data.
$postdata = file_get_contents("php://input");
if (isset($postdata) && !empty($postdata)) {
  // Extract the data. second variable true = array.
  $request = json_decode($postdata, true);
  $userid = $request['userid'];
  $heading = $request['heading'];
  $content = $request['content'];
  // Validate.
  if (trim($heading) === '' || trim($content) === '') {
    return http_response_code(400);
  }
  // Create.
  $sql = "INSERT INTO `blog`(`usersid`,`heading`,`content`) VALUES ({$userid},'{$heading}','{$content}')";
  if (mysqli_query($con, $sql)) {
    //   201 = The request has been fulfilled and resources created
    http_response_code(201);
    $data = [
      'userid' => $userid,
      'heading' => $heading,
      'content' => $content
    ];
    echo json_encode($data);
    // close connection after data has been inserted
    mysqli_close($con);
  } else {
    http_response_code(422);
  }
}
// {
// 	"userid": 1,
// 	"heading": "otsikko",
// 	"content": "Olin kerran banaania etsimässä"
// 	}