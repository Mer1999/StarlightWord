CREATE DATABASE IF NOT EXISTS `Merword`;
USE `Merword`;
DROP TABLE IF EXISTS `Word_cet6`;
CREATE TABLE `Word_cet6` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1;
INSERT INTO Word_cet6(Word,Type,Translation)values("bachelor","n.","未婚男子；学士");
INSERT INTO Word_cet6(Word,Type,Translation)values("badge","n.","徽章，像章，标志");
INSERT INTO Word_cet6(Word,Type,Translation)values("baffle","v.","使挫折");
INSERT INTO Word_cet6(Word,Type,Translation)values("bald","adj.","秃头的；无毛的");
INSERT INTO Word_cet6(Word,Type,Translation)values("ballet","n.","芭蕾舞；舞剧");
INSERT INTO Word_cet6(Word,Type,Translation)values("ban","n.","禁令");
INSERT INTO Word_cet6(Word,Type,Translation)values("bandage","n.","绷带，包带");