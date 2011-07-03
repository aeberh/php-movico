CREATE TABLE `Account` (
	`accountId` INTEGER NOT NULL AUTO_INCREMENT,
	`emailAddress` VARCHAR(30) NOT NULL,
	`password` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`accountId`),
	UNIQUE KEY `IX_EMAILADDRESS` (`emailAddress`)
);

CREATE TABLE `PingpongClub` (
	`clubId` INTEGER NOT NULL AUTO_INCREMENT,
	`number` VARCHAR(10) NOT NULL,
	`name` VARCHAR(30) NOT NULL,
	`location` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`clubId`)
);

CREATE TABLE `PingpongTeam` (
	`teamId` INTEGER NOT NULL AUTO_INCREMENT,
	`team` VARCHAR(1) NOT NULL,
	`recreation` TINYINT(1) NOT NULL,
	PRIMARY KEY (`teamId`)
);

CREATE TABLE `PingpongMatch` (
	`matchId` INTEGER NOT NULL AUTO_INCREMENT,
	`date` DATETIME NOT NULL,
	`homeTeamId` INTEGER NOT NULL,
	`outTeamId` INTEGER NOT NULL,
	`homeTeamPoints` INTEGER NOT NULL,
	`outTeamPoints` INTEGER NOT NULL,
	`review` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`matchId`)
);

