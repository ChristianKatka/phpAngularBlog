<?php
// http://localhost/PHP-master/phpAngularBlog/backend/api/user/register.php

require '../database.php';
require "../../vendor/autoload.php";

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));


if (isset($data) && !empty($data)) {


  $userName = $data->user_name;
  $password = $data->password;

  // echo 'LOGATAA BÄKKÄRIS ' . $userName . ' ' . $password;

  // Hash the password
  $password_hash = password_hash($password, PASSWORD_BCRYPT);

  $query = "INSERT INTO Users (username, password)
  VALUES ('$userName', '$password_hash')";

  $stmt = $conn->prepare($query);


  if ($stmt->execute()) {

    $secret_key = "YOUR_SECRET_KEY";
    $issuer_claim = "THE_ISSUER"; // this can be the servername
    $audience_claim = "THE_AUDIENCE";
    $issuedat_claim = time(); // issued at
    // token will be valid after one second after being issued
    $notbefore_claim = $issuedat_claim + 1; //not before in seconds
    $expire_claim = $issuedat_claim + 6000; // expire time in seconds
    $token = array(
      "iss" => $issuer_claim,
      "aud" => $audience_claim,
      // timestamp of token issuing.
      "iat" => $issuedat_claim,
      "nbf" => $notbefore_claim,
      "exp" => $expire_claim,

      "data" => array(
        "username" => $userName,
        "password" => $password
      )
    );

    http_response_code(200);
    // encode method will transform the PHP array into JSON format and sign the payload
    $jwt = JWT::encode($token, $secret_key);
    echo json_encode(
      array(
        "message" => "User was successfully registered.",
        "jwt" => $jwt,
        "username" => $userName,
        "expireAt" => $expire_claim
      )
    );
  } else {
    http_response_code(400);

    echo json_encode(array("message" => "Unable to register the user."));
  }
} else {
  echo 'error, no data';
}


// {
// 	"user_name": "julli",
// 	"password": "salainen"
// 	}
