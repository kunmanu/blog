<?php
class Database {

    static private ?PDO $pdo  = null;
    static private int $countPdo=0;


    function __construct()
    {
        if (self::$pdo == null){
            self::$pdo=$this->initPDOConnection();
            self::$countPdo++;
        }


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


        self::$pdo = new PDO($dsn, $user, $password, $options);
        return self::$pdo;
    }

    function executeQuery(string $sql, array $values =[] ){

        $pdoStatement = self::$pdo->prepare($sql);
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





