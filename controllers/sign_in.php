<?php 

// On démarre la session pour être certain qu'elle est démarrée
//session_start();

// Inclusion des dépendances
//include '../app/config.php';
//include '../lib/functions.php';
//include '../src/core/Database.php';
//include_once '../src/core/AbstractModel.php';
//
//require ('../src/Model/autoload.php');
// Initialisations
$email = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['plainPassword'];

    // On vérifie les identifiants
    $userModel = new UserModel();
    $user = $userModel -> checkUser($email, $password);


    // On a trouvé l'utilisateur, les identifiants sont corrects...
    if ($user) {

        // Enregistrement du user en session
        $user = $userModel -> registerUser($user['0']['idUsr'], $user['0']['frstUsr'], $user['0']['lstUsr'], $user['0']['mailUsr'], $user['0']['roleUsr']);

    
        // Redirection pour le moment vers la page d'accueil du site
        header('Location:'.buildUrl("home"));
        exit;
    } 
        
    $error = 'Identifiants incorrects';
}

// Inclusion du template
$template = 'sign_in';
$h1title = 'sign in';
include "../templates/base.phtml";