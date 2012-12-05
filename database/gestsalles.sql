-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 05 Décembre 2012 à 03:14
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

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
-- Structure de la table `adresses`
--

CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_et_rue` varchar(127) NOT NULL,
  `ville` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `num_et_rue`, `ville`) VALUES
(1, '27 rue Carmin', 'Besançon'),
(2, '18 avenue de l''Orme', 'Pau'),
(3, '35 allée des Peupliers', 'Paris'),
(4, '09 rue Philistine', 'Bordeaux'),
(5, '01 rue de la Tunisie', 'Bordeaux');

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

CREATE TABLE IF NOT EXISTS `caisses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` int(11) NOT NULL,
  `id_cinema` int(11) NOT NULL,
  `id_caissier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `caisses`
--

INSERT INTO `caisses` (`id`, `contenu`, `id_cinema`, `id_caissier`) VALUES
(1, 35, 1, 3),
(2, 0, 1, 4),
(3, 0, 2, 5),
(4, 0, 3, 6),
(5, 0, 3, 7),
(6, 0, 4, 8),
(7, 0, 4, 9),
(8, 0, 5, 10),
(9, 0, 5, 11),
(10, 0, 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `cinemas`
--

CREATE TABLE IF NOT EXISTS `cinemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cinema` varchar(25) NOT NULL,
  `nb_salles` int(11) NOT NULL,
  `id_adresse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `cinemas`
--

INSERT INTO `cinemas` (`id`, `nom_cinema`, `nb_salles`, `id_adresse`) VALUES
(1, 'Le Rex', 5, 1),
(2, 'Les Variétés', 10, 2),
(3, 'La Libellule', 7, 3),
(4, 'Le Cube', 6, 4),
(5, 'Ciné+', 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) NOT NULL,
  `email` varchar(48) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `id_film` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `pseudo`, `email`, `comment`, `id_film`) VALUES
(1, 'Jean_520', 'jean520@blue.fr', 'Un commentaire !', 1);

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `genre` varchar(24) NOT NULL,
  `duree` int(11) NOT NULL,
  `sortie` date NOT NULL,
  `acteurs` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `nb_copies_en_reserve` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `genre`, `duree`, `sortie`, `acteurs`, `description`, `nb_copies_en_reserve`) VALUES
(1, 'Film Sans Titre 1', 'Action', 90, '2012-11-29', 'L''acteur 1, l''acteur 2', 'Un film comme les autres.', 5),
(2, 'Un Film (V 1987)', 'Science Fiction', 105, '1987-05-02', 'L''acteur 1, l''acteur 2, l''acteur 3', 'Film muet en noir et blanc des années 1980.', 1),
(3, 'Film Au Long Titre n°1000000', 'Documentaire', 30, '2002-07-15', '', 'Discussion autour des macaroni.', 5),
(4, 'Film Au Long Titre n°9999999999999999999999999999999999999999999', 'Science Fiction', 120, '2012-11-15', 'L''acteur 1, l''acteur 2, l''acteur 3', 'Un film comme les autres.', 3),
(5, 'Film Sans Titre 2', 'Documentaire', 60, '2012-12-02', 'L''acteur 1, l''acteur 2', 'Un film comme les autres.', 4),
(6, 'Le Film n°1', 'Action', 105, '2012-04-15', 'L''acteur 1, l''acteur 2', 'Un film comme les autres.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(47) NOT NULL,
  `prenom` varchar(47) NOT NULL,
  `fonction` varchar(23) NOT NULL,
  `login` varchar(23) NOT NULL,
  `password` varchar(23) NOT NULL,
  `id_cinema` int(11) DEFAULT NULL,
  `id_caisse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`id`, `nom`, `prenom`, `fonction`, `login`, `password`, `id_cinema`, `id_caisse`) VALUES
