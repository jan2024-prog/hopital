-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 19 jan. 2025 à 08:14
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_stock_hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcat` varchar(50) NOT NULL,
  `designation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idcat`, `designation`) VALUES
('Cat1', 'vitamine'),
('cat2', 'calma'),
('Cat3', 'Liquide'),
('Cat4', 'ComprimÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idclient` int(10) NOT NULL,
  `nomclient` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `tele` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nomclient`, `adresse`, `tele`) VALUES
(1, 'janvier', 'Butembo', 321548),
(2, 'CS kyondo', 'Kyondo', 356478);

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `identre` int(10) NOT NULL,
  `nomprod` varchar(100) DEFAULT NULL,
  `categ` varchar(10) DEFAULT NULL,
  `dateentre` date DEFAULT NULL,
  `dateperemp` date DEFAULT NULL,
  `pu` decimal(10,0) DEFAULT NULL,
  `quante` int(10) DEFAULT NULL,
  `numlot` varchar(100) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `unitee` varchar(100) NOT NULL,
  `forme` varchar(100) NOT NULL,
  `idprod` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`identre`, `nomprod`, `categ`, `dateentre`, `dateperemp`, `pu`, `quante`, `numlot`, `dosage`, `unitee`, `forme`, `idprod`) VALUES
(1, 'vitamine', 'Cat1', '2025-01-12', '2025-06-14', '20', 10, '', '500mg', 'Boite', 'comprime', 1),
(3, 'Quinine', 'Cat2', '2025-01-12', '2025-05-23', '40', 15, '', '600mg', 'Boite', 'Ampoule', 4),
(4, 'ParacÃ©tamol new', 'Cat2', '2025-01-14', '2025-02-14', '8', 18, '', '700mg', 'ampoule', 'Ampoule', 2),
(5, 'primus', 'Cat4', '2025-01-16', '2025-01-26', '3', 30, '', '600mg', 'Boite', 'comprime', 4),
(6, 'masika', 'Cat1', '2025-01-17', '2025-01-26', '6', 5, '', '700mg', 'Boite', 'Ampoule', 2);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idfourn` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `autre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idfourn`, `nom`, `autre`) VALUES
(1, 'masika', 'Notre partenaire');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idprod` int(10) NOT NULL,
  `nomprod` varchar(100) DEFAULT NULL,
  `idcat` varchar(50) DEFAULT NULL,
  `idfour` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idprod`, `nomprod`, `idcat`, `idfour`) VALUES
(1, 'VitamineC', 'Cat1', 0),
(2, 'paracetamole', 'cat2', 0),
(3, 'Amoxicilline', 'Cat4', 0),
(4, 'Quinine', 'Cat4', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `idsort` int(10) NOT NULL,
  `datesortie` date DEFAULT NULL,
  `pu` decimal(10,0) DEFAULT NULL,
  `quantevend` int(10) DEFAULT NULL,
  `nomprod` varchar(100) DEFAULT NULL,
  `categorie` varchar(100) NOT NULL,
  `idprod` int(10) DEFAULT NULL,
  `idclient` int(100) DEFAULT NULL,
  `numlot` varchar(100) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `unitee` varchar(100) NOT NULL,
  `forme` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`idsort`, `datesortie`, `pu`, `quantevend`, `nomprod`, `categorie`, `idprod`, `idclient`, `numlot`, `dosage`, `unitee`, `forme`) VALUES
(6, '2025-01-12', '2', 20, 'masika', '', 1, 1, '', '500mg', 'Boite', 'comprime'),
(7, '2025-01-12', '3', 10, 'vitamine', 'Cat1', 1, 1, '', '500mg', 'Boite', 'comprime'),
(8, '2025-01-14', '5', 600, 'ParacÃ©tamol new', 'Cat4', 2, 2, '', '500mg', 'Boite', 'comprime');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(200) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `fonct` varchar(200) NOT NULL,
  `motdepasse` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `fonct`, `motdepasse`) VALUES
(1, 'Bonane', 'Admin', '1234'),
(2, 'janvier', 'comptable', '1234'),
(4, 'soki', 'pharmacien', '1234'),
(5, 'kahindo', 'DG', '1234'),
(6, 'kasero', 'comptable', '1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`identre`),
  ADD KEY `fk_prod` (`idprod`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idfourn`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `fk_cat` (`idcat`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idsort`),
  ADD KEY `fk_client` (`idclient`),
  ADD KEY `fk_prds` (`idprod`);

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
  MODIFY `idclient` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `entree`
--
ALTER TABLE `entree`
  MODIFY `identre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idfourn` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idprod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idsort` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entree`
--
ALTER TABLE `entree`
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`idprod`) REFERENCES `produit` (`idprod`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`idcat`) REFERENCES `categorie` (`idcat`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `fk_prds` FOREIGN KEY (`idprod`) REFERENCES `produit` (`idprod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
