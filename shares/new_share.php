<?php
// error_reporting(0);
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shares.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$shares = new Shares($db);

// check if more than 0 record found
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['user_id'] != '' && $_POST['post_id'] != ''&& $_POST['share_post_id'] != '') {

    if($shares->newShare($_POST['user_id'], $_POST['post_id'], $_POST['share_post_id'])) {
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
