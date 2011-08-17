CREATE TABLE `Account` (
	`accountId` INTEGER NOT NULL AUTO_INCREMENT,
	`emailAddress` VARCHAR(30) NOT NULL,
	`password` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`accountId`),
	UNIQUE KEY `IX_EMAILADDRESS` (`emailAddress`)
);

CREATE TABLE `News` (
	`newsId` INTEGER NOT NULL AUTO_INCREMENT,
	`date` DATETIME NOT NULL,
	`title` VARCHAR(30) NOT NULL,
	`content` VARCHAR(500) NOT NULL,
	`creatorId` INTEGER NOT NULL,
	PRIMARY KEY (`newsId`)
);

CREATE TABLE `PingpongPlayer` (
	`playerId` INTEGER NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(20) NOT NULL,
	`lastName` VARCHAR(30) NOT NULL,
	`street` VARCHAR(70) NOT NULL,
	`place` VARCHAR(30) NOT NULL,
	`memberNo` INTEGER NOT NULL,
	`startYear` INTEGER NOT NULL,
	`ranking` VARCHAR(2) NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	`emailAddress` VARCHAR(30) NOT NULL,
	`recreation` TINYINT(1) NOT NULL,
	`active` TINYINT(1) NOT NULL,
	PRIMARY KEY (`playerId`),
	KEY `IX_ACTIVE` (`active`)
);

CREATE TABLE `PingpongClub` (
	`clubId` INTEGER NOT NULL AUTO_INCREMENT,
	`number` VARCHAR(3) NOT NULL,
	`shortName` VARCHAR(20) NOT NULL,
	`name` VARCHAR(30) NOT NULL,
	`building` VARCHAR(30) NOT NULL,
	`street` VARCHAR(70) NOT NULL,
	`place` VARCHAR(30) NOT NULL,
	`distance` INTEGER NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`clubId`),
	UNIQUE KEY `IX_NAME` (`name`),
	UNIQUE KEY `IX_SHORTNAME` (`shortName`),
	UNIQUE KEY `IX_NUMBER` (`number`)
);

CREATE TABLE `PingpongTeam` (
	`teamId` INTEGER NOT NULL AUTO_INCREMENT,
	`clubId` INTEGER NOT NULL,
	`teamNo` VARCHAR(1) NOT NULL,
	`recreation` TINYINT(1) NOT NULL,
	PRIMARY KEY (`teamId`),
	UNIQUE KEY `IX_CLUBANDTEAM` (`clubId`, `teamNo`, `recreation`),
	KEY `IX_CLUB` (`clubId`)
);

CREATE TABLE `PingpongGame` (
	`gameId` INTEGER NOT NULL AUTO_INCREMENT,
	`date` DATETIME NOT NULL,
	`homeTeamId` INTEGER NOT NULL,
	`outTeamId` INTEGER NOT NULL,
	`homeTeamPts` INTEGER NOT NULL,
	`outTeamPts` INTEGER NOT NULL,
	`review` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`gameId`),
	KEY `IX_AFTERDATE` (`date`),
	KEY `IX_BEFOREDATE` (`date`),
	KEY `IX_HOMETEAM` (`homeTeamId`),
	KEY `IX_OUTTEAM` (`outTeamId`)
);

