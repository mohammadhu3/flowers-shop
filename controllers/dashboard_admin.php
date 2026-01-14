<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/getAllTasks.php';
require_once __DIR__ . '/../models/addTask.php';
require_once __DIR__ . '/../models/getAllUsers.php';
require_once __DIR__ . '/../models/statistics.php';
require_once __DIR__ . '/../models/deleteTask.php';

if (!isset($_SESSION['user_role'], $_SESSION['user_id'])) {
    redirect('index.php?page=login');
}

// Traitement ajout de tâche
if (isset($_POST['add_task'])) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $assignedTo = (int) ($_POST['assigned_to'] ?? 0);
    $createdBy = (int) $_SESSION['user_id'];

    if ($title !== '' && $assignedTo > 0) {
        addTask($pdo, $title, $description, $createdBy, $assignedTo);
    }

    header('Location: index.php?page=admin');
    exit();
}

$tasks = getAllTasks($pdo);
$users = getAllUsers($pdo);

// Récupère les statistiques
$statistics = getTasksStatistics($pdo);
$totalTaches = $statistics['total'];
$todoTaches = $statistics['todo'];
$inprogressTaches = $statistics['inprogress'];
$finishedTaches = $statistics['finished'];

// Delete
if (isset($_POST['delete_task_id'])) {
    $taskId = (int)$_POST['delete_task_id'];

    if ($taskId > 0) {
        deleteTask($pdo, $taskId);
    }

    header('Location: index.php?page=admin');
    exit();
}

require_once __DIR__ . '/../views/admin.php';