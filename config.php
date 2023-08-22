<?php

// $sname = "localhost";
// $username = "root";
// $password = "";

// $db_name = 'admin';

// $conn = mysqli_connect($sname, $username, $password, $db_name);

// if(!$conn){
//     echo "Connection Failed";
// }

class Database {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "admin";
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}

$db = new Database(); // Create an instance of the Database class to initialize the connection.

?>