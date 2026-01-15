<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration - Tâches</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
</head>

<body>

    <?php include_once 'welcome.php'; ?>

    <a href="controllers/logout.php">Déconnexion</a>

    <!-- Formulaire d'ajout de tâche -->

    <script src="/flowers-shop/assets/js/script.js"></script>

    <button id="openAddTask">Ajouter une tâche</button>

    <div id="addTaskForm" style="display: none;">

        <form method="post">

            <input type="text" name="title" placeholder="Titre" required>
            <input type="text" name="description" placeholder="Description">

            <select name="assigned_to">

                <option value="">Sélectionner un employé</option>

                <?php
                foreach ($users as $user) {
                    echo '<option value="' . (int)$user['id'] . '">';
                    echo htmlspecialchars($user['last_name']) . ' ' . htmlspecialchars($user['first_name']) . ' - ' . htmlspecialchars($user['role']);
                    echo '</option>';
                }
                ?>

            </select>

            <button type="submit" name="add_task">Valider</button>
            <button type="button" id="closeAddTask">Annuler</button>

        </form>

    </div>

    <?php include_once 'statistics.php'; ?>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tâche</th>
                <th>Description</th>
                <th>Créé par</th>
                <th>Assigné à</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Date de modification</th>
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
                            <form method="post">
                                <input type="hidden" name="task_id" value="<?= (int)($task["id"]) ?>">
                                <td><?= (int)($task["id"]) ?></td>
                                <td>
                                    <input type="text" name="title" value="<?= htmlspecialchars($task["title"]) ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="description" value="<?= htmlspecialchars($task["description"]) ?>">
                                </td>
                                <td><?= htmlspecialchars($task["created_by"]) ?></td>

                                <!-- Select : tâche assignée à -->
                                <td>
                                    <select name="assigned_to">
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?= (int)$user["id"] ?>" <?= ($task["assigned_to"] == $user["id"]) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($user["last_name"]) . " " . htmlspecialchars($user["first_name"]) . " - " . htmlspecialchars($user["role"])  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <!-- Select : statut de la tâche -->
                                <td>
                                    <select name="status">
                                        <option value="<?= htmlspecialchars($task["status"]) ?>">
                                            <?= htmlspecialchars($task["status"]) ?>
                                        </option>
                                        <?php foreach ($selectedTasks as $selectedTask) {
                                            if ($task["status"] !== $selectedTask) { ?>
                                                <option value="<?= htmlspecialchars($selectedTask) ?>">
                                                    <?= htmlspecialchars($selectedTask) ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>

                                </td>

                                <td><?= htmlspecialchars($task["created_at"]) ?></td>
                                <td><?= $task["modified_at"] ? htmlspecialchars($task["modified_at"]) : '-' ?></td>

                                <td>
                                    <button type="submit" name="update_task" class="btn">Modifier</button>
                                    <button type="submit" name="delete_task_id" value="<?= (int)$task['id'] ?>"
                                        class="btn"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                        Supprimer
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php endif; ?>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>