(1, 'Bernan', 'Alice', 'acheteur', 'Alice', 'mdp', NULL, NULL),
(2, 'Mills', 'Dan', 'programmateur', 'Dan', 'mdp', NULL, NULL),
(3, 'Dupont', 'Jean', 'caissier', 'Jean', 'mdp', 1, 1),
(4, 'Fictive', 'Carole', 'caissier', 'Carole', 'mdp', 1, 2),
(5, 'Inizan', 'Lohann', 'caissier', 'Lohann', 'mdp', 2, 3),
(6, 'Guyader', 'Loïck', 'caissier', 'Loïck', 'mdp', 3, 4),
(7, 'Merer', 'Dinan', 'caissier', 'Dinan', 'mdp', 3, 5),
(8, 'Jezequel', 'Egat', 'caissier', 'Egat', 'mdp', 4, 6),
(9, 'Derrien', 'Auregane', 'caissier', 'Auregane', 'mdp', 4, 7),
(10, 'Denyel', 'Marivon', 'caissier', 'Marivon', 'mdp', 5, 8),
(11, 'Auffret', 'Klara', 'caissier', 'Klara', 'mdp', 5, 9),
(12, 'Abautret', 'Maï', 'caissier', 'Maï', 'mdp', 5, 10),
(13, 'Helies', 'Lera', 'gerant', 'Lera', 'mdp', 1, NULL),
(14, 'Menez', 'Kaourintin', 'gerant', 'Kaourintin', 'mdp', 2, NULL),
(15, 'Le Mével', 'Loïk', 'gerant', 'Loïk', 'mdp', 3, NULL),
(16, 'Denoel', 'Jos', 'gerant', 'Loïk', 'mdp', 4, NULL),
(17, 'Prigent', 'Luan', 'gerant', 'Luan', 'mdp', 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projections`
--

CREATE TABLE IF NOT EXISTS `projections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_film` int(255) NOT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `id_cinema` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  `tarif` int(11) NOT NULL,
  `nb_reservations` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `projections`
--

INSERT INTO `projections` (`id`, `id_film`, `date`, `heure_debut`, `heure_fin`, `id_cinema`, `id_salle`, `tarif`, `nb_reservations`) VALUES
(1, 1, '2012-11-09', '08:00:00', '09:30:00', 1, 1, 10, 1),
(2, 2, '2012-11-09', '10:00:00', '11:45:00', 1, 1, 10, 0),
(3, 3, '2012-11-10', '08:15:00', '10:00:00', 1, 1, 8, 0),
(4, 1, '2012-11-09', '09:00:00', '10:45:00', 1, 2, 7, 0),
(5, 5, '2012-11-09', '10:45:00', '11:50:00', 2, 1, 10, 0),
(6, 3, '2012-11-10', '11:30:00', '12:00:00', 3, 2, 10, 0),
(7, 0, '2012-11-10', '10:00:00', '12:00:00', 4, 1, 8, 0),
(8, 6, '2012-12-04', '12:00:00', '13:00:00', 1, 4, 10, 0),
(9, 2, '2012-12-04', '12:30:00', '13:00:00', 1, 5, 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(63) NOT NULL,
  `prenom` varchar(63) NOT NULL,
  `email` varchar(63) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `reservations`
--

INSERT INTO `reservations` (`id`, `nom`, `prenom`, `email`, `id_session`) VALUES
(1, 'Dupont', 'Alex', 'miam@caramail.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE IF NOT EXISTS `salles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_salle` int(11) NOT NULL,
  `nom_salle` varchar(15) NOT NULL,
  `id_cinema` int(11) NOT NULL,
  `nb_places` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `salles`
--

INSERT INTO `salles` (`id`, `num_salle`, `nom_salle`, `id_cinema`, `nb_places`) VALUES
(1, 1, '01', 1, 200),
(2, 2, '02', 1, 150),
(3, 3, '03', 1, 170),
(4, 4, '04', 1, 120),
(5, 5, '05', 1, 100),
(6, 6, '06', 1, 120),
(7, 7, '07', 1, 100),
(8, 8, '08', 1, 100),
(9, 9, '09', 1, 100),
(10, 10, '10', 1, 100),
(11, 1, '01', 2, 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
