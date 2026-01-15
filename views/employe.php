<!-- // dashboard employés sur lequel ils pourront consulter et valider les tâches -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Employé</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/admin.css">

</head>
<body>

    <?php include_once 'welcome.php'; ?>

        <a href="controllers/logout.php">Déconnexion</a>

    <h1>Mes tâches</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Tâche</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Validation</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)) : ?>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td><?= htmlspecialchars($task['description']) ?></td>
                        <td><?= htmlspecialchars($task['status']) ?></td>
                        <td><?= htmlspecialchars($task['created_at']) ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <select name="status">
                                    <option value="A faire" <?= $task['status'] === 'A faire' ? 'selected' : '' ?>>À faire</option>
                                    <option value="En cours" <?= $task['status'] === 'En cours' ? 'selected' : '' ?>>En cours</option>
                                    <option value="Terminé" <?= $task['status'] === 'Terminé' ? 'selected' : '' ?>>Terminé</option>
                                </select>
                                <button type="submit">Valider</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Aucune tâche assignée</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</body>
</html>
