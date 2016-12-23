CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User unique code',
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '' COMMENT 'User full name',
  `email` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL COMMENT 'User email address',
  `username` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '' COMMENT 'Username of the user',
  `password` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '' COMMENT 'Password of the user',
  `salt` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '' COMMENT 'Password SALT of the user',
  `status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A' COMMENT 'Status of the record',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of the user was created',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of the last updated',
  `user_created` int(10) unsigned DEFAULT NULL COMMENT 'User that created the record',
  `user_updated` int(10) unsigned DEFAULT NULL COMMENT 'User of the last updated of the record',
  PRIMARY KEY (`user_id`),
  KEY `idx_user_user_created` (`user_created`),
  KEY `idx_user_user_updated` (`user_updated`),
  CONSTRAINT `fk_user_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_user_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `user_access` (
  `user_access_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique code of user`s access',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Unique code of user',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of connection',
  `ip` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '' COMMENT 'IP of user',
  `type` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'C' COMMENT 'Type of the connection',
  PRIMARY KEY (`user_access_id`),
  KEY `IDX_USER_ACCESS_USER_ID` (`user_id`),
  CONSTRAINT `FK_USER_ACCESS_USER_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `department` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_swedish_ci DEFAULT NULL,
  `info` text COLLATE utf8_swedish_ci NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_created` int(10) unsigned NOT NULL,
  `user_updated` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_department_user_created` (`user_created`),
  KEY `idx_department_user_updated` (`user_updated`),
  CONSTRAINT `fk_department_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_department_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;