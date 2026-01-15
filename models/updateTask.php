<?php

function updateTask($pdo, $id, $title, $description, $assignedTo, $status) {
    try {
        $sql = "UPDATE tasks SET title = ?, description = ?, assigned_to = ?, status = ?, modified_at = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $title,
            $description,
            $assignedTo,
            $status,
            $id
        ]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour de la tâche : " . $e->getMessage());
    }
}
 