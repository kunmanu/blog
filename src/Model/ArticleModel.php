<?php

class ArticleModel extends AbstractModel {




    function getAllArticles(): array
    {
    $sql = 'SELECT *
            FROM article AS A
            ORDER BY A.dtCre DESC';
    return $this->db->getAllResults($sql);
    }



    function getOneArticle(int $idArticle) 
    {



        // Préparation de la requête SQL
        $sql = 'SELECT * 
                FROM article
                WHERE idArt = ?';

        return $this->db->getOneResult($sql,[$idArticle]);
    }

    function getLastArticle(){

        $sql = 'SELECT *
            FROM article AS A
            ORDER BY A.dtCre DESC
            LIMIT 1
            ';

        return $this->db->getOneResult($sql);
    }


    function addArticle(string $title, string $abstract, string $content, string $image, int $idUser, int $category = 1 )
    {

        $sql = 'INSERT INTO article (titArt, AbsArt, txtArt, imgArt, dtCre, idAut, idCat)
                VALUES (?,?,?,?,NOW(),?,?)
                ';

        return $this->db->executeQuery($sql,[$title, $abstract, $content, $image,$idUser,$category]);
    }
    
    function deleteArticle(string $idArticle,$idCommentLinked)
    {

        $sql = 'DELETE FROM comment
                WHERE idArt = ?;
                DELETE FROM article
                WHERE idArt = ?';


        return $this->db->executeQuery($sql,[$idArticle,$idCommentLinked]);
    }

    function editArticle(string $title, string $abstract, string $content, string $image, $idArticle)
    {

        $sql = 'UPDATE article
                SET titArt =?,
                    AbsArt =?,
                    txtArt =?,
                    imgArt =?
                WHERE idArt = ?
                ';

        return $this->db->executeQuery($sql,[$title, $abstract, $content, $image, $idArticle]);

    }

}

