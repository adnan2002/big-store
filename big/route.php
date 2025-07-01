<?php 

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\');
$baseUrl = rtrim($protocol . $host . $path, '/');

$productId = 5;
$redirectUrl = $baseUrl . "/product.php?id=" . $productId;

header("Location: " . $redirectUrl, true, 302);
exit(); 
?>

