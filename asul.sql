-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 11 Octobre 2019 à 12:04
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.2.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `asul`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `fonction` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `identifiant`, `nom`, `prenom`, `mdp`, `fonction`) VALUES
(23, 'test', 'test', 'test', '$2y$10$/3UR1spEKS4Dj1dKuwsOUeDri5bznZ8dLP.SoS6v0e9.O0McykkWW', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

CREATE TABLE `autorisation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quitter_le_gymnase` varchar(255) DEFAULT NULL,
  `actes_medical` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `autorisation`
--

INSERT INTO `autorisation` (`id`, `user_id`, `quitter_le_gymnase`, `actes_medical`) VALUES
(62, 41, 'oui', 'non'),
(68, 47, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `dateinsc`
--

CREATE TABLE `dateinsc` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certificat medical` int(11) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id`, `name`) VALUES
(3, 'senior'),
(4, 'U11'),
(5, 'U13'),
(6, 'coucou');

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

CREATE TABLE `informations` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medical`
--

CREATE TABLE `medical` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `quality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `medical`
--

INSERT INTO `medical` (`id`, `user_id`, `firstname`, `lastname`, `phone_number`, `quality`) VALUES
(72, 41, '', '', '', ''),
(78, 47, '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nom_du_pere` varchar(255) DEFAULT NULL,
  `prenom_du_pere` varchar(255) DEFAULT NULL,
  `mail_du_pere` varchar(255) DEFAULT NULL,
  `profession_du_pere` varchar(255) DEFAULT NULL,
  `entreprise_du_pere` varchar(255) DEFAULT NULL,
  `nom_de_la_mere` varchar(255) DEFAULT NULL,
  `prenom_de_la_mere` varchar(255) DEFAULT NULL,
  `mail_de_la_mere` varchar(255) DEFAULT NULL,
  `profession_de_la_mere` varchar(255) DEFAULT NULL,
  `entreprise_de_la_mere` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parents`
--

INSERT INTO `parents` (`id`, `user_id`, `nom_du_pere`, `prenom_du_pere`, `mail_du_pere`, `profession_du_pere`, `entreprise_du_pere`, `nom_de_la_mere`, `prenom_de_la_mere`, `mail_de_la_mere`, `profession_de_la_mere`, `entreprise_de_la_mere`) VALUES
(62, 41, '', '', '', '', '', '', '', '', '', ''),
(68, 47, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) DEFAULT 'invalid',
  `firstname` varchar(255) DEFAULT 'invalid',
  `address` varchar(255) DEFAULT 'invalid',
  `postal_code` int(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT 'invalid',
  `sexe` varchar(8) DEFAULT 'invalid',
  `birthdate` date DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT 'invalid',
  `fix_number` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT 'invalid',
  `taille` int(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `address`, `postal_code`, `city`, `sexe`, `birthdate`, `categorie`, `phone_number`, `fix_number`, `mail`, `taille`) VALUES
(41, '', '', '243 chemin de la mouchonnierevvhjbf', 69700, 'saint jean de touslas', '', '0000-00-00', 'Sénior', '0652557816', '', 'quentin42.bonnet@laposte.net', 169),
(47, '', '', '', 0, '', '', '0000-00-00', 'Sénior', '', '', '', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autorisation`
--
ALTER TABLE `autorisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`user_id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_id` (`user_id`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `autorisation`
--
ALTER TABLE `autorisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `informations`
--
ALTER TABLE `informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `medical`
--
ALTER TABLE `medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT pour la table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `autorisation`
--
ALTER TABLE `autorisation`
  ADD CONSTRAINT `users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `doc_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medical`
--
ALTER TABLE `medical`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
