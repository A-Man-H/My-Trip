-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 28 Juin 2020 à 21:39
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mytrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`, `confirmCode`) VALUES
(4, 'A-mane', 'Hasnaoui', 'aymane.hasnaoui1@gmail.com', '0663474347', 'Hay Hassany Taza', 'a3ce874f3f404a1ddb0309f8fd53f60f', 'admin', '321'),
(5, 'Hamza', 'Hasnaoui', 'hamza.hasnaoui12345@gmail.com', '4657898765', '93 bloc A Hay Hassany taza', 'a3ce874f3f404a1ddb0309f8fd53f60f', 'staff', '757090');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `quantity`) VALUES
(35, 0, 104, 1),
(36, 0, 80, 1),
(37, 0, 79, 1),
(40, 0, 93, 1),
(44, 0, 107, 1),
(45, 0, 97, 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL,
  `delivery` varchar(30) NOT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`, `delivery`, `price`) VALUES
(180, 12343558, 79, 1, '100 Qods 2, 4eme', '0663474347', 'Yes', '2020-06-27', '3344-03-31', 'Amana +50Dh ', 550),
(181, 12343558, 109, 1, '100 Qods 2, 4eme', '0663474347', 'Cancel', '2020-06-27', '1434-03-12', 'Poste Maroc free', 370),
(182, 12343558, 97, 1, '100 Qods 2, 4eme', '0663474347', 'Yes', '2020-06-27', '0468-05-12', 'Amana +50 DH ', 110),
(184, 12343558, 98, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-27', '0000-00-00', 'Post maroc free', 250),
(185, 12343558, 81, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-27', '0000-00-00', 'Post maroc free', 250),
(186, 12343558, 81, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-27', '0000-00-00', 'Poste Maroc free', 250),
(187, 12343558, 109, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-28', '0000-00-00', 'Amana +50 DH ', 370),
(188, 12343558, 108, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-28', '0000-00-00', 'Amana +50 DH ', 170),
(189, 12343558, 108, 4, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-28', '0000-00-00', 'Amana +50Dh ', 170),
(190, 12343558, 100, 1, '100 Qods 2, 4eme', '0663474347', 'no', '2020-06-28', '0000-00-00', 'Amana +50Dh ', 170);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `piece`, `description`, `available`, `category`, `type`, `item`, `pCode`, `picture`) VALUES
(77, 'backpack 60L', 500, 8, 'water-proof', 100, '', '', 'back', 'aa', '1.jpg'),
(78, 'backpack 70L', 600, 6, 'water-proof', 100, '', '', 'back', 'bb', '2.jpg'),
(79, 'backpack 60L', 550, 6, 'water-proof best quality', 100, '', '', 'back', 'cc', '3.jpg'),
(80, 'backpack 50L', 450, 5, 'water-proof', 100, '', '', 'back', 'dd', '4.jpg'),
(81, 'doggy carpet best quality', 250, 4, 'comfortable', 100, '', '', 'carpet', 'qq', '1.jpg'),
(82, 'trip carpet good quality', 150, 6, 'perfect', 100, '', '', 'carpet', 'qq', '2.jpg'),
(83, 'new carpet,new collection', 180, 3, 'good', 100, '', '', 'carpet', 'qq', '3.jpg'),
(84, 'tent 4 pers', 290, 24, 'water-proof', 100, '', '', 'tent', 'qwe', '1.jpg'),
(85, 'tent 4 pers&child', 300, 24, 'water-proof', 100, '', '', 'tent', 'qwer', '2.jpg'),
(86, 'tent 2 pers', 160, 2, 'water-proof', 100, '', '', 'tent', 'qwrt', '3.jpg'),
(87, 'tent 2pers&child', 160, 24, 'water-proof', 100, '', '', 'tent', 'ryrty', '4.jpg'),
(88, 'tent new collection', 290, 5, 'water-proof', 100, '', '', 'tent', 'mnb', '5.jpg'),
(89, '2020 trip carpet good quality', 150, 6, 'perfect', 100, '', '', 'carpet', 'bb', '4.jpg'),
(90, 'carpet,more comfortable', 180, 3, 'good', 100, '', '', 'carpet', '42', '5.jpg'),
(91, 'power-bank for trip', 165, 4, 'made in morroco', 100, '', 'other', 'power', 'asdaa', '1.jpg'),
(92, '4 full charge power bank 20000mah', 320, 5, 'made in morroco', 100, '', 'other', 'power', 'adf', '2.jpg'),
(93, 'new collection powerbank', 100, 3, 'made in morroco', 100, '', '', 'power', 'gfhjgj', '3.jpg'),
(95, 'sleep-bag good quality 1.8m', 190, 3, 'water-proof', 100, '', '', 'sleep', 'lk', '4.jpg'),
(96, 'sleep-bag 2m', 300, 4, 'water-proof', 100, '', '', 'sleep', 'po', '1.jpg'),
(97, 'sleep-bag 1.5m for child', 110, 4, 'water-proof', 100, '', '', 'sleep', 'n', '2.jpg'),
(98, 'sleep-bag 2m', 250, 4, 'water-proof', 100, '', '', 'sleep', 'b', '3.jpg'),
(99, 'sleep-bag new collection 2.1m', 200, 24, 'water-proof', 100, '', 'other', 'sleep', 'r', '5.jpg'),
(100, 'power-bank 20000', 1000, 48, 'made in morroco', 100, '', '', 'power', 'v', '4.jpg'),
(101, 'power everithing 50000MaH', 1800, 100, 'made in morroco', 100, '', '', 'power', 'e', '5.jpg'),
(102, 'torch 48hours', 400, 3, '255ml 3sets', 100, '', '', 'torch', 'a', '1.jpg'),
(103, 'get your limitless torch', 220, 3, '3sets 100g', 100, '', '', 'torch', 'nl', '2.jpg'),
(104, 'torch 2020 new made in morroco', 300, 7, '7sets 135g', 100, '', '', 'torch', 'ewr', '3.jpg'),
(107, 'new torch collection', 150, 0, 'water-proof ', 4, '', '', 'torch', 'dfef', '4.jpg'),
(108, 'torch 8hours', 170, 0, 'good quality', 4, '', 'Trip', 'torch', '43', '1591339952.jpg'),
(109, 'Get the new family tent', 370, 0, 'good proof water', 4, '', 'trip', 'tent', '23', '1591579490.jpg'),
(113, 'hard back', 300, 0, 'good', 4, '', '', 'back', '', '1593364098.gif');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12343559 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(12343558, 'Aymane', 'Hasnaoui', 'aymane.hasnaoui1@gmail.com', '0663474347', '100 Qods 2, 4eme', 'a3ce874f3f404a1ddb0309f8fd53f60f', '0', 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
