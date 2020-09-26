<?php

// File for running the poage using PHP's build-in server instead of apache/nginx

$uri = $_SERVER['REQUEST_URI'];

// fallback for loading index page by default
if ($uri === '/') {
    require 'index.html';
    exit;
}

// if file actually exists, show the file instead of executing PHP
if (file_exists(__DIR__ . $uri) && is_file(__DIR__ . $uri)) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type =  finfo_file($finfo, __DIR__ . $uri);
    finfo_close($finfo);

    // force CSS files to have correct mime type
    // saw an issue on Vivaldi .. probably applies to all Chrome broswers
    if (strpos($uri, '.css')) {
        $type = 'text/css';
    }

    // force JS files to have correct mime type
    if (strpos($uri, '.js')) {
        $type = 'application/javascript';
    }
    header('Content-Type: ' . $type);
    echo file_get_contents(__DIR__ . $uri);
    exit;
}

// if it gets to here, just run php code
require __DIR__ . '/api.php';
