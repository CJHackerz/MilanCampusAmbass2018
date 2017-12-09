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

function leader(){//ignore the comments please
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    //$result = $db->query('SELECT id,fb_id,name,status FROM users ORDER BY status desc');
    $result = $db->query('SELECT *
                        FROM (SELECT id, fb_id, name, count(*) as score
                            FROM shares
                            GROUP BY id
                            ORDER BY count(*) DESC)
                        LIMIT 10');

    $list = array ();

    echo '<table><tr><th>Name</th><th>Facebook ID</th><th>Score</th></tr>';

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo json_encode(
            array(
                'name' => $row->name,
                'fb_id' => $row->fb_id,
                'score' => $row->score,
                'status_code' => 200,
                'message' => 'Accepted request'
            );
        )
        /*
        echo '<tr><td>' . $row->name . '</td>';
        echo '<td>' . $row->fb_id . '</td>';
        echo '<td>' . $row->score . '</td></tr>';
        */
        /*
        $list[$row->id]['fb_id'] = $row->fb_id;
        $list[$row->id]['name'] = $row->name;
        $list[$row->id]['score'] = $row->score;
        $x++;
        */
    }
   // echo '</table>';
    /*
    foreach($list['id'] as $list) {
        echo $list['fb_id'], '<br>';
        echo $list['name'], '<br>';
        echo $list['status'], '<br>';
    }
    */
    //echo $list;
}
?>