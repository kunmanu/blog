<?php

// On démarre la session pour être certain qu'elle est démarrée
session_start();

// Inclusion des dépendances
include '../app/config.php';
include '../lib/functions.php';
include '../src/Model/autoload.php';
include '../vendor/autoload.php';
require'../src/Model/autoload.php';
include '../src/core/Database.php';
include '../src/core/AbstractModel.php';
include '../app/routes.php';


//$page="home";
//
//if (isset ($_GET['page'])){
//    $page = $_GET['page'];
//};
//^v^^v^^^v^^c'est la même chose^v^^^v^^^v^^^v^^^^v^^^v^
$page = $_GET['page']??'home'; //opérateur de fusion null

/** @noinspection PhpUndefinedVariableInspection */
if (!array_key_exists($page, $routes)){
    http_response_code(404);
    echo 'Page introuvable';
    exit; // Si pas d'id dans l'URL => message d'erreur et on arrête tout !
}






include '../controllers/'.$routes[$page];




