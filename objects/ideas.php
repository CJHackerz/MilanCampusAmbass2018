<?php

class Ideas {
    // database connection and table name
    private $conn;

    // Object properties
    public $id;
    public $user_id;
    public $category;
    public $subject;
    public $message;
    public $contact_name;
    public $contact_college;
    public $contact_number;
    public $contact_mail;
    public $contact_year;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function newIdea(
        $user_id,
        $category,
        $subject,
        $message,
        $contact_name,
        $contact_college,
        $contact_number,
        $contact_mail,
        $contact_year
    ) {

        $this->user_id = htmlspecialchars(strip_tags($user_id));
        $this->category;
        $this->subject = htmlspecialchars(strip_tags($subject));
        $this->message = htmlspecialchars(strip_tags($message));
        $this->contact_name = htmlspecialchars(strip_tags($contact_name));
        $this->contact_college = htmlspecialchars(strip_tags($contact_college));
        $this->contact_number = htmlspecialchars(strip_tags($contact_number));
        $this->contact_mail = htmlspecialchars(strip_tags($contact_mail));
        $this->contact_year = $contact_year;

        $sql = "INSERT INTO ideas(user_id, category, subject, message, contact_name, contact_college, contact_number, contact_mail, contact_year)
                VALUES('$this->user_id', '$this->category', '$this->subject', '$this->message', '$this->contact_name', '$this->contact_college', '$this->contact_number', '$this->contact_mail', $this->contact_year)";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>
