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

public function leader(){
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    $result = $db->query('SELECT id,fb_id,name,status FROM users ORDER BY status desc');

    $list = array ();
    $x = 0;
    while ($row = $result->fetch_array(MYSQLI_ASSOC) {
        $list[$row->id]['fb_id'] = $row->fb_id;
        $list[$row->id]['name'] = $row->name;
        $list[$row->id]['status'] = $row->status;
        $x++;
        if($x==10){
            break;
        }
    }

// not sure which one is correct
    foreach($list['id'] as $list) {
        echo $list['fb_id'], '<br>';
        echo $list['name'], '<br>';
        echo $list['status'], '<br>';
    }
    //echo $list;
}
?>