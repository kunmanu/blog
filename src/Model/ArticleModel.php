<?php

class ArticleModel{

    function getAllArticles(): array
    {
    $sql = 'SELECT *
            FROM article AS A
            ORDER BY A.dtCre DESC';

    $db = new Database();

    return $db->getAllResults($sql);
    }
    function getOneArticle(int $idArticle) 
    {
        // Connexion à la base de données
        $db = new Database() ;

        // Préparation de la requête SQL
        $sql = 'SELECT * 
                FROM article
                WHERE idArt = ?';

        return $db->getOneResult($sql,[$idArticle]);
    }

    function getLastArticle(){
        $db = new Database();
        $sql = 'SELECT *
            FROM article AS A
            ORDER BY A.dtCre DESC
            LIMIT 1
            ';

        return $db->getOneResult($sql);
    }


    function addArticle(string $title, string $abstract, string $content, string $image, int $idUser, int $category = 1 )
    {
        $db = new Database();
        $sql = 'INSERT INTO article (titArt, AbsArt, txtArt, imgArt, dtCre, idAut, idCat)
                VALUES (?,?,?,?,NOW(),?,?)
                ';

        return $db->executeQuery($sql,[$title, $abstract, $content, $image,$idUser,$category]);
    }
    
    function deleteArticle(string $idArticle,$idCommentLinked)
    {
        $db = new Database();
        $sql = 'DELETE FROM comment
                WHERE idArt = ?;
                DELETE FROM article
                WHERE idArt = ?';


        return $db->executeQuery($sql,[$idArticle,$idCommentLinked]);
    }

    function editArticle(string $title, string $abstract, string $content, string $image, $idArticle)
    {
        $db = new Database();
        $sql = 'UPDATE article
                SET titArt =?,
                    AbsArt =?,
                    txtArt =?,
                    imgArt =?
                WHERE idArt = ?
                ';

        return $db->executeQuery($sql,[$title, $abstract, $content, $image, $idArticle]);

    }

}

