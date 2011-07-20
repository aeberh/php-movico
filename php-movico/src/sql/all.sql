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
	PRIMARY KEY (`clubId`),
	UNIQUE KEY `IX_NAME` (`name`)
);

CREATE TABLE `PingpongTeam` (
	`teamId` INTEGER NOT NULL AUTO_INCREMENT,
	`clubId` INTEGER NOT NULL,
	`teamNo` VARCHAR(1) NOT NULL,
	`recreation` TINYINT(1) NOT NULL,
	PRIMARY KEY (`teamId`),
	UNIQUE KEY `IX_CLUBANDTEAM` (`clubId`, `teamNo`, `recreation`)
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
	KEY `IX_BEFOREDATE` (`date`)
);

INSERT INTO `Account` (emailAddress, password) VALUES ('admin@jevota.be', 'admin123');

INSERT INTO `PingpongClub` (number, name) VALUES ('LK031', 'T.T.C. Jevota');