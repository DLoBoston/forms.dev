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

-- Dumping structure for table forms.account_form
DROP TABLE IF EXISTS `account_form`;
CREATE TABLE IF NOT EXISTS `account_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `acct_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table forms.account_form: ~0 rows (approximately)
/*!40000 ALTER TABLE `account_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_form` ENABLE KEYS */;

-- Dumping structure for table forms.form_element
DROP TABLE IF EXISTS `form_element`;
CREATE TABLE IF NOT EXISTS `form_element` (
  `form_element_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `required` char(1) NOT NULL DEFAULT 'f',
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`form_element_id`),
  KEY `FK_form_element_account_form` (`form_id`),
  CONSTRAINT `FK_form_element_account_form` FOREIGN KEY (`form_id`) REFERENCES `account_form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table forms.form_element: ~0 rows (approximately)
/*!40000 ALTER TABLE `form_element` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_element` ENABLE KEYS */;

-- Dumping structure for table forms.form_submission
DROP TABLE IF EXISTS `form_submission`;
CREATE TABLE IF NOT EXISTS `form_submission` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `FK_form_submission_account_form` (`form_id`),
  CONSTRAINT `FK_form_submission_account_form` FOREIGN KEY (`form_id`) REFERENCES `account_form` (`form_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table forms.form_submission: ~0 rows (approximately)
/*!40000 ALTER TABLE `form_submission` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_submission` ENABLE KEYS */;

-- Dumping structure for table forms.form_submission_element_value
DROP TABLE IF EXISTS `form_submission_element_value`;
CREATE TABLE IF NOT EXISTS `form_submission_element_value` (
  `submission_id` int(11) NOT NULL,
  `form_element_id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  KEY `form_element_id` (`form_element_id`,`submission_id`),
  KEY `FK_form_submission_element_value_form_submission` (`submission_id`),
  CONSTRAINT `FK_form_submission_element_value_form_submission` FOREIGN KEY (`submission_id`) REFERENCES `form_submission` (`submission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_form_submission_element_value_form_element` FOREIGN KEY (`form_element_id`) REFERENCES `form_element` (`form_element_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table forms.form_submission_element_value: ~0 rows (approximately)
/*!40000 ALTER TABLE `form_submission_element_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_submission_element_value` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
