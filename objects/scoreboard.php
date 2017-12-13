<?php

class Scoreboard {
    // database connection and table name
    private $conn;

    // Object properties
    public $fb_id;
    public $user_name;
    public $score;
    public $shares;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function newUserScore($fb_id, $user_name) {

        $this->fb_id = htmlspecialchars(strip_tags($fb_id));
        $this->user_name = htmlspecialchars(strip_tags($user_name));

        $sql = "INSERT INTO scoreboard(fb_id, user_name, score, shares)
                VALUES('$this->fb_id', '$this->user_name', 0, 0)";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateScoreOnShare($fb_id) {
        $this->fb_id = htmlspecialchars(strip_tags($fb_id));

        $sql = "UPDATE scoreboard SET score = score+4, shares = shares+1 WHERE fb_id = '$this->fb_id'";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserStats($fb_id) {
        $this->fb_id = htmlspecialchars(strip_tags($fb_id));

        $sql = "SELECT * FROM scoreboard where fb_id = $this->fb_id";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $r = $result->fetch_assoc();
            $this->score = $r['score'];
            $this->shares = $r['shares'];
            $this->user_name = $r['user_name'];

            return $this;
        } else {
            return false;
        }
    }

    public function getTop10() {
        $sql = "SELECT * FROM scoreboard order by score desc limit 10";
        
        $result = $this->conn->query($sql);

        $users = array();

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $t = array(
                    "fb_id"=> $row['fb_id'],
                    'user_name'=> $row['user_name'],
                    'score'=> $row['score']
                );
                array_push($users, $t);
            }

            return $users;
        } else {
            return false;
        }
    }
}

?>
