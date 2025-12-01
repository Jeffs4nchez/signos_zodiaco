<?php

// 🔮 ZODIAC SIGN API - ROUTER FOR RAILWAY
// Simple PHP router that doesn't require full Laravel

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove leading slash
$uri = ltrim($uri, '/');

// If it's a file that exists, serve it
if ($uri && file_exists(__DIR__ . '/public/' . $uri)) {
    return false;
}

// If requesting index, serve index.html or api-simple.php
if ($uri === '' || $uri === '/') {
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
    require __DIR__ . '/public/index.php';
    return true;
}

// API requests go to api-simple.php
if (strpos($uri, 'api/') === 0 || $uri === 'health' || $uri === 'up') {
    $_SERVER['REQUEST_URI'] = '/' . $uri;
    $_SERVER['SCRIPT_NAME'] = '/api-simple.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/api-simple.php';
    require __DIR__ . '/public/api-simple.php';
    return true;
}

// Default: try main index
$_SERVER['REQUEST_URI'] = '/' . $uri;
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
require __DIR__ . '/public/index.php';
return true;
