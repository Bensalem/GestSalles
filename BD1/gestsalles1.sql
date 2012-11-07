-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mer 07 Novembre 2012 à 11:23
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestsalles1`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE IF NOT EXISTS `acteurs` (
  `id_acteur` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `nom`, `prenom`) VALUES
('act01', 'Andre', ' Dussollier'),
('act02', 'Bernard ', 'Giraudeau'),
('act03', 'Christophe', ' Lambert'),
('act04', 'Didier', 'Bourdon'),
('act05', 'Francois', 'Xavier Demaison'),
('act06', 'Jacques', 'Weber'),
('act07', 'Gerard', 'Depardieu'),
('act08', 'Jocelyn', 'Quivrin'),
('act09', 'Martin', 'Lamotte'),
('act10', 'Pierre', 'Mondy'),
('act11', 'jackie ', 'chan'),
('act12', 'mag ', 'iver'),
('act13', 'bruce ', 'lice'),
('act14', 'el fahem', 'sbo3i'),
('act15', 'mohamed ', 'sobhi'),
('act16', 'adel ', 'imam');

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adr` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  PRIMARY KEY (`id_adr`),
  KEY `id_adr` (`id_adr`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_cinema_2` (`id_cinema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adr`, `rue`, `ville`, `id_cinema`) VALUES
('adr01', '17, rue michel', 'Paris', 'cin01'),
('adr02', '18, rue saint michel', 'Paris', 'cin02'),
('adr03', '09,rue tunisie', 'Bordeaux', 'cin03'),
('adr04', '01, rue palastine', 'Bordeaux', 'cin05'),
('adr05', '17, rue liberté', 'Paris', 'cin04'),
('adr06', '20 AV bardanac village 5', 'Bordeaux', 'cin06'),
('adr07', '14 place la Victoire', 'lyon', 'cin07'),
('adr08', '23 Forum', 'lille', 'cin08'),
('adr09', '12 Av de l''université', 'brest', 'cin09'),
('adr10', '13 rue serre', 'Corse', 'cin09');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

CREATE TABLE IF NOT EXISTS `caisse` (
  `id_caisse` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `id_personnel` varchar(255) NOT NULL,
  PRIMARY KEY (`id_caisse`),
  KEY `id_caisse` (`id_caisse`),
  KEY `id_caisse_2` (`id_caisse`),
  KEY `id_caisse_3` (`id_caisse`,`id_cinema`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_personnel` (`id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `caisse`
--

INSERT INTO `caisse` (`id_caisse`, `etat`, `id_cinema`, `id_personnel`) VALUES
('cai01', '123', 'cin01', 'per01'),
('cai02', '345', 'cin01', 'per02'),
('cai03', '723', 'cin02', 'per03'),
('cai04', '673', 'cin02', 'per04'),
('cai05', '932', 'cin03', 'per05'),
('cai06', '324', 'cin03', 'per01'),
('cai07', '939', 'cin04', 'per03'),
('cai08', '342', 'cin04', 'per02'),
('cai09', '432', 'cin05', 'per04'),
('cai10', '848', 'cin05', 'per05');

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE IF NOT EXISTS `cinema` (
  `id_cinema` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nb_salles` int(255) NOT NULL,
  `id_adr` varchar(255) NOT NULL,
  `id_salle` int(255) NOT NULL,
  PRIMARY KEY (`id_cinema`),
  KEY `id_adr` (`id_adr`),
  KEY `id_salle` (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cinema`
--

INSERT INTO `cinema` (`id_cinema`, `nom`, `nb_salles`, `id_adr`, `id_salle`) VALUES
('cin01', 'cinema1', 10, 'adr01', 0),
('cin02', 'cinema2', 8, 'adr02', 0),
('cin03', 'cinema3', 13, 'adr03', 0),
('cin04', 'cinema4', 8, 'adr05', 0),
('cin05', 'cinema5', 4, 'adr04', 0),
('cin06', 'cinema06', 23, 'adr03', 0),
('cin07', 'cinema07', 34, 'adr04', 0),
('cin08', 'cinema08', 56, 'adr01', 0),
('cin09', 'cinema09', 34, 'adr02', 0);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `prenom` varchar(255) NOT NULL,
  `mail` text NOT NULL,
  `id_film` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`prenom`, `mail`, `id_film`, `nom`) VALUES
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', ''),
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', ''),
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', 'ms01'),
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', 'ms01'),
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', 'ms01'),
('dzad', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film15', 'ms01'),
('DAZD', 'dazd', 'film15', 'DAZD'),
('FAZFA', 'FAFA', 'film15', 'FAFA'),
('FAFA', 'FAZFA', 'FAFA', 'film15'),
('FAFA', 'FAZFA', 'FAFA', 'film15'),
('aiai', 'titi', 'aaaaa', 'film15'),
('bensalem', 'ali', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film01'),
('', '', '', 'film02'),
('', '', '', 'film13'),
('', '', '', 'film13'),
('', '', '', 'film06'),
('', '', '', 'film06'),
('', '', '', 'film06'),
('', '', '', 'film11'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film08'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('', '', '', 'film07'),
('benjema', 'rahma', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film06'),
('benjema', 'rahma', 'bilel.bensalem@etu.u-bordeaux1.fr', 'film06'),
('', '', '', 'film01'),
('', '', '', 'film01'),
('', '', '', 'film06'),
('', '', '', 'film08');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id_film` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `duree` int(255) NOT NULL,
  `Description` text NOT NULL,
  `Edition` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `reserve` int(11) NOT NULL,
  `id_genre` varchar(255) NOT NULL,
  `id_salle` varchar(255) NOT NULL,
  `id_seance` varchar(255) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_genre` (`id_genre`),
  KEY `id_salle` (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id_film`, `titre`, `duree`, `Description`, `Edition`, `id_cinema`, `reserve`, `id_genre`, `id_salle`, `id_seance`) VALUES
('film01', 'Devil Inside', 2, 'Le film est une adaptation cinématographique', '2012', 'cin01', 7, 'gen01', 'sal01', 'proj01'),
('film02', 'Contraband', 3, 'est un film de science-fiction de James Cameron tourné en 3D Relief', '2011', 'cin02', 12, 'gen01', 'sal01', 'proj02'),
('film03', 'Dos au mur', 2, 'Un programme est créé par les terriens, le programme Avatar ', '2012', 'cin03', 10, 'gen01', 'sal02', 'proj03'),
('film04', 'The Divide', 3, 'Il a été tourné entre le mois d''août et le mois de septembre ', '2012', 'cin04', 4, 'gen01', 'sal03', 'proj04'),
('film05', '13 Flowers of Nanjing', 2, 'Description du film DILA. Introduction - La DILA; ', '2011', 'cin05', 8, 'gen01', 'sal02', 'proj05'),
('film06', 'hancoock', 3, 'est un film de Action de James Cameron ', '2009', 'cin01', 12, 'gen02', 'sal03', 'proj06'),
('film07', 'sifara fi al imara', 3, 'est un film de science-fiction de James Cameron t', '2010', 'cin02', 12, 'gen02', 'sal04', 'proj07'),
('film08', 'ICE AGE', 2, 'est un film de science-fiction de James Cameron t', '2012', 'cin03', 12, 'gen02', 'sal04', 'proj08'),
('film09', 'fin du monde', 2, 'est un film de science-fiction de James Cameron t', '2009', 'cin04', 14, 'gen03', 'sal05', 'proj09'),
('film10', 'nice day', 3, 'est un film de science-fiction de James Cameron t', '2007', 'cin05', 17, 'gen03', 'sal05', 'proj10'),
('film11', 'My life', 3, 'est un film de science-fiction de James Cameron t', '2000', 'cin01', 23, 'gen03', 'sal06', 'proj11'),
('film12', 'Cockneys vs Zombies ', 0, 'est un film de science-fiction de James Cameron tourné \n', '2012', 'cin02', 12, 'gen03', 'sal06', 'proj12'),
('film13', 'Here Comes the Boom ', 3, 'est un film de Action de Here Comes the Boom', '2003', 'cin03', 12, 'gen04', 'sal07', 'proj13'),
('film14', 'The Wailer 3 2012', 2, 'est un film de The Wailer 3 2012', '2012', 'cin04', 12, 'gen04', 'sal07', 'proj14'),
('film15', 'Christmas 2050', 3, 'est un film de science-fiction de James Cameron ', '2006', 'cin05', 12, 'gen04', 'sal08', 'proj15'),
('film16', 'Absolute ', 2, 'est un film de science-fiction de James Cameron tourné ', '2012', 'cin04', 23, 'gen04', 'sal09', 'proj16'),
('film17', 'Free Men 2011 ', 3, 'est un film de science-fiction de James Cameron tourné ', '2010', 'cin05', 12, 'gen04', 'sal10', 'proj17'),
('film18', 'Oslo August 31 ', 2, 'est un film de science-fiction de James Cameron tourné ', '2009', 'cin02', 12, 'gen05', 'sal11', 'proj18'),
('film20', 'The Silent War 2012', 3, 'est un film de science-fiction de James Cameron tourné ', '2010', 'cin01', 0, 'gen04', 'sal13', 'proj02'),
('film21', 'Wrong Turn 5 2012', 2, 'est un film de science-fiction de James Cameron tourné ', '', 'cin04', 0, 'gen05', 'sal10', 'proj03'),
('film22', 'American Horror ', 3, 'est un film de science-fiction de James Cameron tourné ', '', 'cin05', 0, 'gen05', 'sal11', 'proj04');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` varchar(255) NOT NULL,
  `code_genre` int(255) NOT NULL,
  `libelle_genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `code_genre`, `libelle_genre`) VALUES
('gen01', 1230, 'seance 1'),
('gen02', 1231, 'seance 2'),
('gen03', 1232, 'seance 3'),
('gen04', 1233, 'seance 4'),
('gen05', 1234, 'seance 5');

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `id_film` varchar(255) NOT NULL,
  `id_acteur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`),
  KEY `id_film` (`id_film`,`id_acteur`),
  KEY `id_film_2` (`id_film`,`id_acteur`),
  KEY `id_acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participation`
