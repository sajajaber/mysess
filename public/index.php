<?php
// aftima index with router here tut helpful https://www.youtube.com/watch?v=JycBuHA-glg

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

// get URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = rtrim($url, '/');

if ($url == '') {
    $url = '/';
}

$method = $_SERVER['REQUEST_METHOD'];


//login pg
if ($url == '/' || $url == '/login') {
    $controller = new AuthController();

    if ($method == 'POST') {
        $controller->login();
    } else {
        $controller->showLogin();
    }
}

//logout
else if ($url == '/logout') {
    $controller = new AuthController();
    $controller->logout();
}

//admin tba
else if ($url == '/admin/dashboard') {
    echo "admin dashb not complete yet";
}

// teacher tba
else if ($url == '/teacher/dashboard') {
    echo "teacher dashb not complete yet";
}

else {
    echo "Page not found";
}
?>
