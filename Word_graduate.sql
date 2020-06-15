CREATE DATABASE IF NOT EXISTS `Merword`;
USE `Merword`;
DROP TABLE IF EXISTS `Word_graduate`;
CREATE TABLE `Word_graduate` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1;
INSERT INTO Word_graduate(Word,Type,Translation)values("coherent","adj.","一致的；连贯的；清楚明白的；有条理的");
INSERT INTO Word_graduate(Word,Type,Translation)values("comfortable","adj.","舒适的；令人放松的；愉快放松的");
INSERT INTO Word_graduate(Word,Type,Translation)values("charitable","adj.","慈悲为怀的；慈善的；仁慈的；施舍慷慨的");
INSERT INTO Word_graduate(Word,Type,Translation)values("constarin","v.","约束；限制；强迫");
INSERT INTO Word_graduate(Word,Type,Translation)values("curb","v.","控制；抑制；限定；约束");
INSERT INTO Word_graduate(Word,Type,Translation)values("conclusion","n.","结论；推论；结束；终结");
INSERT INTO Word_graduate(Word,Type,Translation)values("conclude","v.","总结；结束；得出结论；断定；决定");