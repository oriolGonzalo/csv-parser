<?php

$request = $_SERVER['REQUEST_URI'];

if( ($pos = strpos($request, '?')) !== false) $request = substr($request, 0, $pos);

switch ($request) {
    case '/' :
        require __DIR__ . '/src' . '/showStarshipsTableSummary.php';
        break;
    case '/show_starship_detail' :
        require __DIR__ . '/src' . '/showStarshipDetail.php';
        break;
    case '/delete_starship' :
        require __DIR__ . '/src' . '/deleteStarship.php';
        break;
    case '/add_starship_form' :
        require  __DIR__ . '/src' . '/addStarshipForm.php';
        break;
    case '/add_starship' :
        require __DIR__ . '/src' . '/addStarship.php';
        break;
    default:
        http_response_code(404);
        break;
}