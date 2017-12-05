<?php

class Ideas {
    // database connection and table name
    private $conn;

    // Object properties
    public $id;
    public $user_id;
    public $venue;
    public $address;
    public $contact_name;
    public $contact_number;
    public $remarks;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function newIdea($user_id, $venue, $address, $contact_name, $contact_number, $remarks) {
        if($user_id == 'undefined' || $venue == 'undefined' || $address == 'undefined' || $contact_name == 'undefined' || $contact_number == 'undefined' || $remarks == 'undefined') {
            return false;
        }

        $this->user_id = htmlspecialchars(strip_tags($user_id));
        $this->venue = htmlspecialchars(strip_tags($venue));
        $this->address = htmlspecialchars(strip_tags($address));
        $this->contact_name = htmlspecialchars(strip_tags($contact_name));
        $this->contact_number = htmlspecialchars(strip_tags($contact_number));
        $this->remarks = htmlspecialchars(strip_tags($remarks));

        $sql = "INSERT INTO ideas(user_id, venue, address, contact_name, contact_number, remarks)
                VALUES('$this->user_id', '$this->venue', '$this->address', '$this->contact_name', '$this->contact_number', '$this->remarks')";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>
