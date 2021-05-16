CREATE DATABASE IF NOT EXISTS intranet DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE intranet;

drop table if exists listeNote;
create table if not exists listeNote(
    id_note int not null primary key,
    matiere_test varchar(20) not null,
    valeur int not null,
    id_etudiant int not null,
    id_prof int not null
)engine = InnoDB;

drop table if exists Utilisateurs;
create table if not exists Utilisateurs(
    id_utilisateur int not null primary key,
    Nom varchar(20) not null,
    Prénom varchar(20) not null,
    Pseudo varchar(20) not null,
    mdp int not null,
    rang varchar(20) not null
)engine = InnoDB;

alter table listeNote add foreign key(id_etudiant) references Utilisateurs(id_utilisateur);