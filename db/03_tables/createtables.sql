use blog;

drop table if exists comment;
drop table if exists article;
drop table if exists user;
drop table if exists category;


create table category
(
    idCat   int signed AUTO_INCREMENT,
    labCat  VARCHAR(512) ,
    PRIMARY KEY (idCat)
)engine=innoDB;



create table user
(
    idUsr       int signed AUTO_INCREMENT,
    lstUsr      VARCHAR(512),
    frstUsr     VARCHAR(512),
    mailUsr     VARCHAR(512),
    hashUsr     VARCHAR(512),
    roleUsr     VARCHAR(512),
    dtCreUsr    DATE,
    PRIMARY KEY (idUsr)
)engine=innoDB;


create table article
(
    idArt       int signed AUTO_INCREMENT,
    titArt      VARCHAR(512) ,
    AbsArt      VARCHAR(512),
    txtArt      VARCHAR(10000),
    imgArt      VARCHAR(512),
    dtCre       DATETIME,
    idAut       int signed,
    idCat       int signed,
    PRIMARY KEY (idArt),
    constraint fk_ArtAuthor
        FOREIGN KEY (idAut)
            references user (idUsr),
    constraint fk_ArtCategory
        FOREIGN KEY (idCat)
            references category (idCat)
)engine=innoDB;


create table comment
(
    idCom   int signed AUTO_INCREMENT,
    txtCom  VARCHAR(10000),
    dtCre   DATETIME,
    idAut   int signed,
    idArt   int signed,
    PRIMARY KEY (idCom),
    constraint fk_ComAuthor
        FOREIGN KEY (idAut)
            references user (idUsr),
    constraint fk_ComArt
        FOREIGN KEY (idArt)
            references article (idArt)
)engine=innoDB;

