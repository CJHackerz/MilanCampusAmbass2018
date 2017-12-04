<?php

class Shares {
    // database connection and table name
    private $conn;
    private $table_name = "products";

    // Object properties
    public $id;             // db id
    public $user_id;        // fb id of user
    public $post_id;        // id of the post being shared
    public $share_post_id;  // id of the post by user
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function newShare($user_id, $post_id, $share_post_id) {
        $this->$user_id         = htmlspecialchars(strip_tags($user_id));
        $this->post_id          = htmlspecialchars(strip_tags($post_id));
        $this->share_post_id    = htmlspecialchars(strip_tags($share_post_id));

        $sql = "INSERT INTO shares(user_id, post_id, share_post_id)
                VALUES('$this->user_id', '$this->post_id', '$shares->share_post_id')";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>
