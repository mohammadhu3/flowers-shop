// formulaire de connexion
//ajout du formulaire de connexion

<?php require_once __DIR__ . '/../controllers/auth.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="dark">

    <main class="container">
        <h1>Connexion</h1>

        <form method="POST">

            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="ex: employe@flowershop.fr"
                    value="lucas.petit@flowers-shop.com"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••"
                    value="password123"
                    required
                >
            </div>

            <input type="submit" value="Se connecter">

        </form>
    </main>

</body>
</html>
