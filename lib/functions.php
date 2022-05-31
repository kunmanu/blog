<?php 



// Constantes
const ARTICLES_FILENAME = '../data/articles.json';
const USERS_FILENAME = '../data/users.json'; 
const ROLE_USER = 'USER';
const ROLE_ADMIN = 'ADMIN';


function buildUrl(string $page, array $params = [])
{

    if (empty($params)){
        return "index.php?page=".$page;
    }
    return "index.php?page=".$page."&".http_build_query($params);
}


function getPDOConnection()
{
    // Connexion à la base de données
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
    $user = DB_USER; // Utilisateur
    $password = DB_PASS; // Mot de passe
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
    ];

    $pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

    return $pdo;
}


/////////////////////////////////////////
///////////////// USERS /////////////////
/////////////////////////////////////////

//function getUserByEmail(string $email)
//{
//    // Connexion à la base de données
//    $pdo = getPDOConnection();
//
//    // Préparation de la requête
//    $sql = 'SELECT *
//            FROM user
//            WHERE mailUsr = ?';
//
//    $pdoStatement = $pdo->prepare($sql);
//
//    // Exécution de la requête
//    $pdoStatement->execute([$email]);
//
//    // Récupération d'UN SEUL résultat : un seul utilisateur possède cet email
//    $user = $pdoStatement->fetch();
//
//    return $user;
//}

/**
 * Ajoute un user
 * @param string $firstname Le prénom de l'utilisateur
 * @param string $lastname Le nom de l'utilisateur
 * @param string $email L'email de l'utilisateur
 * @param string $hash Le mot de passe hashé de l'utilisateur
 * @return void
 */
// function addUser(string $firstname, string $lastname, string $email, string $hash)
// {
//     // On commence par récupérer tous les articles
//     $users = getAllUsers();

//     // Création de la date de création de l'article (date du jour)
//     $today = new DateTimeImmutable();

//     // On regroupe les informations du nouvel article dans un tableau associatif
//     $user = [
//         'id' => sha1(uniqid(rand(), true)),
//         'firstname' => $firstname,
//         'lastname' => $lastname,
//         'email' => $email,
//         'hash' => $hash,
//         'role' => ROLE_USER,
//         'createdAt' => $today->format('Y-m-d')
//     ];

//     // On ajoute le nouvel article au tableau d'articles
//     $users[] = $user;

//     // On enregistre les articles à nouveau dans le fichier JSON
//     saveJSON(USERS_FILENAME, $users);
// }

/**
 * Vérifie les identifiants d el'utilisateur
 * @param string $email L'email rentré par l'utilisateur
 * @param string $password Le mot de passe rentré par l'utilisateur
 */
//function checkUser(string $email, string $password)
//{
//    // On récupère l'utilisateur à partir de son email
//    $userModel = new UserModel();
//    $user = $userModel ->getUserByEmail($email);
//
//    // Si on trouve bien un utilisateur...
//    if ($user) {
//
//        // On vérifie son mot de passe
//        if (password_verify($password, $user['hashUsr'])) {
//
//            // Tout est ok, on retourne l'utilisateur
//            return $user;
//        }
//    }
//
//    // Si l'email ou le mot de passe est incorrect...
//    return false;
//}

/**
 * Enregistre les données d el'utilisateur en session
 */
//function registerUser(string $id, string $firstname, string $lastname, string $email, string $role)
//{
//    // On commence par vérifier qu'une session est bien démarrée
//    if (session_status() == PHP_SESSION_NONE) {
//        session_start();
//    }
//
//    // Puis on enregistre les données de l'utilisateur en session
//    $_SESSION['user'] = [
//        'id' => $id,
//        'firstname' => $firstname,
//        'lastname' => $lastname,
//        'email' => $email,
//        'role' => $role
//    ];
//}

/**
 * Détermine si l'utilisateur est connecté ou non
 * @return bool - true si l'utilisateur est connecté, false sinon
 */
function isConnected(): bool
{
    // On commence par vérifier qu'une session est bien démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
}

/**
 * Déconnecte l'utilisateur
 */
//function logout()
//{
//    // Si l'utilisateur est connecté...
//    if (isConnected()) {
//
//        // On efface nos données en session
//        $_SESSION['user'] = null;
//
//        // On ferme la session
//        session_destroy();
//    }
//}

/**
 * Retourne l'id de l'utilisateur connecté
 */
//function getUserId()
//{
//    // Si l'utilisateur est connecté...
//    if (!isConnected()) {
//        return null;
//    }
//
//    return $_SESSION['user']['id'];
//}

/**
 * Retourne le prénom de l'utilisateur connecté
 */
function getUserFirstname()
{
    // Si l'utilisateur est connecté...
    if (!isConnected()) {
        return null;
    }

    return $_SESSION['user']['firstname'];
}

/**
 * Retourne le nom de l'utilisateur connecté
 */
function getUserLastname()
{
    // Si l'utilisateur est connecté...
    if (!isConnected()) {
        return null;
    }

    return $_SESSION['user']['lastname'];
}

/**
 * Retourne l'email de l'utilisateur connecté
 */
function getUserEmail()
{
    // Si l'utilisateur est connecté...
    if (!isConnected()) {
        return null;
    }

    return $_SESSION['user']['email'];
}

/**
 * Retourne le rôle de l'utilisateur connecté
 */
function getUserRole()
{
    // Si l'utilisateur est connecté...
    if (!isConnected()) {
        return null;
    }

    return $_SESSION['user']['role'];
}

/**
 * Vérifie si l'utilisateur possède un rôle particulier
 */
function hasRole(string $role)
{
    if (!isConnected()) {
        return false;
    }

    return getUserRole() == $role;
}