<?php

require_once __DIR__ . "/../config/database.php";

// Récupère un utilisateur par l'id
function getEmployeById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
    return $data;
}

// Optionnel addUser($pdo, $data)
// Optionnel updateUser($pdo, $id, $data)
// Optionnel deleteUser($pdo, $id)