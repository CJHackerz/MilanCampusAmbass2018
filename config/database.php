<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "milancr";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        $this->conn = new mysqli($host, $username, $password, $db_name);
        $this->conn->exec("set names utf8");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        return $this->conn;
    }
}
?>
