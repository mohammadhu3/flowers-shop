<?php

function setStatusTask(PDO $pdo, $taskId, $userId, $status)
{
    $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ? AND assigned_to = ?");
    $stmt->execute([$status, (int)$taskId, (int)$userId]);
}