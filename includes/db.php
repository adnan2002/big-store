<?php // /gemini-store/includes/db.php

// --- Database Configuration ---
$dbHost = 'localhost';
$dbUser = 'root'; // Default XAMPP user
$dbPass = '';     // Default XAMPP password
$dbName = 'gemini_store';

// --- Create Connection ---
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// --- Check Connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Helper function to get the base URL ---
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    // This provides the path to the directory containing the main script.
    // e.g. /gemini-store
    $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    // Ensure we handle being in the root directory
    $path = ($path == '/' || $path == '\\') ? '' : $path;
    return rtrim($protocol . $host . $path, '/');
}

define('BASE_URL', getBaseUrl());

?>