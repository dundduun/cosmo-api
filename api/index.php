<?php
declare(strict_types=1);

require_once('../db.php');
require_once('../utils/echoRes.php');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requsted-With');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];

$input = json_decode(file_get_contents('php://input'));

