# users-Table:
create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `password` varchar(255) not null, `role` varchar(255) not null default 'user', `key` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `users` add unique `users_email_unique`(`email`);

# sessions-table:
create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` text not null, `last_activity` int not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `sessions` add primary key `sessions_id_primary`(`id`);
alter table `sessions` add index `sessions_user_id_index`(`user_id`);
alter table `sessions` add index `sessions_last_activity_index`(`last_activity`);

# messages-table:
create table `messages` (`id` bigint unsigned not null auto_increment primary key, `subject` varchar(255) not null, `body` varchar(255) not null, `recipient_id` bigint unsigned not null, `sender_id` bigint unsigned not null, `read` tinyint(1) not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `messages` add constraint `messages_recipient_id_foreign` foreign key (`recipient_id`) references `users` (`id`);
alter table `messages` add constraint `messages_sender_id_foreign` foreign key (`sender_id`) references `users` (`id`);

# scoreboard-table:
create table `scoreboard` (`id` bigint unsigned not null auto_increment primary key, `score` int unsigned not null, `user_id` bigint unsigned not null, `time` timestamp default CURRENT_TIMESTAMP not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `scoreboard` add constraint `scoreboard_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

# failed_logins-table:
create table `failed_logins` (`id` bigint unsigned not null auto_increment primary key, `IP` bigint not null, `time` timestamp default CURRENT_TIMESTAMP not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';