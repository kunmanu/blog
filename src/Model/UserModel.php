<?php

class UserModel extends AbstractModel
{

    function getUserByEmail(string $email)
    {


        $sql = 'SELECT *
                FROM user
                WHERE mailUsr = ?';

        return $this->db->getAllResults($sql, [$email]);
    }


    function addUser(string $firstname, string $lastname, string $email, string $role, string $hash)
    {

        $sql = 'INSERT INTO user (lstUsr,frstUsr,mailUsr,roleUsr,hashUsr,dtCreUsr)
                VALUES      (?,?,?,?,?,NOW())
        ';
        return $this->db->executeQuery($sql, [$firstname, $lastname, $email, $role, $hash]);
    }


    function checkUser(string $email, string $password)
    {

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);


        // Si on trouve bien un utilisateur...
        if ($user) {

            // On vérifie son mot de passe
            if (password_verify($password, $user['0']['hashUsr'])) {

                // Tout est ok, on retourne l'utilisateur
                return $user;
            }
        }
        // Si l'email ou le mot de passe est incorrect...
        return false;
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

    function isConnected(): bool
    {
        // On commence par vérifier qu'une session est bien démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
    }

    function logout()
    {


        // Si l'utilisateur est connecté...
        if ($this->isConnected()) {

            // On efface nos données en session
            $_SESSION['user'] = null;

            // On ferme la session
            session_destroy();
        }
    }

    function getUserId()
    {
        // Si l'utilisateur est connecté...
        if (! $this -> isConnected()) {
            return null;
        }

        return $_SESSION['user']['id'];
    }
}
