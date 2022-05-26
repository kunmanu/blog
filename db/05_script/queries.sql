use blog;

-- all article ordered by date
select      idArt, libArt, txtArt, dtCre
from        article
order by    dtCre;


-- all author
select      idAut, nomAut, preAut
from        auteur aut
order by    aut.nomAut, aut.preAut;

-- l'article 3
select      idArt, libArt, txtArt, dtCre
from        article
where       idArt = 3;


-- 3 article plus récent
select      idArt, libArt, txtArt, dtCre
from        article
order by    dtCre desc
limit       3;


-- tt article from one auteur
select      aut.idAut, aut.preAut, aut.nomAut,
            art.idArt, art.libArt, art.txtArt, art.dtCre
from        auteur aut
inner join  article art on art.idAut=aut.idaut
where       aut.idAut=3;

-- nombre d'article d'un auteur marche pas
select      aut.preAut, aut.nomAut, count(art.idart)
from        auteur aut
inner join  article art on art.idAut = aut.idAut
group by    aut.preAut, aut.nomAut
order by    count(art.idArt), desc
limit       1;

-- suppr un article avec son ID
DELETE
from        article
where       idArt = 3;

-- Update un article avec son ID

UPDATE      article
set         libArt ='...'
where       idArt = 3;