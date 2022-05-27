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
};
