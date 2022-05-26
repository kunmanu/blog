<?php 

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
include_once '../src/core/Database.php';

require ('../src/Model/autoload.php');


// Vérification du rôle
if (!hasRole(ROLE_ADMIN)) {
    http_response_code(403);
    // var_dump($_SESSION);
    echo 'Accès interdit';
    exit;
}

// Traitements : récupérer les articles
$articleModel = new ArticleModel();
$articles = $articleModel -> getAllArticles();
// Affichage : inclusion du fichier de template
$template = 'admin';
$h1title = 'Admin';
$script = '<script src="js/admin.js" defer></script>';
include '../templates/base_admin.phtml';




