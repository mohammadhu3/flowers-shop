// routeur => pointe vers les views

<?php

require_once "includes/functions.php";
// Définition des routes
$routes = [
    'login' => 'views/login.php',
    'admin' => 'views/admin.php',
    'employe' => 'views/employe.php',
    'dashboard' => 'controllers/dashboard.php',
    '404' => 'views/404.php',
];

// Récupération de la route lors du chargement de la page
$page = $_GET["page"] ?? "login";

// Routage
if (!array_key_exists($page, $routes)) {
    redirect($routes['404']);
}

include($routes[$page]);
