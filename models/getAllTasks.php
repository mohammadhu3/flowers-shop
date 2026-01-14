<?php

function getAllTasks(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM tasks");
    return $stmt->fetchAll();
}

// prepare/execute à la place de query