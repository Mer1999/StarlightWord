CREATE DATABASE IF NOT EXISTS `Merword`;
USE `Merword`;
DROP TABLE IF EXISTS `Word_cet4`;
CREATE TABLE `Word_cet4` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1;
INSERT INTO Word_cet4(Word,Type,Translation)values("abandon","v.","（不顾责任、义务等）离弃，遗弃，抛弃");
INSERT INTO Word_cet4(Word,Type,Translation)values("abnormal","adj.","不正常的；反常的；变态的；畸形的");
INSERT INTO Word_cet4(Word,Type,Translation)values("aboard","adj.","在船（车）上；上船");
INSERT INTO Word_cet4(Word,Type,Translation)values("absolute","adj.","绝对的，纯粹的");
INSERT INTO Word_cet4(Word,Type,Translation)values("absorb","v.","吸收，使专心");
INSERT INTO Word_cet4(Word,Type,Translation)values("abstract","n.","摘要");
INSERT INTO Word_cet4(Word,Type,Translation)values("abundant","adj.","丰富的，大量的");