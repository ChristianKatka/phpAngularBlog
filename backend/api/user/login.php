<?php
// http://localhost/PHP-master/phpAngularBlog/backend/api/user/login.php

include_once '../database.php';
require "../../vendor/autoload.php";

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();


$data = json_decode(file_get_contents("php://input"));

$userName = $data->user_name;
$password = $data->password;

$table_name = 'Users';

$query = "SELECT username, password FROM users WHERE username='$userName' LIMIT 1";

$stmt = $conn->prepare( $query );
$stmt->execute();

$num = $stmt->rowCount();

// If query returns something
if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['usersid'];
    $username = $row['username'];
    $password2 = $row['password'];

    // Verify hashed password
    if(password_verify($password, $password2))
    {
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
                "id" => $id,
                "username" => $username,
                "password" => $password
        ));

        http_response_code(200);
        // encode method will transform the PHP array into JSON format and sign the payload
        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "username" => $username,
                "expireAt" => $expire_claim
            ));
    }
    else{

        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
}

// {
// 	"user_name": "julli",
// 	"password": "salainen"
// 	}

?>
