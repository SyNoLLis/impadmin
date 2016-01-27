-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 27 Janvier 2016 à 11:53
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `impbnsco_admin`
--

-- --------------------------------------------------------

--
-- Structure de la table `2016_standings`
--

CREATE TABLE IF NOT EXISTS `2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `april2016_standings`
--

CREATE TABLE IF NOT EXISTS `april2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `april2016_standings`
--

INSERT INTO `april2016_standings` (`id`, `name`, `class`, `points`, `profile`, `region`) VALUES
(1, 'testing', 'Blade Dancer', 150, 'test', 'eu'),
(2, 'testing', 'Blade Dancer', 150, 'test', 'eu'),
(3, 'testing2', 'Blade Dancer', 150, 'test', 'eu');

-- --------------------------------------------------------

--
-- Structure de la table `august2016_standings`
--

CREATE TABLE IF NOT EXISTS `august2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `december2016_standings`
--

CREATE TABLE IF NOT EXISTS `december2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `february2016_standings`
--

CREATE TABLE IF NOT EXISTS `february2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `february2016_standings`
--

INSERT INTO `february2016_standings` (`id`, `name`, `class`, `points`, `profile`, `region`) VALUES
(1, 'test', 'Blade Dancer', 9999, 'god', 'na'),
(2, 'ttt', 'Assassin', 97, 'gagg', 'na'),
(3, 'ttt', 'Assassin', 97, 'gagg', 'na'),
(4, 'gdsgdg', 'Blade Dancer', 8464, '51gsd', 'eu'),
(5, 'aaaa', 'Destroyer', 111, '15', 'eu'),
(6, 'aaaaaaaaaaa', 'Assassin', 112, '15', 'eu');

-- --------------------------------------------------------

--
-- Structure de la table `january2016_standings`
--

CREATE TABLE IF NOT EXISTS `january2016_standings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `january2016_standings`
--

