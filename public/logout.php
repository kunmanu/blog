<?php 

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
require ('../src/Model/autoload.php');
// On déconnecte l'utilisateur
$userModel = new UserModel();
$user = $userModel -> logout();

// On le redirige vers l'accueil
header('Location: home.php');

exit;

