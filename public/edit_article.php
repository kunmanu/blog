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
    echo 'Accès interdit';
    exit;
}

// Traitements

/////////////////////
// STEP #1 : on va chercher les données de l'article pour pré remplir le formulaire

// Validation du paramètre id de l'URL
if (!array_key_exists('id', $_GET) || !$_GET['id']) {

    http_response_code(404);
    echo 'Article introuvable';
    exit; // Si pas d'id dans l'URL => message d'erreur et on arrête tout ! 
}

// On récupère l'id de l'article à afficher depuis la chaîne de requête
$idArticle = $_GET['id'];

// On va chercher l'article correspondant
$articleModel = new ArticleModel();
$article = $articleModel -> getOneArticle($idArticle);

// On vérifie qu'on a bien récupéré un article, sinon => 404
if (!$article) {

    http_response_code(404);
    echo 'Article introuvable';
    exit; // Si pas d'article => message d'erreur et on arrête tout ! 
}

// Initialisation des variables qui vont servir à pré remplir le formulaire
$title = $article['titArt'];
$abstract = $article['AbsArt'];
$content = $article['txtArt'];
$image = $article['imgArt'];

/////////////////////
// STEP #2 : Traitements des données du formulaire en cas de soumission
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $title = strip_tags(trim($_POST['title']));
    $abstract = strip_tags(trim($_POST['abstract']));
    $content = strip_tags(trim($_POST['content']));
    $image = strip_tags(trim($_POST['image']));
    
    //et l'id de l'article
    

    // On valide les données (titre et contenu obligatoires)
    if (!$title) {
        $errors['title'] = 'Le champ "Titre" est obligatoire';
    }

    if (!$content) {
        $errors['content'] = 'Le champ "Contenu" est obligatoire';
    }

    // Si tout est OK (pas d'erreurs)...
    if (empty($errors)) {

        // On modifie l'article
        
        $article = $articleModel -> editArticle($title, $abstract, $content, $image, $idArticle);

        // On redirige l'internaute (pour l'instant vers une page de confirmation)
        header('Location: admin.php');
        exit;
    }
}

// Affichage : inclusion du fichier de template
$template = 'Modify Article';
$h1title = 'Modify Article';
$template = 'edit_article';
include '../templates/base_admin.phtml';