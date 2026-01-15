<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration - Tâches</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <?php include_once 'welcome.php'; ?>

    <?php
    $sort = $_GET['sort'] ?? '';
    $dir  = $_GET['dir'] ?? 'asc';
    ?>

    <a href="controllers/logout.php">Déconnexion</a>

    <!-- Formulaire d'ajout de tâche -->

    <script src="./assets/js/script.js"></script>

    <?php include_once 'statistics.php'; ?>

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

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tâche</th>
                <th>Commentaire</th>
                <th>Créé par</th>
                <th>
                    <a href="index.php?page=admin&sort=employee&dir=<?= ($sort === 'employee' && $dir === 'asc') ? 'desc' : 'asc' ?>">
                        Assigné à <i class="fa-solid fa-sort"></i>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=admin&sort=status&dir=<?= ($sort === 'status' && $dir === 'asc') ? 'desc' : 'asc' ?>">
                        Statut <i class="fa-solid fa-sort"></i>
                    </a>
                </th>
                <th>Priorité</th>
                <th>
                    <a href="index.php?page=admin&sort=created_at&dir=<?= ($sort === 'created_at' && $dir === 'asc') ? 'desc' : 'asc' ?>">
                        Date de création <i class="fa-solid fa-sort"></i>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=admin&sort=modified_at&dir=<?= ($sort === 'modified_at' && $dir === 'asc') ? 'desc' : 'asc' ?>">
                        Date de modification <i class="fa-solid fa-sort"></i>
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($tasks) && is_array($tasks)) { ?>
                <?php foreach ($tasks as $task) { ?>
                    <?php
                    $selectedTasks = [
                        "À faire",
                        "En cours",
                        "Terminé",
                        "À reassigner"
                    ];
                    $priorityTasks = [
                        "Urgent",
                        "Non urgent"
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
                                <!-- Select : priorité de la tâche -->
                                <td>
                                    <select name="priority">
                                        <?php foreach ($priorityTasks as $priority) { ?>
                                            <option value="<?= htmlspecialchars($priority) ?>" <?= ($task["priority"] ?? 'Non urgent') === $priority ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($priority) ?>
                                            </option>
                                        <?php } ?>
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