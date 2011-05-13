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

CREATE TABLE `movico_student` (
	`studentId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	PRIMARY KEY (`studentId`)
);

CREATE TABLE `movico_teacher` (
	`teacherId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	PRIMARY KEY (`teacherId`)
);

CREATE TABLE `movico_boggle_hscore` (
	`hscoreId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`lang` VARCHAR(5) NOT NULL,
	`grid` VARCHAR(50) NOT NULL,
	`points` INTEGER NOT NULL,
	`playDate` DATETIME NOT NULL,
	PRIMARY KEY (`hscoreId`),
	KEY `IX_LANG` (`lang`)
);

CREATE TABLE `movico_bubble_hscore` (
	`hscoreId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`playDate` DATETIME NOT NULL,
	`seconds` INTEGER NOT NULL,
	PRIMARY KEY (`hscoreId`)
);

CREATE TABLE `movico_students_teachers` (
	`teacherId` INTEGER NOT NULL,
	`studentId` INTEGER NOT NULL,
	 PRIMARY KEY (`teacherId`,`studentId`)
);

