<!-- SÉPARER CHAQUE FONCTION DANS UN FICHIER -->

<?php

// Récupère toutes les tâches
function getAllTasks($pdo) {
    // ...
}

// Récupère les tâches assignées à un utilisateur spécifique
function getTasksByUser($pdo, $id) {
    // ...
}

// Ajoute une nouvelle tâche
function addTask($pdo, $data) {
    // ...
}

// Met à jour une tâche existante
function updateTask($pdo, $id, $data) {
    // ...
}

// Supprime une tâche
function deleteTask($pdo, $id) {
    // ...
}

// Assigne une tâche à un utilisateur
function assignTaskToUser($pdo, $taskId, $userId) {
    // ...
}

// Marque une tâche comme terminée
function markTaskAsDone($pdo, $taskId) {
    // ...
}
