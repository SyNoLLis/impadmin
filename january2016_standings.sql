-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Janvier 2016 à 15:52
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
-- Structure de la table `january2016_standings`
--

CREATE TABLE IF NOT EXISTS `february2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `march2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `april2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;


CREATE TABLE IF NOT EXISTS `may2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `june2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `july2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `august2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `september2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `october2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `november2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `december2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

CREATE TABLE IF NOT EXISTS `2016_standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `region` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;