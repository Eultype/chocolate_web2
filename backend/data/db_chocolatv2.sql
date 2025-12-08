-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 06 déc. 2025 à 18:02
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
-- Base de données : `db_chocolat`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_slug` varchar(105) NOT NULL,
  `category_desc` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_has_recipes`
--

CREATE TABLE `category_has_recipes` (
  `category_category_id` int(10) UNSIGNED NOT NULL,
  `recipes_recipes_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comments_id` int(10) UNSIGNED NOT NULL,
  `comment_sujet` varchar(120) DEFAULT NULL,
  `comment_message` varchar(500) NOT NULL,
  `comment_created_date` datetime DEFAULT current_timestamp(),
  `comment_is_published` tinyint(3) UNSIGNED DEFAULT 0,
  `users_users_id` int(10) UNSIGNED NOT NULL,
  `recipes_recipes_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredients_id` int(10) UNSIGNED NOT NULL,
  `ingredient_name` varchar(100) NOT NULL,
  `ingredient_slug` varchar(105) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredients_has_recipes`
--

CREATE TABLE `ingredients_has_recipes` (
  `ingredients_ingredients_id` int(10) UNSIGNED NOT NULL,
  `recipes_recipes_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `likes_id` int(10) UNSIGNED NOT NULL,
  `users_users_id` int(10) UNSIGNED NOT NULL,
  `recipes_recipes_id` int(10) UNSIGNED NOT NULL,
  `like_cote` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1 à 5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `recipes_id` int(10) UNSIGNED NOT NULL,
  `recipe_title` varchar(120) NOT NULL,
  `recipe_slug` varchar(125) NOT NULL,
  `recipe_desc` text NOT NULL,
  `recipe_img` varchar(45) DEFAULT NULL,
  `recipe_cook_time` int(10) UNSIGNED NOT NULL,
  `recipe_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `users_users_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`recipes_id`, `recipe_title`, `recipe_slug`, `recipe_desc`, `recipe_img`, `recipe_cook_time`, `recipe_created_date`, `users_users_id`) VALUES
