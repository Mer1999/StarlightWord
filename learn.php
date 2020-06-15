<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Starlight单词-学习页面</title>
    <style>
        html {
            background-color: #F0F8FF;
        }

        #top {
            height: 50px;
        }

        #span_title {
            float: left;
            margin-left: 30px;
            margin-top: 10px;
            font-size: 18px;
        }

        #span_index,
        #span_logout,
        #span_notebook {
            float: right;
            margin-right: 30px;
            margin-top: 10px;
            font-size: 18px;
        }

        #span_title {
            font-size: 20px;
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

        #span_recentbook {
            margin-top: 30px;
            font-size: 20px;
        }

        #span_word {
            text-align: center;
            display: block;
            margin-top: 100px;
            font-size: 50px;
        }

        #span_type,
        #span_translation {
            text-align: center;
            display: block;
            margin-top: 10px;
            font-size: 25px;
        }

        #div_word {
            text-align: center;
            width: auto;
        }

        #btn_showtranslation {
            width: 150px;
            height: 50px;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 23px;
            letter-spacing: 8px;
            text-indent: 8px;
            margin: 30px auto;
            border-radius: 10px;
        }

        #form_showtranslation {
            width: auto;
            height: 100px;
            text-align: center;
        }

        #btn_before,
        #btn_next,
        #btn_insertnotebook {
            width: 180px;
            height: 50px;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 23px;
            letter-spacing: 8px;
            text-indent: 8px;
            margin: 30px auto;
            border-radius: 10px;
        }

        #table_btn {
            width: 100%;
            text-align: center;
        }

        #div_before,
        #div_next,
        #div_insertnotebook {
            text-align: center;
        }

        .p_insertnotebook {
            text-align: center;
            font-size:20px;
        }
    </style>
</head>

