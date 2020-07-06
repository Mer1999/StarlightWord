CREATE DATABASE IF NOT EXISTS `StarlightWord`;
USE `StarlightWord`;
DROP TABLE IF EXISTS `Word_cet4`;
CREATE TABLE `Word_cet4` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
  `Soundmark` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
INSERT INTO Word_cet4(Word,Type,Translation,Soundmark)values("abandon","v.","（不顾责任、义务等）离弃，遗弃，抛弃","/əˈbændən/"),
("abnormal","adj.","不正常的；反常的；变态的；畸形的","/æbˈnɔːrml/"),
("aboard","adj.","在船（车）上；上船","/əˈbɔːrd/"),
("absolute","adj.","绝对的，纯粹的","/ˈæbsəluːt/"),
("absorb","v.","吸收，使专心","/əbˈzɔːrb,əbˈsɔːrb/"),
("abstract","n.","摘要","/ˈæbstrækt/"),
("abundant","adj.","丰富的，大量的","/əˈbʌndənt/");