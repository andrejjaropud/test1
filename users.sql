CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(100) NOT NULL ,
  `country` ENUM('Hungary','Germany','Russia','Bulgaria','France','Ukraine','Austria') NOT NULL ,
  `firstname` VARCHAR(100) NOT NULL ,
  `lastname` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `zip` VARCHAR(6) NOT NULL ,
  `active` BOOLEAN NOT NULL DEFAULT TRUE ,
  `rate` INT NULL DEFAULT NULL ,
  `registred` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `registr_ind` (`registred`)
) ENGINE = InnoDB;
