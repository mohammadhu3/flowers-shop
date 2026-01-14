<?php

require_once "includes/functions.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : liste blanche des pages
$routes = [
    'login' => 'views/login.php',
    'admin' => 'controllers/dashboard_admin.php',  // MVC : controller pour admin
    'employe' => 'controllers/dashboard_employe.php',
//    'dashboard' => 'controllers/dashboard_admin.php',
    '404' => 'views/404.php',
];

$page = $_GET["page"] ?? "login";

// Sécurité : verifie que la page existe dans $routes
if (!array_key_exists($page, $routes)) {
    $page = '404';
}

// Sécurité : verifie si l'utilisateur est connecté avant d'acceder aux pages sur la liste blanche
if (!isset($_SESSION['user_id']) && $page !== 'login' && $page !== '404') {
    redirect('index.php?page=login');
}

require_once $routes[$page];
