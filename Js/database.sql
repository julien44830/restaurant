-- Création de la base de données "restaurant"
CREATE DATABASE IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurant`;

-- Structure de la table `carte_menu`
CREATE TABLE IF NOT EXISTS `carte_menu` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `prix` double(11,2) NOT NULL,
  `categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Structure de la table `carte_plat`
CREATE TABLE IF NOT EXISTS `carte_plat` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `prix` double(11,2) NOT NULL,
  `image` varchar(250) NOT NULL,
  `categorie` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Structure de la table `horaires`
CREATE TABLE IF NOT EXISTS `horaires` (
  `id` int(6) UNSIGNED NOT NULL,
  `jour_de_la_semaine` varchar(20) NOT NULL,
  `heure_ouverture_midi` time DEFAULT NULL,
  `heure_fermeture_midi` time DEFAULT NULL,
  `heure_ouverture_soir` time DEFAULT NULL,
  `heure_fermeture_soir` time DEFAULT NULL,
  `ferme_midi` tinyint(1) DEFAULT 0,
  `ferme_soir` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Structure de la table `images`
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `legend` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Structure de la table `reservation`
CREATE TABLE IF NOT EXISTS `reservation` (
  `username` varchar(50) NOT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `tel` varchar(10) NOT NULL,
  `user_allergy` varchar(250) DEFAULT NULL,
  `nb_couverts` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `periode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Structure de la table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(10) NOT NULL

,
  `password` varchar(255) DEFAULT NULL,
  `nb_default_user` int(11) NOT NULL,
  `user_allergy` varchar(250) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Ajout des contraintes de clé primaire et étrangère
ALTER TABLE `carte_menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `carte_plat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

-- Attribution de l'auto-incrémentation
ALTER TABLE `carte_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `carte_plat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `horaires`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

-- Ajout des contraintes de clé étrangère
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`);

-- Fin du fichier d'alimentation de la base de données
