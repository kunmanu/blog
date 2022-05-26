<?php 

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
require ('../src/Model/autoload.php');
// Initialisations
$email = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['plainPassword'];

    // On vérifie les identifiants
    $user = checkUser($email, $password);

    // On a trouvé l'utilisateur, les identifiants sont corrects...
    if ($user) {

        // Enregistrement du user en session
        registerUser($user['idUsr'], $user['frstUsr'], $user['lstUsr'], $user['mailUsr'], $user['roleUsr']);
    
        // Redirection pour le moment vers la page d'accueil du site
        header('Location: home.php');
        exit;
    } 
        
    $error = 'Identifiants incorrects';
}

// Inclusion du template
$template = 'sign_in';
$h1title = 'sign in';
include "../templates/base.phtml";