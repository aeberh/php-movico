CREATE TABLE `User` (
	`id` INTEGER unsigned NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(25) NOT NULL,
	`lastName` VARCHAR(25) NOT NULL,
	`createDate` DATETIME NOT NULL,
	`default` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
);

