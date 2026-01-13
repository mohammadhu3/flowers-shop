// formulaire de connexion
//ajout du formulaire de connexion

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

        <form method="post" action="index.php?page=login">

            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="ex: employe@flowershop.fr"
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
                    required
                >
            </div>

            <button type="submit">Se connecter</button>

        </form>
    </main>

</body>
</html>
