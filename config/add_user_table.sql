-- ============================================================
-- Ajout de la table `user` à la base existante `comparoperator`
-- À exécuter dans phpMyAdmin > onglet SQL
-- ============================================================

CREATE TABLE IF NOT EXISTS `user` (
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
