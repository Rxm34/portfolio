-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 18 avr. 2025 à 09:38
-- Version du serveur : 10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `IdArt` int(11) NOT NULL,
  `TitreArt` varchar(60) NOT NULL,
  `DateArt` datetime NOT NULL DEFAULT current_timestamp(),
  `ContenuArt` varchar(1024) NOT NULL,
  `IdMemb` varchar(50) NOT NULL,
  `IdRub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `IdCat` int(11) NOT NULL,
  `NomCat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IdCat`, `NomCat`) VALUES
(1, 'Matières Technologiques'),
(2, 'Matières Générales'),
(3, 'Niveaux');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `IdMemb` varchar(50) NOT NULL,
  `NomMemb` varchar(50) NOT NULL,
  `PrenomMemb` varchar(50) NOT NULL,
  `DateIns` datetime NOT NULL DEFAULT current_timestamp(),
  `MdpMemb` varchar(100) NOT NULL,
  `TypeMemb` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`IdMemb`, `NomMemb`, `PrenomMemb`, `DateIns`, `MdpMemb`, `TypeMemb`) VALUES
('remy.borde34@gmail.com', 'Borde', 'Remy', '2025-04-18 08:45:17', '$2y$10$sqcmmT3rop2aQHQr3O0JuO9KVQg6XT25eEQhLbDD6TKZlN5dVx9ym', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `IdRep` int(11) NOT NULL,
  `IdMemb` varchar(50) NOT NULL,
  `IdArt` int(11) NOT NULL,
  `DateRep` datetime NOT NULL DEFAULT current_timestamp(),
  `ContenuRep` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE `rubrique` (
  `IdRub` int(11) NOT NULL,
  `NomRub` varchar(100) NOT NULL,
  `DescRub` varchar(3000) NOT NULL,
  `IdCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `rubrique`
--

INSERT INTO `rubrique` (`IdRub`, `NomRub`, `DescRub`, `IdCat`) VALUES
(1, 'Bloc 1 - Support et mise à disposition des services numériques', 'Le développement des compétences de ce bloc apporte aux étudiants et aux apprentis une première initiation à l\'informatique d\'entreprise en ayant affaire à \r\nses différentes composantes : les utilisateurs, les équipements, les services réseaux et applicatifs. Plus prosaïquement, il s\'agit aussi de leur permettre de \r\nchoisir leur option (SISR ou SLAM) à l\'issue du premier semestre.\r\n', 1),
(2, 'Bloc 3 - Cybersécurité des services informatiques', 'Il s\'agit de former aux compétences permettant d\'appréhender les problématiques de sécurité pour intervenir efficacement dans un contexte fortement \r\nencadré réglementairement, notamment par le RGPD.', 1),
(3, 'Expression et communication en langue anglaise', 'L\'étude de l\'anglais contribue au développement des compétences professionnelles attendues de la \r\npersonne titulaire du BTS Services informatiques aux organisations : elle est amenée à mobiliser la \r\nlangue anglaise pour comprendre une documentation ou encore échanger avec des pairs du monde \r\nentier sur des problèmes techniques', 2),
(4, 'Mathématiques pour l’informatique', 'Le programme est conçu avec l’intention de permettre l’acquisition des bases mathématiques \r\nnécessaires à la compréhension et la maîtrise des finalités spécifiques du BTS Services informatiques \r\naux organisations et de démarches mathématiques et algorithmiques permettant d’en appréhender \r\nla pertinence et l’efficacité pour évoluer dans un environnement numérique.', 2),
(5, 'SIO 1', '', 3),
(6, 'SIO 2', '', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`IdArt`),
  ADD KEY `IdArt` (`IdArt`),
  ADD KEY `IdRub` (`IdRub`),
  ADD KEY `IdMemb` (`IdMemb`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IdCat`),
  ADD KEY `IdCat` (`IdCat`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`IdMemb`),
  ADD KEY `IdMemb` (`IdMemb`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`IdRep`),
  ADD KEY `IdMemb` (`IdMemb`),
  ADD KEY `IdArt` (`IdArt`);

--
-- Index pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`IdRub`),
  ADD KEY `IdCat` (`IdCat`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `IdArt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `IdRep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `rubrique`
--
ALTER TABLE `rubrique`
  MODIFY `IdRub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_art_memb` FOREIGN KEY (`IdMemb`) REFERENCES `membre` (`IdMemb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_art_rub` FOREIGN KEY (`IdRub`) REFERENCES `rubrique` (`IdRub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_rep_art` FOREIGN KEY (`IdArt`) REFERENCES `article` (`IdArt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rep_memb` FOREIGN KEY (`IdMemb`) REFERENCES `membre` (`IdMemb`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `fk_rub_cat` FOREIGN KEY (`IdCat`) REFERENCES `categorie` (`IdCat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
