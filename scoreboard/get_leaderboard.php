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

if($users = $scoreboard->getTop10()) {
    $list = array();
    foreach($users as $u) {
        array_push($list, array(
            'fb_id' => $u['fb_id'],
            'user_name' => $u['user_name'],
            'score' => $u['score']
        ));
    }

    echo json_encode(
        array(
            'status_code' => 200,
            'message'=> "leaderboard list",
            'users' => $list
        )
    );
} else {
    echo json_encode(
        array(
            'status_code' => 400,
            'message' => 'BAD REQUEST. Invalid method or missing params'
        )
    );
}
?>
