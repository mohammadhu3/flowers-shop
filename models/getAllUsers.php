
<?php

require_once __DIR__ . "/../config/database.php";

// Récupère tout les utilisateurs
function getAllUsers($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}
