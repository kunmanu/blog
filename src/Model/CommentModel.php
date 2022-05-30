<?php

class CommentModel extends AbstractModel {



    function insertComment(string $content, int $idUser, int $idArticle)
        {

            $sql = 'INSERT INTO comment (txtCom, idAut, dtCre,  idArt)            
                    VALUES (?,?,NOW(),?)
                    ';
    
            return $this->db->executeQuery($sql,[$content,$idUser, $idArticle]);
        }
    function getCommentsByArticleId(int $idArticle)
        {

            $sql = 'SELECT c.txtCom, c.dtCre, u.lstUsr, u.frstUsr
                    FROM comment as c
                    INNER JOIN user as u
                    on c.idAut = u.idUsr
                    WHERE c.idArt = ?
                    ORDER BY c.dtCre DESC';
            return $this->db->getAllResults($sql,[$idArticle]);

        }

}