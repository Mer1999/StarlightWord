<?php
session_start();
$recentword=$_SESSION['recentword'];
$_SESSION['showtranslation'] = '';
$username=$_SESSION['username'];
//连接数据库
$mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');
//判断数据库是否连接
if ($mySQLi->connect_errno) {
    die('数据库连接错误' . $mySQLi->connect_error);
}
//设置字符集
$mySQLi->set_charset('utf8');
$recentword++;
$sql = "UPDATE User SET Recentword='" . $recentword . "' WHERE Username='" . $username . "'";
$result = $mySQLi->query($sql);
$mySQLi->close();
header('Refresh:0; url=learn.php');
?>