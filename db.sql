-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.32 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             7.0.0.4369
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table auction.ps_auction
CREATE TABLE IF NOT EXISTS `ps_auction` (
  `id_auction` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) NOT NULL,
  `min_bid_price` int(10) NOT NULL,
  `start_price` float NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `checkout_time` datetime NOT NULL,
  `refresh_time` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 : unpublic, 1 : public, 2 : auctioned',
  `sent_mail` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: No, 1:Yes',
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  PRIMARY KEY (`id_auction`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
