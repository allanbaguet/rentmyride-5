DROP TABLE IF EXISTS `rents`;
DROP TABLE IF EXISTS `vehicles`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients`(
   `id_clients` INT AUTO_INCREMENT,
   `lastname` VARCHAR(50)  NOT NULL,
   `firstname` VARCHAR(50)  NOT NULL,
   `email` VARCHAR(120)  NOT NULL,
   `birthday` DATE NOT NULL,
   `phone` VARCHAR(12)  NOT NULL,
   `city` VARCHAR(50)  NOT NULL,
   `zipcode` VARCHAR(5)  NOT NULL,
   `created_at` DATETIME NOT NULL,
   `updated_at` DATETIME NOT NULL,
   PRIMARY KEY(`id_clients`)
);

CREATE TABLE `categories`(
   `id_categories` INT AUTO_INCREMENT,
   `name` VARCHAR(50)  NOT NULL,
   PRIMARY KEY(`id_categories`)
);

CREATE TABLE `vehicles`(
   `id_vehicles` INT AUTO_INCREMENT,
   `brand` VARCHAR(50)  NOT NULL,
   `model` VARCHAR(50)  NOT NULL,
   `registration` VARCHAR(10)  NOT NULL,
   `mileage` INT NOT NULL,
   `picture` VARCHAR(50),
   `created_at` DATETIME NOT NULL,
   `updated_at` DATETIME NOT NULL,
   `deleted_at` DATETIME,
   `id_categories` INT NOT NULL,
   PRIMARY KEY(`id_vehicles`),
   FOREIGN KEY(`id_categories`) REFERENCES `categories`(`id_categories`)
);

CREATE TABLE `rents`(
   `id_rents` INT AUTO_INCREMENT,
   `startdate` DATETIME NOT NULL,
   `enddate` DATETIME NOT NULL,
   `created_at` DATETIME NOT NULL,
   `confirmed_at` DATETIME,
   `id_vehicles` INT,
   `id_clients` INT,
   PRIMARY KEY(`id_rents`),
   FOREIGN KEY(`id_vehicles`) REFERENCES `vehicles`(`id_vehicles`),
   FOREIGN KEY(`id_clients`) REFERENCES `clients`(`id_clients`)
);
