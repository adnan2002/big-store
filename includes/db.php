<?php 
$dbHost = 'localhost';
$dbUser = 'root'; 
$dbPass = '';     
$dbName = 'big_store';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
            $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        $path = ($path == '/' || $path == '\\') ? '' : $path;
    return rtrim($protocol . $host . $path, '/');
}

define('BASE_URL', getBaseUrl());

?>