INSERT INTO `january2016_standings` (`id`, `name`, `class`, `points`, `profile`, `region`) VALUES
(12, 'Radeyz', 'Kung Fu Master', 75, 'Radeyz', 'eu'),
(13, 'Bevv', 'Force Master', 100, 'Bevv', 'eu'),
(14, 'Beyblade', 'Blade Dancer', 30, 'Beyblade', 'eu'),
(15, 'Ringshu', 'Destroyer', 150, 'Ringshu', 'eu'),
(16, 'Acchan', 'Summoner', 50, 'Acchan', 'eu'),
(17, 'Skroft', 'Assassin', 30, 'Skroft', 'eu'),
(18, 'Luki', 'Blade Master', 30, 'Luki', 'eu'),
(19, 'Xukania', 'Assassin', 30, 'Xukania', 'eu'),
(20, 'Enoll', 'Blade Master', 20, 'Enoll', 'eu'),
(21, 'Nyne', 'Assassin', 20, 'Nyne', 'eu'),
(22, 'Voidklng', 'Assassin', 20, 'Voidklng', 'eu'),
(23, 'Comrade', 'Destroyer', 20, 'Comrade', 'eu'),
(24, 'MinatoKFMr', 'Kung Fu Master', 20, 'MinatoKFM', 'eu'),
(25, 'Shu', 'Blade Dancer', 20, 'Shu', 'eu'),
(26, 'qik', 'Kung Fu Master', 20, 'qik', 'eu'),
(27, 'Wilhelmina Tell', 'Summoner', 20, 'Wilhelmina Tell', 'eu'),
(28, 'Second', 'Blade Master', 10, 'Second', 'eu'),
(29, 'Exthelion', 'Destroyer', 10, 'Exthelion', 'eu'),
(30, 'Rekd', 'Kung Fu Master', 10, 'Rekd', 'eu'),
(31, 'Rikh', 'Force Master', 10, 'Rikh', 'eu'),
(32, 'Maziuke', 'Summoner', 10, 'Maziuke', 'eu'),
(33, 'thormond', 'Destroyer', 10, 'thormond', 'eu'),
(34, 'Woulven', 'Destroyer', 10, 'Woulven', 'eu'),
(35, 'intro', 'Force Master', 10, 'intro', 'eu'),
(36, 'Shiro', 'Kung Fu Master', 10, 'Shiro', 'eu'),
(37, 'Cayata ', 'Summoner', 10, 'Cayata ', 'eu'),
(38, 'Saitama', 'Kung Fu Master', 10, 'Saitama', 'eu'),
(39, 'Empathy', 'Blade Dancer', 10, 'Empathy', 'eu'),
(40, 'EnollSempai', 'Blade Master', 10, 'EnollSempai', 'eu'),
(41, 'Seathorious', 'Assassin', 10, 'Seathorious', 'eu'),
(42, 'Baguette', 'Blade Dancer', 10, 'Baguette', 'eu'),
(43, 'Ferazu', 'Blade Dancer', 10, 'Ferazu', 'eu'),
(44, 'A r', 'Blade Dancer', 150, 'A r', 'na'),
(45, 'Silas', 'Blade Dancer', 100, 'Silas', 'na'),
(46, 'Vanguards', 'Summoner', 75, 'Vanguards', 'na'),
(47, 'Frolic', 'Summoner', 50, 'Frolic', 'na'),
(48, 'Kycir', 'Blade Dancer', 30, 'Kycir', 'na'),
(49, 'Fap', 'Assassin', 30, 'Fap', 'na'),
(50, 'Hawk', 'Kung Fu Master', 30, 'Hawk', 'na'),
(51, 'Madoshi', 'Force Master', 30, 'Madoshi', 'na'),
(52, 'Rylor', 'Force Master', 20, 'Rylor', 'na'),
(53, 'endahlol', 'Destroyer', 20, 'endahlol', 'na'),
(54, 'LilUshio', 'Blade Dancer', 20, 'LilUshio', 'na'),
(55, 'Suyji', 'Force Master', 20, 'Suyji', 'na'),
(56, 'Hongie', 'Force Master', 20, 'Hongie', 'na'),
(57, 'PepeLeFrog', 'Summoner', 20, 'PepeLeFrog', 'na'),
(58, 'Laifu', 'Blade Master', 20, 'Laifu', 'na'),
(59, 'Safe', 'Blade Master', 20, 'Safe', 'na'),
(60, '', '', 0, '', ''),
(61, 'GotJuice', 'Destroyer', 10, 'GotJuice', 'na'),
(62, 'Acrimony', 'Assassin', 10, 'Acrimony', 'na'),
(63, 'Tumblr', 'Destroyer', 10, 'Tumblr', 'na'),
(64, 'JacktheRipper', 'Assassin', 10, 'JacktheRipper', 'na'),
(65, 'Insatia', 'Destroyer', 10, 'Insatia', 'na'),
(66, 'Think', 'Blade Dancer', 10, 'Think', 'na'),
(67, 'Arin', 'Summoner', 10, 'Arin', 'na'),
(68, 'Sayumi Shimoda', 'Destroyer', 10, 'Sayumi Shimoda', 'na'),
(69, 'Satellites', 'Blade Dancer', 10, 'Satellites', 'na'),
(70, 'Rimo', 'Destroyer', 10, 'Rimo', 'na'),
(71, 'Name', 'Destroyer', 10, 'Name', 'na'),
(72, 'Zero', 'Blade Master', 10, 'Zero', 'na'),
(73, 'Rat', 'Blade Dancer', 10, 'Rat', 'na'),
(74, 'xShadow', 'Assassin', 10, 'xShadow', 'na'),
(75, 'Jaxi', 'Blade Dancer', 10, 'Jaxi', 'na'),
(76, 'Demonic', 'Force Master', 10, 'Demonic', 'na');

-- --------------------------------------------------------

--
-- Structure de la table `july2016_standings`
--

CREATE TABLE IF NOT EXISTS `july2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `june2016_standings`
--

CREATE TABLE IF NOT EXISTS `june2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `march2016_standings`
--

CREATE TABLE IF NOT EXISTS `march2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `march2016_standings`
--

INSERT INTO `march2016_standings` (`id`, `name`, `class`, `points`, `profile`, `region`) VALUES
(1, 'overkill', 'Destroyer', 99999, 'godlike', 'eu');

-- --------------------------------------------------------

--
-- Structure de la table `may2016_standings`
--

CREATE TABLE IF NOT EXISTS `may2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `november2016_standings`
--

CREATE TABLE IF NOT EXISTS `november2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `october2016_standings`
--

CREATE TABLE IF NOT EXISTS `october2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `september2016_standings`
--

CREATE TABLE IF NOT EXISTS `september2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`) VALUES
(1, 'SyNoLLis', 'synollis@gmx.com', '161ffd5b19a2ade5931309b5fd584bec', 'admin'),
(2, 'Averest', 'impbns@gmail.com', '59329f355b14108ace1461eb37adb770', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
