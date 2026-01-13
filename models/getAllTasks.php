<?php

function getAllTasks(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM tasks");
    return $stmt->fetchAll();
}