<?php

class Users {
    // database connection and table name
    private $conn;

    // Object properties
    public $id;             // db id
    public $fb_id;          // fb id of user
    public $name;           // Users fb name
    public $email;
    public $mobile_number;
    public $whatsapp_number;
    public $city;
    public $college;
    public $address;
    public $zipcode;
    public $year_of_study;
    public $status;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }

    public function newUser($fb_id, $name, $email, $mobile_number, $whatsapp_number, $city, $college, $address, $zipcode, $year_of_study, $status) {
        $this->fb_id = htmlspecialchars(strip_tags($fb_id));
        $this->name = htmlspecialchars(strip_tags($name));
        $this->email = htmlspecialchars(strip_tags($email));
        $this->mobile_number = htmlspecialchars(strip_tags($mobile_number));
        $this->whatsapp_number = htmlspecialchars(strip_tags($whatsapp_number));
        $this->city = htmlspecialchars(strip_tags($city));
        $this->college = htmlspecialchars(strip_tags($college));
        $this->address = htmlspecialchars(strip_tags($address));
        $this->zipcode = htmlspecialchars(strip_tags($zipcode));
        $this->year_of_study = htmlspecialchars(strip_tags($year_of_study));
        $this->status = htmlspecialchars(strip_tags($status));

        $sql = "INSERT INTO users(fb_id, name, email, mobile_number, whatsapp_number, city, college, address, zipcode, year_of_study, status)
                VALUES(
                    '$this->fb_id',
                    '$this->name',
                    '$this->email',
                    '$this->mobile_number',
                    '$this->whatsapp_number',
                    '$this->city',
                    '$this->college',
                    '$this->address',
                    '$this->zipcode',
                    '$this->year_of_study',
                    '$this->status'
                )";

        if($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserStatus($fb_id) {
        $sql = "SELECT * FROM users WHERE fb_id = '$fb_id' AND status = 'set'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfile($fb_id) {
        $this->fb_id = htmlspecialchars(strip_tags($fb_id));

        $sql = "SELECT * FROM users WHERE fb_id = '$this->fb_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->email = $row['email'];
            $this->mobile_number = $row['mobile_number'];
            $this->whatsapp_number = $row['whatsapp_number'];
            $this->city = $row['city'];
            $this->college = $row['college'];
            $this->address = $row['address'];
            $this->zipcode = $row['zipcode'];
            $this->year_of_study = $row['year_of_study'];

            return $this;
        } else {
            return false; 
        }
    }

    public function updateProfile($fb_id, $email, $mobile_number, $whatsapp_number, $city, $college, $address, $zipcode, $year_of_study) {
        $this->fb_id = htmlspecialchars(strip_tags($fb_id));
        $this->email = htmlspecialchars(strip_tags($email));
        $this->mobile_number = htmlspecialchars(strip_tags($mobile_number));
        $this->whatsapp_number = htmlspecialchars(strip_tags($whatsapp_number));
        $this->city = htmlspecialchars(strip_tags($city));
        $this->college = htmlspecialchars(strip_tags($college));
        $this->address = htmlspecialchars(strip_tags($address));
        $this->zipcode = htmlspecialchars(strip_tags($zipcode));
        $this->year_of_study = htmlspecialchars(strip_tags($year_of_study));

        $sql = "SELECT * FROM users WHERE fb_id = '$this->fb_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {

            $sql = "UPDATE users SET
                    email='$this->email',
                    mobile_number = '$this->mobile_number',
                    whatsapp_number = '$this->whatsapp_number',
                    city = '$this->city',
                    college = '$this->college',
                    address = '$this->address',
                    zipcode = '$this->zipcode',
                    year_of_study = '$this->year_of_study'
                    WHERE fb_id = '$this->fb_id'";

            if($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>
