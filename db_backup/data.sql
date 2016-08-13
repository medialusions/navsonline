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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('1', 'Citizens & Saints', 'G', '120', '205', '12', '', 'https://www.youtube.com/watch?v=YNnwtxNkwBI', '1', '[{\"key\":\"Open\",\"id\":\"13\"},{\"key\":\"G\",\"id\":\"13\"}]', '[\"1\"]', '1468366750', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('2', 'Kings Kaleidoscope', 'G', '120', '233', '16', '', 'https://www.youtube.com/watch?v=rxP45fCBdtw', '1', '[{\"key\":\"Open\",\"id\":\"15\"},{\"key\":\"G\",\"id\":\"15\"},{\"key\":\"D\",\"id\":\"14\"}]', '[\"1\"]', '1468367312', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('3', 'Hillsong Live', 'G', '', '0', '', '', 'https://www.youtube.com/watch?v=rSCE8uLuTJY', '2', '[{\"key\":\"G\",\"id\":\"17\"},{\"key\":\"Open\",\"id\":\"17\"}]', '[\"1\"]', '1468386899', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('14', 'Van Morrison', 'G', '', '183', '', '11', 'https://www.youtube.com/watch?v=TG8Ect3Xn7w', '25', '[]', '[\"1\"]', '1468560545', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('7', 'Bethel Music', 'A#', '', '376', '19', '', 'https://www.youtube.com/watch?v=XxkNj5hcy5E', '3', '[{\"key\":\"A#\",\"id\":\"18\"}]', '[\"1\"]', '1468484997', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('9', 'Hillsong Young & Free', 'A', '', '247', '21', '', 'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwjzoZDFyvLNAhUj7IMKHeESDEEQ3ywIHjAA&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dffr0pGkXPJg&usg=AFQjCNFSb3p1a2PyIDqFo7INsjn7NMrtuA&sig2=Zwd0ziK-iv6IqgSACrEfxQ&bvm=bv.127178174,d.amc', '4', '[{\"key\":\"Open\",\"id\":\"22\"},{\"key\":\"A\",\"id\":\"23\"},{\"key\":\"A#\",\"id\":\"20\"},{\"key\":\"G\",\"id\":\"22\"}]', '[\"1\"]', '1468486840', '185279332');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('17', 'Citizens & Saints', 'C#', '', '0', '', '', '', '18', '[{\"key\":\"C#\",\"id\":\"24\"}]', '[\"1\"]', '1470887344', '647664095');
INSERT INTO `arrangement` (`id`, `artist`, `default_key`, `bpm`, `length`, `lyrics`, `audio`, `video`, `song`, `song_keys`, `organizations`, `date_created`, `created_by`) VALUES ('18', 'Kings Kaleidoscope', 'G', '130', '285', '', '', 'https://www.youtube.com/watch?v=aT3YJVkYPwU', '28', '[{\"key\":\"G\",\"id\":\"26\"},{\"key\":\"Open\",\"id\":\"26\"}]', '[\"1\"]', '1470888762', '647664095');


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

INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('0cc2ed8b13596f101355374f96c7482d3ccdce8d', '185279332', '2016-08-12 21:53:52', '2016-08-12 21:53:57', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('8f7305144cea8cc836efeba6df2210f08f3a349a', '185279332', '2016-08-11 19:22:49', '2016-08-11 22:46:59', '10.0.0.9', 'Chrome 52.0.2743.116 on Windows 10');
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES ('c80f43a33bcb4a8b8a3cdacde9bab65141c2b467', '185279332', '2016-08-11 22:48:11', '2016-08-11 22:48:11', '50.134.251.136', 'Chrome 52.0.2743.116 on Windows 10');


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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('15', 'Nav Night', '1', '1469840400', '{\"2096776302\":{\"confirmed\":true}}', '{\"2096776302\":[\"event-manager\"]}', '1469663305', '2096776302');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('18', 'Nav Night', '1', '1472263200', '{\"185279332\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\"]}', '1470322312', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('17', 'Nav Night', '1', '1471658400', '{\"185279332\":{\"confirmed\":true},\"2096776302\":{\"confirmed\":true},\"775806119\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\"],\"2096776302\":[\"event-manager\",\"electric-guitar\"],\"775806119\":[\"event-manager\",\"rhythm-guitar\"]}', '1470175134', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('14', 'TEST', '1', '1468634400', '{\"185279332\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\"]}', '1468997788', '185279332');
INSERT INTO `event` (`id`, `name`, `organization`, `date`, `users_matrix`, `roles_matrix`, `date_created`, `created_by`) VALUES ('12', 'Nav Night', '1', '1469844000', '{\"185279332\":{\"confirmed\":true}}', '{\"185279332\":[\"event-manager\"]}', '1468387804', '185279332');


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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('18', '12', 'simple', 'Last minute cleanup', '', '1469843100', '', '', '1469003016', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('14', '12', 'simple', 'Practice', 'Zach\'s house', '1469674800', '', '', '1469002847', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('15', '12', 'simple', 'Pickup Gear', '', '1469835000', '', '', '1469002886', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('16', '12', 'simple', 'Setup', 'Everyone', '1469836800', '', '', '1469002912', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('17', '12', 'simple', 'Practice', '', '1469839500', '', '', '1469002951', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('19', '12', 'simple', 'Intro/Game', 'Emcee\'s', '1469844000', '', '', '1469003043', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('20', '12', 'simple', 'Worship', 'Worship team', '1469844900', '', '', '1469003110', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('21', '12', 'song', 'Be Thou My Vision - Citizens & Saints', 'Notes.', '1469844900', '1', 'G', '1469004771', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('25', '15', 'simple', 'Meeting', 'Ahead of time meeting. ', '1469836800', '', '', '1469663337', '2096776302');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('26', '17', 'simple', 'Practice', 'At Collin\'s house', '1471485600', '', '', '1470175175', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('27', '17', 'simple', 'Pickup Gear', 'From Collin\'s house', '1471649400', '', '', '1470175208', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('28', '17', 'simple', 'Setup', '', '1471651200', '', '', '1470175264', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('29', '17', 'simple', 'Practice', '', '1471653000', '', '', '1470175281', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('30', '17', 'simple', 'Countdown', '5-10 min countdown on projector', '1471658400', '', '', '1470175345', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('31', '17', 'simple', 'Intro/Game', 'Emcees', '1471659000', '', '', '1470175367', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('32', '17', 'song', 'Be Thou My Vision - Citizens & Saints', 'Begin with intro/speech and prayer', '1471659300', '1', 'G', '1470175410', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('40', '17', 'song', 'No Longer Slaves - Bethel Music', '', '1471659600', '7', 'A#', '1470178493', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('41', '17', 'song', 'Be Thou My Vision - Kings Kaleidoscope', '', '1471659900', '2', 'G', '1470322420', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('42', '17', 'simple', 'Message', 'Jim Rinella', '1471660200', '', '', '1470322477', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('43', '17', 'song', 'Brown Eyed Girl - Van Morrison', '', '1471662600', '14', 'G', '1470322497', '185279332');
INSERT INTO `event_item` (`id`, `event_id`, `type`, `title`, `memo`, `start_time`, `arrangement_id`, `arrangement_key`, `date_created`, `created_by`) VALUES ('44', '17', 'simple', 'Clean Up', '', '1471662900', '', '', '1470322541', '185279332');


#
# TABLE STRUCTURE FOR: ips_on_hold
#

CREATE TABLE `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: login_errors
#

CREATE TABLE `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES ('25', 'Smitherz', '10.0.0.9', '2016-08-10 18:01:41');
INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES ('26', 'smithza', '10.0.0.9', '2016-08-10 18:01:54');


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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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


#
# TABLE STRUCTURE FOR: username_or_email_on_hold
#

CREATE TABLE `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

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

INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('185279332', 'zach', 'zach@medialusions.com', '3035490491', 'Zach', 'Smith', '1,', '[]', '10', '0', '$2y$11$XUnQtI3PHq2DeXaDxTSS8Osw2nK.sPjcVu5q3PcYVHSjoXNTQmWCG', '$2y$11$q68J1u3eEmBuOaiL.HDoMOY93BmFpT2Vi8fV9112L0uqcMaAQUDoe', '2016-07-03 19:37:50', '2016-07-03 13:38:14', '2016-08-12 21:53:52', '2016-07-03 19:07:56', '2016-08-12 21:53:57');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('647664095', 'costover', 'cstover1996@comcast.net', '', 'Collin', 'Stover', '1,', '[]', '9', '0', '$2y$10$b599cf5d32050960f471ausjJoosPpt3pUCAIgu8v5hO6G6HqlEbO', '$2y$10$4d1337aa25d2832f410ecuGav8wcv1nC1t7j1JlWCNrSx/X4gOIia', '2016-08-10 15:25:27', '2016-08-10 20:37:16', '2016-08-10 21:20:26', '2016-08-10 15:25:27', '2016-08-10 21:20:26');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('775806119', 'smithza', 'zsmith812@gmail.com', '', 'Zachary', 'Smith', '1,', '[]', '5', '0', '$2y$10$56ed1747cedf22bbffb17uphzB.QA8NXQotwt.mLCOPHx/5vhbBPi', '$2y$10$2a75cdcf4034571a22a0de7pY4YAr/e1T2TSgmPhHz7oRj.rP15Ca', '2016-08-10 15:18:30', '2016-08-10 15:23:52', '2016-08-10 15:23:52', '2016-08-10 15:18:30', '2016-08-10 15:23:52');
INSERT INTO `users` (`user_id`, `username`, `email`, `phone`, `first_name`, `last_name`, `organizations`, `blockouts`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES ('2096776302', 'smitherz', 'smithza@rams.colostate.edu', '', 'Zman', 'Smith', '1,', '[{\"start_date\":\"1469922430\",\"date_end\":\"1470095230\",\"reason\":\"Sick\"}]', '9', '0', '$2y$11$lQJBP86EJs6U0IVj7OSCiu7pnZsCTJBQnRxaQ/lC5SfJKGfZKA.qC', '$2y$11$p6m/1qqMncVcRnHrKpWuT.ay4dZ2I65I1FDI99gGzJdqlyT5x4NSS', '2016-07-27 16:43:59', '2016-07-27 20:33:43', '2016-07-27 19:33:50', '2016-07-27 16:43:59', '2016-08-10 18:04:43');


