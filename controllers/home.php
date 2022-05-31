<?php

$articleModel = new ArticleModel();
$articles = $articleModel -> getAllArticles();



// Affichage : inclusion du template
$template = 'home';
$h1title = 'Home';
include '../templates/base.phtml';
