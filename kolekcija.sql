-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Računalo: 127.0.0.1
-- Vrijeme generiranja: Stu 18, 2013 u 11:32 
-- Verzija poslužitelja: 5.6.11
-- PHP verzija: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `kolekcija`
--
CREATE DATABASE IF NOT EXISTS `kolekcija` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kolekcija`;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `filmovi`
--

CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(30) NOT NULL,
  `id_zanr` int(10) unsigned NOT NULL,
  `godina` year(4) NOT NULL,
  `trajanje` varchar(10) NOT NULL,
  `slika` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_zanr` (`id_zanr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `zanr`
--

CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `zanr`
--

INSERT INTO `zanr` (`id`, `naziv`) VALUES
(1, 'Znanstveno - fantast'),
(2, 'Triler'),
(3, 'Akcija'),
(4, 'Drama');

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `filmovi`
--
ALTER TABLE `filmovi`
  ADD CONSTRAINT `filmovi_idfk_1` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
