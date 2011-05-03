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
	`points` INTEGER NOT NULL,
	`playDate` DATETIME NOT NULL,
	PRIMARY KEY (`hscoreId`)
);

CREATE TABLE `boggle_game` (
	`gameId` INTEGER NOT NULL AUTO_INCREMENT,
	`started` TINYINT(1) NOT NULL,
	PRIMARY KEY (`gameId`),
	KEY `IX_STARTED` (`started`)
);

CREATE TABLE `boggle_player` (
	`playerId` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`gameId` INTEGER NOT NULL,
	PRIMARY KEY (`playerId`),
	UNIQUE KEY `IX_NAME` (`name`)
);

CREATE TABLE `boggle_guessed_word` (
	`wordId` INTEGER NOT NULL AUTO_INCREMENT,
	`word` VARCHAR(16) NOT NULL,
	`gameId` INTEGER NOT NULL,
	`playerId` INTEGER NOT NULL,
	PRIMARY KEY (`wordId`)
);

CREATE TABLE `movico_students_teachers` (
	`teacherId` INTEGER NOT NULL,
	`studentId` INTEGER NOT NULL,
	 PRIMARY KEY (`teacherId`,`studentId`)
);

