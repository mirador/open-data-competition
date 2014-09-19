CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(25) NOT NULL default '',
  `pw` varchar(32) NOT NULL default '',
  `real_name` varchar(32) NOT NULL default '',
  `extra_info` varchar(100) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `tmp_mail` varchar(50) NOT NULL default '',
  `access_level` tinyint(4) NOT NULL default '0',
  `active` enum('y','n','b') NOT NULL default 'n',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`login`),
  UNIQUE KEY `mail` (`email`)
) ENGINE=MyISAM;

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL auto_increment,
  `users_id` int(11) NOT NULL default '0',
  `language` char(2) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `postcode` varchar(15) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `country` char(2) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `fax` varchar(50) NOT NULL default '',
  `homepage` varchar(100) NOT NULL default '',
  `notes` text NOT NULL,
  `user_1` varchar(100) NOT NULL default '',
  `user_2` varchar(100) NOT NULL default '',
  `user_3` varchar(100) NOT NULL default '',
  `user_4` varchar(100) NOT NULL default '',
  `user_5` varchar(100) NOT NULL default '',
  `user_6` varchar(100) NOT NULL default '',
  `last_change` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `users_id` (`users_id`)
) ENGINE=MyISAM;

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `db` varchar(255) NOT NULL,
  `var1` varchar(255) NOT NULL,
  `var2` varchar(255) NOT NULL,
  `ranges` varchar(8000) DEFAULT NULL,
  `history` longtext,
  `selected` bool DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL auto_increment,
  `iso` char(2) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

INSERT INTO `countries` VALUES (NULL, 'AR', 'Argentina');
INSERT INTO `countries` VALUES (NULL, 'AU', 'Australia');
INSERT INTO `countries` VALUES (NULL, 'AT', 'Austria');
INSERT INTO `countries` VALUES (NULL, 'BS', 'Bahamas');
INSERT INTO `countries` VALUES (NULL, 'BE', 'Belgium');
INSERT INTO `countries` VALUES (NULL, 'BO', 'Bolivia');
INSERT INTO `countries` VALUES (NULL, 'BR', 'Brazil');
INSERT INTO `countries` VALUES (NULL, 'CA', 'Canada');
INSERT INTO `countries` VALUES (NULL, 'CL', 'Chile');
INSERT INTO `countries` VALUES (NULL, 'CN', 'China');
INSERT INTO `countries` VALUES (NULL, 'CO', 'Colombia');
INSERT INTO `countries` VALUES (NULL, 'CR', 'Costa Rica');
INSERT INTO `countries` VALUES (NULL, 'HR', 'Croatia');
INSERT INTO `countries` VALUES (NULL, 'CU', 'Cuba');
INSERT INTO `countries` VALUES (NULL, 'CZ', 'Czech, Rep.');
INSERT INTO `countries` VALUES (NULL, 'DK', 'Denmark');
INSERT INTO `countries` VALUES (NULL, 'DO', 'Dominican, Rep.');
INSERT INTO `countries` VALUES (NULL, 'EC', 'Ecuador');
INSERT INTO `countries` VALUES (NULL, 'EG', 'Egypt');
INSERT INTO `countries` VALUES (NULL, 'SV', 'El Salvador');
INSERT INTO `countries` VALUES (NULL, 'FI', 'Finland');
INSERT INTO `countries` VALUES (NULL, 'FR', 'France');
INSERT INTO `countries` VALUES (NULL, 'DE', 'Germany');
INSERT INTO `countries` VALUES (NULL, 'GB', 'Great Britain');
INSERT INTO `countries` VALUES (NULL, 'GR', 'Greece');
INSERT INTO `countries` VALUES (NULL, 'GT', 'Guatemala');
INSERT INTO `countries` VALUES (NULL, 'HN', 'Honduras');
INSERT INTO `countries` VALUES (NULL, 'HK', 'Hong Kong');
INSERT INTO `countries` VALUES (NULL, 'IN', 'India');
INSERT INTO `countries` VALUES (NULL, 'IE', 'Ireland');
INSERT INTO `countries` VALUES (NULL, 'IL', 'Israel');
INSERT INTO `countries` VALUES (NULL, 'IT', 'Italy');
INSERT INTO `countries` VALUES (NULL, 'JM', 'Jamaica');
INSERT INTO `countries` VALUES (NULL, 'JP', 'Japan');
INSERT INTO `countries` VALUES (NULL, 'LU', 'Luxembourg');
INSERT INTO `countries` VALUES (NULL, 'MX', 'Mexico');
INSERT INTO `countries` VALUES (NULL, 'MA', 'Morocco');
INSERT INTO `countries` VALUES (NULL, 'NL', 'Netherlands');
INSERT INTO `countries` VALUES (NULL, 'NZ', 'New Zealand');
INSERT INTO `countries` VALUES (NULL, 'NI', 'Nicaragua');
INSERT INTO `countries` VALUES (NULL, 'NG', 'Nigeria');
INSERT INTO `countries` VALUES (NULL, 'NO', 'Norway');
INSERT INTO `countries` VALUES (NULL, 'PY', 'Paraguay');
INSERT INTO `countries` VALUES (NULL, 'PE', 'Peru');
INSERT INTO `countries` VALUES (NULL, 'PL', 'Poland');
INSERT INTO `countries` VALUES (NULL, 'PT', 'Portugal');
INSERT INTO `countries` VALUES (NULL, 'PR', 'Puerto Rico');
INSERT INTO `countries` VALUES (NULL, 'RU', 'Russia');
INSERT INTO `countries` VALUES (NULL, 'SA', 'Saudi Arabia');
INSERT INTO `countries` VALUES (NULL, 'ZA', 'South Africa');
INSERT INTO `countries` VALUES (NULL, 'ES', 'Spain');
INSERT INTO `countries` VALUES (NULL, 'SE', 'Sweden');
INSERT INTO `countries` VALUES (NULL, 'CH', 'Switzerland');
INSERT INTO `countries` VALUES (NULL, 'TW', 'Taiwan');
INSERT INTO `countries` VALUES (NULL, 'TR', 'Turkey');
INSERT INTO `countries` VALUES (NULL, 'US', 'United States');
INSERT INTO `countries` VALUES (NULL, 'UY', 'Uruguay');
INSERT INTO `countries` VALUES (NULL, 'VE', 'Venezuela');
INSERT INTO `countries` VALUES (999999, '', 'Other...');


