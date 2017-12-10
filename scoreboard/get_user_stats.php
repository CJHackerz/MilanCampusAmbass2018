<?php
// error_reporting(0);
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/scoreboard.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$scoreboard = new Scoreboard($db);

// check if more than 0 record found
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fb_id'])) {

    if($res = $scoreboard->getUserStats($_POST['fb_id'])) {
        echo json_encode(
            array(
                'status_code' => 200,
                'message' => 'User stats received',
                'user' => array(
                    'shares' => $res->shares,
                    'score' => $res->score
                )
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
