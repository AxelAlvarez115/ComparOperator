-- ============================================================
-- ComparOperator – Base de données complète
-- Version du serveur : MySQL 8.x / MariaDB
-- Exécutable directement dans phpMyAdmin
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- ------------------------------------------------------------
-- Création de la base (à décommenter si elle n'existe pas encore)
-- ------------------------------------------------------------
-- CREATE DATABASE IF NOT EXISTS `comparoperator`
--   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `comparoperator`;

-- ------------------------------------------------------------
-- Suppression des tables existantes (ordre inverse des FK)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `score`;
DROP TABLE IF EXISTS `review`;
DROP TABLE IF EXISTS `destination`;
DROP TABLE IF EXISTS `author`;
DROP TABLE IF EXISTS `tour_operator`;
DROP TABLE IF EXISTS `user`;

-- ============================================================
-- TABLE : tour_operator
-- ============================================================
CREATE TABLE `tour_operator` (
  `id`         INT            NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)   NOT NULL,
  `link`       VARCHAR(255)   NOT NULL,
  `is_premium` TINYINT(1)     NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tour_operator` (`id`, `name`, `link`, `is_premium`) VALUES
(1,  'James Ford',       'https://jamesford.travel',      1),
(2,  'Kate Austen',      'https://kateausten.travel',     1),
(3,  'John Locke',       'https://johnlocke.travel',      0),
(4,  'Jack Shephard',    'https://jackshephard.travel',   1),
(5,  'Benjamin Linus',   'https://benjaminlinus.travel',  0),
(6,  'Hurley Reyes',     'https://hurleyreyes.travel',    0),
(7,  'Sayid Jarrah',     'https://sayidjarrah.travel',    0),
(8,  'Bonus Miles',      'https://bonusmiles.travel',     0),
(9,  'Jacob Traveler',   'https://jacobtraveler.travel',  1),
(10, 'Claire Littleton', 'https://clairelittleton.travel',0);

-- ============================================================
-- TABLE : author
-- ============================================================
CREATE TABLE `author` (
  `id`   INT          NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Alice Martin'),
(2, 'Bob Johnson'),
(3, 'Claire Dupont'),
(4, 'David Smith'),
(5, 'Emma Wilson'),
(6, 'François Leblanc'),
(7, 'Grace Chen'),
(8, 'Hugo Martinez');

-- ============================================================
-- TABLE : destination
-- tour_operator_id = 0  → destination "vitrine" (page d'accueil)
-- tour_operator_id > 0  → offre d'un opérateur pour cette ville
-- ============================================================
CREATE TABLE `destination` (
  `id`               INT          NOT NULL AUTO_INCREMENT,
  `location`         VARCHAR(255) NOT NULL,
  `country`          VARCHAR(255) NOT NULL,
  `price`            INT          NOT NULL,
  `image`            VARCHAR(255) NOT NULL,
  `tour_operator_id` INT          NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_location`        (`location`),
  KEY `idx_tour_operator`   (`tour_operator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10 destinations vitrine (tour_operator_id = 0)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(1,  'New York',     'USA',       3000, 'new_york.webp',     0),
(2,  'Paris',        'France',    2800, 'paris.jpg',         0),
(3,  'London',       'UK',        3200, 'london.jpg',        0),
(4,  'Tokyo',        'Japan',     2500, 'tokyo.webp',        0),
(5,  'Bangkok',      'Thailand',  2300, 'bangkok.webp',      0),
(6,  'Istanbul',     'Turkey',    2100, 'istanbul.jpg',      0),
(7,  'Dubai',        'UAE',       2000, 'dubai.jpeg',        0),
(8,  'Kuala Lumpur', 'Malaysia',  2600, 'kuala_lumpur.jpg',  0),
(9,  'Barcelona',    'Spain',     2400, 'barcelona.jpg',     0),
(10, 'Las Vegas',    'USA',       2200, 'las_vegas.jpg',     0);

-- New York — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(11, 'New York', 'USA', 3100, 'new_york.webp',  1),  -- James Ford
(12, 'New York', 'USA', 2950, 'new_york.webp',  2),  -- Kate Austen
(13, 'New York', 'USA', 3250, 'new_york.webp',  4);  -- Jack Shephard

-- Paris — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(14, 'Paris', 'France', 1800, 'paris.jpg', 1),  -- James Ford
(15, 'Paris', 'France', 2100, 'paris.jpg', 6),  -- Hurley Reyes
(16, 'Paris', 'France', 1650, 'paris.jpg', 5);  -- Benjamin Linus

-- London — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(17, 'London', 'UK', 1300, 'london.jpg',  3),  -- John Locke
(18, 'London', 'UK', 1500, 'london.jpg',  7),  -- Sayid Jarrah
(19, 'London', 'UK', 1450, 'london.jpg', 10);  -- Claire Littleton

-- Tokyo — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(20, 'Tokyo', 'Japan', 2600, 'tokyo.webp',  4),  -- Jack Shephard
(21, 'Tokyo', 'Japan', 2400, 'tokyo.webp',  2),  -- Kate Austen
(22, 'Tokyo', 'Japan', 2750, 'tokyo.webp',  9);  -- Jacob Traveler

-- Bangkok — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(23, 'Bangkok', 'Thailand', 1900, 'bangkok.webp',  5),  -- Benjamin Linus
(24, 'Bangkok', 'Thailand', 2000, 'bangkok.webp',  6),  -- Hurley Reyes
(25, 'Bangkok', 'Thailand', 1750, 'bangkok.webp',  8);  -- Bonus Miles

-- Istanbul — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(26, 'Istanbul', 'Turkey', 1600, 'istanbul.jpg',  7),  -- Sayid Jarrah
(27, 'Istanbul', 'Turkey', 1800, 'istanbul.jpg',  1),  -- James Ford
(28, 'Istanbul', 'Turkey', 1550, 'istanbul.jpg',  3);  -- John Locke

-- Dubai — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(29, 'Dubai', 'UAE', 1900, 'dubai.jpeg', 10),  -- Claire Littleton
(30, 'Dubai', 'UAE', 2100, 'dubai.jpeg',  4),  -- Jack Shephard
(31, 'Dubai', 'UAE', 2200, 'dubai.jpeg',  2);  -- Kate Austen

-- Kuala Lumpur — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(32, 'Kuala Lumpur', 'Malaysia', 1800, 'kuala_lumpur.jpg',  9),  -- Jacob Traveler
(33, 'Kuala Lumpur', 'Malaysia', 2000, 'kuala_lumpur.jpg',  5),  -- Benjamin Linus
(34, 'Kuala Lumpur', 'Malaysia', 1950, 'kuala_lumpur.jpg',  6);  -- Hurley Reyes

-- Barcelona — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(35, 'Barcelona', 'Spain', 1600, 'barcelona.jpg',  8),  -- Bonus Miles
(36, 'Barcelona', 'Spain', 1700, 'barcelona.jpg',  1),  -- James Ford
(37, 'Barcelona', 'Spain', 1500, 'barcelona.jpg',  7);  -- Sayid Jarrah

-- Las Vegas — 3 opérateurs
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(38, 'Las Vegas', 'USA', 1900, 'las_vegas.jpg',  3),  -- John Locke
(39, 'Las Vegas', 'USA', 2000, 'las_vegas.jpg', 10),  -- Claire Littleton
(40, 'Las Vegas', 'USA', 2100, 'las_vegas.jpg',  4);  -- Jack Shephard

-- -------------------------------------------------------
-- 3 opérateurs supplémentaires par destination (IDs 41-70)
-- -------------------------------------------------------

-- New York (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(41, 'New York', 'USA', 2850, 'new_york.webp',  5),  -- Benjamin Linus
(42, 'New York', 'USA', 3150, 'new_york.webp',  6),  -- Hurley Reyes
(43, 'New York', 'USA', 2700, 'new_york.webp',  7);  -- Sayid Jarrah

-- Paris (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(44, 'Paris', 'France', 2200, 'paris.jpg',  2),  -- Kate Austen
(45, 'Paris', 'France', 1950, 'paris.jpg',  4),  -- Jack Shephard
(46, 'Paris', 'France', 2350, 'paris.jpg',  9);  -- Jacob Traveler

-- London (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(47, 'London', 'UK', 1600, 'london.jpg',  1),  -- James Ford
(48, 'London', 'UK', 1750, 'london.jpg',  4),  -- Jack Shephard
(49, 'London', 'UK', 1250, 'london.jpg',  8);  -- Bonus Miles

-- Tokyo (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(50, 'Tokyo', 'Japan', 2300, 'tokyo.webp',  3),  -- John Locke
(51, 'Tokyo', 'Japan', 2650, 'tokyo.webp',  6),  -- Hurley Reyes
(52, 'Tokyo', 'Japan', 2500, 'tokyo.webp',  7);  -- Sayid Jarrah

-- Bangkok (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(53, 'Bangkok', 'Thailand', 2100, 'bangkok.webp',  2),  -- Kate Austen
(54, 'Bangkok', 'Thailand', 1850, 'bangkok.webp',  7),  -- Sayid Jarrah
(55, 'Bangkok', 'Thailand', 2200, 'bangkok.webp',  9);  -- Jacob Traveler

-- Istanbul (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(56, 'Istanbul', 'Turkey', 1700, 'istanbul.jpg',  2),  -- Kate Austen
(57, 'Istanbul', 'Turkey', 1900, 'istanbul.jpg',  6),  -- Hurley Reyes
(58, 'Istanbul', 'Turkey', 2000, 'istanbul.jpg', 10);  -- Claire Littleton

-- Dubai (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(59, 'Dubai', 'UAE', 1850, 'dubai.jpeg',  3),  -- John Locke
(60, 'Dubai', 'UAE', 2050, 'dubai.jpeg',  7),  -- Sayid Jarrah
(61, 'Dubai', 'UAE', 2300, 'dubai.jpeg',  9);  -- Jacob Traveler

-- Kuala Lumpur (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(62, 'Kuala Lumpur', 'Malaysia', 2200, 'kuala_lumpur.jpg',  2),  -- Kate Austen
(63, 'Kuala Lumpur', 'Malaysia', 2500, 'kuala_lumpur.jpg',  4),  -- Jack Shephard
(64, 'Kuala Lumpur', 'Malaysia', 1900, 'kuala_lumpur.jpg',  7);  -- Sayid Jarrah

-- Barcelona (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(65, 'Barcelona', 'Spain', 1550, 'barcelona.jpg',  3),  -- John Locke
(66, 'Barcelona', 'Spain', 1750, 'barcelona.jpg',  5),  -- Benjamin Linus
(67, 'Barcelona', 'Spain', 1800, 'barcelona.jpg',  9);  -- Jacob Traveler

-- Las Vegas (+3)
INSERT INTO `destination` (`id`, `location`, `country`, `price`, `image`, `tour_operator_id`) VALUES
(68, 'Las Vegas', 'USA', 2050, 'las_vegas.jpg',  2),  -- Kate Austen
(69, 'Las Vegas', 'USA', 1950, 'las_vegas.jpg',  6),  -- Hurley Reyes
(70, 'Las Vegas', 'USA', 1750, 'las_vegas.jpg',  8);  -- Bonus Miles

-- ============================================================
-- TABLE : review
-- ============================================================
CREATE TABLE `review` (
  `id`               INT           NOT NULL AUTO_INCREMENT,
  `message`          VARCHAR(1000) NOT NULL,
  `grade`            INT           NULL,
  `tour_operator_id` INT           NOT NULL,
  `author_id`        INT           NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tour_operator` (`tour_operator_id`),
  KEY `idx_author`        (`author_id`),
  CONSTRAINT `fk_review_operator` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_review_author`   FOREIGN KEY (`author_id`)        REFERENCES `author`         (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `review` (`id`, `message`, `grade`, `tour_operator_id`, `author_id`) VALUES
-- James Ford (1) — moyenne 4.7
(1,  'Excellent service, James connaît chaque recoin de New York. Très pro et sympa.',       5, 1, 1),
(2,  'Super expérience à Paris grâce à James. Rapport qualité-prix imbattable.',             4, 1, 2),
(3,  'Guide attentionné, toujours à l\'écoute. Je recommande vivement James Ford Travel.',  5, 1, 7),

-- Kate Austen (2) — moyenne 4.5
(4,  'Kate a organisé notre séjour à Tokyo à la perfection. Zéro stress, tout était prévu.',5, 2, 4),
(5,  'Très bonne agence, itinéraire bien pensé et guide très cultivée.',                     4, 2, 5),

-- John Locke (3) — moyenne 3.7
(6,  'Surpris par la qualité du service. John Locke Travel a dépassé toutes nos attentes.', 4, 3, 6),
(7,  'Opérateur sérieux, communication claire et réactive. Très bon séjour à Londres.',     4, 3, 8),
(8,  'Bon rapport qualité-prix pour Las Vegas. Je rebookerai sans hésiter.',                3, 3, 1),

-- Jack Shephard (4) — moyenne 5.0
(9,  'Service d\'exception du début à la fin. Jack Shephard est un vrai professionnel.',    5, 4, 2),
(10, 'Tokyo avec Jack Shephard Travel : une expérience inoubliable. 10/10.',                5, 4, 3),

-- Benjamin Linus (5) — moyenne 4.5
(11, 'Itinéraire original et bien ficelé. Benjamin a un vrai sens du détail.',              4, 5, 4),
(12, 'Superbe voyage à Bangkok, tout était parfaitement coordonné. Merci Benjamin !',       5, 5, 5),

-- Hurley Reyes (6) — moyenne 4.5
(13, 'Hurley est trop cool, l\'ambiance était top tout le voyage. On a adoré Paris !',      5, 6, 6),
(14, 'Voyage plein de bonne humeur et bien organisé. Highly recommended.',                  4, 6, 7),

-- Sayid Jarrah (7) — moyenne 4.0
(15, 'Ponctuel, efficace et très bien organisé. Istanbul était magnifique.',                4, 7, 8),
(16, 'Service nickel, Sayid gère tout à la perfection. On a rien eu à faire.',              4, 7, 1),

-- Bonus Miles (8) — moyenne 3.0
(17, 'Bon opérateur pour les petits budgets. Barcelone à prix raisonnable, sans surprise.', 3, 8, 2),
(18, 'Correct, rien d\'extraordinaire mais le service était honnête et propre.',            3, 8, 3),

-- Jacob Traveler (9) — moyenne 4.5
(19, 'Expérience unique à Kuala Lumpur. Jacob a une façon de raconter l\'histoire locale.', 4, 9, 3),
(20, 'Très agréable, Jacob est passionné par ses destinations. Très inspirant !',           5, 9, 4),

-- Claire Littleton (10) — moyenne 4.5
(21, 'Claire nous a fait découvrir Dubai comme si on était des locaux. Magnifique.',        5, 10, 5),
(22, 'Super chaleureuse et très professionnelle. Le meilleur séjour à Las Vegas ever.',     4, 10, 6);

-- ============================================================
-- TABLE : score
-- Valeur de 1 à 5
-- ============================================================
CREATE TABLE `score` (
  `id`               INT NOT NULL AUTO_INCREMENT,
  `value`            INT NOT NULL CHECK (`value` BETWEEN 1 AND 5),
  `tour_operator_id` INT NOT NULL,
  `author_id`        INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_score` (`tour_operator_id`, `author_id`),
  KEY `idx_tour_operator` (`tour_operator_id`),
  KEY `idx_author`        (`author_id`),
  CONSTRAINT `fk_score_operator` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_score_author`   FOREIGN KEY (`author_id`)        REFERENCES `author`         (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `score` (`id`, `value`, `tour_operator_id`, `author_id`) VALUES
-- James Ford → moyenne 4.7
(1,  5, 1, 1),
(2,  4, 1, 2),
(3,  5, 1, 7),

-- Kate Austen → moyenne 4.5
(4,  5, 2, 4),
(5,  4, 2, 5),

-- John Locke → moyenne 3.7
(6,  4, 3, 6),
(7,  4, 3, 8),
(8,  3, 3, 1),

-- Jack Shephard → moyenne 5.0
(9,  5, 4, 2),
(10, 5, 4, 3),

-- Benjamin Linus → moyenne 4.5
(11, 4, 5, 4),
(12, 5, 5, 5),

-- Hurley Reyes → moyenne 4.5
(13, 5, 6, 6),
(14, 4, 6, 7),

-- Sayid Jarrah → moyenne 4.0
(15, 4, 7, 8),
(16, 4, 7, 1),

-- Bonus Miles → moyenne 3.0
(17, 3, 8, 2),
(18, 3, 8, 3),

-- Jacob Traveler → moyenne 4.5
(19, 4, 9, 3),
(20, 5, 9, 4),

-- Claire Littleton → moyenne 4.5
(21, 5, 10, 5),
(22, 4, 10, 6);

-- ============================================================
-- TABLE : user
-- Rôles : 'admin' | 'user'
-- Hash bcrypt générés avec PHP password_hash(..., PASSWORD_BCRYPT)
-- admin   → password: admin123
-- visiteur → password: user123
-- ============================================================
CREATE TABLE `user` (
  `id`         INT          NOT NULL AUTO_INCREMENT,
  `username`   VARCHAR(80)  NOT NULL,
  `email`      VARCHAR(255) NOT NULL,
  `password`   VARCHAR(255) NOT NULL,
  `role`       ENUM('admin','user') NOT NULL DEFAULT 'user',
  `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_username` (`username`),
  UNIQUE KEY `uq_email`    (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin',    'admin@comparoperator.com',    '$2y$12$/1oPDtz/7GNsB9ah8SSoreW3s.rkGNA7J/6Eob5qrsrs6INBIrw3u', 'admin'),
(2, 'visiteur', 'visiteur@comparoperator.com', '$2y$12$aKV2A490.wN8ZMSwJn2L/OHODuISG0h3keeQdmx8T2YzH9z7/85BK', 'user');

-- ============================================================
-- AUTO_INCREMENT : positionner après le dernier ID inséré
-- ============================================================
ALTER TABLE `tour_operator` AUTO_INCREMENT = 11;
ALTER TABLE `author`        AUTO_INCREMENT = 9;
ALTER TABLE `destination`   AUTO_INCREMENT = 71;
ALTER TABLE `review`        AUTO_INCREMENT = 23;
ALTER TABLE `score`         AUTO_INCREMENT = 23;
ALTER TABLE `user`          AUTO_INCREMENT = 3;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
