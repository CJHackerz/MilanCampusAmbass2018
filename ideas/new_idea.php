<?php
error_reporting(0);
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/ideas.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$shares = new Ideas($db);

// check if more than 0 record found
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['venue']) && isset($_POST['venue_address']) && isset($_POST['contact_name']) && isset($_POST['contact_number']) && isset($_POST['remarks'])) {

    if($shares->newIdea($_POST['user_id'], $_POST['venue'], $_POST['venue_address'], $_POST['contact_name'], $_POST['contact_number'], $_POST['remarks'])) {
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
