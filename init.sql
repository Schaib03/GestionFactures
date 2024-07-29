-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 24 juil. 2024 à 19:55
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
-- Create and use the database
CREATE DATABASE IF NOT EXISTS appwebfactures;
USE appwebfactures;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `appwebfactures`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` int(99) NOT NULL,
  `idUser` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `numero` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `montantTotal` double NOT NULL,
  `etat` varchar(40) NOT NULL,
  `idC` int(99) NOT NULL,
  `idP` int(99) NOT NULL,
  `idU` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idPaiement` int(99) NOT NULL,
  `dateP` date NOT NULL,
  `montant` double NOT NULL,
  `methode` varchar(50) NOT NULL,
  `idUser` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idPaiement`, `dateP`, `montant`, `methode`, `idUser`) VALUES
(0, '0000-00-00', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(99) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `login`, `password`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', ''),
(5, 'Saad CHAIB', 'allal.chaib@hotmail.fr', '789'),
(6, 'Alae Lahlou', 'alaelayhlow@gmail.es', 'goat01'),
(7, 'Eaque ullam voluptat', 'o@o.o', '123'),
(8, 'Saad CHAIB', 'saadchaib03@gmail.com', '789'),
(9, '', '', ''),
(10, '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `idU` (`idU`),
  ADD KEY `idC` (`idC`),
  ADD KEY `idP` (`idP`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idPaiement`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `numero` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idPaiement` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`idU`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factures_ibfk_2` FOREIGN KEY (`idC`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `factures_ibfk_3` FOREIGN KEY (`idP`) REFERENCES `paiement` (`idPaiement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
