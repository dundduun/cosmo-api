<?php
require_once('db.php');
require_once('utils/echoRes.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requsted-With');
header('Content-Type: application/json');


$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'), true);

switch($method) {
    case 'GET':
        handleGet($db);
        break;
    
    // case 'POST':
    //     handlePost($db);
    //     break;
    
    // case 'PUT':
    //     handlePut();
    //     break;

    // case 'DELETE':
    //     handleDelete();
    //     break;

    default:
        echoRes(['message' => 'Invalid request']);
}

function handleGet(PDO $db) {
    $sql = 'SELECT * FROM crew_list';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echoRes($result);
}

// function handlePost(PDO $db) {

// }
