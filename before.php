<?php
session_start();
$recentword=$_SESSION['recentword'];
$username=$_SESSION['username'];
//连接数据库
$mySQLi = new MySQLi('localhost', 'root', '123456', 'Merword');
//判断数据库是否连接
if ($mySQLi->connect_errno) {
    die('数据库连接错误' . $mySQLi->connect_error);
}
//设置字符集
$mySQLi->set_charset('utf8');
if ($recentword == '1') {
    echo "<script>alert('已到达本书首端!')</script>";
    $mySQLi->close();
    header('Refresh:0; url=learn.php');
} else {
    //否则更新recnetword-1
    $_SESSION['showtranslation'] = '';
    $recentword--;
    $sql = "UPDATE User SET Recentword='" . $recentword . "' WHERE Username='" . $username . "'";
    $result = $mySQLi->query($sql);
    $mySQLi->close();
    header('Refresh:0; url=learn.php');
}
?>