--

INSERT INTO `participation` (`id_film`, `id_acteur`) VALUES
('film01', 'act01'),
('film02', 'act02'),
('film03', 'act03'),
('film04', 'act04'),
('film05', 'act05'),
('film01', 'act06'),
('film02', 'act07'),
('film03', 'act08'),
('film04', 'act09'),
('film05', 'act10');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Fonction` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `id_caisse` varchar(255) NOT NULL,
  PRIMARY KEY (`id_personnel`,`Fonction`),
  KEY `id_personnel` (`id_personnel`,`Fonction`),
  KEY `Fonction` (`Fonction`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_caisse` (`id_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `nom`, `prenom`, `Login`, `Password`, `Fonction`, `id_cinema`, `id_caisse`) VALUES
('per01', 'Al Pacino', 'pino', 'perso01', 'perso01', 'acheteur', 'cin01', 'cai01'),
('per02', 'Schwarzenegger', 'lonu', 'perso02', 'perso02', 'programmateur', 'cin02', 'cai02'),
('per03', 'saaas', 'kszdz', 'perso03', 'perso03', 'gerant', 'cin03', 'cai03'),
('per04', 'bruno', 'malle', 'perso04', 'perso04', 'caissier', 'cin04', 'cai04'),
('per05', 'Bruce', 'lee', 'perso05', 'perso05', 'caissier', 'cin05', 'cai05');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `capacite` int(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_salle`),
  KEY `id_salle` (`id_salle`),
  KEY `id_salle_2` (`id_salle`),
  KEY `numero` (`numero`),
  KEY `id_salle_3` (`id_salle`),
  KEY `id_salle_4` (`id_salle`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_salle_5` (`id_salle`,`id_cinema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `numero`, `capacite`, `id_cinema`, `nom`) VALUES
