-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.46-0ubuntu0.14.04.2 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for forms
CREATE DATABASE IF NOT EXISTS `forms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forms`;

-- Dumping structure for table forms.custom_forms
DROP TABLE IF EXISTS `custom_forms`;
CREATE TABLE IF NOT EXISTS `custom_forms` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `acct_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table forms.form_elements
DROP TABLE IF EXISTS `form_elements`;
CREATE TABLE IF NOT EXISTS `form_elements` (
  `form_element_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `guidelines` varchar(250) NOT NULL,
  `default_value` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`form_element_id`),
  KEY `FK_form_elements_custom_forms` (`form_id`),
  CONSTRAINT `FK_form_elements_custom_forms` FOREIGN KEY (`form_id`) REFERENCES `custom_forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table forms.form_element_options
DROP TABLE IF EXISTS `form_element_options`;
CREATE TABLE IF NOT EXISTS `form_element_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_element_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_form_element_options_form_elements` (`form_element_id`),
  CONSTRAINT `FK_form_element_options_form_elements` FOREIGN KEY (`form_element_id`) REFERENCES `form_elements` (`form_element_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=745 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table forms.form_submissions
DROP TABLE IF EXISTS `form_submissions`;
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `FK_form_submissions_custom_forms` (`form_id`),
  CONSTRAINT `FK_form_submissions_custom_forms` FOREIGN KEY (`form_id`) REFERENCES `custom_forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table forms.form_submission_values
DROP TABLE IF EXISTS `form_submission_values`;
CREATE TABLE IF NOT EXISTS `form_submission_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_id` int(11) NOT NULL,
  `form_element_id` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_form_submission_values_form_elements` (`form_element_id`),
  KEY `FK_form_submission_values_form_submissions` (`submission_id`),
  CONSTRAINT `FK_form_submission_values_form_elements` FOREIGN KEY (`form_element_id`) REFERENCES `form_elements` (`form_element_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_form_submission_values_form_submissions` FOREIGN KEY (`submission_id`) REFERENCES `form_submissions` (`submission_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
