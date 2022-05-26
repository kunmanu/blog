<?php

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
include_once '../src/core/Database.php';
require ('../src/Model/autoload.php');
// Traitements : récupérer les articles
$articleModel = new ArticleModel();
$articles = $articleModel -> getAllArticles();

// Affichage : inclusion du template
$template = 'home';
$h1title = 'Home';
include '../templates/base.phtml';
