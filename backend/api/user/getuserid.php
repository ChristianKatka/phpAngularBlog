<?php
// http://localhost/PHP-master/phpAngularBlog/backend/api/user/getuserid.php?username=a
include_once '../database.php';



$databaseService = new DatabaseService();
$conn = $databaseService->mysqlConnect();

// extract param id
$username = $_GET['username'];

if (!$username) {
    return http_response_code(400);
}

//   SELECT usersid FROM Users WHERE username='a';
$sql = "SELECT usersid FROM Users WHERE username='$username'";


if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    // output data of each row
    while ($row = mysqli_fetch_array($result)) {
        echo json_encode($row["usersid"]);
    }
        // free the memory associated with the result
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not execute $sql " . mysqli_error($link);
}









mysqli_close($con);
