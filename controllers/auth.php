<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Sécurité : récupère les erreurs
$error = "";

// Verifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Optionnel/sécurité : verifier le token csrf / if else

    // Récupération des données du formulaire
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Vérification : email valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email invalide.";
    }

    // Verification : email ou mot de passe vide
    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {

        // Recherche de l'utilisateur par email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND status = 'Actif'");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Sécurité : reinitialise l'id de la SESSION, évite le vol de session
        session_regenerate_id(true);

        // Sécurité : verifie le mot de passe
        if ($user && password_verify($password, $user["password"])) {

            // Création de la session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["first_name"] . ' ' . $user["last_name"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_role"] = $user["role"];

            // Redirection selon le rôle
            if ($_SESSION["user_role"] === "Responsable") {
                redirect("index.php?page=admin");
            } else {
                redirect("index.php?page=employe");
            }
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}
