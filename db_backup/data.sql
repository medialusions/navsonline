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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

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
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('24', 'Jesus Culture', 'A', '', '0', '', '', 'https://www.youtube.com/watch?v=X_2qG22SPwU', '32', '[{\"key\":\"Open\",\"id\":\"32\"},{\"key\":\"G\",\"id\":\"32\"},{\"key\":\"A\",\"id\":\"39\"}]', '[\"1\"]', '1473975052', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('25', 'David Crowder Band', 'C', '', '0', '', '', 'https://www.youtube.com/watch?v=2FxaUYjRtkc', '33', '[{\"key\":\"Open\",\"id\":\"33\"},{\"key\":\"C\",\"id\":\"33\"}]', '[\"1\"]', '1473975563', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('26', 'Hillsong Live', 'E', '', '0', '', '', 'https://www.youtube.com/watch?v=jgsqfjRslzA', '34', '[{\"key\":\"E\",\"id\":\"34\"}]', '[\"1\"]', '1473975724', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('28', 'Misty Edwards', 'E', '', '0', '', '', 'https://www.youtube.com/watch?v=QFdeOT3lzqc', '35', '[{\"key\":\"E\",\"id\":\"35\"}]', '[\"1\"]', '1473975917', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('29', 'Kari Jobe', 'G', '', '0', '', '', 'https://www.youtube.com/watch?v=rGgX_oqdib4', '36', '[{\"key\":\"Open\",\"id\":\"38\"},{\"key\":\"G\",\"id\":\"38\"},{\"key\":\"F\",\"id\":\"36\"}]', '[\"1\"]', '1473976259', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('30', 'Dustin Kensrue', 'A#', '120', '300', '', '', 'https://www.youtube.com/watch?v=c8u0pGvb30U', '37', '[{\"key\":\"Open\",\"id\":\"40\"},{\"key\":\"G\",\"id\":\"40\"},{\"key\":\"A#\",\"id\":\"45\"}]', '[\"1\"]', '1474336863', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('31', 'Vertical Church Band', 'D', '120', '300', '', '', 'https://www.youtube.com/watch?v=eF9pVCDHN_4', '38', '[{\"key\":\"Open\",\"id\":\"41\"},{\"key\":\"C\",\"id\":\"41\"},{\"key\":\"D\",\"id\":\"46\"}]', '[\"1\"]', '1474336962', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('32', 'Matt Redman', 'G', '120', '300', '', '', 'https://www.youtube.com/watch?v=DXDGE_lRI0E', '39', '[{\"key\":\"Open\",\"id\":\"42\"},{\"key\":\"G\",\"id\":\"42\"}]', '[\"1\"]', '1474337071', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('33', 'Kari Jobe', 'G', '120', '300', '', '', 'https://www.youtube.com/watch?v=s6duzVn5M6E', '40', '[{\"key\":\"Open\",\"id\":\"43\"},{\"key\":\"G\",\"id\":\"43\"}]', '[\"1\"]', '1474337173', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('34', 'Hillsong', 'A', '120', '300', '', '', 'https://www.youtube.com/watch?v=kV5iZBTNYrk', '41', '[{\"key\":\"A\",\"id\":\"44\"}]', '[\"1\"]', '1474337323', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('36', 'Kari Jobe', 'F', '120', '300', '', '', 'https://www.youtube.com/watch?v=s6duzVn5M6E', '40', '[{\"key\":\"F\",\"id\":\"47\"}]', '[\"1\"]', '1474642126', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('37', 'Misc.', 'C', '120', '300', '', '', 'https://www.youtube.com/watch?v=ga4F87Y87Pc', '42', '[{\"key\":\"C\",\"id\":\"48\"}]', '[\"1\"]', '1474927827', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('38', 'Bethel Music', 'C', '120', '300', '', '', 'https://www.youtube.com/watch?v=ty1TesUnXVw', '43', '[{\"key\":\"C\",\"id\":\"49\"}]', '[\"1\"]', '1474928066', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('39', 'Bethel Music', 'G#', '120', '300', '', '', 'https://www.youtube.com/watch?v=6Hi-VMxT6fc', '44', '[{\"key\":\"G#\",\"id\":\"50\"},{\"key\":\"Open\",\"id\":\"51\"}]', '[\"1\"]', '1474928574', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('40', 'Hillsong United', 'G', '120', '300', '', '', 'https://www.youtube.com/watch?v=FBJJJkiRukY', '45', '[{\"key\":\"G\",\"id\":\"52\"}]', '[\"1\"]', '1474928934', '647664095');


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

INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('231bf7c0de429a948f9ce862bc244619a5fc4d28', '185279332', '2016-09-26 18:58:58', '2016-09-26 18:58:58', '50.134.251.136', 'Chrome 53.0.2785.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('cbc1a5d783a8a9d2a37cedc53798be48fb02d00d', '3223701345', '2016-09-26 19:00:18', '2016-09-26 19:00:18', '73.181.50.156', 'Safari 9537.53 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('1ea04249d049a354f4d26a2c0b7a0d05cc08fd3c', '2074895394', '2016-09-27 08:09:04', '2016-09-27 08:09:04', '75.71.82.209', 'Safari 601.7.7 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('5dd23c15b6ba2ac9e4340cf388f264784325e676', '2229189973', '2016-09-27 15:55:14', '2016-09-27 15:55:14', '129.19.62.203', 'Chrome 53.0.2785.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('4c4c386e649728a0b4a82b98562650b4d666cf9e', '2074895394', '2016-09-27 20:57:23', '2016-09-27 20:57:23', '75.71.82.209', 'Safari 601.7.7 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('44e2ce62366b36548c385d899451f5d7cab7fda0', '2074895394', '2016-09-26 16:30:22', '2016-09-26 18:13:59', '75.71.82.209', 'Safari 601.7.7 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('0f3b4c5b188090d89ca037666e6a6724aea494a0', '3223701345', '2016-09-26 16:06:39', '2016-09-26 16:06:39', '73.181.50.156', 'Safari 9537.53 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('e9e7afae0a59c3539260b540427b3660badfe271', '647664095', '2016-09-26 14:54:12', '2016-09-26 15:28:54', '24.9.123.104', 'Chrome 53.0.2785.116 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('a145fd14a0e77afbbaa1deddbc64728739f94309', '2074895394', '2016-09-26 14:28:17', '2016-09-26 14:28:17', '129.82.198.32', 'Safari 600.1.4 on iOS');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('6b7750ffa16c60bc794ff0a10dbc62c61004854e', '2074895394', '2016-09-25 13:58:27', '2016-09-25 13:58:27', '75.71.82.209', 'Safari 601.7.7 on Mac OS X');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('d9a753e2da720b5ec184b1849485db75cadbcd9e', '185279332', '2016-09-25 13:35:45', '2016-09-25 13:35:45', '129.82.53.208', 'Chrome 53.0.2785.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('1786c01f667397b310ab9c775cabc5eef796f689', '185279332', '2016-09-25 13:38:44', '2016-09-25 13:50:16', '10.0.0.9', 'Chrome 53.0.2785.116 on Windows 10');


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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('6', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-06 23:58:41', '2016-09-06 23:58:28');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('5', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-06 23:48:08', '2016-09-06 23:47:35');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('7', 'event', '185279332', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 10:00:03', '2016-09-06 23:59:42');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('8', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 00:06:10', '2016-09-07 00:05:41');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('9', 'event', '1355214819', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 10:00:03', '2016-09-07 00:11:05');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('10', 'event', '185279332', 'dequeued', '{\"eid\":\"22\"}', '2016-09-07 00:33:01', '2016-09-07 00:12:05');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('11', 'event', '1275491953', 'dequeued', '{\"eid\":\"22\"}', '2016-09-09 09:00:03', '2016-09-08 23:14:13');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('17', 'event', '185279332', 'dequeued', '{\"eid\":\"23\"}', '2016-09-20 09:00:02', '2016-09-19 19:10:46');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('13', 'event', '325570997', 'dequeued', '{\"eid\":\"22\"}', '2016-09-09 09:00:03', '2016-09-08 23:15:24');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('14', 'event', '570431960', 'dequeued', '{\"eid\":\"22\"}', '2016-09-09 09:00:03', '2016-09-08 23:16:21');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('16', 'event', '647664095', 'dequeued', '{\"eid\":\"21\"}', '2016-09-15 16:00:02', '2016-09-15 14:52:27');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('18', 'event', '1275491953', 'dequeued', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:11:11');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('19', 'event', '325570997', 'dequeued', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:11:29');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('20', 'event', '570431960', 'dequeued', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:11:59');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('21', 'event', '2147483647', 'error', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:12:18');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('22', 'event', '2147483647', 'error', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:12:52');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('23', 'event', '2147483647', 'error', '{\"eid\":\"23\"}', '2016-09-20 09:00:03', '2016-09-19 19:17:05');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('24', 'event', '647664095', 'dequeued', '{\"eid\":\"28\"}', '2016-09-26 16:00:04', '2016-09-26 14:55:44');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('25', 'event', '2147483647', 'error', '{\"eid\":\"28\"}', '2016-09-26 16:00:04', '2016-09-26 14:56:12');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('26', 'event', '2074895394', 'dequeued', '{\"eid\":\"28\"}', '2016-09-26 16:00:04', '2016-09-26 14:57:14');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('27', 'event', '2147483647', 'error', '{\"eid\":\"28\"}', '2016-09-26 16:00:04', '2016-09-26 14:57:31');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('28', 'event', '1275491953', 'dequeued', '{\"eid\":\"28\"}', '2016-09-26 16:00:04', '2016-09-26 14:57:44');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('29', 'event', '1102677379', 'dequeued', '{\"eid\":\"28\"}', '2016-09-26 16:00:05', '2016-09-26 14:58:00');
INSERT INTO `communication_queue` (`id`, `type`, `user_id`, `status`, `pertanent_data`, `updated`, `created`) VALUES ('30', 'event', '2147483647', 'error', '{\"eid\":\"28\"}', '2016-09-26 16:00:05', '2016-09-26 15:24:28');


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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('23', 'Nav Night - Week 5', '1', '1474682400', '{\"647664095\":{\"confirmed\":true},\"185279332\":{\"confirmed\":true},\"325570997\":{\"confirmed\":true},\"570431960\":{\"confirmed\":true},\"3946107201\":{\"confirmed\":true},\"2229189973\":{\"confirmed\":true},\"3663360872\":{\"confirmed\":true}}', '{\"647664095\":[\"band-leader\",\"vox\",\"guitar\"],\"185279332\":[\"co-leader\",\"electric-guitar\"],\"325570997\":[\"vox\"],\"570431960\":[\"vox\"],\"3946107201\":[\"acoustic-guitar\"],\"2229189973\":[\"drums\"],\"3663360872\":[\"event-manager\"]}', '1474336518', '647664095');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('21', 'Nav Night - Week 4', '1', '1474077600', '{\"185279332\":{\"confirmed\":true},\"647664095\":{\"confirmed\":true}}', '{\"185279332\":[\"co-leader\",\"electric-guitar\"],\"647664095\":[\"band-leader\",\"guitar\",\"vox\"]}', '1472706487', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('22', 'Nav Night - Week 3', '1', '1473472800', '{\"647664095\":{\"confirmed\":true},\"3663360872\":{\"confirmed\":true},\"185279332\":{\"confirmed\":true},\"1275491953\":{\"confirmed\":true},\"3946107201\":{\"confirmed\":true},\"325570997\":{\"confirmed\":true},\"570431960\":{\"confirmed\":true},\"2229189973\":{\"confirmed\":true}}', '{\"647664095\":[\"band-leader\",\"guitar\",\"vox\"],\"3663360872\":[\"event-manager\"],\"185279332\":[\"electric-guitar\",\"co-leader\"],\"1275491953\":[\"keyboard\"],\"3946107201\":[\"acoustic-guitar\"],\"325570997\":[\"vox\"],\"570431960\":[\"vox\"],\"2229189973\":[\"drums\"]}', '1473179118', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('28', 'Nav Night - Week 6', '1', '1475287200', '{\"185279332\":{\"confirmed\":true},\"647664095\":{\"confirmed\":true},\"3663360872\":{\"confirmed\":true},\"2074895394\":{\"confirmed\":true},\"2229189973\":{\"confirmed\":true},\"1275491953\":{\"confirmed\":true},\"1102677379\":{\"confirmed\":true},\"3223701345\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\",\"electric-guitar\"],\"647664095\":[\"band-leader\",\"vox\",\"guitar\",\"event-manager\"],\"3663360872\":[\"event-manager\"],\"2074895394\":[\"acoustic-guitar\"],\"2229189973\":[\"drums\"],\"1275491953\":[\"keyboard\"],\"1102677379\":[\"vox\"],\"3223701345\":[\"acoustic-guitar\"]}', '1474835800', '185279332');


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
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('74', '22', 'song', 'It Is Well - Kristene DiMarco', 'Rachel leads', '1473476400', '22', 'G', '1473180042', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('73', '22', 'simple', 'Message', '', '1473474900', '', '', '1473179994', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('72', '22', 'song', 'Great Are You Lord - All Sons and Daughters', '', '1473474600', '21', 'C', '1473179977', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('70', '22', 'song', 'Relentless - Hillsong United', '', '1473474000', '19', 'C', '1473179946', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('68', '22', 'simple', 'Announcements', 'Emcee prays for worship band', '1473473700', '', '', '1473179865', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('71', '22', 'song', 'This is Amazing Grace - Phil Wickham', 'Jacob leads', '1473474300', '20', 'C', '1473179963', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('66', '22', 'simple', 'Game', 'Name of game is...', '1473473400', '', '', '1473179834', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('65', '22', 'simple', 'Welcome', 'Emcees', '1473473100', '', '', '1473179810', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('64', '22', 'simple', 'Countdown', 'Emcees', '1473472500', '', '', '1473179777', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('77', '21', 'simple', 'Pickup Gear', 'Jecka\'s place.', '1474068600', '', '', '1473974806', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('62', '22', 'simple', 'Pre Navs Meeting', '', '1473471900', '', '', '1473179652', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('61', '22', 'simple', 'Rehearsal', '', '1473467400', '', '', '1473179389', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('60', '22', 'simple', 'Setup', 'Clark A101', '1473465600', '', '', '1473179354', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('59', '22', 'simple', 'Pickup Gear', 'From Jecka\'s house. 1615 Underhill Dr #3.', '1473463800', '', '', '1473179323', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('58', '22', 'simple', 'Practice', 'Collin\'s house. 812 Myrtle St.', '1473386400', '', '', '1473179167', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('57', '20', 'simple', 'Practice', 'Collin\'s house. 812 Myrtle.', '1473386400', '', '', '1472794493', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('75', '22', 'song', 'Forever Reign - Hillsong Live', '', '1473476700', '23', 'C', '1473180060', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('76', '21', 'simple', 'Practice', 'Collin\'s', '1473991200', '', '', '1473264653', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('78', '21', 'simple', 'Setup', 'Clark A101', '1474070400', '', '', '1473974826', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('79', '21', 'simple', 'Rehearsal', '', '1474072200', '', '', '1473974842', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('80', '21', 'simple', 'Pre Navs Meeting', '', '1474076700', '', '', '1473974858', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('81', '21', 'simple', 'Countdown', '', '1474077300', '', '', '1473974877', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('82', '21', 'simple', 'Game & Announcements', '', '1474078200', '', '', '1473974902', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('83', '21', 'song', 'Your Love Never Fails - Jesus Culture', '', '1474078800', '24', 'A', '1473975963', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('84', '21', 'song', 'How He Loves - David Crowder Band', '', '1474079100', '25', 'C', '1473975979', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('85', '21', 'song', 'I Surrender - Hillsong Live', '', '1474079400', '26', 'E', '1473975989', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('86', '21', 'simple', 'Message', 'Speaker...', '1474079700', '', '', '1473976002', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('87', '21', 'song', 'Revelation Song - Kari Jobe', '', '1474081800', '29', 'G', '1473976287', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('88', '21', 'song', 'You Won\'t Relent - Misty Edwards', '', '1474082100', '28', 'E', '1473976315', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('89', '23', 'simple', 'Rehearsal', 'Collin\'s House', '1474596000', '', '', '1474336542', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('139', '23', 'simple', 'Announcements', '808 (Myrtle men hype), journey video\r\n(EMCEEs to stage)', '1474683300', '', '', '1474664849', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('92', '23', 'song', 'Rejoice - Dustin Kensrue', '', '1474684800', '30', 'A#', '1474337350', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('93', '23', 'song', 'Open Up The Heavens - Vertical Church Band', '', '1474685040', '35', 'D', '1474337363', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('94', '23', 'song', '10,000 Reasons - Matt Redman', '(band member pray, Randy to stage)', '1474685280', '32', 'G', '1474337373', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('95', '23', 'simple', 'Message', 'Randy (pray, worship band to stage)', '1474685400', '', '', '1474337384', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('96', '23', 'song', 'Forever - Kari Jobe', '', '1474686900', '36', 'F', '1474337403', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('97', '23', 'song', 'The Stand - Hillsong', '(band member pray, video starts)', '1474687140', '34', 'A', '1474337420', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('98', '25', 'simple', 'Rehearsal', 'Collin\'s House', '1475373600', '', '', '1474610140', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('99', '25', 'simple', 'Pick Up Gear', 'Jecka\'s House', '1475296200', '', '', '1474610140', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('100', '25', 'simple', 'Welcome', '', '1475287200', '', '', '1474610140', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('101', '25', 'song', 'Rejoice - Dustin Kensrue', '', '1475286300', '30', 'A#', '1474610141', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('102', '25', 'song', 'Open Up The Heavens - Vertical Church Band', '', '1475286000', '31', 'C', '1474610141', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('103', '25', 'song', '10,000 Reasons - Matt Redman', '', '1475285700', '32', 'G', '1474610141', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('104', '25', 'simple', 'Message', '', '1475285400', '', '', '1474610141', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('105', '25', 'song', 'Forever - Kari Jobe', '', '1475283600', '33', 'G', '1474610141', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('106', '25', 'song', 'The Stand - Hillsong', '', '1475283300', '34', 'A', '1474610142', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('107', '26', 'simple', 'Practice', 'Collin\'s', '1475200800', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('108', '26', 'simple', 'Pickup Gear', 'Jecka\'s place.', '1475278200', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('109', '26', 'simple', 'Setup', 'Clark A101', '1475280000', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('120', '27', 'simple', 'Practice', 'Collin\'s', '1475805600', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('111', '26', 'simple', 'Pre Navs Meeting', '', '1475286300', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('112', '26', 'simple', 'Countdown', '', '1475286900', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('113', '26', 'simple', 'Game & Announcements', '', '1475287800', '', '', '1474610206', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('114', '26', 'song', 'Your Love Never Fails - Jesus Culture', '', '1475288400', '24', 'A', '1474610207', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('115', '26', 'song', 'How He Loves - David Crowder Band', '', '1475288700', '25', 'C', '1474610207', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('116', '26', 'song', 'I Surrender - Hillsong Live', '', '1475289000', '26', 'E', '1474610207', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('117', '26', 'simple', 'Message', 'Speaker...', '1475289300', '', '', '1474610207', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('118', '26', 'song', 'Revelation Song - Kari Jobe', '', '1475291400', '29', 'G', '1474610207', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('119', '26', 'song', 'You Won\'t Relent - Misty Edwards', '', '1475291700', '28', 'E', '1474610208', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('121', '27', 'simple', 'Pickup Gear', 'Jecka\'s place.', '1475883000', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('122', '27', 'simple', 'Setup', 'Clark A101', '1475884800', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('123', '27', 'simple', 'Pre Navs Meeting', '', '1475891100', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('124', '27', 'simple', 'Countdown', '', '1475891700', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('125', '27', 'simple', 'Game & Announcements', '', '1475892600', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('126', '27', 'song', 'Your Love Never Fails - Jesus Culture', '', '1475893200', '24', 'A', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('127', '27', 'song', 'How He Loves - David Crowder Band', '', '1475893500', '25', 'C', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('128', '27', 'song', 'I Surrender - Hillsong Live', '', '1475893800', '26', 'E', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('129', '27', 'simple', 'Message', 'Speaker...', '1475894100', '', '', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('130', '27', 'song', 'Revelation Song - Kari Jobe', '', '1475896200', '29', 'G', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('131', '27', 'song', 'You Won\'t Relent - Misty Edwards', '', '1475896500', '28', 'E', '1474610703', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('132', '23', 'simple', 'Arrive at Clark A101', 'A/V Team', '1474675200', '', '', '1474664422', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('133', '23', 'simple', 'EMCEES arrive', '', '1474678800', '', '', '1474664469', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('134', '23', 'simple', 'Worship band done practicing', 'Collin S', '1474680600', '', '', '1474664530', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('135', '23', 'simple', 'Pre Navs Meeting', 'Ryan', '1474681500', '', '', '1474664560', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('136', '23', 'simple', 'Pre Navs Timer', '', '1474682100', '', '', '1474664613', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('137', '23', 'simple', 'Welcome', 'EMCEES', '1474682700', '', '', '1474664667', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('138', '23', 'simple', 'Game', 'Cereal Off\r\n(one of 808 hype men compete and then invite bros to stage)', '1474682880', '', '', '1474664693', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('140', '23', 'simple', 'Journey sign up', 'EMCEES, prize drawing (Ashley invites Lauren to stage)', '1474683600', '', '', '1474664892', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('141', '23', 'simple', 'Testimony', 'Lauren\r\n(pray for the night, band to stage)', '1474684500', '', '', '1474665267', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('142', '23', 'simple', 'Announcements', 'EMCEE- 808, la pancake, journey sign up/connecting table, nafter', '1474687320', '', '', '1474665832', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('143', '23', 'simple', 'Video', '808 (EMCEEs to stage)', '1474687200', '', '', '1474665943', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('144', '23', 'simple', 'Nav Nite end', '', '1474687620', '', '', '1474666323', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('145', '23', 'simple', 'EVERYONE GET EVERYONE TO NAFTER', '', '1474688520', '', '', '1474666356', '2147483647');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('146', '28', 'simple', 'Rehearsal', 'Collin\'s House', '1475200800', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('147', '28', 'simple', 'Pick Up Gear', 'Jecka\'s House', '1475278200', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('148', '28', 'simple', 'Arrive at Clark A101', 'A/V Team', '1475280000', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('149', '28', 'simple', 'EMCEES arrive', '', '1475283600', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('150', '28', 'simple', 'Worship band done practicing', 'Collin S', '1475285400', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('151', '28', 'simple', 'Pre Navs Meeting', 'Ryan', '1475286300', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('152', '28', 'simple', 'Pre Navs Timer', '', '1475286900', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('153', '28', 'simple', 'Welcome', 'EMCEES', '1475287500', '', '', '1474835800', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('173', '28', 'song', 'Oceans - Hillsong United', '', '1475291700', '40', 'G', '1474928992', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('172', '28', 'song', 'You Make Me Brave - Bethel Music', '', '1475291400', '39', 'G#', '1474928649', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('171', '28', 'simple', 'Message', '', '1475289300', '', '', '1474928627', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('170', '28', 'song', 'Fall Afresh - Bethel Music', '', '1475289000', '38', 'C', '1474928087', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('169', '28', 'song', 'Nothing But The Blood - Misc.', 'Simpler than recording on video. Upbeat, folky rock version, but still traditional', '1475288700', '37', 'C', '1474927884', '647664095');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('168', '28', 'song', 'Rejoice - Dustin Kensrue', '', '1475288400', '30', 'A#', '1474927288', '647664095');


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
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES ('70', 'annieshep@hotmail.com', '129.82.72.59', '2016-09-27 22:37:25');


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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('32', 'Your-Love-Never-Fails_G.pdf', '.pdf', '35.41', 'application/pdf', 'chord', 'media/chord/8c0c215068f7002d687d0c85c26c035e.pdf', '[\"1\"]', '1473975025', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('33', 'How-He-Loves.pdf', '.pdf', '35.13', 'application/pdf', 'chord', 'media/chord/81f552e91a9021584d60af625f77cb99.pdf', '[\"1\"]', '1473975545', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('34', 'I-Surrender_Cm.pdf', '.pdf', '33.53', 'application/pdf', 'chord', 'media/chord/54c850d1105829a0d54b785cd1fdb0bc.pdf', '[\"1\"]', '1473975692', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('35', 'You-Wont-Relent.pdf', '.pdf', '35.1', 'application/pdf', 'chord', 'media/chord/6f068fd67c671dcb103ebdbedf516c10.pdf', '[\"1\"]', '1473975902', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('36', 'Revelation-Song-Kari-Jobe.pdf', '.pdf', '36.97', 'application/pdf', 'chord', 'media/chord/87207b8e9472caf77cad5c6a2d5c2660.pdf', '[\"1\"]', '1473976139', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('37', 'Revelation-Song.pdf', '.pdf', '33.67', 'application/pdf', 'chord', 'media/chord/c250cda60c5f5bc07cafc5f7d95362b2.pdf', '[\"1\"]', '1473976217', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('38', 'Revelation-Song_update.pdf', '.pdf', '36.59', 'application/pdf', 'chord', 'media/chord/33d6f1fb6d1f63c49cf2fcee1c27fd4e.pdf', '[\"1\"]', '1474060277', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('39', 'Your-Love-Never-Fails_update.pdf', '.pdf', '35.95', 'application/pdf', 'chord', 'media/chord/0d4f2cfccb0aec5c30c6615b44623329.pdf', '[\"1\"]', '1474060406', '185279332');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('40', 'Rejoice.pdf', '.pdf', '36.08', 'application/pdf', 'chord', 'media/chord/18b8f210a5803f0ca28867669f9f4f61.pdf', '[\"1\"]', '1474336797', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('41', 'Open Up The Heavens.pdf', '.pdf', '34.84', 'application/pdf', 'chord', 'media/chord/444ee1ef1f0969cb36f2fd756d6a0913.pdf', '[\"1\"]', '1474336938', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('42', '10,000 Reasons.pdf', '.pdf', '35.31', 'application/pdf', 'chord', 'media/chord/c423e1a168544d0a5a96b6b3233d82f5.pdf', '[\"1\"]', '1474337048', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('43', 'Forever.pdf', '.pdf', '32.53', 'application/pdf', 'chord', 'media/chord/39ad990854671c31a03a0c6a4255fe99.pdf', '[\"1\"]', '1474337149', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('44', 'The Stand.pdf', '.pdf', '34.33', 'application/pdf', 'chord', 'media/chord/28f26cad83b91f67282254a2a48c5494.pdf', '[\"1\"]', '1474337302', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('45', 'Rejoice_NoCapo.pdf', '.pdf', '35.56', 'application/pdf', 'chord', 'media/chord/ef4c1b47228741cca462ef26d5337ecb.pdf', '[\"1\"]', '1474338925', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('46', 'Open Up The Heavens - D.pdf', '.pdf', '34.57', 'application/pdf', 'chord', 'media/chord/4035daf91f739061a7c46345b2466535.pdf', '[\"1\"]', '1474641532', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('47', 'Forever - F.pdf', '.pdf', '35.95', 'application/pdf', 'chord', 'media/chord/5a3638ee945956174ecad999d0d1af3a.pdf', '[\"1\"]', '1474642052', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('48', 'Nothing But The Blood.pdf', '.pdf', '34.42', 'application/pdf', 'chord', 'media/chord/55626d6d793093710d7533768ddb8eb0.pdf', '[\"1\"]', '1474927703', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('49', 'Fall Afresh.pdf', '.pdf', '33.38', 'application/pdf', 'chord', 'media/chord/153b534f0b2f7385e5f2ed4450b71756.pdf', '[\"1\"]', '1474928044', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('50', 'You Make Me Brave.pdf', '.pdf', '36.22', 'application/pdf', 'chord', 'media/chord/0dc426380d35cbc62f7eceb36aeef9fe.pdf', '[\"1\"]', '1474928495', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('51', 'You Make Me Brave_Open.pdf', '.pdf', '34.23', 'application/pdf', 'chord', 'media/chord/607c957074738c5228d493d211a5f278.pdf', '[\"1\"]', '1474928554', '647664095');
INSERT INTO `media` (`id`, `name`, `file_ext`, `file_size`, `file_type`, `link_type`, `link`, `organizations`, `date_created`, `created_by`) VALUES ('52', 'Oceans.pdf', '.pdf', '37.28', 'application/pdf', 'chord', 'media/chord/1bd0b76b8f39630734a6d2b9985f5983.pdf', '[\"1\"]', '1474928914', '647664095');


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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('1', 'Be Thou My Vision', '[\"Hymns\",\"Secular\",\"Staples\"]', '[\"1\"]', '1468291147', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('2', 'With Everything', '[\"Staples\",\"Slow\",\"Progressive\",\"Big\"]', '[\"1\"]', '1468375416', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('3', 'No Longer Slaves', '[\"Staples\",\"Progressive\",\"Freedom\"]', '[\"1\"]', '1468387904', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('4', 'Sinking Deep', '[\"Staples\",\"Progressive\",\"Spiritual\"]', '[\"1\"]', '1468486434', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('10', 'Relentless', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1468487780', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('43', 'Fall Afresh', '[\"Slow\",\"Spiritual\"]', '[\"1\"]', '1474928006', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('44', 'You Make Me Brave', '[\"Slow Build\",\"Powerful\",\"Female Lead\"]', '[\"1\"]', '1474928180', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('45', 'Oceans', '[\"Female Lead\",\"Closer\",\"Big\",\"Piano Lead\"]', '[\"1\"]', '1474928873', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('42', 'Nothing But The Blood', '[\"Hymns\",\"Classic\",\"Upbeat\"]', '[\"1\"]', '1474927657', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('18', 'In Tenderness', '[\"Staples\",\"Progressive\",\"Powerful\"]', '[\"1\"]', '1468488111', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('20', 'Great Are You Lord', '[\"Staples\",\"Piano Lead\",\"Progressive\",\"Spiritual\"]', '[\"1\"]', '1468488209', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('25', 'Brown Eyed Girl', '[\"Secular\"]', '[\"1\"]', '1468560488', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('28', 'In Christ Alone', '[\"Hymns\",\"Powerful\"]', '[\"1\"]', '1470888096', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('29', 'This is Amazing Grace', '[\"Staples\",\"Upbeat\"]', '[\"1\"]', '1473179444', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('30', 'It Is Well', '[\"Female Lead\",\"Big\",\"Build\",\"Piano Lead\",\"Powerful\"]', '[\"1\"]', '1473179641', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('31', 'Forever Reign', '[\"Powerful\",\"Staples\"]', '[\"1\"]', '1473179755', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('32', 'Your Love Never Fails', '[\"Big\",\"Fast\",\"Upbeat\"]', '[\"1\"]', '1473974954', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('33', 'How He Loves', '[\"Powerful\",\"Piano Lead\",\"Spiritual\",\"Staples\"]', '[\"1\"]', '1473975475', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('34', 'I Surrender', '[\"Slow Build\",\"Progressive\",\"Powerful\"]', '[\"1\"]', '1473975652', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('35', 'You Won\'t Relent', '[\"Big\",\"Progressive\",\"Upbeat\"]', '[\"1\"]', '1473975854', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('36', 'Revelation Song', '[\"Female Lead\",\"Progressive\",\"Slow Build\"]', '[\"1\"]', '1473976056', '185279332');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('37', 'Rejoice', '[\"New\",\"Fast\"]', '[\"1\"]', '1474336701', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('38', 'Open Up The Heavens', '[\"New\",\"Fast\",\"Praise\"]', '[\"1\"]', '1474336909', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('39', '10,000 Reasons', '[\"Piano Lead\",\"Mellow\",\"Slow\"]', '[\"1\"]', '1474337017', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('40', 'Forever', '[\"Female Lead\",\"Powerful\"]', '[\"1\"]', '1474337114', '647664095');
INSERT INTO `song` (`id`, `title`, `tags`, `organizations`, `date_created`, `created_by`) VALUES ('41', 'The Stand', '[\"Piano Lead\",\"Powerful\",\"Closer\"]', '[\"1\"]', '1474337209', '647664095');


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

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('185279332', 'zach', 'zach@medialusions.com', '3035490491', '', '', '2016-09-19 19:37:35', 'phone', 'Zach', 'Smith', '1,', '[]', '10', '0', '$2y$11$Lgvip1PHfINFx7yXUhJWu.5htbl7EV1JZNgx9ucOJZL27XW5noFG6', '$2y$11$q68J1u3eEmBuOaiL.HDoMOY93BmFpT2Vi8fV9112L0uqcMaAQUDoe', '2016-07-03 19:37:50', '2016-08-31 00:54:31', '2016-09-26 18:58:58', '2016-07-03 19:07:56', '2016-09-26 18:58:58');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('325570997', 'rachelbiegan', 'rachel.bieganski@gmail.com', '9075758597', '', '', '2016-09-19 20:25:27', 'phone', 'Rachel', 'Bieganski', '1,', '[]', '5', '0', '$2y$10$0385d120a38f68b932821OyNKbQ.IgPcpT4XiAzI6hLdV9bRg4e7G', '', '0000-00-00 00:00:00', '2016-09-09 07:08:01', '2016-09-23 15:38:38', '2016-09-08 23:10:07', '2016-09-23 15:38:38');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('570431960', 'jcal', 'calvert.jacob8@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Jacob', 'Calvert', '1,', '[]', '5', '0', '$2y$10$67f6ddd5a0827c9170adeu0QP/lK8WHX4WZAKb8sLPu5D7qegy6.q', '', '0000-00-00 00:00:00', '2016-09-09 09:15:27', '2016-09-22 18:03:30', '2016-09-08 23:13:24', '2016-09-22 18:03:30');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('647664095', 'costover', 'cstover1996@comcast.net', '7203174206', '', '', '2016-09-04 20:27:18', 'phone', 'Collin', 'Stover', '1,', '[]', '9', '0', '$2y$10$b599cf5d32050960f471ausjJoosPpt3pUCAIgu8v5hO6G6HqlEbO', '$2y$10$4d1337aa25d2832f410ecuGav8wcv1nC1t7j1JlWCNrSx/X4gOIia', '2016-08-10 15:25:27', '2016-08-10 20:37:16', '2016-09-26 14:54:12', '2016-08-10 15:25:27', '2016-09-26 14:54:12');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('757417152', NULL, 'tymmoore@rams.colostate.edu', '', '', '', '0000-00-00 00:00:00', 'email', 'Tym', 'Moore', '1,', '[]', '5', '0', '', '$2y$10$0e24c296ecdcf3fee2c3eejzdPPnPg44CJ/5LCkGmLJd2WeVr/AKm', '2016-09-23 21:01:02', NULL, NULL, '2016-09-23 21:01:02', '2016-09-23 21:01:02');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('1102677379', NULL, 'annieshep@hotmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Annie', 'Schoephoerster', '1,', '[]', '5', '0', '', '$2y$10$331a4b515969c9ab77570eqxpy7R0ac8nXsbBjprvN2bNTyf5dRGi', '2016-09-16 14:07:46', NULL, NULL, '2016-09-16 14:07:46', '2016-09-16 14:07:46');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('1275491953', 'zdub', 'zmdwyer@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Zack', 'Dwyer', '1,', '[]', '5', '0', '$2y$10$490010e28f20ee8506806OTDS5ITLDjS6fULz.ucCirMx4AX0c2r6', '', '0000-00-00 00:00:00', '2016-09-10 19:04:13', '2016-09-10 19:06:36', '2016-09-08 23:11:49', '2016-09-10 19:06:36');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('1387746014', 'leasupplee', 'lea.supplee@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Lea', 'Supplee', '1,', '[]', '5', '0', '$2y$10$a3a0ab1bf528f6fafdecaeTW7BOtIX37EiermabUToHyD2jtuv9qC', '', '0000-00-00 00:00:00', '2016-09-19 11:33:53', '2016-09-19 11:33:53', '2016-09-16 14:07:17', '2016-09-19 11:33:53');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('2074895394', 'hannahharris', 'hannahnh@rams.colostate.edu', '', '', '', '0000-00-00 00:00:00', 'email', 'Hannah', 'Harrison', '1,', '[]', '5', '0', '$2y$10$65a194516cf0946c56a44u93cO2rWubjbVg6cQ.qA.ez0V1CAcYFy', '', '0000-00-00 00:00:00', '2016-09-16 15:05:40', '2016-09-27 20:57:23', '2016-09-16 14:08:11', '2016-09-27 20:57:23');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('2198479107', 'kboykin', 'kboykin@rams.colostate.edu', '', '', '', '0000-00-00 00:00:00', 'email', 'Kellie', 'Boykin', '1,', '[]', '5', '0', '$2y$10$1425a6e41cbfe3cf194f2uAJICIRXz56R2ODEDId6AqQlaVuc9Bmu', '', '0000-00-00 00:00:00', '2016-09-17 11:52:22', '2016-09-17 11:52:40', '2016-09-16 14:08:33', '2016-09-17 11:52:40');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('2229189973', 'dmoody', 'danielnmoody@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Dan', 'Moody', '1,', '[]', '5', '0', '$2y$10$bc5d7a11927b8bba1e7f3uFL8SqzHsuJb/V/7jSIZdUxwz2aKphp6', '', '0000-00-00 00:00:00', '2016-09-09 00:25:49', '2016-09-27 15:55:14', '2016-09-08 23:12:32', '2016-09-27 15:55:14');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('2292670933', 'athariri13', 'athariri13@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Austin', 'Hariri', '1,', '[]', '5', '0', '$2y$10$dc7050ff2a2851852ae93ul4hKYgz/Ca8mzjSlhDuDAOeNM0nsqpy', '', '0000-00-00 00:00:00', '2016-09-09 11:00:22', '2016-09-09 11:00:22', '2016-09-09 10:54:25', '2016-09-09 11:00:22');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('3223701345', 'wjfriesen', 'ohgravity71@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Will', 'Friesen', '1,', '[]', '5', '0', '$2y$10$1edbb7d7119e6aa6ede74uQ4KhJtPvpz96gY8nqpibGuos5EyB8h.', '', '0000-00-00 00:00:00', '2016-09-26 16:06:39', '2016-09-26 19:00:18', '2016-09-26 15:03:51', '2016-09-26 19:00:18');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('3663360872', 'rkrammes', 'rkrammes1025@gmail.com', '', '', '', '0000-00-00 00:00:00', 'email', 'Ryan', 'Krammes', '1,', '[]', '9', '0', '$2y$10$ed8f9ff6f50bdeeeb4531O4BXfklh9vyXbDTrUxp3BkqdoTNP7RBu', '', '0000-00-00 00:00:00', '2016-09-02 11:15:53', '2016-09-23 15:21:20', '2016-09-01 11:44:51', '2016-09-23 15:21:20');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `phone_to_confirm`, `phone_confirmation`, `phone_confirmation_date`, `comm_preference`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('3946107201', 'jpurban', 'jpurban14@gmail.com', '3039607131', '', '', '2016-09-20 19:51:56', 'phone', 'Josh', 'Urban', '1,', '[]', '5', '0', '$2y$10$e3d4cb18d811d0a71aa10uNiZqqc6c5MUiYqO7zpXPTj0kOgPgfAC', '', '0000-00-00 00:00:00', '2016-09-20 19:50:51', '2016-09-20 19:50:51', '2016-09-08 23:11:05', '2016-09-20 19:51:56');


