<?php
// error_reporting(0);
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$users = new Users($db);

// check if more than 0 record found
if(
    $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['fb_id'])
    && isset($_POST['name'])
    && isset($_POST['email'])
    && isset($_POST['mobile_number'])
    && isset($_POST['whatsapp_number'])
    && isset($_POST['city'])
    && isset($_POST['college'])
    && isset($_POST['address'])
    && isset($_POST['zipcode'])
    && isset($_POST['year_of_study'])
) {

    if($users->newUser(
        $_POST['fb_id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile_number'],
        $_POST['whatsapp_number'],
        $_POST['city'],
        $_POST['college'],
        $_POST['address'],
        $_POST['zipcode'],
        $_POST['year_of_study'],
        'set'
    )) {
        echo json_encode(
            array(
                'status_code' => 200,
                'message' => 'Accepted request'
            )
        );
    } else {
        echo json_encode(
            array(
                'status_code' => 500,
                'message' => 'Internal server error'
            )
        );
    }

}

else{
    echo json_encode(
        array(
            'status_code' => 400,
            'message' => 'BAD REQUEST. Invalid method or missing params'
        )
    );
}
?>
