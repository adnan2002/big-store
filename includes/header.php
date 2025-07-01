<?php
require_once 'db.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Big Store</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <script>
        const BASE_URL = '<?= BASE_URL ?>';
        const CURRENT_PAGE = '<?= $current_page ?>';
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased">
    
    <div id="tailwind-warning" style="display: none; padding: 1rem; background-color: #fffbe5; color: #c2820a; text-align: center; border-bottom: 1px solid #fef3c7; font-weight: 500;">
        <strong>Styling Issue:</strong> The website's design framework could not be loaded. Please check your internet connection and disable any ad-blockers that might be interfering.
    </div>

    <header class="bg-white/70 backdrop-blur-lg shadow-sm sticky top-0 z-40">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?= BASE_URL ?>/index.php" class="text-2xl font-extrabold text-gray-900 tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-500">Big</span>Store
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?= BASE_URL ?>/index.php" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300 font-medium">Home</a>
                <a href="<?= BASE_URL ?>/category.php?id=1" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300 font-medium">Hoodies</a>
                <a href="<?= BASE_URL ?>/category.php?id=2" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300 font-medium">Pants</a>
                <a href="<?= BASE_URL ?>/big/route" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm">
                    ✨ Special Product
                </a>
            </div>
             <button class="md:hidden text-gray-600 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
    </header>
    <main class="container mx-auto px-4 sm:px-6 py-10">