<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/getAllTasks.php';
require_once __DIR__ . '/../models/getTasksByUser.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role'], $_SESSION['user_id'])) {
    redirect('index.php?page=login');
}

debug($_SESSION["user_id"]);

if ($_SESSION["user_role"] === "Responsable") {
    $tasks = getAllTasks($pdo);
    require_once __DIR__ . '/../views/admin.php';
} else {
    $tasks = getTasksByUser($pdo, (int)$_SESSION["user_id"]);
    require_once __DIR__ . '/../views/employe.php';
}

