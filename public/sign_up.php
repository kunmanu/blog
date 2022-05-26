<?php 

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
include_once '../src/core/Database.php';
include_once '../src/Model/UserModel.php';
require ('../src/Model/autoload.php');

// Initialisations
$errors = [];
$firstname = '';
$lastname = '';
$email = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $firstname = strip_tags(trim($_POST['name']));
    $lastname = strip_tags(trim($_POST['surname']));
    $email = strip_tags(trim($_POST['email']));
    $password = $_POST['pass'];
    $passwordConfirm = $_POST['confirmPass'];

    // On valide les données (titre et contenu obligatoires)
    if (!strlen($firstname)) {
        $errors['name'] = 'Le champ "Prénom" est obligatoire';
    }

    if (!strlen($lastname)) {
        $errors['surname'] = 'Le champ "Nom" est obligatoire';
    }

    if (!strlen($email)) {
        $errors['email'] = 'Le champ "Email" est obligatoire';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email invalide';
    }
    // elseif (getUserByEmail($email)) {
    //     $errors['email'] = 'Un compte existe déjà avec cet email';
    // }

    if (strlen($password) < 8) {
        $errors['pass'] = 'Le mot de passe doit comporter au moins 8 caractères';
    }
    elseif ($password != $passwordConfirm) {
        $errors['confirmPass'] = 'Le mot de passe de confirmation ne correspond pas';
    }

    // Si tout est OK (pas d'erreurs)...
    if (empty($errors)) {

        // Hashage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // On enregistre l'article
        // addUser($firstname, $lastname, $email, $hash);
        $role = 'USER';
        $userModel = new UserModel();
        $User = $userModel -> addUser($firstname, $lastname, $email,$role, $hash);

        // On redirige l'internaute (pour l'instant vers une page de confirmation)
        header('Location: home.php');
        exit;
    }
}

// Inclusion du template
$template = 'sign_up';
$h1title = 'sign up';
include "../templates/base.phtml";