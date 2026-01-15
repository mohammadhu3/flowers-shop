<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/getTasksByUser.php';
require_once __DIR__ . '/../models/setStatusTask.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role'], $_SESSION['user_id'])) {
    redirect('index.php?page=login');
}

if (isset($_POST['task_id'], $_POST['status'])) {
    $taskId = (int)$_POST['task_id'];
    $status = trim($_POST['status']);

    setStatusTask($pdo, $taskId, (int)$_SESSION['user_id'], $status);

    header('Location: index.php?page=employe');
    exit;
}

$tasks = getTasksByUser($pdo, $_SESSION['user_id']);

require_once __DIR__ . '/../views/employe.php';