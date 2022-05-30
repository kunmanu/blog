<?php
class Database {

    private PDO $pdo;
    static private int $countPdo=0;


    function __construct()
    {
        $this->initPDOConnection();
        self::$countPdo++;
    }


    //methode
    function initPDOConnection(): PDO
    {
        // Connexion à la base de données
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
        $user = DB_USER; // Utilisateur
        $password = DB_PASS; // Mot de passe
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
        ];

        $this ->pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

        return $this->pdo;
    }

    function executeQuery(string $sql, array $values =[] ){

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement -> execute($values);
        return $pdoStatement;
    }

    function getAllResults(string $sql, array $values =[]){
        $pdoStatement = $this -> executeQuery($sql,$values);
        return $pdoStatement -> fetchAll();
    }
    function getOneResult(string $sql, array $values =[] ){
        $pdoStatement = $this -> executeQuery($sql,$values);
        return $pdoStatement -> fetch();

    }

    static function getcountPDO()
    {
        return self::$countPdo;
    }


}





