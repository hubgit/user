SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_tmp` varchar(255) DEFAULT NULL,
  `email_token` varchar(32) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_tmp` varchar(32) DEFAULT NULL,
  `password_token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `password_token` (`password_token`),
  UNIQUE KEY `email_token` (`email_token`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;