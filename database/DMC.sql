/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `luckybet` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `luckybet`;

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `v_code` varchar(45) DEFAULT NULL,
  `bet_count` double DEFAULT NULL,
  `bet_status` double DEFAULT NULL,
  `t_status` double DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `admin` (`email`, `name`, `password`, `v_code`, `bet_count`, `bet_status`, `t_status`) VALUES
	('akilagimhana2005@gmail.com', 'Akila Gimhana', 'user@0000', '68b723c029ae6', 10, 1, 1);

CREATE TABLE IF NOT EXISTS `bets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` bigint DEFAULT NULL,
  `invest` double DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `number` int DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bets_user1_idx` (`user_email`),
  KEY `fk_bets_status1_idx` (`status_id`),
  CONSTRAINT `fk_bets_status1` FOREIGN KEY (`status_id`) REFERENCES `b_status` (`id`),
  CONSTRAINT `fk_bets_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `b_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `b_status` (`id`, `name`) VALUES
	(1, 'pending'),
	(2, 'Success');

CREATE TABLE IF NOT EXISTS `b_wallet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `balance` double DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wallet_user1_idx` (`user_email`),
  CONSTRAINT `fk_wallet_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT INTO `b_wallet` (`id`, `balance`, `user_email`) VALUES
	(1, 43.6, 'test@gmail.com');

CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `color` (`id`, `name`) VALUES
	(0, 'NO'),
	(1, 'RED'),
	(2, 'GREEN'),
	(3, 'VIOLET');

CREATE TABLE IF NOT EXISTS `custom_result` (
  `session` bigint NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL DEFAULT '0',
  `status` int DEFAULT NULL,
  PRIMARY KEY (`session`)
) ENGINE=InnoDB AUTO_INCREMENT=100000000151 DEFAULT CHARSET=utf8mb3;

INSERT INTO `custom_result` (`session`, `number`, `status`) VALUES
	(100000000002, 3, 2);

