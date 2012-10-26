-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Dim 21 Octobre 2012 à 22:20
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestsalles`
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
('act10', 'Pierre', 'Mondy');

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
('adr04', '01, rue palastine', 'Bordeaux', 'cin03'),
('adr05', '17, rue liberté', 'Paris', 'cin04');

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
('cin05', 'cinema5', 4, 'adr04', 0);

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id_film` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `duree` int(255) NOT NULL,
  `Catégorie` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Edition` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  `reserve` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_cinema` (`id_cinema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`id_film`, `titre`, `duree`, `Catégorie`, `Description`, `Edition`, `id_cinema`, `reserve`) VALUES
('film01', 'Devil Inside', 2, 'Horreur, Thriller', 'Le film «Sia le rêve du python» est une adaptation cinématographique de la légende du Wagadu (mythe Soninké du 7e siècle). Inspiré de la pièce de théâtre «La légende du Wagadu vue par Sia Yatabéré» de l´auteur mauritanien Moussa Diagana, le film est une approche politique universelle et contemporaine du mythe, une réflexion sur l''utilisation du mystère par le pouvoir.', '2012', 'cin01', 7),
('film02', 'Contraband', 3, 'Drame, Thriller', 'est un film de science-fiction de James Cameron tourné en 3D Relief, sorti en France le 16 décembre 2009. L''action se déroule sur la lune d''une géante gazeuse, Pandora, recouverte d''une jungle luxuriante', '2011', 'cin02', 12),
('film03', 'Dos au mur', 2, 'Crime, Thriller', 'Un programme est créé par les terriens, le programme Avatar qui va leur permettre de contrôler des corps Na''vi clonés associés à des gènes humains, afin de s''insérer dans la population et de tenter de négocier avec elle, dans la mesure où le clan', '2012', 'cin03', 10),
('film04', 'The Divide', 3, 'Science-Fiction, Thriller, Action', 'Il a été tourné entre le mois d''août et le mois de septembre 1999 au Burkina Faso, dans la région de Ouagadougou (Kokologho) pour les extérieurs du Palais et pour le reste à Bobo-Dioulasso notamment dans le vieux quartier de Dioulassoba et dans les environs de cette ville.', '2012', 'cin04', 4),
('film05', '13 Flowers of Nanjing', 2, 'action', 'Description du film DILA. Introduction - La DILA; La diffusion de la norme juridique française; La garantie de la transparence économique et financière', '2011', 'cin05', 8);

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
-- Structure de la table `projections`
--

CREATE TABLE IF NOT EXISTS `projections` (
  `id_proj` varchar(255) NOT NULL,
  `heure_debut` time NOT NULL,
  `durée_proj` int(255) NOT NULL,
  `Date` date NOT NULL,
  `Prix` int(255) NOT NULL,
  `id_film` varchar(255) NOT NULL,
  `id_salle` varchar(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
  PRIMARY KEY (`id_proj`),
  KEY `id_proj` (`id_proj`),
  KEY `id_proj_2` (`id_proj`),
  KEY `id_film` (`id_film`),
  KEY `id_proj_3` (`id_proj`,`id_film`),
  KEY `id_salle` (`id_salle`),
  KEY `id_proj_4` (`id_proj`,`id_salle`),
  KEY `id_cinema` (`id_cinema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projections`
--

INSERT INTO `projections` (`id_proj`, `heure_debut`, `durée_proj`, `Date`, `Prix`, `id_film`, `id_salle`, `id_cinema`) VALUES
('proj01', '10:00:00', 2, '2012-03-03', 3, 'film01', 'sal01', 'cin01'),
('proj02', '12:00:00', 2, '2012-03-01', 6, 'film02', 'sal02', 'cin03'),
('proj03', '15:00:00', 3, '2012-03-07', 4, 'film03', 'sal05', 'cin02'),
('proj04', '18:00:00', 3, '2012-03-23', 8, 'film04', 'sal06', 'cin04'),
('proj05', '20:00:00', 2, '2012-03-12', 10, 'film05', 'sal07', 'cin05'),
('proj06', '21:00:00', 2, '2012-03-22', 7, 'film01', 'sal04', 'cin01');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `capacite` int(255) NOT NULL,
  `id_cinema` varchar(255) NOT NULL,
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

INSERT INTO `salle` (`id_salle`, `numero`, `capacite`, `id_cinema`) VALUES
('sal01', 19, 280, 'cin01'),
('sal02', 23, 344, 'cin02'),
('sal03', 2, 212, 'cin03'),
('sal04', 1, 190, 'cin04'),
('sal05', 5, 200, 'cin05'),
('sal06', 6, 400, 'cin01'),
('sal07', 3, 322, 'cin02'),
('sal08', 4, 323, 'cin03'),
('sal09', 2, 210, 'cin04'),
('sal10', 1, 200, 'cin05');

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
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteurs` (`id_acteur`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`),
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`id_caisse`) REFERENCES `caisse` (`id_caisse`);

--
-- Contraintes pour la table `projections`
--
ALTER TABLE `projections`
  ADD CONSTRAINT `projections_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`),
  ADD CONSTRAINT `projections_ibfk_2` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`),
  ADD CONSTRAINT `projections_ibfk_3` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id_cinema`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
