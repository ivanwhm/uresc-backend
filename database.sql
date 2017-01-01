CREATE TABLE `user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`email` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
`username` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`password` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`salt` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned DEFAULT NULL,
`user_updated` int(10) unsigned DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `idx_user_user_created` (`user_created`),
KEY `idx_user_user_updated` (`user_updated`),
CONSTRAINT `fk_user_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_user_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `user_access` (
`user_access_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) unsigned NOT NULL,
`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`ip` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`type` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'C',
PRIMARY KEY (`user_access_id`),
KEY `IDX_USER_ACCESS_USER_ID` (`user_id`),
CONSTRAINT `FK_USER_ACCESS_USER_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `USER` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `department` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`info` text COLLATE utf8_swedish_ci,
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_department_user_created` (`user_created`),
KEY `idx_department_user_updated` (`user_updated`),
CONSTRAINT `fk_department_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_department_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `download_category` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(59) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_download_category_user_created` (`user_created`),
KEY `idx_download_category_user_updated` (`user_updated`),
CONSTRAINT `fk_download_category_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_download_category_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `download` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`category_id` int(11) unsigned NOT NULL,
`address` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_download_category_id` (`category_id`),
KEY `idx_download_user_created` (`user_created`),
KEY `idx_download_user_updated` (`user_updated`),
CONSTRAINT `fk_download_category_id` FOREIGN KEY (`category_id`) REFERENCES `download_category` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_download_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_download_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `gallery_category` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(59) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `Idx_gallery_category_user_created` (`user_created`),
KEY `Idx_gallery_category_user_updated` (`user_updated`),
CONSTRAINT `fk_gallery_category_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_gallery_category_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `gallery` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`category_id` int(11) unsigned NOT NULL,
`address` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_gallery_category_id` (`category_id`),
KEY `idx_gallery_user_created` (`user_created`),
KEY `idx_gallery_user_updated` (`user_updated`),
CONSTRAINT `fk_gallery_category_id` FOREIGN KEY (`category_id`) REFERENCES `gallery_category` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_gallery_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_gallery_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `calendar` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
`status` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_calendar_user_created` (`user_created`),
KEY `idx_calendar_user_updated` (`user_updated`),
CONSTRAINT `fk_calendar_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_calendar_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `event` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`calendar_id` int(11) unsigned NOT NULL,
`name` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`date` date NOT NULL,
`start_time` time NOT NULL,
`end_time` time NOT NULL,
`info` text COLLATE utf8_swedish_ci,
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_event_calendar_id` (`calendar_id`),
KEY `idx_event_user_created` (`user_created`),
KEY `idx_event_user_updated` (`date_updated`),
KEY `fk_event_user_updated` (`user_updated`),
CONSTRAINT `fk_event_calendar_id` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_event_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_event_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `news` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`text` text COLLATE utf8_swedish_ci NOT NULL,
`published` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'N',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_news_user_created` (`user_created`),
KEY `idx_news_user_updated` (`user_updated`),
CONSTRAINT `fk_news_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_news_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;