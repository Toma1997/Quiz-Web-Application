-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2017 at 01:42 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kviz`
--
CREATE DATABASE IF NOT EXISTS `kviz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kviz`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnikID` int(11) NOT NULL AUTO_INCREMENT,
  `imePrezime` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`korisnikID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `imePrezime`, `username`, `password`, `admin`) VALUES
(1, 'Toma Joksimovic', 'tomas', 'tomas123', 1),
(2, 'Pera Peric', 'perica', 'bubblecup2018', 0),
(3, 'Zivko Zivic', 'zare21', 'zareVoliPare221', 0),
(4, 'Marko Jovic', 'marecare', 'marko95', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pitanje`
--

CREATE TABLE IF NOT EXISTS `pitanje` (
  `pitanjeID` int(11) NOT NULL AUTO_INCREMENT,
  `pitanje` varchar(255) NOT NULL,
  `A` varchar(255) NOT NULL,
  `B` varchar(255) NOT NULL,
  `C` varchar(255) NOT NULL,
  `D` varchar(255) NOT NULL,
  `tacan` varchar(255) NOT NULL,
  PRIMARY KEY (`pitanjeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pitanje`
--

INSERT INTO `pitanje` (`pitanjeID`, `pitanje`, `A`, `B`, `C`, `D`, `tacan`) VALUES
(1, 'Gde su se prvo pocele koristiti papirne novcanice ?', 'Indija', 'Kina', 'Pakistan', 'Egipat', 'b'),
(2, 'Mesopotamija je poznata kao ? ', 'Crna zemlja', 'Egipatsko kraljevstvo', 'Kolevka civilizacije', 'Bozija vrata', 'c'),
(3, 'Legendarni drevni grad Petra koji je u vreme antike bio glavni grad Nabatejaca se nalazi u ?', 'Libanu', 'Iranu', 'Pakistanu', 'Jordanu', 'd'),
(4, 'Pre solo nastupa , Sting je bio tekstopisac, pevac i basista koje grupe ?', 'The Who', 'Oasis', 'The Clash', 'The police', 'd'),
(5, 'Najveca vrsta macaka na svetu ?', 'Tigar', 'Ris', 'Gepar', 'Lav', 'a'),
(6, 'Pre nego sto je promenio ime, Muhamed Ali se zvao ?', 'Bobi Dzonson', 'Karim Abdul Jabar', 'Kasijus Klej', 'Dzim Frejzer', 'c'),
(7, 'U kojoj drzavi se nalazi najvise vulkana ?', 'Indonezija', 'Filipini', 'Italija', 'Japan', 'a'),
(8, 'Alfred Nobel je patentirao ?', 'Aspirin', 'Dinamit', 'Plastiku', 'Hemijsku olovku', 'b'),
(9, 'Vinsent Van Gog je nacrtan Zvezdanu noc dok je boravio ?', 'Bolnici u Francuskoj', 'Kaficu u Amsterdamu', 'Odmaralistu u Belgiji', 'Stanu u Parizu', 'a'),
(10, 'Dzimi Pejdz je osnovao bend ?', 'Led Cepelin', 'Pink Flojd', 'Queen', 'Bitlsi', 'a'),
(11, 'Na zastavi koje drzave se nalazi zuta zvezda, knjiga i AK-47 ?', 'Kuba', 'Mozambik', 'Severna Koreja', 'Somalija', 'b'),
(12, 'Koji je bio prvi covek u svemiru ?', 'Nil Armstrong', 'Juri Gagarin', 'Baz Aldrin', 'Sergej Krikalev', 'b'),
(13, 'Afrika nije prirodno staniste ove zivotinje ?', 'Tigar', 'Gnu', 'Leopard', 'Kapski pavijan', 'a'),
(14, 'Hamlet je bio princ ?', 'Engleske', 'Danske', 'Norveske', 'Velsa', 'b'),
(15, 'Na kojem se kontinentu nalazi Gvajana ?', 'Afrika', 'Juzna Amerika', 'Azija', 'Evropa', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `tabela`
--

CREATE TABLE IF NOT EXISTS `tabela` (
  `tabelaID` int(11) NOT NULL AUTO_INCREMENT,
  `korisnikID` int(11) NOT NULL,
  `brojPoena` int(11) NOT NULL,
  `pitanja` varchar(255) NOT NULL,
  PRIMARY KEY (`tabelaID`),
  KEY `korisnikID` (`korisnikID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tabela`
--

INSERT INTO `tabela` (`tabelaID`, `korisnikID`, `brojPoena`, `pitanja`) VALUES
(1, 1, 4, '14,13,6,8,5'),
(2, 2, 4, '14,13,6,8,5'),
(3, 1, 5, '1,5,11,2,3'),
(4, 3, 3, '7,11,9,8,5'),
(5, 1, 2, '10,2,14,4,13'),
(6, 2, 3, '10,6,13,1,5'),
(7, 1, 5, '12,5,7,13,11'),
(8, 2, 4, '12,5,14,4,13'),
(9, 1, 3, '15,7,10,14,3'),
(10, 4, 3, '1,12,4,11,9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
