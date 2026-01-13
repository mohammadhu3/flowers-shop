<?php
//Démarre la session 
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

//Pour stocker les erreurs
$error = "";

//Verifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Récuperer les informations du formulaire
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
 
    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        //Rechercher l'utilisateur dans la base de donnée //? est important contre l'injection, sera remplacé par $email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND status = 'Actif'");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        //Verifie le mot de passe
        if ($user && password_verify($password, $user["password"])) {
            //On crée la session // $_SESSION peut être appelé sur toute les pages
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["first_name"] . ' ' . $user["last_name"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_role"] = $user["role"];
            //On redirige vers l'accueil selon le rôle
            $page = ($user["role"] === "Responsable") ? "admin" : "employe";
            redirect("index.php?page=" . $page);
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}
?>