<?php
class Database {


    //methode
    function getPDOConnection()
    {
        // Connexion à la base de données
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8'; // DSN : Data Source Name (informations de connexion à la BDD)
        $user = DB_USER; // Utilisateur
        $password = DB_PASS; // Mot de passe
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Pour afficher les erreurs SQL
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats
        ];

        $pdo = new PDO($dsn, $user, $password, $options); // Création d'un objet de la classe PDO

        return $pdo;
    }

    function executeQuery(string $sql, array $values =[] ){
        $pdo = $this->getPDOConnection();
        $pdoStatement = $pdo->prepare($sql);
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


}





