CREATE TABLE `wishlist` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`list` TEXT NOT NULL,
	`updateDate` DATETIME NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `IX_NAME` (`name`)
);
