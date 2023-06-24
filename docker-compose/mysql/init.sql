CREATE DATABASE construp_webhook_receiver;

USE construp_webhook_receiver;

DROP TABLE IF EXISTS `webhook_received`;

CREATE TABLE webhook_received(
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`construp_user_id` INT UNSIGNED NOT NULL,
	`tag` VARCHAR(50) NOT NULL,
	`order_id` INT UNSIGNED NOT NULL,
	`sent_from_url` VARCHAR(100) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);