CREATE TABLE `user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`email` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
`password` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`can_access_settings` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'N',
`language` varchar(5) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'en-US',
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
`session_id` varchar(128) COLLATE utf8_swedish_ci NOT NULL,
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
`cover_filename` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
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

CREATE TABLE `gallery_files` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`gallery_id` int(11) unsigned NOT NULL,
`filename` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`cover` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'N',
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_gallery_files_gallery_id` (`gallery_id`),
KEY `idx_gallery_files_user_created` (`user_created`),
KEY `idx_gallery_files_user_updated` (`user_updated`),
CONSTRAINT `fk_gallery_files_gallery_id` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_gallery_files_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_gallery_files_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
`start_date` date NOT NULL,
`end_date` date NOT NULL,
`all_day` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'N',
`start_time` time DEFAULT NULL,
`end_time` time DEFAULT NULL,
`place` text COLLATE utf8_swedish_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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

CREATE TABLE `settings` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`phrase` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`phrase_author` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`page_title` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_updated` int(10) unsigned NOT NULL,
`phone_mask` varchar(20) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`login_logo_image` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`default_business_hours` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `idx_settings_user_updated` (`user_updated`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `contact` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`contact_name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
`contact_email` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`contact_message` text COLLATE utf8_swedish_ci NOT NULL,
`contact_date` datetime NOT NULL,
`contact_ip` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`answer_message` text COLLATE utf8_swedish_ci,
`answer_date` datetime DEFAULT NULL,
`answer_user_id` int(10) unsigned DEFAULT NULL,
`answer_sent` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'N',
PRIMARY KEY (`id`),
KEY `idx_contact_answer_user_id` (`answer_user_id`),
CONSTRAINT `fk_contact_answer_user_id` FOREIGN KEY (`answer_user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `centre` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`address` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`neighborhood` varchar(100) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`city` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`state` varchar(2) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`phone` varchar(20) COLLATE utf8_swedish_ci DEFAULT '',
`email` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
`business_hours` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
`calendar_id` int(11) unsigned DEFAULT NULL,
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_centre_user_created` (`user_created`),
KEY `idx_centre_user_updated` (`user_updated`),
KEY `fk_centre_calendar_id` (`calendar_id`),
CONSTRAINT `fk_centre_calendar_id` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_centre_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_centre_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `page` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(150) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`text` text COLLATE utf8_swedish_ci,
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_page_user_created` (`user_created`),
KEY `idx_page_user_updated` (`user_updated`),
CONSTRAINT `fk_page_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_page_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `menu` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`icon` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
`name` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
`visible` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'Y',
`order` int(2) unsigned NOT NULL,
`type` char(1) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'M',
`page_id` int(11) unsigned DEFAULT NULL,
`date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_created` int(10) unsigned NOT NULL,
`user_updated` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `idx_menu_page_id` (`page_id`),
KEY `idx_menu_user_created` (`user_created`),
KEY `idx_menu_user_updated` (`user_updated`),
CONSTRAINT `fk_menu_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_menu_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
CONSTRAINT `fk_menu_user_updated` FOREIGN KEY (`user_updated`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;