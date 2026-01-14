<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin-Tasks</title>
</head>

<body>

    <?php include_once 'welcome.php'; ?>

    <a href="controllers/logout.php">Déconnexion</a>

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

                            
                            <td><?= htmlspecialchars($task["assigned_to"]) ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="task_id" value="<?= (int)$task["id"] ?>">
                                    <select name="status">
                                        <option value="<?= htmlspecialchars($task["status"]) ?>"><?= htmlspecialchars($task["status"]) ?></option>
                                        <?php foreach ($selectedTasks as $selectedTask) {
                                            if ($task["status"] !== $selectedTask) { ?>
                                                <option value="<?= htmlspecialchars($selectedTask) ?>"><?= htmlspecialchars($selectedTask) ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <input type="submit" value="Valider">
                                </form>
                            </td>
                            <td><?= htmlspecialchars($task["created_at"]) ?></td>
                            <!-- Sécurité : à améliorer via GET + token CSRF ? -->
                            <td>
                                <a href="edit_task.php?id=<?= (int)($task["id"]) ?>" class="btn">Modify</a>
                                <a href="delete_task.php?id=<?= (int)($task["id"]) ?>"
                                    class="btn"
                                    onclick="return confirm('Are you sure you want to delete this task?');">
                                    Delete
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