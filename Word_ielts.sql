CREATE DATABASE IF NOT EXISTS `Merword`;
USE `Merword`;
DROP TABLE IF EXISTS `Word_ielts`;
CREATE TABLE `Word_ielts` (
  `Wordid` int NOT NULL AUTO_INCREMENT,
  `Word` varchar(20) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Translation` varchar(50) NOT NULL,
   PRIMARY KEY(`Wordid`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1;
INSERT INTO Word_ielts(Word,Type,Translation)values("discard","v.","丢弃；抛弃；放弃");
INSERT INTO Word_ielts(Word,Type,Translation)values("desert","v.","丢开；抛弃");
INSERT INTO Word_ielts(Word,Type,Translation)values("decorate","v.","授予（某人）勋章；装饰；装点；点缀；布置");
INSERT INTO Word_ielts(Word,Type,Translation)values("denominate","v.","给……命名；称呼……为");
INSERT INTO Word_ielts(Word,Type,Translation)values("disputable","adj.","有讨论余地的；真假可疑的");
INSERT INTO Word_ielts(Word,Type,Translation)values("divide","v.","分；划分；分开；分配；除；意见分歧；分裂");
INSERT INTO Word_ielts(Word,Type,Translation)values("dividen","n.","被除数；股息；红利；附属品；发给参加保险投保人的盈余比例份额");