CREATE TABLE IF NOT EXISTS `referral` (
  `id` int NOT NULL AUTO_INCREMENT,
  `refer_code` varchar(45) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_referral_user1_idx` (`user_email`),
  CONSTRAINT `fk_referral_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `result` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profit` double DEFAULT NULL,
  `bets_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_result_bets1_idx` (`bets_id`),
  CONSTRAINT `fk_result_bets1` FOREIGN KEY (`bets_id`) REFERENCES `bets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `r_income` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `from` varchar(50) DEFAULT NULL,
  `to` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

INSERT INTO `r_income` (`id`, `amount`, `date`, `from`, `to`) VALUES
	(1, 1, '2023-11-25 11:07:13', 'test2@gmail.com', 'test@gmail.com'),
	(2, 4, '2023-11-25 11:10:13', 'test2@gmail.com', 'test@gmail.com'),
	(3, 2, '2023-11-25 11:34:39', 'test3@gmail.com', 'test@gmail.com'),
	(4, 1, '2023-11-25 11:53:59', 'test3@gmail.com', 'test@gmail.com'),
	(5, 10, '2023-11-25 15:49:07', 'test@gmail.com4', 'test@gmail.com');

CREATE TABLE IF NOT EXISTS `session` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `result` int NOT NULL,
  `time` datetime NOT NULL,
  `ftime` datetime DEFAULT NULL,
  `color_id` int NOT NULL DEFAULT '0',
  `color_id1` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_session_color_idx` (`color_id`),
  KEY `fk_session_color1_idx` (`color_id1`),
  CONSTRAINT `fk_session_color` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_session_color1` FOREIGN KEY (`color_id1`) REFERENCES `color` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100000000021 DEFAULT CHARSET=utf8mb3;

INSERT INTO `session` (`id`, `price`, `result`, `time`, `ftime`, `color_id`, `color_id1`) VALUES
	(100000000000, 12121.01, 1, '2023-11-24 19:04:49', NULL, 1, 0),
	(100000000001, 37666.78, 8, '2023-11-24 19:07:27', NULL, 1, 0),
	(100000000002, 37666.73, 3, '2023-11-24 19:10:29', NULL, 2, 0),
	(100000000003, 37710.6, 0, '2023-11-24 19:13:30', NULL, 1, 3),
	(100000000004, 37710.67, 7, '2023-11-24 19:16:36', NULL, 2, 0),
	(100000000005, 37770.55, 5, '2023-11-24 19:19:36', NULL, 2, 3),
	(100000000006, 37770.53, 3, '2023-11-24 19:22:36', NULL, 2, 0),
	(100000000007, 37806, 0, '2023-11-24 19:25:37', NULL, 1, 3),
	(100000000008, 37802, 0, '2023-11-24 19:28:38', NULL, 1, 3),
	(100000000009, 37772.93, 3, '2023-11-24 19:31:38', NULL, 2, 0),
	(100000000010, 37708.96, 6, '2023-11-25 15:44:13', '2023-11-25 15:47:13', 1, 0),
	(100000000011, 37704.02, 2, '2023-11-25 15:47:14', '2023-11-25 15:50:14', 1, 0),
	(100000000012, 37687.29, 9, '2023-11-25 15:50:15', '2023-11-25 15:53:15', 2, 0),
	(100000000013, 37698.55, 5, '2023-11-25 15:53:16', '2023-11-25 15:56:16', 2, 3),
	(100000000014, 37688.02, 2, '2023-11-25 15:56:17', '2023-11-25 15:59:17', 1, 0),
	(100000000015, 37681.88, 8, '2023-11-25 15:59:18', '2023-11-25 16:02:18', 1, 0),
	(100000000016, 37681.6, 0, '2023-11-25 16:02:19', '2023-11-25 16:05:19', 1, 3),
	(100000000017, 37674.54, 4, '2023-11-25 16:05:20', '2023-11-25 16:08:20', 1, 0),
	(100000000018, 37659.85, 5, '2023-11-25 16:08:21', '2023-11-25 16:11:21', 2, 3),
	(100000000019, 37659.36, 6, '2023-11-25 16:11:22', '2023-11-25 16:14:22', 1, 0),
	(100000000020, 37653.19, 9, '2023-11-25 16:14:23', '2023-11-25 16:17:23', 2, 0);

CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'Pending'),
	(2, 'Success\r\n'),
	(3, 'Faild');

CREATE TABLE IF NOT EXISTS `transition_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `amount` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `t_type_id` int NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transition_history_user1_idx` (`user_email`),
  KEY `fk_transition_history_t_type1_idx` (`t_type_id`),
  KEY `fk_transition_history_status1_idx` (`status_id`),
  CONSTRAINT `fk_transition_history_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_transition_history_t_type1` FOREIGN KEY (`t_type_id`) REFERENCES `t_type` (`id`),
  CONSTRAINT `fk_transition_history_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `transition_history` (`id`, `user_email`, `amount`, `date`, `path`, `t_type_id`, `status_id`) VALUES
	(2, 'test@gmail.com', 11, '2023-12-01 14:12:21', NULL, 2, 2);

CREATE TABLE IF NOT EXISTS `t_type` (
  `id` int NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `t_type` (`id`, `type`) VALUES
	(1, 'Deposite'),
	(2, 'Withdraw');

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(50) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `v_code` varchar(45) DEFAULT NULL,
  `r_date` datetime DEFAULT NULL,
  `r_code` varchar(45) DEFAULT NULL,
  `u_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_u_status1_idx` (`u_status_id`),
  CONSTRAINT `fk_user_u_status1` FOREIGN KEY (`u_status_id`) REFERENCES `u_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`email`, `name`, `mobile`, `password`, `v_code`, `r_date`, `r_code`, `u_status_id`) VALUES
	('test@gmail.com', '00000000', '0710000000', '123456', '655d200a64104', '2023-11-22 02:54:26', '655d200a64102', 1);

CREATE TABLE IF NOT EXISTS `u_status` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `u_status` (`id`, `name`) VALUES
	(1, 'Active'),
	(2, 'Deactive');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
