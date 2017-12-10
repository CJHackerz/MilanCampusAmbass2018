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
include_once '../objects/users.php';

function leader(){//ignore the comments please
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    //$result = $db->query('SELECT id,fb_id,name,status FROM users ORDER BY status desc');
    $result = $db->query('SELECT * FROM (SELECT id, fb_id, name, count(*) as score FROM shares GROUP BY id ORDER BY count(*) DESC) LIMIT 10');

    $list = array ();

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        /*
        echo json_encode(
            array(
                'name' => $row->name,
                'fb_id' => $row->fb_id,
                'score' => $row->score,
                'status_code' => 200,
                'message' => 'Accepted request'
            );
        )*/
        $user_table = $db->query("SELECT city, college FROM users WHERE fb_id = '$row->fb_id'")
        $row_1 = $user_table->fetch_array(MYSQLI_ASSOC);

        $list[$row->id]['fb_id'] = $row->fb_id;
        $list[$row->id]['name'] = $row->name;
        $list[$row->id]['score'] = $row->score;
        $list[$row->id]['city'] = $row_1->city;
        $list[$row->id]['college'] = $row_1->college;
    }
    echo json_encode($list);
}
?>