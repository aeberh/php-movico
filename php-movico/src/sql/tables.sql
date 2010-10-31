CREATE TABLE `User` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(25) NOT NULL,
	`lastName` VARCHAR(25) NOT NULL,
	`createDate` DATETIME NOT NULL,
	`default` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Team` (
	`teamId` INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`teamId`)
);

CREATE TABLE `Player` (
	`playerId` INTEGER NOT NULL AUTO_INCREMENT,
	`teamId` INTEGER NOT NULL,
	PRIMARY KEY (`playerId`)
);
