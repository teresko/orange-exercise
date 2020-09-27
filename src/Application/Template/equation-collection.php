<?php

return [
    'rel' => 'collection',
    'href' => '/api/equations',
    'count' => count($list),
    'items' => array_map(function ($equation) {
        return (require __DIR__ . '/equation.php');
    }, \a(...$list)),
];
