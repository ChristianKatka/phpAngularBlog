<?php
// http://localhost/PHP-master/phpAngularBlog/backend/api/blog/read.php
require '../database.php';

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$databaseService = new DatabaseService();
$con = $databaseService->mysqlConnect();

$sql = "SELECT * FROM blog ORDER BY Date DESC";

if ($result = mysqli_query($con, $sql)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $blog[$i]['Blogid']     = $row['Blogid'];
        $blog[$i]['Usersid'] = $row['Usersid'];
        $blog[$i]['heading'] = $row['heading'];
        $blog[$i]['content'] = $row['content'];
        $blog[$i]['date'] = $row['date'];
        $i++;
    }
    echo json_encode($blog);
   
} else {
    echo 'errorr';
    http_response_code(404);
    echo mysqli_error($conn);
    echo mysqli_connect_error();
}
mysqli_close($con);


// $stmt = $conn->prepare($query);

// if ($stmt->execute()) {
//     $i = 0;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $blog[$i]['Blogid']  = $row['Blogid'];
//         $blog[$i]['usersid'] = $row['usersid'];
//         $blog[$i]['heading'] = $row['heading'];
//         $blog[$i]['content'] = $row['content'];
//         $blog[$i]['date'] = $row['date'];
//         $i++;
//     }
//     echo json_encode($blog);
// }
// else {
//     http_response_code(404);
//     echo json_encode(array("message" => "not found."));
// }

// if (false === $stmt) {
//     // and since all the following operations need a valid/ready statement object
//     // it doesn't make sense to go on
//     // you might want to use a more sophisticated mechanism than die()
//     // but's it's only an example
//     die('prepare() failed: ' . htmlspecialchars($mysqli->error));
// }

// $rc = $stmt->execute();
// // execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable
// // 2006 "server gone away" is always an option
// if (false === $rc) {
//     die('execute() failed: ' . htmlspecialchars($stmt->error));
// }

// $stmt->close();




// // connect function from database.php
// if ($result = mysqli_query($databaseService->mysqlConnect(), $sql)) {
//     echo 'toimi';
//     $i = 0;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $blog[$i]['Blogid']     = $row['Blogid'];
//         $blog[$i]['Usersid'] = $row['Usersid'];
//         $blog[$i]['heading'] = $row['heading'];
//         $blog[$i]['content'] = $row['content'];
//         $blog[$i]['date'] = $row['date'];
//         $i++;
//     }
//     echo json_encode($blog);
// } else {
//     echo 'errorr';
//     http_response_code(404);
//     echo mysqli_error($conn);
//     echo mysqli_connect_error();
// }








