<?php 

//// On démarre la session pour être certain qu'elle est démarrée
//session_start();
//
//// Inclusion des dépendances
//include '../app/config.php';
//include '../lib/functions.php';
//include_once '../src/core/AbstractModel.php';
//include_once '../src/core/Database.php';
//require ('../src/Model/autoload.php');
// On déconnecte l'utilisateur
$userModel = new UserModel();
$user = $userModel -> logout();

// On le redirige vers l'accueil
header('Location:'.buildUrl("home") );

exit;

