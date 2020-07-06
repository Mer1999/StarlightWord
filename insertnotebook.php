<?php
session_start();
$username=$_SESSION["username"];
$Word=$_SESSION["Word"];
$Type=$_SESSION["Type"];
$Translation=$_SESSION["Translation"];
$Soundmark=$_SESSION["Soundmark"];
//连接数据库
$mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');
//判断数据库是否连接
if ($mySQLi->connect_errno) {
    die('数据库连接错误' . $mySQLi->connect_error);
}
//设置字符集
$mySQLi->set_charset('utf8');
$sql="select Wordid from " . $username . " where Word='" . $Word . "'";
$result = $mySQLi->query($sql);
//已存在
if ($result->num_rows > 0) {
    $_SESSION["isInsert"]=2;
} else {
    //不存在则插入
    $sql = "INSERT INTO " . $username . "(Word,Type,Translation,Soundmark) VALUES ('" . $Word . "', '" . $Type . "','" . $Translation . "','" . $Soundmark . "')";
    $result = $mySQLi->query($sql);
    $_SESSION["isInsert"]=1;
}
header('Refresh:0; url=learn.php');
?>