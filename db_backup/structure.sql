#
# TABLE STRUCTURE FOR: acl
#

DROP TABLE IF EXISTS `acl`;

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

DROP TABLE IF EXISTS `acl_actions`;

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

DROP TABLE IF EXISTS `acl_categories`;

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

DROP TABLE IF EXISTS `arrangement`;

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

#
# TABLE STRUCTURE FOR: auth_sessions
#

DROP TABLE IF EXISTS `auth_sessions`;

CREATE TABLE `auth_sessions` (
  `id` varchar(40) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: denied_access
#

DROP TABLE IF EXISTS `denied_access`;

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

DROP TABLE IF EXISTS `event`;

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: event_item
#

DROP TABLE IF EXISTS `event_item`;

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: ips_on_hold
#

DROP TABLE IF EXISTS `ips_on_hold`;

CREATE TABLE `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: login_errors
#

DROP TABLE IF EXISTS `login_errors`;

CREATE TABLE `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: media
#

DROP TABLE IF EXISTS `media`;

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: organization
#

DROP TABLE IF EXISTS `organization`;

CREATE TABLE `organization` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `location` text CHARACTER SET latin1 NOT NULL,
  `timezone` text CHARACTER SET latin1 NOT NULL,
  `date_created` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: song
#

DROP TABLE IF EXISTS `song`;

CREATE TABLE `song` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET latin1 NOT NULL,
  `tags` text CHARACTER SET latin1 NOT NULL,
  `organizations` text CHARACTER SET latin1 NOT NULL,
  `date_created` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: username_or_email_on_hold
#

DROP TABLE IF EXISTS `username_or_email_on_hold`;

CREATE TABLE `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
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

