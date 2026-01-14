<?php

function addTask(PDO $pdo, $title, $description, $createdBy, $assignedTo)
{
    $stmt = $pdo->prepare(
        "INSERT INTO tasks (title, description, created_by, assigned_to, status) VALUES (?, ?, ?, ?, 'A faire')"
    );

    $stmt->execute([
        $title,
        $description,
        $createdBy,
        $assignedTo
    ]);
}