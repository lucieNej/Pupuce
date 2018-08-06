-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2018 at 09:16 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veterinaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Jeux'),
(2, 'Toilettage'),
(3, 'Medicaments');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `client_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `client_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `client_psw` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_firstname`, `client_name`, `client_email`, `client_psw`) VALUES
(1, 'Lucie', 'Nejezchlebova', 'nejezchlebovalucie@gmail.com', 'azerty'),
(2, 'Vera', 'Husta', 'vera@gmail.com', 'poiu'),
(4, 'Alix', 'Chastang', 'alix@gmail.com', 'cannes'),
(6, 'Zuzana', 'Valachova', 'zuza@gmail.com', 'karvina'),
(9, 'Petr', 'Nejezchleb', 'petr@gmail.com', 'chleba'),
(11, 'Ainoha', 'Chastang', 'ainoha@gmail.com', '$2y$10$XYWZDOLaXgJJTVKxGFFocOgHVQsSIvXOxrl7N9l7lsIrOqB.qlw1q'),
(16, 'Lenka', 'Nova', 'lenka@gmail.com', 'aqw'),
(17, 'Lenka', 'Nova', 'lenka@gmail.com', 'aqw'),
(18, 'Jean Michel', 'Chastang', 'jean@gmail.com', 'bateau'),
(19, 'Jean Michel', 'Chastang', 'jean@gmail.com', 'bateau'),
(21, 'Anna', 'Scibska', 'anna@gmail.com', 'nice'),
(22, 'Anna', 'Scibska', 'anna@gmail.com', 'nice'),
(23, 'Anna', 'Scibska', 'anna@gmail.com', 'nice'),
(24, 'Anna', 'Scibska', 'anna@gmail.com', 'nice'),
(25, 'Anne', 'Babry', 'anne@gmail.com', 'france'),
(26, 'Anne', 'Babry', 'anne@gmail.com', 'france'),
(30, 'Pavel', 'Novak', 'novak@gmail.com', '$2y$10$mGUEJVDU9M23v1HSh3x6nOcwo0tZESiGe6rFdE4U0yKI8YkH.3Iuq'),
(31, 'Pavel', 'Novak', 'novak@gmail.com', '$2y$10$k7zr/u9Trxib3CGUm1BsOOQy74L16zg/rf1WNnmWTsEScf/7pOjHy'),
(32, 'Pavel', 'Novak', 'novak@gmail.com', '$2y$10$AKepkisP4pep8l51iQ0l1eiZVm9ROK3qYCK8QaxzF4ZnQ3XOyCF2K'),
(33, 'Alena', 'Cerna', 'alena@gmail.com', '$2y$10$j8xoULRg00Ol61UdSP/sS.9nWXoeA7VeraSzlJ8vjeU5KULK7poMK');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `fournisseur_nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `fournisseur_prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `fournisseur_mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `fournisseur_adresse` varchar(255) COLLATE utf8_bin NOT NULL,
  `fournisseur_cp` int(11) NOT NULL,
  `fournisseur_ville` varchar(255) COLLATE utf8_bin NOT NULL,
  `fournisseur_date_naissance` date NOT NULL,
  `fournisseur_code_comptable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `fournisseur_nom`, `fournisseur_prenom`, `fournisseur_mail`, `fournisseur_adresse`, `fournisseur_cp`, `fournisseur_ville`, `fournisseur_date_naissance`, `fournisseur_code_comptable`) VALUES
(1, 'Pietri', 'Nicola', 'nico@gmail.com', '12 rue Antibes', 6400, 'Cannes', '1983-08-29', 6678);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `category` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `category`, `quantity`, `code`) VALUES
(37, 'Os', 'jouet pour chien', 12.5, 'jouet1.jpg', 1, 0, ''),
(38, 'Felipil', 'reproduction', 25.5, 'medic1.jpeg', 3, 0, ''),
(39, 'Biocanina Shampoing ', 'Shampoing sans l\'eau', 23, 'toil1.jpg', 2, 0, ''),
(41, 'Gastroentericanis', 'AntidiarrhÃ©ique, antiseptique intestinal pour chiens et chats', 8.4, 'medic2.jpg', 3, 0, ''),
(42, 'Diamond eyes', 'Un dÃ©tachant pour nettoyer en douceur le contour de l\'oeil ', 22.9, 'toil2.jpg', 2, 0, ''),
(43, 'Spasmomen', 'Calment ou neutralisent les contractions involontaires des muscles.', 11.2, 'medic3.jpg', 3, 0, ''),
(45, 'Skateboard', 'Amusez vous avec votre chien', 35, 'jouet3.jpg', 1, 0, ''),
(46, 'Piscine', 'petite piscine pour votre chien', 35, 'jouet2.jpg', 1, 0, ''),
(47, 'Tondeuse', 'Toilettage de Chien sans fil', 46, 'toil3.jpg', 2, 0, ''),
(48, 'Veste pour le chien', 'veste chaude pour l\'hiver', 100, 'vest.jpg', 1, NULL, 'FTKFI65656');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_mdp` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_login`, `user_mdp`) VALUES
(1, 'Anne', 'Tabry', 'simplon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
