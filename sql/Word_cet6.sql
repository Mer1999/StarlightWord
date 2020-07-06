CREATE DATABASE IF NOT EXISTS `StarlightWord`;
USE `StarlightWord`;
DROP TABLE IF EXISTS `Word_cet6`;
CREATE TABLE `Word_cet6` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
  `Soundmark` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
INSERT INTO Word_cet6(Word,Type,Translation,Soundmark)values("bachelor","n.","未婚男子；学士","/ˈbætʃələr/"),
("badge","n.","徽章，像章，标志","/bædʒ/"),
("baffle","v.","使挫折","/ˈbæfl/"),
("bald","adj.","秃头的；无毛的","/bɔːld/"),
("ballet","n.","芭蕾舞；舞剧","/bæˈleɪ/"),
("ban","n.","禁令","/bæn/"),
("bandage","n.","绷带，包带","/ˈbændɪdʒ/");