<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Tâches</title>
    <link rel="stylesheet" href="/flowers-shop/assets/css/admin.css">
</head>

<body>

    <?php include_once 'welcome.php'; ?>

    <a href="controllers/logout.php">Déconnexion</a>

    <?php include_once 'statistics.php'; ?>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Créé par</th>
                <th>Assigné à</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($tasks) && is_array($tasks)) { ?>
                <?php foreach ($tasks as $task) { ?>
                    <?php
                    $selectedTasks = [
                        "A faire",
                        "En cours",
                        "Terminé",
                        "A reassigner"
                    ];
                    ?>
                    <?php if (is_numeric($task["id"])) : ?>
                        <tr>
                            <td><?= (int)($task["id"]) ?></td>
                            <td><?= htmlspecialchars($task["title"]) ?></td>
                            <td><?= htmlspecialchars($task["description"]) ?></td>
                            <td><?= htmlspecialchars($task["created_by"]) ?></td>

                            <td>
                                <form action="" method="post">
                                    <!-- <input type="hidden" name="task_id" value="<?= (int)$task["id"] ?>"> -->
                                    <select name="assigned_to">
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?= htmlspecialchars($user["first_name"]) ?>"><?= htmlspecialchars($user["last_name"]) . " " . htmlspecialchars($user["first_name"]) . " - " . htmlspecialchars($user["role"])  ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="submit" value="Valider">
                                </form>
                            </td>

                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="task_id" value="<?= (int)$task["id"] ?>">
                                    <select name="status">
                                        <option value="<?= htmlspecialchars($task["status"]) ?>">
                                            <?= htmlspecialchars($task["status"]) ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                            <input type="submit" value="Valider">
                        </form>
                    </td>

                    <td><?= htmlspecialchars($task["created_at"]) ?></td>
                    <td>
                        <a href="edit_task.php?id=<?= (int)($task["id"]) ?>" class="btn">Modifier</a>
                        <a href="delete_task.php?id=<?= (int)($task["id"]) ?>"
                           class="btn"
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>

</body>

</html>