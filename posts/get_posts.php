<?php
// error_reporting(0);
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/posts.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$posts = new Posts($db);

// check if more than 0 record found

if($result = $posts->getPost()) {
    $list = array();
    foreach($result as $r) {
        array_push($list, array(
            'post_id' => $r['post_id'],
        ));
    }

    echo json_encode(
        array(
            'status_code' => 200,
            'message'=> "post list",
            'posts' => $list
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