<body>
    <div id="top">
        <span id="span_title">学习页面</span>
        <span id="span_logout"><a href='logout.php' id='logout'>登出</a></span>
        <span id="span_index"><a href='index.php' id='index'>回到主页</a></span>
        <span id="span_notebook"><a href='vocanotebook.php' id='notebook'>生词本</a></span>
    </div>
    <hr />

    <?php
    session_start();
    $username = $_SESSION["username"];

    //连接数据库
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'Merword');
    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('数据库连接错误' . $mySQLi->connect_error);
    }
    //设置字符集
    $mySQLi->set_charset('utf8');

    //无正在学习的单词书
    if ($_SESSION['recentbook'] == "当前无任何进行中的单词书") {
        $recentbook = $_POST["recentbook"];
        $_SESSION["recentbook"] = $recentbook;

        //将当前用户学习单词书更新
        $sql = "UPDATE User SET Recentbook='" . $recentbook . "' WHERE Username='" . $username . "'";
        $result = $mySQLi->query($sql);
        $sql = "UPDATE User SET Recentword='1' WHERE Username='" . $username . "'";
        $result = $mySQLi->query($sql);
        $recentword = 1;
    }
    //已有原配
    else {
        //修改单词书
        if ($_POST["changebook"] != NULL) {
            $recentbook = $_POST["changebook"];
            $_SESSION["recentbook"] = $recentbook;
            $_SESSION["showtranslation"]='';

            //将当前用户学习单词书更新
            $sql = "UPDATE User SET Recentbook='" . $recentbook . "' WHERE Username='" . $username . "'";
            $result = $mySQLi->query($sql);
            $sql = "UPDATE User SET Recentword='1' WHERE Username='" . $username . "'";
            $result = $mySQLi->query($sql);
            $recentword = 1;
        }
        //不改继续学习
        else {
            $recentbook = $_SESSION["recentbook"];
            $_SESSION['showtranslation']='';
            $sql = "SELECT Recentword from User where Username='" . $username . "'";
            $result = $mySQLi->query($sql);
            if ($result->num_rows > 0) {
                $res = $result->fetch_array();
                $recentword = $res["Recentword"];
            }
        }
    }
    echo "<div><span id='span_recentbook'>当前单词书：";
    switch ($recentbook) {
        case "Word_cet4":
            echo "《四级词汇》";
            break;
        case "Word_cet6":
            echo "《六级词汇》";
            break;
        case "Word_graduate":
            echo "《考研词汇》";
            break;
        case "Word_ielts":
            echo "《雅思词汇》";
            break;
        default:
            echo $_SESSION["recentbook"];
    }
    echo "</span></div>";
    //echo "当前单词";
    //echo $recentword;

    //获取当前应学单词
    $sql = "select Word, Type, Translation from " . $recentbook . " where Wordid='" . $recentword . "'";
    $result = $mySQLi->query($sql);
    if ($result->num_rows > 0) {
        $res = $result->fetch_array();
        $Word = $res["Word"];
        $Type = $res["Type"];
        $Translation = $res["Translation"];
    }

    //若已经没有返回值则说明已经学完，强制返回主页
    else {
        $sql = "UPDATE User SET Recentword='1' WHERE Username='" . $username . "'";
        $result = $mySQLi->query($sql);
        echo "<script>alert('恭喜你已经学完了这本书！')</script>";
        header('Refresh:0; url=index.php');
    }
    echo "  <div id='div_word'>
                <span id='span_word'>" . $Word . "</span>
                <br/>
        ";
    ?>
    <form id='form_showtranslation' name='form_showtranslation' action='' method='POST'>
        <input id='btn_showtranslation' type='submit' name='submit_showtranslation' value='显示释义'>
        <input name="showtranslation" type="hidden" id="showtranslation" value="showtranslation">
    </form>
    </div>
    <?php
    $_SESSION['recentword'] = $recentword;
    //权宜之计
    //点击按钮显示中文释义
    if ($_SESSION['showtranslation'] == 'showtranslation' || $_POST['showtranslation'] == 'showtranslation') {
        if ($_POST['showtranslation'] == 'showtranslation') {
            $_SESSION['showtranslation'] = $_POST['showtranslation'];
        } ?>

        <div id='div_translation'>
            <span id='span_type'> <?php echo $Type ?> </span>
            <br />
            <span id='span_translation'><?php echo $Translation ?> </span>
            <br />
        </div>
        <table id='table_btn'>
            <tr>
                <td>

                    <div id='div_before'>
                        <form id='form_before' name='form_before' action='before.php' method='POST'>
                            <input id='btn_before' type='submit' name='submit_before' value='上一个'>
                        </form>
                    </div>
                </td>
                <td>
                    <div id='div_insertnotebook'>
                        <form id='form_insertnotebook' name='form_insertnotebook' action='' method='POST'>
                            <input id='btn_insertnotebook' type='submit' name='submit_insertnotebook' value='加入生词本'>
                            <input name='insertnotebook' type='hidden' id='insertnotebook' value='insertnotebook'>
                        </form>
                    </div>
                </td>
                <td>
                    <div id='div_next'>
                        <form id='form_next' name='form_next' action='next.php' method='POST'>
                            <input id='btn_next' type='submit' name='submit_next' value='下一个'>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    <?php
    }
    //点击按钮显示下一个单词
    //$before = $_POST['before'];
    //$next = $_POST['next'];
    $insertnotebook = $_POST['insertnotebook'];
    //下一个单词
    /*if ($next == 'next') {
        $_SESSION['showtranslation'] = '';
        $recentword++;
        $sql = "UPDATE User SET Recentword='" . $recentword . "' WHERE Username='" . $username . "'";
        $result = $mySQLi->query($sql);
        $result->free();
        $mySQLi->close();
        header('Refresh:0; url=learn.php');
    }*/
    //上一个单词
    /*if ($before == 'before') {
        //已是第一个，无法向前
        if ($recentword == '1') {
            echo "<script>alert('已到达本书首端!')</script>";
        } else {
            //否则更新recnetword-1
            $_SESSION['showtranslation'] = '';
            $recentword--;
            $sql = "UPDATE User SET Recentword='" . $recentword . "' WHERE Username='" . $username . "'";
            $result = $mySQLi->query($sql);
            $result->free();
            $mySQLi->close();
            header('Refresh:0; url=learn.php');
        }
    }*/
    //将词汇插入生词本-Notebook表
    if ($insertnotebook == 'insertnotebook') {
        //查看生词本中是否存在此单词
        $sql = "select Wordid from ".$username." where Word='" . $Word . "'";
        $result = $mySQLi->query($sql);
        //已存在
        if ($result->num_rows > 0) {
            //$_SESSION['showtranslation'] = '';
            echo "<p class='p_insertnotebook'>生词本中该单词已存在！<p>";
        } else {
            //不存在则插入
            $sql = "INSERT INTO ".$username."(Word,Type,Translation) VALUES ('" . $Word . "', '" . $Type . "','" . $Translation . "')";
            $result = $mySQLi->query($sql);
            //$_SESSION['showtranslation'] = '';
            echo "<p class='p_insertnotebook'>加入生词本成功~<p>";
        }
    }
    ?>
</body>

</html>