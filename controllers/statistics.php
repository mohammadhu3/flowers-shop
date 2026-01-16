<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/statistics.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : verifie le rôle sinon redirige
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Responsable') {
    redirect('index.php?page=login');
}

// Récupère les statistiques
$statistics = getTasksStatistics($pdo);

// Assigne les variables pour la vue
$totalTaches = $statistics['total'];
$todoTaches = $statistics['todo'];
$inprogressTaches = $statistics['inprogress'];
$finishedTaches = $statistics['finished'];

// Afficher la VUE statistics
require_once __DIR__ . '/../views/statistics.php';