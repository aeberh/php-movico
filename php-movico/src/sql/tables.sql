CREATE TABLE `movico_user` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(25) NOT NULL,
	`lastName` VARCHAR(25) NOT NULL,
	`createDate` DATETIME NOT NULL,
	`default` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `movico_team` (
	`teamId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	PRIMARY KEY (`teamId`)
);

CREATE TABLE `movico_player` (
	`playerId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`teamId` INTEGER NOT NULL,
	PRIMARY KEY (`playerId`)
);

