<?php

function getTasksByUser(PDO $pdo, int $userId): array
{
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE assigned_to = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}
