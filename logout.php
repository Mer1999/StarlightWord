<?php
session_start();
$_SESSION['username']='';
header('Refresh:0; url=index.php');
?>