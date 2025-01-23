<?php
const DB_HOST = 'localhost';
const DB_USER = 'webprof_kupriun';
const DB_PASS = 'Webprof!1';
const DB_NAME = 'webprof_kupriun';
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try {
    $db = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
    die('Connection failed: ' . $e);
}
