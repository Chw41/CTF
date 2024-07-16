SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci';

DROP DATABASE IF EXISTS web;
CREATE DATABASE IF NOT EXISTS web CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

USE web;

CREATE TABLE IF NOT EXISTS `urls` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `url` TEXT NOT NULL,
    `user_id` VARCHAR(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(30) NOT NULL,
    `password` VARCHAR(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

REVOKE ALL ON *.* FROM web_user;
REVOKE ALL ON web.* FROM web_user;
GRANT SELECT ON web.* TO web_user;
GRANT INSERT ON web.* TO web_user;
GRANT DELETE ON web.* TO web_user;