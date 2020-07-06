<?php
session_start();
if($_SESSION['showtranslation']=='showtranslation'){
    $_SESSION['showtranslation']='';
}
else{
    $_SESSION['showtranslation']='showtranslation';
}
header('Refresh:0; url=learn.php');
?>