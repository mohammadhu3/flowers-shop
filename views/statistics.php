<div class="stats-container">

    <div class="card">
        <h2>Total des tâches</h2>
        <p><?= $totalTaches ?></p>
    </div>

    <div class="card">
        <h2>À faire</h2>
        <p><?= $todoTaches ?></p>
    </div>

    <div class="card">
        <h2>En cours</h2>
        <p><?= $inprogressTaches ?></p>
    </div>

    <div class="card">
        <h2>Terminées</h2>
        <p><?= $finishedTaches ?></p>
    </div>

    <div class="card">
        <h2>À réassigner</h2>
        <p style="color: <?= $reassignTaches == 0 ? 'green' : 'red' ?>;"><?= $reassignTaches ?></p>
    </div>

</div>