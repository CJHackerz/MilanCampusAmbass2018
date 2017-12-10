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

if($res = $scoreboard->getUserStats($_POST['fb_id'])) {

    $query = $db->query('SELECT * FROM scoreboard GROUP BY fb_id ORDER BY shares DESC LIMIT 10'); 
    
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {


        $list[$row->id]['fb_id'] = $row->fb_id;
        $list[$row->id]['name'] = $row->name;
        $list[$row->id]['score'] = $row->score;
        $list[$row->id]['city'] = $row_1->city;
        $list[$row->id]['college'] = $row_1->college;
    }
    echo json_encode($list);
    echo json_encode(
        array(
            'status_code' => 200,
            'message' => 'User stats received',
            'user' => array(
                'fb_id' => $res->fb_id,
                'name' => $res->user_name,
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
?>
