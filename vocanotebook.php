<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Starlight单词-生词本</title>
    <style>
        html {
            background-color: #F0F8FF;
        }
        #div_top {
            height: 50px;
        }

        #span_title {
            float: left;
            margin-left: 30px;
            margin-top: 10px;
            font-size: 20px;
        }

        #span_index,
        #span_logout,
        #span_learn {
            float: right;
            margin-right: 30px;
            margin-top: 10px;
            font-size: 18px;
        }

        table {
            text-align: center;
            margin:20px auto;
        }

        a:link {
            color: #000000;
            text-decoration: none
        }

        a:visited {
            color: #000000;
            text-decoration: none
        }

        a:active {
            text-decoration: none
        }

        a:hover {
            color: #ee2c2c;
            text-decoration: none
        }
        #div_table{
            text-align: center;
        }
    </style>
    
</head>

<body>
    <div id="div_root">
        <div id="div_top">
            <span id="span_title">生词本&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当前用户:
        <?php 
        session_start();
        echo$_SESSION["username"];
        ?></span>
            <span id="span_logout"><a href='logout.php' id='logout'>登出</a></span>
            <span id="span_index"><a href='index.php' id='index'>回到主页</a></span>
            <span id="span_learn"><a href='learn.php' id='learn'>回到学习页面</a></span>
        </div>

        <hr />
        <?php
        //连接数据库
        session_start();
        $username=$_SESSION['username'];
        $mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');
        //判断数据库是否连接
        if ($mySQLi->connect_errno) {
            die('数据库连接错误' . $mySQLi->connect_error);
        }
        //设置字符集
        $mySQLi->set_charset('utf8');

        $str = "select*from ".$username."";

        $result = $mySQLi->query($str);

        echo "<div id='div_table'><table id='table_word' style='border-color: #e6e6fa;' border='1px' cellpadding='5px' cellspacing='0px'><tr>";
        echo "<th>序号</th><th>单词</th><th>音标</th><th>词性</th><th>汉译</th>";
        echo "</tr>";
        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo"<td>".$row["Wordid"]."</td>";
            echo"<td>".$row["Word"]."</td>";
            echo"<td>".$row["Soundmark"]."</td>";
            echo"<td>".$row["Type"]."</td>";
            echo"<td>".$row["Translation"]."</td>";
            echo "</tr>";
        }
        echo "</table></div>";
        $result->free();
        $mySQLi->close();
        ?>
    </div>
</body>

</html>