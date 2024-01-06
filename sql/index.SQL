-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : sam. 06 jan. 2024 à 23:20
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

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
                        `idrole` int(11) NOT NULL,
                        `Role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
                       `idtag` int(11) NOT NULL,
                       `nametag` varchar(30) DEFAULT NULL,
                       `idwiki` int(11) DEFAULT NULL,
                       `idcategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
                         `iduser` int(11) NOT NULL,
                         `Nom` varchar(30) DEFAULT NULL,
                         `Email` varchar(40) DEFAULT NULL,
                         `password` varchar(8) DEFAULT NULL,
                         `image` varchar(30) DEFAULT NULL,
                         `idrole` int(11) DEFAULT NULL,
                         `idwiki` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wiki`
--

CREATE TABLE `wiki` (
                        `idwiki` int(11) NOT NULL,
                        `Title` varchar(30) DEFAULT NULL,
                        `Descreption` varchar(255) DEFAULT NULL,
                        `image` varchar(30) DEFAULT NULL,
                        `ladate` date DEFAULT NULL,
                        `etat` varchar(20) DEFAULT NULL,
                        `idcategory` int(11) DEFAULT NULL,
                        `iduser` int(11) DEFAULT NULL
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
-- Index pour la table `role`
--
ALTER TABLE `role`
    ADD PRIMARY KEY (`idrole`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
    ADD PRIMARY KEY (`idtag`),
  ADD KEY `fk_tag` (`idwiki`),
  ADD KEY `fk_category` (`idcategory`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_role` (`idrole`),
  ADD KEY `fk_wiki` (`idwiki`);

--
-- Index pour la table `wiki`
--
ALTER TABLE `wiki`
    ADD PRIMARY KEY (`idwiki`),
  ADD KEY `fk_user` (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
    MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
    MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
    MODIFY `idtag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
    MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wiki`
--
ALTER TABLE `wiki`
    MODIFY `idwiki` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
    ADD CONSTRAINT `fk_category` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`),
  ADD CONSTRAINT `fk_tag` FOREIGN KEY (`idwiki`) REFERENCES `wiki` (`idwiki`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `fk_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`),
  ADD CONSTRAINT `fk_wiki` FOREIGN KEY (`idwiki`) REFERENCES `wiki` (`idwiki`);

--
-- Contraintes pour la table `wiki`
--
ALTER TABLE `wiki`
    ADD CONSTRAINT `fk_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
