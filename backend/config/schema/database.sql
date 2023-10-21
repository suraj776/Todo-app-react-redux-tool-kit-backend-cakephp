
DROP TABLE IF EXISTS `user`;
CREATE TABLE user (
    `id` int NOT NULL auto_increment,
    `name` varchar(255) NOT NULL CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `email` varchar(255) NOT NULL CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `password` varchar(255) NOT NULL CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `created_on` datetime NOT NULL,
    PRIMARY KEY (`id`),
    INDEX(`id`),
    INDEX(`name`),
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `daily_todo`;
CREATE TABLE user (
    `id` int NOT NULL auto_increment,
    `day` VARCHAR(15) Not NULL,
    `story` text NOT NULL CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    `saved` BOOLEAN,
    `user_id` varchar(255) NOT NULL,
    `created_on` datetime NOT NULL,
    PRIMARY KEY (`id`),
    INDEX(`day_id`),
    INDEX(`user_id`),
    key `fk_daily_todo_user_id`(`user_id`)
    CONSTRAINT `fk_daily_todo_user_id` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

