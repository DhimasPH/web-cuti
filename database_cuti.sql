-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table cuti.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cuti.ci_sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

-- Dumping structure for table cuti.tbl_leave
CREATE TABLE IF NOT EXISTS `tbl_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `date_request` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `change_by` varchar(50) DEFAULT NULL,
  `change_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cuti.tbl_leave: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_leave` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_leave` ENABLE KEYS */;

-- Dumping structure for table cuti.tbl_priviledge
CREATE TABLE IF NOT EXISTS `tbl_priviledge` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cuti.tbl_priviledge: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_priviledge` DISABLE KEYS */;
INSERT INTO `tbl_priviledge` (`id`, `name`) VALUES
	(0, 'Admin'),
	(1, 'Employe');
/*!40000 ALTER TABLE `tbl_priviledge` ENABLE KEYS */;

-- Dumping structure for table cuti.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `priviledge` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cuti.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `password`, `priviledge`) VALUES
	(1, 'Admin', 'admin', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 0),
	(2, 'Dhimas', 'dhimas', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
