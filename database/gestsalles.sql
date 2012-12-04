-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mer 10 Octobre 2012 à 23:15
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
  PRIMARY KEY (`id_adr`),
  KEY `id_adr` (`id_adr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adr`, `rue`, `ville`) VALUES
('adr01', '17, rue michel', 'Paris'),
('adr02', '18, rue saint michel', 'Paris'),
('adr03', '09,rue tunisie', 'Bordeaux'),
('adr04', '01, rue palastine', 'Bordeaux'),
('adr05', '17, rue liberté', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

CREATE TABLE IF NOT EXISTS `caisse` (
  `id_caisse` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_caisse`),
  KEY `id_caisse` (`id_caisse`),
  KEY `id_caisse_2` (`id_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `caisse`
--

INSERT INTO `caisse` (`id_caisse`, `etat`) VALUES
('cai01', '123'),
('cai02', '345'),
('cai03', '723'),
('cai04', '673'),
('cai05', '932'),
('cai06', '324'),
('cai07', '939'),
('cai08', '342'),
('cai09', '432'),
('cai10', '848');

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE IF NOT EXISTS `cinema` (
  `id_cinema` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nb_salles` int(255) NOT NULL,
  PRIMARY KEY (`id_cinema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cinema`
--

INSERT INTO `cinema` (`id_cinema`, `nom`, `nb_salles`) VALUES
('cin01', 'cinema1', 10),
('cin02', 'cinema2', 8),
('cin03', 'cinema3', 13),
('cin04', 'cinema4', 8),
('cin05', 'cinema5', 4);

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
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`id_film`, `titre`, `duree`, `Catégorie`, `Description`, `Edition`) VALUES
('film01', 'Devil Inside', 2, 'Horreur, Thriller', 'Le film «Sia le rêve du python» est une adaptation cinématographique de la légende du Wagadu (mythe Soninké du 7e siècle). Inspiré de la pièce de théâtre «La légende du Wagadu vue par Sia Yatabéré» de l´auteur mauritanien Moussa Diagana, le film est une approche politique universelle et contemporaine du mythe, une réflexion sur l''utilisation du mystère par le pouvoir.', '2012'),
('film02', 'Contraband', 3, 'Drame, Thriller', 'est un film de science-fiction de James Cameron tourné en 3D Relief, sorti en France le 16 décembre 2009. L''action se déroule sur la lune d''une géante gazeuse, Pandora, recouverte d''une jungle luxuriante', '2011'),
('film03', 'Dos au mur', 2, 'Crime, Thriller', 'Un programme est créé par les terriens, le programme Avatar qui va leur permettre de contrôler des corps Na''vi clonés associés à des gènes humains, afin de s''insérer dans la population et de tenter de négocier avec elle, dans la mesure où le clan', '2012'),
('film04', 'The Divide', 3, 'Science-Fiction, Thriller, Action', 'Il a été tourné entre le mois d''août et le mois de septembre 1999 au Burkina Faso, dans la région de Ouagadougou (Kokologho) pour les extérieurs du Palais et pour le reste à Bobo-Dioulasso notamment dans le vieux quartier de Dioulassoba et dans les environs de cette ville.', '2012'),
('film05', '13 Flowers of Nanjing', 2, 'action', 'Description du film DILA. Introduction - La DILA; La diffusion de la norme juridique française; La garantie de la transparence économique et financière', '2011');

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `id_film` varchar(255) NOT NULL,
  `id_acteur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`),
  KEY `id_film` (`id_film`,`id_acteur`),
  KEY `id_acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_personnel`,`Fonction`),
  KEY `id_personnel` (`id_personnel`,`Fonction`),
  KEY `Fonction` (`Fonction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `nom`, `prenom`, `Login`, `Password`, `Fonction`) VALUES
('per01', 'Al Pacino', 'pino', 'perso01', 'perso01', 'acheteur'),
('per02', 'Schwarzenegger', 'lonu', 'perso02', 'perso02', 'programmateur'),
('per03', 'saaas', 'kszdz', 'perso03', 'perso03', 'gerant'),
('per04', 'bruno', 'malle', 'perso04', 'perso04', 'caissier'),
('per05', 'Bruce', 'lee', 'perso05', 'perso05', 'caissier');

-- --------------------------------------------------------

--
-- Structure de la table `projections`
--

CREATE TABLE IF NOT EXISTS `projections` (
  `id_proj` varchar(255) NOT NULL,
  `horaire` varchar(255) NOT NULL,
  `durée_proj` int(255) NOT NULL,
  `Date` date NOT NULL,
  `Prix` int(255) NOT NULL,
  PRIMARY KEY (`id_proj`),
  KEY `id_proj` (`id_proj`),
  KEY `id_proj_2` (`id_proj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projections`
--

INSERT INTO `projections` (`id_proj`, `horaire`, `durée_proj`, `Date`, `Prix`) VALUES
('proj01', '10:00', 2, '0000-00-00', 3),
('proj02', '12:00', 2, '0000-00-00', 6),
('proj03', '15:00', 3, '0000-00-00', 4),
('proj04', '18:00', 3, '0000-00-00', 8),
('proj05', '20:00', 2, '0000-00-00', 10);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `capacite` int(255) NOT NULL,
  PRIMARY KEY (`id_salle`),
  KEY `id_salle` (`id_salle`),
  KEY `id_salle_2` (`id_salle`),
  KEY `numero` (`numero`),
  KEY `id_salle_3` (`id_salle`),
  KEY `id_salle_4` (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `numero`, `capacite`) VALUES
('sal01', 19, 280),
('sal02', 23, 344),
('sal03', 2, 212),
('sal04', 1, 190),
('sal05', 5, 200),
('sal06', 6, 400),
('sal07', 3, 322),
('sal08', 4, 323),
('sal09', 2, 210),
('sal10', 1, 200);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
