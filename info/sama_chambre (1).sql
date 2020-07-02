-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 juin 2020 à 17:06
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sama_chambre`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `login`, `pwd`, `tel`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '778900909', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Structure de la table `boursier`
--

CREATE TABLE `boursier` (
  `id` int(11) NOT NULL,
  `ishoused` varchar(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_type_bourse` int(11) NOT NULL,
  `id_chambre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boursier`
--

INSERT INTO `boursier` (`id`, `ishoused`, `id_etudiant`, `id_type_bourse`, `id_chambre`) VALUES
(29, 'oui', 67, 2, 2),
(30, 'oui', 68, 2, 4),
(31, 'oui', 70, 2, 3),
(32, 'non', 72, 2, NULL),
(33, 'non', 73, 1, NULL),
(34, 'oui', 74, 1, 3),
(35, 'oui', 75, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `id` int(11) NOT NULL,
  `numeroChambre` varchar(50) NOT NULL,
  `numeroBatiment` varchar(50) NOT NULL,
  `id_type_chambre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `numeroChambre`, `numeroBatiment`, `id_type_chambre`) VALUES
(1, '0024952', '2', 1),
(3, '0011567', '2', 1),
(4, '0234230', '23', 1),
(6, '0000', '01', 2);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `email`, `tel`, `matricule`, `dateNaissance`) VALUES
(67, 'Sognane', 'Djiby', 'Sognane', '780196884', '0SOSO\r\nDJ\r\n4296', '2020-06-05'),
(68, 'Niang', 'Pape Ibnaliou', 'Niang', '771452367', '2020NI\r\nPA\r\n1134', '2020-06-10'),
(70, 'Sognane', 'Djiber', 'djiber@gmail.com', '781234567', '2020SO\r\nDJ\r\n5251', '2020-06-03'),
(71, 'Coulibaly', 'Sountou', 'Sountou@gmail.com', '773033928', '2020CO\r\nSO\r\n3582', '2020-06-02'),
(73, 'Niang', 'Mamadou', 'niang@gmail.com', '774563425', '2020NI\r\nMA\r\n4294', '2020-06-02');

-- --------------------------------------------------------

--
-- Structure de la table `non_boursier`
--

CREATE TABLE `non_boursier` (
  `id` int(11) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `non_boursier`
--

INSERT INTO `non_boursier` (`id`, `adresse`, `id_etudiant`) VALUES
(8, 'Ndiaréme Limamoulaye', 69),
(9, 'France', 71);

-- --------------------------------------------------------

--
-- Structure de la table `type_bourse`
--

CREATE TABLE `type_bourse` (
  `id` int(11) NOT NULL,
  `libele` varchar(50) NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_bourse`
--

INSERT INTO `type_bourse` (`id`, `libele`, `montant`) VALUES
(1, 'demi-bourse', 20000),
(2, 'pension', 40000);

-- --------------------------------------------------------

--
-- Structure de la table `type_chambre`
--

CREATE TABLE `type_chambre` (
  `id` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_chambre`
--

INSERT INTO `type_chambre` (`id`, `categorie`) VALUES
(1, 'individuel'),
(2, 'binome');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boursier`
--
ALTER TABLE `boursier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `non_boursier`
--
ALTER TABLE `non_boursier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_bourse`
--
ALTER TABLE `type_bourse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `boursier`
--
ALTER TABLE `boursier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `non_boursier`
--
ALTER TABLE `non_boursier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `type_bourse`
--
ALTER TABLE `type_bourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
