<?php
declare(strict_types=1);

require_once('../db.php');
require_once('../utils/echoRes.php');
require_once('registration.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requsted-With');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];
$uriParts = parse_url($uri);

$pathParts = explode('/', trim($uriParts['path'], '/'));
$queryString = $uriParts['query'];

$input = json_decode(file_get_contents('php://input'));

switch ($pathParts[0]) {
    case 'registration': // Вынести всю байду в отдельный файл
        if ($pathParts[1]) {
            echoRes(['message' => 'Invalid request']); // Не соответствует требованиям, временная мера
            break;
        } else if ($method !== 'POST') {
            echoRes(['message' => 'Invalid request']); // Не соответствует требованиям, временная мера
            break;
        }

        registration($db, $input);
        break;

    default: 
        echoRes(['message' => 'Invalid request']); // Не соответствует требованиям, временная мера
}   
