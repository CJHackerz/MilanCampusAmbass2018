<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "milancr";
    private $username = "root";
    private $password = "srmdsa";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        // $this->conn->exec("set names utf8");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $this->conn;
    }
}
?>
