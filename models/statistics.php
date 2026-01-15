<?php

// Récupère les statistiques des tâches
function getTasksStatistics($pdo)
{
    $stats = [];
    
    // Total des tâches
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM tasks");
    $stmt->execute();
    $stats['total'] = $stmt->fetch()['total'];
    
    // Tâches "A faire"
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tasks WHERE status = 'A faire'");
    $stmt->execute();
    $stats['todo'] = $stmt->fetch()['count'];
    
    // Tâches "En cours"
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tasks WHERE status = 'En cours'");
    $stmt->execute();
    $stats['inprogress'] = $stmt->fetch()['count'];
    
    // Tâches "Terminé"
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tasks WHERE status = 'Terminé'");
    $stmt->execute();
    $stats['finished'] = $stmt->fetch()['count'];
    
    // Tâches "A reassigner"
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tasks WHERE status = 'A reassigner'");
    $stmt->execute();
    $stats['reassign'] = $stmt->fetch()['count'];
    
    return $stats;
}
