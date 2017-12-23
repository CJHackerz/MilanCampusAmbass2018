<?php

class Scoreboard {
    // database connection and table name
    private $conn;

    // Object properties
    public $fb_id;
    public $user_name;
    public $score;
    public $shares;
    public $fortnight_score;
    public $fortnight_shares;
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

        $sql = "UPDATE scoreboard SET score = score+4, shares = shares+1, fortnight_score = fortnight_score + 4, fortnight_shares = fortnight_shares + 1 WHERE fb_id = '$this->fb_id'";

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
            $this->fortnight_score = $r['fortnight_score'];
            $this->fortnight_shares = $r['fortnight_shares'];

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

    public function resetFortnight($secret) {
        if($secret != '6b7477c1a02a90e2fc50b185a872d82a') {
            return false;
        }
        // Create csv file

        $file = fopen('../../Fortnight' . date('d-m-Y h-i-s', time()) . '.csv', 'w');

        fputcsv($file, array('position', 'fb_id', 'name', 'fortnight_score', 'fortnight_shares'));

        $sql = "SELECT * FROM scoreboard ORDER BY fortnight_score";

        $result = $this->conn->query($sql);

        $data = array();

        $i = 1;
        while($row = $result->fetch_assoc()) {
            array_push($data, array(
                $i, $row['fb_id'], $row['user_name'], $row['fortnight_score'], $row['fortnight_shares']
            ));
            $i++;
        }

        foreach ($data as $r)
        {
            fputcsv($file, $r);
        }

        $sql = "UPDATE scoreboard SET fortnight_score = 0, fortnight_shares = 0";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

}

?>
