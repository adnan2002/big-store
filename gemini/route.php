<?php // /gemini-store/gemini/route.php

/**
 * This is the entry point for our custom module route.
 * It forwards the user to a specific product page.
 *
 * The URL is constructed manually here to avoid issues with path calculation
 * when this script is run from a subdirectory.
 */

// Construct the base URL by navigating two levels up from the current script's directory.
// This correctly finds the root of the store (e.g., /gemini-store)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
// dirname($_SERVER['SCRIPT_NAME']) gives /gemini-store/gemini
// dirname of that gives /gemini-store, which is the correct base path.
$path = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\');
$baseUrl = rtrim($protocol . $host . $path, '/');


// The ID of the product we want to redirect to.
// Let's choose the "Stellar Solar Jacket" (ID: 5)
$productId = 5;

// Construct the full, correct redirect URL.
$redirectUrl = $baseUrl . "/product.php?id=" . $productId;

// Perform the redirect.
// The 302 status code indicates a temporary redirect.
header("Location: " . $redirectUrl, true, 302);
exit(); // Ensure no further code is executed after the redirect.

?>
