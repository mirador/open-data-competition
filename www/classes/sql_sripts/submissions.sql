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