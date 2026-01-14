<?php

require_once __DIR__ . '/../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Supprime la session et redirige vers login
session_destroy();
redirect("../index.php?page=login");
