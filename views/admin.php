<?php
// Exemple temporaire de données pour tester le HTML
// Ajout du tableau des taches (HTML)

// $tasks = [
//     [
//         'id' => 1,
//         'title' => 'Préparer bouquet',
//         'description' => 'Bouquet de roses rouges',
//         'created_by' => 1,
//         'assigned_to' => 2,
//         'status' => 'A faire',
//         'created_at' => '2026-01-13 10:00:00'
//     ],
//     [
//         'id' => 2,
//         'title' => 'Inventaire',
//         'description' => 'Faire l\'inventaire complet',
//         'created_by' => 1,
//         'assigned_to' => 3,
//         'status' => 'En cours',
//         'created_at' => '2026-01-13 11:00:00'
//     ]
// ];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin-Tasks</title>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($tasks) && is_array($tasks)) { ?>
                <?php foreach ($tasks as $task) { ?>
                    <tr>
                        <td><?= htmlspecialchars($task["id"]) ?></td>
                        <td><?= htmlspecialchars($task["title"]) ?></td>
                        <td><?= htmlspecialchars($task["description"]) ?></td>
                        <td><?= htmlspecialchars($task["created_by"]) ?></td>
                        <td><?= htmlspecialchars($task["assigned_to"]) ?></td>
                        <td><select>
                                <option value="A faire" <?= $task["status"] == "A faire" ? "selected" : "" ?>>A faire</option>
                                <option value="En cours" <?= $task["status"] == "En cours" ? "selected" : "" ?>>En cours</option>
                                <option value="Terminé" <?= $task["status"] == "Terminé" ? "selected" : "" ?>>Terminé</option>
                            </select></td>

                        <td><?= htmlspecialchars($task["created_at"]) ?></td>
                        <td>
                            <a href="edit_task.php?id=<?= htmlspecialchars($task["id"]) ?>">Modify</a>
                            <a href="delete_task.php?id=<?= htmlspecialchars($task["id"]) ?>"
                                onclick="return confirm('Are you sure you want to delete this task?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>