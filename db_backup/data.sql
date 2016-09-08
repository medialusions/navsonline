#
# TABLE STRUCTURE FOR: acl
#

CREATE TABLE `acl` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ai`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `acl_actions` (`action_id`) ON DELETE CASCADE,
  CONSTRAINT `acl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: acl_actions
#

CREATE TABLE `acl_actions` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `acl_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: acl_categories
#

CREATE TABLE `acl_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`),
  UNIQUE KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: arrangement
#

CREATE TABLE `arrangement` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `artist` mediumtext COLLATE utf16_unicode_ci NOT NULL,
  `default_key` mediumtext COLLATE utf16_unicode_ci NOT NULL,
  `bpm` mediumtext COLLATE utf16_unicode_ci NOT NULL,
  `length` int(16) NOT NULL,
  `lyrics` text COLLATE utf16_unicode_ci NOT NULL COMMENT 'Media lyrics ID',
  `audio` text COLLATE utf16_unicode_ci NOT NULL COMMENT 'From media table',
  `video` mediumtext COLLATE utf16_unicode_ci NOT NULL COMMENT 'Unique ID. Like YouTube ID.',
  `song` int(32) NOT NULL COMMENT 'ID from song table',
  `song_keys` text COLLATE utf16_unicode_ci NOT NULL COMMENT 'JSON with keys and media id',
  `organizations` mediumtext COLLATE utf16_unicode_ci NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('1', 'Citizens & Saints', 'G', '120', '205', '12', '', 'https://www.youtube.com/watch?v=YNnwtxNkwBI', '1', '[{\"key\":\"Open\",\"id\":\"13\"},{\"key\":\"G\",\"id\":\"13\"}]', '[\"1\"]', '1468366750', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('2', 'Kings Kaleidoscope', 'G', '120', '233', '16', '', 'https://www.youtube.com/watch?v=rxP45fCBdtw', '1', '[{\"key\":\"Open\",\"id\":\"15\"},{\"key\":\"G\",\"id\":\"15\"},{\"key\":\"D\",\"id\":\"14\"}]', '[\"1\"]', '1468367312', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('3', 'Hillsong Live', 'G', '', '0', '', '', 'https://www.youtube.com/watch?v=rSCE8uLuTJY', '2', '[{\"key\":\"G\",\"id\":\"17\"},{\"key\":\"Open\",\"id\":\"17\"}]', '[\"1\"]', '1468386899', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('14', 'Van Morrison', 'G', '', '183', '', '11', 'https://www.youtube.com/watch?v=TG8Ect3Xn7w', '25', '[]', '[\"1\"]', '1468560545', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('7', 'Bethel Music', 'A#', '', '376', '19', '', 'https://www.youtube.com/watch?v=XxkNj5hcy5E', '3', '[{\"key\":\"A#\",\"id\":\"18\"}]', '[\"1\"]', '1468484997', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('9', 'Hillsong Young & Free', 'A', '', '247', '21', '', 'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwjzoZDFyvLNAhUj7IMKHeESDEEQ3ywIHjAA&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dffr0pGkXPJg&usg=AFQjCNFSb3p1a2PyIDqFo7INsjn7NMrtuA&sig2=Zwd0ziK-iv6IqgSACrEfxQ&bvm=bv.127178174,d.amc', '4', '[{\"key\":\"Open\",\"id\":\"22\"},{\"key\":\"A\",\"id\":\"23\"},{\"key\":\"A#\",\"id\":\"20\"},{\"key\":\"G\",\"id\":\"22\"}]', '[\"1\"]', '1468486840', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('17', 'Citizens & Saints', 'C#', '', '0', '', '', '', '18', '[{\"key\":\"C#\",\"id\":\"24\"}]', '[\"1\"]', '1470887344', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('18', 'Kings Kaleidoscope', 'G', '130', '285', '', '', 'https://www.youtube.com/watch?v=aT3YJVkYPwU', '28', '[{\"key\":\"G\",\"id\":\"26\"},{\"key\":\"Open\",\"id\":\"26\"}]', '[\"1\"]', '1470888762', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('19', 'Hillsong United', 'C', '', '300', '', '', 'https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DA3O_pAOiGuo&h=AAQEO6Tqj', '10', '[{\"key\":\"C\",\"id\":\"27\"}]', '[\"1\"]', '1473179388', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('20', 'Phil Wickham', 'C', '', '300', '', '', 'https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DXFRjr_x-yxU&h=AAQEO6Tqj', '29', '[{\"key\":\"C\",\"id\":\"28\"}]', '[\"1\"]', '1473179491', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('21', 'All Sons and Daughters', 'C', '', '300', '', '', 'https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DuHz0w-HG4iU&h=AAQEO6Tqj', '20', '[{\"key\":\"C\",\"id\":\"29\"}]', '[\"1\"]', '1473179606', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('22', 'Kristene DiMarco', 'G', '', '300', '', '', 'https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DT0dIWJ4t4Jg&amp;h=AAQEO6Tqj', '30', '[{\"key\":\"Open\",\"id\":\"30\"},{\"key\":\"G\",\"id\":\"30\"}]', '[\"1\"]', '1473179696', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('23', 'Hillsong Live', 'C', '', '300', '', '', 'https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dau3EGgISYMc&h=AAQEO6Tqj', '31', '[{\"key\":\"C\",\"id\":\"31\"}]', '[\"1\"]', '1473179799', '647664095');


#
# TABLE STRUCTURE FOR: auth_sessions
#

CREATE TABLE `auth_sessions` (
  `id` varchar(40) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('5a1bcee684a2da9a4cd2a5a3ce5036d50b68ae7f', '185279332', '2016-09-07 09:05:34', '2016-09-07 10:35:48', '129.82.52.115', 'Chrome 50.0.2661.102 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('7f50d1da6b444dd9ef9ac5f4f2d0200d2d43630c', '185279332', '2016-09-06 23:46:55', '2016-09-07 00:24:34', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('88f605f3823e764032945ebd55e25525e4a916f0', '185279332', '2016-09-06 23:24:48', '2016-09-06 23:32:19', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('61cb59b068605030c392908a7657fde943465934', '185279332', '2016-09-06 21:29:00', '2016-09-06 21:38:18', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('2835d7df7cae50c3de3527a8ddab66d00b8a5282', '647664095', '2016-09-06 09:26:09', '2016-09-06 09:36:39', '24.9.123.104', 'Chrome 52.0.2743.116 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('a306ee83e5a18ac73b8a14f5eb0a9a0ff9a175c6', '185279332', '2016-09-01 11:40:31', '2016-09-01 11:40:31', '129.82.198.9', 'Chrome 52.0.2743.116 on Windows 7');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('383bef2a12860e5983d191ac2d16f6b5f5d2a1c5', '185279332', '2016-09-04 15:29:41', '2016-09-04 15:29:41', '207.86.122.114', 'Safari 601.1.46 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('f3dc44e1ec6218943074a5d031e3da60f370850c', '647664095', '2016-09-04 20:25:57', '2016-09-04 20:25:57', '70.196.198.28', 'Safari 601.1 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('662f3ae3cf3c30a32c11ffb6821d730406b5cd5d', '185279332', '2016-09-06 09:21:47', '2016-09-06 09:45:18', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('301c08eeda3bec09273a83c42a038e805748ecd2', '18156152', '2016-09-01 11:43:44', '2016-09-01 11:43:44', '129.82.198.9', 'Chrome 52.0.2743.116 on Windows 7');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('eb4677d077ae52797c6c41d164bef84c95b9971b', '185279332', '2016-08-31 21:46:53', '2016-08-31 22:34:40', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('cb29e258d9ac62d415e75c455062f66ab3c88c91', '185279332', '2016-08-31 21:33:32', '2016-08-31 22:34:15', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('a879795380a35d5d1fe38f1ba987f24251aa04d7', '185279332', '2016-09-04 08:49:19', '2016-09-04 08:49:19', '207.86.122.114', 'Safari 601.1.46 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('ceea3a8d5501d8e5a54dd33b5f3ede40f3bd3229', '185279332', '2016-09-02 13:43:17', '2016-09-02 13:43:17', '50.134.251.136', 'Safari 601.1.46 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('6585d9cc2ac3b05b74385deb5175ef86f5b3c0c3', '3663360872', '2016-09-02 11:15:53', '2016-09-02 11:15:53', '67.172.139.38', 'Chrome 52.0.2743.116 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('8b84ec323980342349c5e61b88f117d2460f6621', '185279332', '2016-09-02 08:48:15', '2016-09-02 08:48:15', '129.82.198.9', 'Chrome 52.0.2743.116 on Windows 7');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('99a137f68e9bde8262649436c3b6fca709eab1ce', '185279332', '2016-09-01 22:18:41', '2016-09-01 22:34:53', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('4ccc88b21ad0695f54147874f2adc7c67c9b217c', '185279332', '2016-09-07 20:12:52', '2016-09-07 21:57:25', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('f7a5dc6dc89060e881ed6f39db69f8dc0665ccc4', '185279332', '2016-09-07 20:15:14', '2016-09-07 21:51:21', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('e4d63e2070560743b8b12ff50f78f003734ca882', '185279332', '2016-09-07 22:02:53', '2016-09-07 22:02:54', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');


#
# TABLE STRUCTURE FOR: ci_sessions
#

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: communication_queue
#

CREATE TABLE `communication_queue` (
  `id` int(64) NOT NULL AUTO_INCREMENT COMMENT 'primary index',
  `type` text NOT NULL COMMENT 'event, etc',
  `user_id` int(64) NOT NULL COMMENT 'user id',
  `status` text NOT NULL COMMENT 'queued, dequeued',
  `pertanent_data` text NOT NULL COMMENT 'array or other',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp of dequeue',
  `created` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('6', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-06 23:58:41', '2016-09-06 23:58:28');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('5', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-06 23:48:08', '2016-09-06 23:47:35');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('7', 'event', '185279332', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 10:00:03', '2016-09-06 23:59:42');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('8', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 00:06:10', '2016-09-07 00:05:41');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('9', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 10:00:03', '2016-09-07 00:11:05');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('10', 'event', '185279332', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 00:33:01', '2016-09-07 00:12:05');


#
# TABLE STRUCTURE FOR: denied_access
#

CREATE TABLE `denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: event
#

