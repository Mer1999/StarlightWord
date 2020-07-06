CREATE DATABASE IF NOT EXISTS `StarlightWord`;
USE `StarlightWord`;
DROP TABLE IF EXISTS `Word_graduate`;
CREATE TABLE `Word_graduate` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
  `Soundmark` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
INSERT INTO Word_graduate(Word,Type,Translation,Soundmark)values("coherent","adj.","一致的；连贯的；清楚明白的；有条理的","/koʊˈhɪrənt/"),
("comfortable","adj.","舒适的；令人放松的；愉快放松的","/ˈkʌmftəbl,ˈkʌmfərtəbl/"),
("charitable","adj.","慈悲为怀的；慈善的；仁慈的；施舍慷慨的","/ˈtʃærətəbl/"),
("compel","v.","强迫，迫使","/kəmˈpel/"),
("curb","v.","控制；抑制；限定；约束","/kɜːrb/"),
("crack","v.","破裂；砸开；（使）发出爆裂声","/kræk/"),
("commit","v.","犯（罪）；做（错事）；把……托付给；保证","/kəˈmɪt/");