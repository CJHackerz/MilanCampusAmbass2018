<?php

class Posts {
    // database connection and table name
    private $conn;

    // Object properties
    public $post_id;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getPost() {
       $sql = "SELECT * FROM posts ORDER BY timestamp DESC";

       $result = $this->conn->query($sql);

       $posts = array();

       if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $p = array(
                    "post_id"=> $row['post_id'],
                );
                array_push($posts, $p);
           }
           return $posts;
        } else {
           return false;
        }
    }
}

?>