CREATE TABLE `event` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `organization` int(32) NOT NULL,
  `date` int(32) NOT NULL,
  `users_matrix` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `roles_matrix` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('21', 'Nav Night - Week 4', '1', '1474077600', '{\"185279332\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\"]}', '1472706487', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('22', 'Nav Night - Week 3', '1', '1473472800', '{\"647664095\":{\"confirmed\":true},\"3663360872\":{\"confirmed\":true},\"185279332\":{\"confirmed\":true}}', '{\"647664095\":[\"band-leader\",\"guitar\",\"vox\"],\"3663360872\":[\"event-manager\"],\"185279332\":[\"electric-guitar\",\"co-leader\"]}', '1473179118', '185279332');


#
# TABLE STRUCTURE FOR: event_item
#

CREATE TABLE `event_item` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `event_id` int(32) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `memo` text CHARACTER SET latin1 NOT NULL,
  `start_time` int(32) NOT NULL,
  `arrangement_id` text COLLATE utf8_unicode_ci NOT NULL,
  `arrangement_key` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('74', '22', 'song', 'It Is Well - Kristene DiMarco', '', '1473476400', '22', 'G', '1473180042', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('73', '22', 'simple', 'Message', '', '1473474900', '', '', '1473179994', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('72', '22', 'song', 'Great Are You Lord - All Sons and Daughters', '', '1473474600', '21', 'C', '1473179977', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('70', '22', 'song', 'Relentless - Hillsong United', '', '1473474000', '19', 'C', '1473179946', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('68', '22', 'simple', 'Announcements', 'Emcee prays for worship band', '1473473700', '', '', '1473179865', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('71', '22', 'song', 'This is Amazing Grace - Phil Wickham', '', '1473474300', '20', 'C', '1473179963', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('66', '22', 'simple', 'Game', 'Name of game is...', '1473473400', '', '', '1473179834', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('65', '22', 'simple', 'Welcome', 'Emcees', '1473473100', '', '', '1473179810', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('64', '22', 'simple', 'Countdown', 'Emcees', '1473472500', '', '', '1473179777', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('63', '22', 'simple', 'Emcees Arrive', 'Their names are...', '1473469200', '', '', '1473179733', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('62', '22', 'simple', 'Pre Navs Meeting', '', '1473471900', '', '', '1473179652', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('61', '22', 'simple', 'Rehearsal', '', '1473467400', '', '', '1473179389', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('60', '22', 'simple', 'Setup', 'Clark A101', '1473465600', '', '', '1473179354', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('59', '22', 'simple', 'Pickup Gear', 'From Jecka\'s house. 1615 Underhill Dr #3.', '1473463800', '', '', '1473179323', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('58', '22', 'simple', 'Practice', 'Collin\'s house. 812 Myrtle St.', '1473386400', '', '', '1473179167', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('57', '20', 'simple', 'Practice', 'Collin\'s house. 812 Myrtle.', '1473386400', '', '', '1472794493', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('75', '22', 'song', 'Forever Reign - Hillsong Live', '', '1473476700', '23', 'C', '1473180060', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('76', '21', 'simple', 'Practice', 'Collin\'s', '1473991200', '', '', '1473264653', '185279332');


#
# TABLE STRUCTURE FOR: ips_on_hold
#

CREATE TABLE `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: login_errors
#

CREATE TABLE `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES ('53', 'cstover1996@comcast.net', '70.196.198.28', '2016-09-04 20:25:36');


#
# TABLE STRUCTURE FOR: media
#

CREATE TABLE `media` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `file_ext` text COLLATE utf8_unicode_ci NOT NULL,
  `file_size` double NOT NULL,
  `file_type` text COLLATE utf8_unicode_ci NOT NULL,
  `link_type` text CHARACTER SET latin1 NOT NULL,
  `link` text CHARACTER SET latin1 NOT NULL,
  `organizations` text CHARACTER SET latin1 NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('12', 'Be Thou My Vision - Citizens and Saints.pdf', '.pdf', '57.58', 'application/pdf', 'lyric', 'media/lyric/2f1b5dd8325b0445f5b5cc7a6b0e77fb.pdf', '[\"1\"]', '1468364593', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('11', '01 Brown Eyed Girl.mp3', '.mp3', '2714.79', 'audio/mpeg', 'audio', 'media/audio/ec839d3bccc5d6703abdde4afb8499dd.mp3', '[\"1\"]', '1468352081', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('10', 'Always Forever Chords by Phil Wickham @ Ultimate-Guitar.pdf', '.pdf', '77.1', 'application/pdf', 'lyric', 'media/lyric/8ebfeac2fe22de892774020422d53151.pdf', '[\"1\"]', '1468351272', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('8', 'All I Can Say - G.pdf', '.pdf', '84.33', 'application/pdf', 'chord', 'media/chord/4dbe398210b433227b2de6709a6c9deb.pdf', '[\"1\"]', '1468346145', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('9', 'All I Can Say - G.pdf', '.pdf', '84.33', 'application/pdf', 'chord', 'media/chord/205cba5cd5cd178a3c9eb1cd4868f261.pdf', '[\"1\"]', '1468347016', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('13', 'BeThouMyVision-C&S.pdf', '.pdf', '37.05', 'application/pdf', 'chord', 'media/chord/8b29e3d955611e3d62ecdcf554684861.pdf', '[\"1\"]', '1468364620', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('14', 'Be Thou My Vision Chords by Misc Praise Songs tabs - D.pdf', '.pdf', '52.84', 'application/pdf', 'chord', 'media/chord/28c354bf620048c617d8f5cc1084d460.pdf', '[\"1\"]', '1468367187', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('15', 'Be Thou My Vision Chords by Misc Praise Songs tabs - G.pdf', '.pdf', '52.68', 'application/pdf', 'chord', 'media/chord/27e09143874caf9fbf9b4eee02d6f445.pdf', '[\"1\"]', '1468367196', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('16', 'Be Thou My Vision Lyrics & Tabs by Kings Kaleidoscope.pdf', '.pdf', '74.51', 'application/pdf', 'lyric', 'media/lyric/6a5ad813dac02c18e3908ddc15d61a0c.pdf', '[\"1\"]', '1468367209', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('17', 'With-Everything.docx', '.docx', '73.76', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'chord', 'media/chord/ff27b21e76ca7563ad8334586458de22.docx', '[\"1\"]', '1468386839', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('18', 'No Longer Slaves - Bethel Music - F.pdf', '.pdf', '346.23', 'application/pdf', 'chord', 'media/chord/e8db1bc26ebe6446b1340ae5da640fe3.pdf', '[\"1\"]', '1468388695', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('19', 'No Longer Slaves - Bethel Music.pdf', '.pdf', '320.4', 'application/pdf', 'lyric', 'media/lyric/f2fabe626f517e6cc1e090cf0b45d4fc.pdf', '[\"1\"]', '1468388782', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('20', 'Sinking Deep Chords by Hillsongs - A#.pdf', '.pdf', '77.63', 'application/pdf', 'chord', 'media/chord/29609fd3ac8427e939ed25e1824c1316.pdf', '[\"1\"]', '1468486613', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('21', 'Sinking Deep.pdf', '.pdf', '29.06', 'application/pdf', 'lyric', 'media/lyric/882fa2af4eed6b74fce12cf3df52f101.pdf', '[\"1\"]', '1468486756', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('22', 'Sinking Deep Chords (ver 2) by Hillsongs  - G.pdf', '.pdf', '77.71', 'application/pdf', 'chord', 'media/chord/af79bbf04781a862bff655b1a0b7589f.pdf', '[\"1\"]', '1468486779', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('23', 'Sinking Deep Chords (ver 2) by Hillsongs  - A.pdf', '.pdf', '78.12', 'application/pdf', 'chord', 'media/chord/7800b16c56b3446f67d2719b2b2108c0.pdf', '[\"1\"]', '1468486785', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('24', 'In Tenderness.pdf', '.pdf', '38.19', 'application/pdf', 'chord', 'media/chord/24ecb8d2ab7b75ff68908e762eaa95e1.pdf', '[\"1\"]', '1470887118', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('25', 'In Tenderness.pdf', '.pdf', '38.19', 'application/pdf', 'chord', 'media/chord/e603cf7ec86d7b11fa029a041f4752e4.pdf', '[\"1\"]', '1470887293', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('26', 'In Christ Alone Kings Kaleidoscope in G (1).pdf', '.pdf', '34.81', 'application/pdf', 'chord', 'media/chord/c62dc38852822ef0d764c5cf4e15f5c3.pdf', '[\"1\"]', '1470888739', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('27', 'Relentless_C.pdf', '.pdf', '32.1', 'application/pdf', 'chord', 'media/chord/29051bbc72645d4e9a89a31276e6b700.pdf', '[\"1\"]', '1473179370', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('28', 'This is Amazing Grace.pdf', '.pdf', '35.03', 'application/pdf', 'chord', 'media/chord/8f2b2313902afa16e3fad4be8d7171a7.pdf', '[\"1\"]', '1473179484', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('29', 'Great Are You Lord.pdf', '.pdf', '32.59', 'application/pdf', 'chord', 'media/chord/86f8b821caa8e365df9972022b5b32bd.pdf', '[\"1\"]', '1473179575', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('30', 'It Is Well.pdf', '.pdf', '35.75', 'application/pdf', 'chord', 'media/chord/fcf06ad5de1a356ea7a9277a2e87c1e2.pdf', '[\"1\"]', '1473179676', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('31', 'Forever Reign.pdf', '.pdf', '35.04', 'application/pdf', 'chord', 'media/chord/e4c8fcf030c6ac4cc73f6d89aa300acf.pdf', '[\"1\"]', '1473179775', '647664095');


#
# TABLE STRUCTURE FOR: organization
#

CREATE TABLE `organization` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `location` text CHARACTER SET latin1 NOT NULL,
  `timezone` text CHARACTER SET latin1 NOT NULL,
  `date_created` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `organization` (`id`, `name`, `location`, `timezone`, `date_created`) VALUES ('1', 'Colorado State Navigators', 'Fort Collins, CO', 'America/Denver', '1467597716');


#
# TABLE STRUCTURE FOR: song
#

CREATE TABLE `song` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET latin1 NOT NULL,
  `tags` text CHARACTER SET latin1 NOT NULL,
  `organizations` text CHARACTER SET latin1 NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('1', 'Be Thou My Vision', '[\"Hymns\",\"Secular\",\"Staples\"]', '[\"1\"]', '1468291147', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('2', 'With Everything', '[\"Staples\",\"Slow\",\"Progressive\",\"Big\"]', '[\"1\"]', '1468375416', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('3', 'No Longer Slaves', '[\"Staples\",\"Progressive\",\"Freedom\"]', '[\"1\"]', '1468387904', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('4', 'Sinking Deep', '[\"Staples\",\"Progressive\",\"Spiritual\"]', '[\"1\"]', '1468486434', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('8', 'Freedom Is Here', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1468487150', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('6', 'Go', '[\"Staples\",\"Upbeat\",\"Fast\",\"Realease\"]', '[\"1\"]', '1468486993', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('7', 'Rhythms of Grace', '[\"Staples\",\"3\\/4\",\"Fast\",\"Spiritual\"]', '[\"1\"]', '1468487042', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('9', 'Lead Me To The Cross', '[\"Staples\",\"Slow\",\"Spiritual\",\"Female Lead\",\"Pretty\"]', '[\"1\"]', '1468487721', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('10', 'Relentless', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1468487780', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('11', 'Scandal of Grace', '[\"Staples\",\"Slow\",\"Spiritual\",\"Slow Build\"]', '[\"1\"]', '1468487822', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('12', 'Oceans (Where Feet May Fail)', '[\"Staples\",\"Slow\",\"Female Lead\",\"Spiritual\"]', '[\"1\"]', '1468487864', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('13', 'Praise Him', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1468487898', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('14', 'I Will Worship You', '[\"Staples\",\"Build\",\"Spiritual\"]', '[\"1\"]', '1468487930', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('15', 'My Savior My God', '[\"Staples\",\"Spiritual\"]', '[\"1\"]', '1468487974', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('16', 'My Hope Is In You', '[\"Staples\",\"Piano Lead\",\"Spiritual\"]', '[\"1\"]', '1468488013', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('17', 'Sweetness of Freedom', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1468488054', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('18', 'In Tenderness', '[\"Staples\",\"Progressive\",\"Powerful\"]', '[\"1\"]', '1468488111', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('19', 'All the Poor and Powerless', '[\"Staples\",\"Piano Lead\",\"Progressive\",\"Spiritual\"]', '[\"1\"]', '1468488166', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('20', 'Great Are You Lord', '[\"Staples\",\"Piano Lead\",\"Progressive\",\"Spiritual\"]', '[\"1\"]', '1468488209', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('25', 'Brown Eyed Girl', '[\"Secular\"]', '[\"1\"]', '1468560488', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('28', 'In Christ Alone', '[\"Hymns\",\"Powerful\"]', '[\"1\"]', '1470888096', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('29', 'This is Amazing Grace', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1473179444', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('30', 'It Is Well', '[\"Female Lead\",\"Big\",\"Build\",\"Piano Lead\",\"Powerful\"]', '[\"1\"]', '1473179641', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('31', 'Forever Reign', '[\"Powerful\",\"Staples\"]', '[\"1\"]', '1473179755', '647664095');


#
# TABLE STRUCTURE FOR: username_or_email_on_hold
#

CREATE TABLE `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `phone_to_confirm` varchar(16) NOT NULL,
  `phone_confirmation` varchar(6) NOT NULL,
  `phone_confirmation_date` datetime NOT NULL,
  `comm_preference` varchar(10) NOT NULL DEFAULT 'email',
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `organizations` text NOT NULL,
  `blockouts` text NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('185279332', 'zach', 'zach@medialusions.com', '3035490491', '', '', '2016-09-02 13:45:27', 'phone', 'Zach', 'Smith', '1,', '[]', '10', '0', '$2y$11$Lgvip1PHfINFx7yXUhJWu.5htbl7EV1JZNgx9ucOJZL27XW5noFG6', '$2y$11$q68J1u3eEmBuOaiL.HDoMOY93BmFpT2Vi8fV9112L0uqcMaAQUDoe', '2016-07-03 19:37:50', '2016-08-31 00:54:31', '2016-09-07 22:02:53', '2016-07-03 19:07:56', '2016-09-07 22:02:54');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('647664095', 'costover', 'cstover1996@comcast.net', '7203174206', '', '', '2016-09-04 20:27:18', 'phone', 'Collin', 'Stover', '1,', '[]', '9', '0', '$2y$10$b599cf5d32050960f471ausjJoosPpt3pUCAIgu8v5hO6G6HqlEbO', '$2y$10$4d1337aa25d2832f410ecuGav8wcv1nC1t7j1JlWCNrSx/X4gOIia', '2016-08-10 15:25:27', '2016-08-10 20:37:16', '2016-09-06 09:26:09', '2016-08-10 15:25:27', '2016-09-06 09:26:09');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('1355214819', NULL, 'zsmith812@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Zachary', 'Smith', '1,', '[]', '5', '0', '', '$2y$11$ng40Lo6feXNkya5htD71BuSwfFsy/HQVaOtgn9HZfBWRSnAObMrmC', '2016-09-06 23:25:20', NULL, NULL, '2016-09-06 23:25:20', '2016-09-06 23:25:21');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('3663360872', 'rkrammes', 'rkrammes1025@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Ryan', 'Krammes', '1,', '[]', '9', '0', '$2y$10$ed8f9ff6f50bdeeeb4531O4BXfklh9vyXbDTrUxp3BkqdoTNP7RBu', '', '0000-00-00 00:00:00', '2016-09-02 11:15:53', '2016-09-02 11:15:53', '2016-09-01 11:44:51', '2016-09-02 11:15:53');


