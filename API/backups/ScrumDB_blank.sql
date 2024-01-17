-- Generation time: Mon, 05 Sep 2022 02:03:09 +0200
-- Host: localhost
-- DB name: localscrumdb
/*!40030 SET NAMES UTF8 */;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `isroot` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO `admins` VALUES ('1','admin','admin','1'); 


DROP TABLE IF EXISTS `assist`;
CREATE TABLE `assist` (
  `assist_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `mrole` varchar(2) NOT NULL DEFAULT 'ds',
  PRIMARY KEY (`assist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `assist` VALUES ('1','7739983','1','ds'),
('2','2434658','1','ds'),
('3','9260135','1','ds'); 


DROP TABLE IF EXISTS `estimations`;
CREATE TABLE `estimations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `sprint_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `est_val` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO `estimations` VALUES ('1','1','1','1','1','7739983','4'),
('2','1','1','1','1','2434658','5'),
('3','1','1','1','1','9260135','6'),
('4','1','1','1','2','7739983','5'),
('5','1','1','1','2','2434658','0'),
('6','1','1','1','2','9260135','0'),
('7','1','1','1','3','7739983','0'),
('8','1','1','1','3','2434658','0'),
('9','1','1','1','3','9260135','0'),
('10','1','1','1','4','7739983','0'),
('11','1','1','1','4','2434658','0'),
('12','1','1','1','4','9260135','0'),
('13','1','1','2','5','7739983','0'),
('14','1','1','2','5','2434658','0'),
('15','1','1','2','5','9260135','0'),
('16','1','1','2','6','7739983','0'),
('17','1','1','2','6','2434658','0'),
('18','1','1','2','6','9260135','0'),
('19','1','1','2','7','7739983','0'),
('20','1','1','2','7','2434658','0'),
('21','1','1','2','7','9260135','0'),
('22','1','1','3','8','7739983','0'),
('23','1','1','3','8','2434658','0'),
('24','1','1','3','8','9260135','0'); 


DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(7) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `members` VALUES ('2434658','Jasmine','James'),
('7739983','John','Ferguson'),
('9260135','Justin','Wright'); 


DROP TABLE IF EXISTS `off_tasks`;
CREATE TABLE `off_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL DEFAULT 'New Blank Task',
  `goal` varchar(64) NOT NULL DEFAULT 'Off Project Task',
  `priority` int(11) NOT NULL DEFAULT 3,
  `tskstatus` int(11) NOT NULL DEFAULT 3,
  `duration` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `off_tasks` VALUES ('1','1','1','2434658','New Blank Task','Off Project Task','3','3','1'),
('2','1','1','2434658','New Blank Task','Off Project Task','3','3','1'),
('3','1','1','2434658','New Blank Task','Off Project Task','3','3','1'),
('4','1','1','2434658','New Blank Task','Off Project Task','3','3','2'),
('5','1','1','2434658','New Blank Task','Off Project Task','3','3','1'),
('6','1','1','7739983','New Blank Task','Off Project Task','3','3','1'),
('7','1','1','9260135','New Blank Task','Off Project Task','3','3','1'); 


DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `goal` varchar(256) NOT NULL,
  `descr` text NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `powner` varchar(32) NOT NULL,
  `pstatus` int(8) NOT NULL DEFAULT 1,
  `member_count` int(32) NOT NULL DEFAULT 0,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `projects` VALUES ('1','Project template 1','app testing','description example 1','2022-09-04','2022-11-03','Admin','2','3','0'); 


DROP TABLE IF EXISTS `sprint_member`;
CREATE TABLE `sprint_member` (
  `memto_sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `sprint_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`memto_sp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sprint_member` VALUES ('1','7739983','1','1'),
('2','2434658','1','1'),
('3','9260135','1','1'); 


DROP TABLE IF EXISTS `sprints`;
CREATE TABLE `sprints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `goal` text DEFAULT NULL,
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `dur` int(11) NOT NULL DEFAULT 0,
  `spstatus` int(11) DEFAULT 1,
  `descr` varchar(124) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sprints` VALUES ('1','1','Sprint template 1','Sprint test','2022-09-04','2022-09-17','13','2','Sprint Description example'); 


DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `goal` varchar(64) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `ststatus` int(11) NOT NULL DEFAULT 1,
  `est_dur` int(11) NOT NULL DEFAULT 0,
  `real_dur` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `stories` VALUES ('1','1','1','story 1','story goal 1','1','1','10','9'),
('2','1','1','story 2','story goal 2','2','1','0','0'),
('3','1','1','story 3','story goal 3','1','1','0','0'); 


DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `goal` varchar(64) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `tskstatus` int(11) NOT NULL DEFAULT 1,
  `est_dur` int(11) NOT NULL DEFAULT 0,
  `real_dur` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tasks` VALUES ('1','1','1','1','9260135','New task title','New task Goal','1','1','5','5'),
('2','1','1','1','2434658','New task title','New task Goal','1','1','5','4'),
('3','1','1','1','7739983','New task title','New task Goal','1','1','0','0'),
('4','1','1','1','7739983','New task title','New task Goal','1','1','0','0'),
('5','1','1','2','9260135','New task title','New task Goal','1','1','0','0'),
('6','1','1','2','9260135','New task title','New task Goal','1','1','0','0'),
('7','1','1','2','9260135','New task title','New task Goal','1','1','0','0'),
('8','1','1','3','9260135','New task title','New task Goal','1','1','0','0'); 




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