('sal01', 19, 280, 'cin01', 'nom1'),
('sal02', 23, 344, 'cin02', 'nom2'),
('sal03', 2, 212, 'cin03', 'nom3'),
('sal04', 1, 190, 'cin04', 'nom4'),
('sal05', 5, 200, 'cin05', 'nom5'),
('sal06', 6, 400, 'cin01', 'nom6'),
('sal07', 3, 322, 'cin02', 'nom7'),
('sal08', 4, 323, 'cin03', 'nom8'),
('sal09', 2, 210, 'cin04', 'nom9'),
('sal10', 1, 200, 'cin05', 'nom10'),
('sal11', 45, 212, 'cin06', 'nom11'),
('sal12', 31, 241, 'cin01', 'nom12'),
('sal13', 27, 122, 'cin02', 'nom13'),
('sal14', 12, 343, 'cin03', 'nom14'),
('sal15', 26, 122, 'cin04', 'nom15'),
('sal16', 25, 244, 'cin05', 'nom16'),
('sal17', 24, 344, 'cin06', 'nom17'),
('sal18', 23, 122, 'cin07', 'nom18'),
('sal19', 22, 234, 'cin08', 'nom19'),
('sal20', 21, 233, 'cin09', 'nom20');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE IF NOT EXISTS `seance` (
  `id_seance` varchar(255) NOT NULL,
  `horaire` time NOT NULL,
  `durée_seance` int(255) NOT NULL,
  `Date` date NOT NULL,
  `Prix` varchar(255) NOT NULL,
  `id_film` varchar(255) NOT NULL,
  `id_salle` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `id_semaine` varchar(255) NOT NULL,
  `nb_reserv` int(255) NOT NULL,
  PRIMARY KEY (`id_seance`),
  KEY `id_proj` (`id_seance`),
  KEY `id_proj_2` (`id_seance`),
  KEY `id_film` (`id_film`),
  KEY `id_proj_3` (`id_seance`,`id_film`),
  KEY `id_salle` (`id_salle`),
  KEY `id_proj_4` (`id_seance`,`id_salle`),
  KEY `id_cinema` (`id_cinema`),
  KEY `id_semaine` (`id_semaine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `horaire`, `durée_seance`, `Date`, `Prix`, `id_film`, `id_salle`, `id_cinema`, `id_semaine`, `nb_reserv`) VALUES
('proj01', '10:00:00', 2, '2012-03-03', '5  €', 'film01', 'sal01', 'cin01', 'sem01', 0),
('proj02', '12:00:00', 2, '2012-03-01', '6 €', 'film02', 'sal02', 'cin03', 'sem01', 0),
('proj03', '15:00:00', 3, '2012-03-07', '5  €', 'film03', 'sal05', 'cin09', 'sem01', 0),
('proj04', '12:00:00', 3, '2012-03-23', '9  €', 'film04', 'sal06', 'cin04', 'sem01', 0),
('proj05', '16:00:00', 2, '2012-03-12', '8  €', 'film05', 'sal07', 'cin05', 'sem01', 0),
('proj06', '21:00:00', 2, '2012-03-22', '7  €', 'film01', 'sal04', 'cin02', 'sem02', 0),
('proj07', '22:00:00', 0, '0000-00-00', '7  €', 'film06', 'sal11', 'cin01', 'sem02', 0),
('proj08', '10:00:00', 0, '0000-00-00', '7  €', 'film07', 'sal12', 'cin02', 'sem02', 0),
('proj09', '16:00:00', 0, '0000-00-00', '6  €', 'film08', 'sal13', 'cin03', 'sem02', 0),
('proj10', '18:00:00', 0, '0000-00-00', '5 €', 'film09', 'sal14', 'cin04', 'sem02', 0),
('proj11', '20:00:00', 0, '0000-00-00', '7  €', 'film10', 'sal15', 'cin05', 'sem03', 0),
('proj12', '00:21:00', 0, '0000-00-00', '5 €', 'film11', 'sal16', 'cin01', 'sem03', 0),
('proj13', '22:00:00', 0, '0000-00-00', '6  €', 'film12', 'sal17', 'cin02', 'sem04', 0),
('proj14', '14:00:00', 0, '0000-00-00', '7 €', 'film13', 'sal18', 'cin03', 'sem04', 0),
('proj15', '15:00:00', 0, '0000-00-00', '9  €', 'film14', 'sal19', 'cin04', 'sem05', 0),
('proj16', '19:00:00', 0, '0000-00-00', '5 €', 'film15', 'sal20', 'cin05', 'sem05', 0),
('proj17', '18:00:00', 0, '0000-00-00', '7 €', 'film16', 'sal01', 'cin01', 'sem05', 0),
('proj18', '22:00:00', 0, '0000-00-00', '6  €', 'film18', 'sal19', 'cin02', 'sem04', 0);

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE IF NOT EXISTS `semaine` (
  `id_semaine` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id_semaine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `semaine`
--

INSERT INTO `semaine` (`id_semaine`, `date_debut`, `date_fin`) VALUES
('sem01', '2012-11-02', '2012-11-09'),
('sem02', '2012-11-16', '2012-11-23'),
('sem03', '2012-11-30', '2012-12-01'),
('sem04', '2012-12-07', '2012-12-14'),
('sem05', '2012-11-23', '2012-11-30');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`);

--
-- Contraintes pour la table `caisse`
--
ALTER TABLE `caisse`
  ADD CONSTRAINT `caisse_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `caisse_ibfk_2` FOREIGN KEY (`id_personnel`) REFERENCES `personnel` (`id_personnel`);

--
-- Contraintes pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD CONSTRAINT `cinema_ibfk_1` FOREIGN KEY (`id_adr`) REFERENCES `adresse` (`id_adr`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `film_ibfk_3` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteurs` (`id_acteur`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`id_caisse`) REFERENCES `caisse` (`id_caisse`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `seance_ibfk_2` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`),
  ADD CONSTRAINT `seance_ibfk_3` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `seance_ibfk_4` FOREIGN KEY (`id_semaine`) REFERENCES `semaine` (`id_semaine`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
