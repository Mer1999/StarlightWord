CREATE DATABASE IF NOT EXISTS `StarlightWord`;
USE `StarlightWord`;
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `Userid` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Recentbook` varchar(20),
  `Recentword` int,
   PRIMARY KEY(`Userid`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1;