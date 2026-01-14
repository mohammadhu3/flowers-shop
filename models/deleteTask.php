<?php

function deleteTask(PDO $pdo, $taskId)
{
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([(int)$taskId]);
}