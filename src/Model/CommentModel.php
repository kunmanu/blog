<?php

class CommentModel{
    function insertComment(string $content, int $idUser, int $idArticle)
        {
            $db = new Database();
            $sql = 'INSERT INTO comment (txtCom, idAut, dtCre,  idArt)            
                    VALUES (?,?,NOW(),?)
                    ';
    
            return $db->executeQuery($sql,[$content,$idUser, $idArticle]);
        }
    function getCommentsByArticleId(int $idArticle)
        {
            $db = new Database();
            $sql = 'SELECT c.txtCom, c.dtCre, u.lstUsr, u.frstUsr
                    FROM comment as c
                    INNER JOIN user as u
                    on c.idAut = u.idUsr
                    WHERE c.idArt = ?
                    ORDER BY c.dtCre DESC';
            return $db->getAllResults($sql,[$idArticle]);

        }

}