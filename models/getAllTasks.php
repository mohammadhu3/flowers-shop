<?php

function getAllTasks(PDO $pdo): array
{
    $stmt = $pdo->prepare("SELECT * FROM tasks");
    $stmt->execute();
    return $stmt->fetchAll();
}
