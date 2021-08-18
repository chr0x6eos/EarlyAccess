# Create users-Table:
CREATE TABLE `users` (`id` BIGINT unsigned NOT NULL auto_increment PRIMARY KEY, `name` varchar(255) NOT NULL, `email` varchar(255) NOT NULL, `password` varchar(255) NOT NULL, `role` varchar(255) NOT NULL default 'user', `key` varchar(255) NULL, `created_at` timestamp NULL, `updated_at` timestamp NULL) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
ALTER TABLE `users` add unique `users_email_unique`(`email`);

# Create sessions-TABLE:
CREATE TABLE `sessions` (`id` varchar(255) NOT NULL, `user_id` BIGINT unsigned NULL, `ip_address` varchar(45) NULL, `user_agent` text NULL, `payload` text NOT NULL, `last_activity` int NOT NULL) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
ALTER TABLE `sessions` add PRIMARY KEY `sessions_id_PRIMARY`(`id`);
ALTER TABLE `sessions` add index `sessions_user_id_index`(`user_id`);
ALTER TABLE `sessions` add index `sessions_last_activity_index`(`last_activity`);

# Create messages-TABLE:
CREATE TABLE `messages` (`id` BIGINT unsigned NOT NULL auto_increment PRIMARY KEY, `subject` varchar(255) NOT NULL, `body` varchar(255) NOT NULL, `recipient_id` BIGINT unsigned NOT NULL, `sender_id` BIGINT unsigned NOT NULL, `read` tinyint(1) NOT NULL default '0', `created_at` timestamp NULL, `updated_at` timestamp NULL) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
ALTER TABLE `messages` add constraint `messages_recipient_id_FOREIGN` FOREIGN KEY (`recipient_id`) references `users` (`id`);
ALTER TABLE `messages` add constraint `messages_sender_id_FOREIGN` FOREIGN KEY (`sender_id`) references `users` (`id`);

# Create scoreboard-TABLE:
CREATE TABLE `scoreboard` (`id` BIGINT unsigned NOT NULL auto_increment PRIMARY KEY, `score` int unsigned NOT NULL, `user_id` BIGINT unsigned NOT NULL, `time` timestamp default CURRENT_TIMESTAMP NOT NULL) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
ALTER TABLE `scoreboard` add constraint `scoreboard_user_id_FOREIGN` FOREIGN KEY (`user_id`) references `users` (`id`);

# Create failed_logins-TABLE:
CREATE TABLE `failed_logins` (`id` BIGINT unsigned NOT NULL auto_increment PRIMARY KEY, `IP` BIGINT NOT NULL, `time` timestamp default CURRENT_TIMESTAMP NOT NULL) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

# Create admin user:
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES ('admin', 'admin@earlyaccess.htb', '618292e936625aca8df61d5fff5c06837c49e491', 'admin');

# Create other users:
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('chr0x6eos', 'chr0x6eos@earlyaccess.htb', 'd997b2a79e4fc48183f59b2ce1cee9da18aa5476');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('firefart', 'firefart@earlyaccess.htb', '584204a0bbe5e392173d3dfdf63a322c83fe97cd');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('farbs', 'farbs@earlyaccess.htb', '290516b5f6ad161a86786178934ad5f933242361');

# Insert into scoreboard-Table:
INSERT INTO `scoreboard` (`score`, `user_id`, `time`) VALUES (82, 2, CURRENT_TIMESTAMP-1001);
INSERT INTO `scoreboard` (`score`, `user_id`, `time`) VALUES (54, 3, CURRENT_TIMESTAMP-808);
INSERT INTO `scoreboard` (`score`, `user_id`, `time`) VALUES (67, 4, CURRENT_TIMESTAMP-666);