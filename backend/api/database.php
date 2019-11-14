
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

class DatabaseService
{

    private $connection;

    /**PDO
     * 
     */
    public function getConnection()
    {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=phpblog", "root", "root");
        } catch (PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->connection;
    }

    public function mysqlConnect()
    {
       return $conn = mysqli_connect('localhost', 'root', 'root', 'phpblog');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}

// $databaseService = new DatabaseService();
// $databaseService->getConnection();

?>