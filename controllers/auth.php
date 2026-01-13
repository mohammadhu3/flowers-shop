<?php

require_once '/../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// LOGOUT

if (isset($_GET['page']) && $_GET['page'] === 'logout') {

    $_SESSION = [];

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    } // vide la session et supprime les cookies

    session_destroy();

    header('Location: index.php?page=login');
    exit; // puis retour à la page de connexion
}

// LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email !== '' && $password !== '') {

        $error = "Veuillez remplir tous les champs";
    } else {
        $stmt = $pdo->prepare(
            "SELECT *
             FROM users
             WHERE email = ? AND status = 'Actif'
             LIMIT 1"
        );

        $stmt->execute([$email]);
        $user = $stmt->fetch();

    }

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = ($user['role'] === 'Responsable') ? 'admin' : 'employe';

            header('Location: index.php?page=' . ($_SESSION['user_role'] === 'admin' ? 'admin' : 'employe'));
            exit;
        } else {
        $error = "Email ou mot de passe incorrect";
    }
}