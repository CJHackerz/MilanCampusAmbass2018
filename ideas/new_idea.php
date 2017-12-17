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
$ideas = new Ideas($db);

// check if more than 0 record found
if(
    $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['user_id'])
    && isset($_POST['category'])
    && isset($_POST['subject'])
    && isset($_POST['message'])
    && isset($_POST['contact_name'])
    && isset($_POST['contact_college'])
    && isset($_POST['contact_number'])
    && isset($_POST['contact_mail'])
    && isset($_POST['contact_year'])
) {

    if($ideas->newIdea(
        $_POST['user_id'],
        $_POST['category'],
        $_POST['subject'],
        $_POST['message'],
        $_POST['contact_name'],
        $_POST['contact_college'],
        $_POST['contact_number'],
        $_POST['contact_mail'],
        $_POST['contact_year']
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
