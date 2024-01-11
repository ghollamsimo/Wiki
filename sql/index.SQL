-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 jan. 2024 à 03:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wiki`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
                            `idcategory` int(11) NOT NULL,
                            `namecategory` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`idcategory`, `namecategory`) VALUES
                                                          (9, '1234'),
                                                          (10, 'kokab');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
                       `idtag` int(11) NOT NULL,
                       `nametag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`idtag`, `nametag`) VALUES
    (12, 'aaaawwwww');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
                         `iduser` int(11) NOT NULL,
                         `Nom` varchar(30) DEFAULT NULL,
                         `Email` varchar(40) DEFAULT NULL,
                         `password` varchar(200) DEFAULT NULL,
                         `image` varchar(30) DEFAULT NULL,
                         `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`iduser`, `Nom`, `Email`, `password`, `image`, `role`) VALUES
                                                                                (85, 'Admin', 'admin@youcode.ma', '$2y$10$x55BmoVWmE4OIayboUgN6OQ9phpKIHK1qHCAcQQOIjqwbTQ6eXRRe', NULL, 'Admin'),
                                                                                (86, 'GhollamSimo', 'ghollamsimo1@gmail.com', '$2y$10$nppP9ySBQmX0i4RE7szDJ.JjdaijbFjC/Kfe.ZUxCtBHBoRIbs3S.', NULL, 'Auteur');

-- --------------------------------------------------------

--
-- Structure de la table `wiki`
--

CREATE TABLE `wiki` (
                        `idwiki` int(11) NOT NULL,
                        `Title` varchar(30) DEFAULT NULL,
                        `Descreption` varchar(700) DEFAULT NULL,
                        `image` varchar(30) DEFAULT NULL,
                        `ladate` date DEFAULT current_timestamp(),
                        `etat` varchar(20) DEFAULT NULL,
                        `idcategory` int(11) DEFAULT NULL,
                        `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wiki`
--

INSERT INTO `wiki` (`idwiki`, `Title`, `Descreption`, `image`, `ladate`, `etat`, `idcategory`, `iduser`) VALUES
                                                                                                             (1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'path1', '2024-01-03', 'Archiver', NULL, NULL),
                                                                                                             (2, 'Lorem ipsum dolor sit amet 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'path2', '2024-01-03', 'Archiver', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wiki_tag`
--

CREATE TABLE `wiki_tag` (
                            `idtag` int(11) DEFAULT NULL,
                            `idwiki` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`idcategory`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
    ADD PRIMARY KEY (`idtag`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`iduser`);

--
-- Index pour la table `wiki`
--
ALTER TABLE `wiki`
    ADD PRIMARY KEY (`idwiki`),
  ADD KEY `fk_user` (`iduser`),
  ADD KEY `Fk_idcategory` (`idcategory`);

--
-- Index pour la table `wiki_tag`
--
ALTER TABLE `wiki_tag`
    ADD KEY `idtag` (`idtag`),
  ADD KEY `idwiki` (`idwiki`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
    MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
    MODIFY `idtag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
    MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `wiki`
--
ALTER TABLE `wiki`
    MODIFY `idwiki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wiki`
--
ALTER TABLE `wiki`
    ADD CONSTRAINT `Fk_idcategory` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

--
-- Contraintes pour la table `wiki_tag`
--
ALTER TABLE `wiki_tag`
    ADD CONSTRAINT `wiki_tag_ibfk_1` FOREIGN KEY (`idtag`) REFERENCES `tag` (`idtag`),
  ADD CONSTRAINT `wiki_tag_ibfk_2` FOREIGN KEY (`idwiki`) REFERENCES `wiki` (`idwiki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
