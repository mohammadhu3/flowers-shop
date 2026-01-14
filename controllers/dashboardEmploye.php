<?php
require_once DIR . '/../config/database.php';
require_once DIR . '/../includes/functions.php';
require_once DIR . '/../models/getTasksByUser.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : verifie le rôle sinon redirige
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Vendeur') {
    redirect('index.php?page=login');
}

// Récupère les tâches de l'employé connecté
$tasks = getTasksByUser($pdo, $_SESSION['user_id']);

// Afficher la VUE employe
require_once DIR . '/../views/employe.php';