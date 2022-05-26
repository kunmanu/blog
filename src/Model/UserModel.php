<?php

class UserModel {

    function getUserByEmail(string $email) {

        $db = new Database();
        $sql = 'SELECT *
                FROM user
                WHERE mailUsr = ?';

            return $db->getAllResults($sql,[$email]);
}


    function addUser(string $firstname, string $lastname, string $email, string $role, string $hash){
        $db = new Database();
        $sql = 'INSERT INTO user (lstUsr,frstUsr,mailUsr,roleUsr,hashUsr,dtCreUsr)
                VALUES      (?,?,?,?,?,NOW())
        ';
        return $db->executeQuery($sql,[$firstname, $lastname, $email, $role, $hash]);
    }


    function checkUser(string $email, string $password){
        $db = new Database();
    }

    
    function registerUser(string $id, string $firstname, string $lastname, string $email, string $role)
    {
        // On commence par vérifier qu'une session est bien démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Puis on enregistre les données de l'utilisateur en session
        $_SESSION['user'] = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'role' => $role
        ];
    }
    
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
    function logout()
    {
        // Si l'utilisateur est connecté...
        if (isConnected()) {
    
            // On efface nos données en session
            $_SESSION['user'] = null;
    
            // On ferme la session 
            session_destroy();
        }
    }
    
    /**
     * Retourne l'id de l'utilisateur connecté
     */
    function getUserId()
    {
        // Si l'utilisateur est connecté...
        if (!isConnected()) {
            return null;
        }
    
        return $_SESSION['user']['id'];
    }
    
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

};
