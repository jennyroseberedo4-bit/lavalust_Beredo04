-- LavaLust Laboratory Exercise 4 database export
-- Import this file in phpMyAdmin, MySQL Workbench, or the mysql CLI.


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password_hash` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (firstname, lastname, email, username)  
VALUES  
('Brianna', 'Cruzat', 'brianna@gmail.com', 'briannacruzat'),
('Jenny', 'Beredo', 'jenny@gmail.com', 'jennyberedo'),
('Krystal', 'Fabic', 'krystal@gmail.com', 'krystalfabic'),
('Adi', 'Dima', 'adi@gmail.com', 'adidima'),
('Jink', 'Macandili', 'jink@gmail.com', 'jinkmacandili'),
('Syl', 'Casten', 'syl@gmail.com', 'sylcasten'),
('Rosei', 'Estolano', 'rosei@gmail.com', 'roseiestolano'),
('Maria', 'Beredo', 'maria@gmail.com', 'mariaberedo');

SELECT * FROM `users` ORDER BY `id`;
