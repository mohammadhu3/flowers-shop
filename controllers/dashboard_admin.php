<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/getAllTasks.php';
require_once __DIR__ . '/../models/addTask.php';
require_once __DIR__ . '/../models/getAllUsers.php';
require_once __DIR__ . '/../models/statistics.php';
require_once __DIR__ . '/../models/deleteTask.php';
require_once __DIR__ . '/../models/updateTask.php';
require_once __DIR__ . '/../models/getAllTasksFiltered.php';

if (!isset($_SESSION['user_role'], $_SESSION['user_id'])) {
    redirect('index.php?page=login');
}

// Traitement ajout de tâche
if (isset($_POST['add_task'])) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $assignedTo = (int) ($_POST['assigned_to'] ?? 0);
    $createdBy = trim($_SESSION['user_name'] ?? '-');

    if ($title !== '' && $assignedTo > 0) {
        addTask($pdo, $title, $description, $createdBy, $assignedTo);
    }

    redirect("index.php?page=admin");
}

// Traitement mise à jour de tâche
if (isset($_POST['update_task'])) {
    $taskId = (int) ($_POST['task_id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $assignedTo = (int) ($_POST['assigned_to'] ?? 0);
    $status = $_POST['status'] ?? '';
    $priority = $_POST['priority'] ?? '';

    if ($taskId > 0 && $title !== '' && $assignedTo > 0 && $status !== '') {
        updateTask($pdo, $taskId, $title, $description, $assignedTo, $status, $priority);
    }

    redirect("index.php?page=admin");
}

// Traitement de la suppression de tâche
if (isset($_POST['delete_task_id'])) {
    $taskId = (int)$_POST['delete_task_id'];

    if ($taskId > 0) {
        deleteTask($pdo, $taskId);
    }

    redirect("index.php?page=admin");
}

// Traitement de tri des tâches
$sort = 'created_at';
$dir = 'asc';

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
}

// Récupère les informations pour les traiter dans admin.php
$tasks = getAllTasksSorted($pdo, $sort, $dir);
$users = getAllUsers($pdo);

// Récupère les statistiques
$statistics = getTasksStatistics($pdo);
$totalTaches = $statistics['total'];
$todoTaches = $statistics['todo'];
$inprogressTaches = $statistics['inprogress'];
$finishedTaches = $statistics['finished'];
$reassignTaches = $statistics['reassign'];


require_once __DIR__ . '/../views/admin.php';