(1, 'Tiramisu au chocolat', 'tiramisu-au-chocolat', 'Ce Tiramisu au Chocolat est un pur délice de l\'Italie. Il marie la douceur onctueuse d\'une crème Mascarpone aérée et le moelleux de biscuits imbibés de café intense. Le tout est généreusement parsemé de copeaux de chocolat noir croquants et nappé d\'une sauce chocolat fondante. Un dessert riche, crémeux et intensément cacaoté pour une satisfaction immédiate.', 'tiramisu_chocolat_blur2.png', 30, '2025-12-06 15:55:14', 1),
(2, 'Cannoli au chocolat', 'cannoli-au-chocolat', 'Les cannoli sont une spécialité sicilienne emblématique : des coques de pâte fine, frites pour devenir parfaitement croustillantes, puis garnies d’une crème de ricotta douce et veloutée. Les pépites de chocolat apportent une touche gourmande, tandis que le zeste d’orange parfume le tout d’une fraîcheur méditerranéenne. Une alliance simple, authentique et irrésistible.', 'cannoli_chocolat.png', 60, '2025-12-06 16:39:36', 1),
(3, 'Brownies au chocolat ultra fondants', 'brownies-au-chocolat-ultra-fondants', 'Riche, décadent et incroyablement fondant — ces brownies sont le rêve de tout amateur de chocolat.', 'brownies_hero.jpg', 30, '2025-12-06 16:52:54', 3),
(4, 'Mousse au Chocolat au Lait Aérien', 'mousse-au-chocolat-au-lait-aerien', 'Une texture légère et mousseuse qui fond en bouche, avec une douceur équilibrée par la richesse du chocolat au lait. Parfait pour une fin de repas gourmande ou une pause sucrée.', 'mousse-au-chocolat-au-lait-aerien.jpg', 30, '2025-12-06 17:00:34', 6),
(5, 'Fondant Coeur Coulant', 'fondant-coeur-coulant', 'Le dessert qui fait fondre tout le monde. Un extérieur croustillant, un cœur ultra coulant… prêt en 25 minutes seulement.', 'fondant-coeur-coulant.webp', 25, '2025-12-06 17:04:12', 6),
(6, 'Fondant au Chocolat coeur coulant\r\n', 'fondant-daniel\r\n', 'Une recette pensée comme une tablette de bonheur : croûte fine, intérieur dense et velouté, parfum de cacao qui reste longtemps. On vise un fondant \"bistrot chic\"… mais faisable en 25 minutes.', NULL, 25, '2025-12-06 17:28:13', 7),
(7, 'Gâteau praliné chocolat-noisette', 'gateau-praline-chocolat-noisette', 'Un délicieux gâteau au chocolat praline chocolat noisette', 'gateauPralineChocolatNoisette.jpg', 30, '2025-12-06 17:34:43', 5),
(8, 'Mousse au chocolat', 'mousse-au-chocolat', 'Une mousse au chocolat, c’est un peu comme un bon design : minimaliste, mais chaque détail compte. Trois ingrédients, quelques gestes précis, et la magie opère. Cette recette, c’est celle que je fais quand j’ai besoin de plonger dans quelque chose de plus… sensoriel.', 'image2.jpg', 20, '2025-12-06 17:44:35', 4),
(9, 'Les brownies de ma grand-mère', 'les-brownies-de-ma-grand-mere', 'Il y a des recettes qui ressemblent à des souvenirs. Ce brownie granulé de ma grand-mère, c’est exactement ça : un dessert qui fait du bruit quand on croque dedans, qui sent le chocolat chaud dans toute la cuisine et qui a ce petit côté imparfait… mais terriblement rassurant.', 'image3.png', 15, '2025-12-06 17:48:43', 4),
(10, 'Recettes 2 JM ', 'recette2-JM', '...............', NULL, 10, '2025-12-06 17:56:24', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_mail` varchar(120) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `user_name`, `user_mail`, `user_pwd`, `user_role`) VALUES
(1, 'Samuel', 'Sdarryy59@gmail.com', '$2y$10$zDCc2kr5tC5qejPBXidDperucazDuBeLrz3cJAAPAakfMSTv7YnQC', 'user'),
(3, 'Reda', 'reda@gmail.com', '$2a$12$Hh71OrvSPqv9kiB1Q3qEHOaaX.3bjQM9B.y0NKgNI5AHZT/OyZyZG', 'user'),
(4, 'Sola', 'Sola@gmail.com', '$2a$12$Hh71OrvSPqv9kiB1Q3qEHOaaX.3bjQM9B.y0NKgNI5AHZT/OyZyZG', 'user'),
(5, 'akaJM', 'JM@gmail.com', '$2a$12$Hh71OrvSPqv9kiB1Q3qEHOaaX.3bjQM9B.y0NKgNI5AHZT/OyZyZG', 'user'),
(6, 'Mykyta', 'mykyta@gmail.com', '$2a$12$Hh71OrvSPqv9kiB1Q3qEHOaaX.3bjQM9B.y0NKgNI5AHZT/OyZyZG', 'user'),
(7, 'Daniel', 'daniel@gmail.com', '$2a$12$Hh71OrvSPqv9kiB1Q3qEHOaaX.3bjQM9B.y0NKgNI5AHZT/OyZyZG', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_slug_UNIQUE` (`category_slug`);

--
-- Index pour la table `category_has_recipes`
--
ALTER TABLE `category_has_recipes`
  ADD PRIMARY KEY (`category_category_id`,`recipes_recipes_id`),
  ADD KEY `fk_category_has_recipes_recipes1_idx` (`recipes_recipes_id`),
  ADD KEY `fk_category_has_recipes_category1_idx` (`category_category_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comments_id`),
  ADD KEY `fk_comments_users1_idx` (`users_users_id`),
  ADD KEY `fk_comments_recipes1_idx` (`recipes_recipes_id`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredients_id`),
  ADD UNIQUE KEY `ingredient_slug_UNIQUE` (`ingredient_slug`);

--
-- Index pour la table `ingredients_has_recipes`
--
ALTER TABLE `ingredients_has_recipes`
  ADD PRIMARY KEY (`ingredients_ingredients_id`,`recipes_recipes_id`),
  ADD KEY `fk_ingredients_has_recipes_recipes1_idx` (`recipes_recipes_id`),
  ADD KEY `fk_ingredients_has_recipes_ingredients1_idx` (`ingredients_ingredients_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes_id`),
  ADD KEY `fk_likes_users1_idx` (`users_users_id`),
  ADD KEY `fk_likes_recipes1_idx` (`recipes_recipes_id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipes_id`),
  ADD UNIQUE KEY `recipe_slug_UNIQUE` (`recipe_slug`),
  ADD KEY `fk_recipes_users_idx` (`users_users_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  ADD UNIQUE KEY `user_mail_UNIQUE` (`user_mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comments_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredients_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `likes_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipes_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category_has_recipes`
--
ALTER TABLE `category_has_recipes`
  ADD CONSTRAINT `fk_category_has_recipes_category1` FOREIGN KEY (`category_category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_has_recipes_recipes1` FOREIGN KEY (`recipes_recipes_id`) REFERENCES `recipes` (`recipes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_recipes1` FOREIGN KEY (`recipes_recipes_id`) REFERENCES `recipes` (`recipes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ingredients_has_recipes`
--
ALTER TABLE `ingredients_has_recipes`
  ADD CONSTRAINT `fk_ingredients_has_recipes_ingredients1` FOREIGN KEY (`ingredients_ingredients_id`) REFERENCES `ingredients` (`ingredients_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ingredients_has_recipes_recipes1` FOREIGN KEY (`recipes_recipes_id`) REFERENCES `recipes` (`recipes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_recipes1` FOREIGN KEY (`recipes_recipes_id`) REFERENCES `recipes` (`recipes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_likes_users1` FOREIGN KEY (`users_users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_users` FOREIGN KEY (`users_users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
