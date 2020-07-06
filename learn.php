<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Starlight单词-学习页面</title>
    <style>
        html {
            background-color: #F5FFFA;
        }


        #top {
            height: 70px;
            
        }
        #root{
            background-color: #008B8B;
        }

        #span_title {
            float: left;
            margin-left: 30px;
            margin-top: 20px;
            font-size: 20px;
            color:#F0F8FF;
            font-weight: bold;
        }

        #span_index,
        #span_logout,
        #span_notebook {
            float: right;
            margin-right: 30px;
            margin-top: 20px;
            font-size: 20px;
            color:#F0F8FF;
            font-weight: bold;
        }

        a:link {
            color: #F0F8FF;
            text-decoration: none
        }

        a:visited {
            color: #F0F8FF;
            text-decoration: none
        }

        a:active {
            text-decoration: none
        }

        a:hover {
            color: #FF6347;
            text-decoration: none
        }

        #span_recentbook {
            margin-top: 30px;
            font-size: 20px;
        }

        #span_word {
            text-align: center;
            display: block;

            font-size: 50px;
        }

        #span_type,
        #span_translation,
        #span_soundmark {
            text-align: center;
            display: block;
            margin-top: 10px;
            font-size: 25px;
        }

        #div_word {
            text-align: center;
        }

        #btn_showtranslation,
        #btn_hidetranslation{
            width: 150px;
            height: 50px;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 23px;
            letter-spacing: 8px;
            text-indent: 8px;
            margin: 30px auto;
            border-radius: 10px;
            cursor: pointer;
        }

        #form_showtranslation {
            width: auto;
            height: 100px;
            text-align: center;
        }


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
            cursor: pointer;
        }


        #btn_showtranslation:hover,
        #btn_hidetranslation:hover,
        #btn_before:hover,
        #btn_next:hover,
        #btn_insertnotebook:hover {
            background-color: aliceblue;
        }




        #div_insertnotebook {
            width:auto;
            text-align: center;
        }

        #div_before {
            position: absolute;
            top: 50%;

            transform: translate(50%, -50%);
        }

        #div_next {
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translate(-150%, -50%);
        }

        #btn_before,
        #btn_next {
            width: 100px;
            height: 100px;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 50px;
            border-radius: 10px;
            cursor: pointer;
        }

        .p_insertnotebook {
            text-align: center;
            font-size: 20px;
        }

        img {
            cursor: pointer;
        }

        #div_main {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <!--js控制单词发音函数-->
    <script>
        window.onload = function() {
            var audio = document.getElementById('pronounce');
            audio.pause(); //打开页面时无音乐
        }

        function play() {
            var audio = document.getElementById('pronounce');
            if (audio.paused) {
                audio.play();
            }
        }
    </script>
</head>

<body>
    <!--顶端栏-->
    <div id="root">

    <div id="top">
        <span id="span_title">学习页面&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当前用户:
            <?php
            header("Content-type: text/html; charset=utf-8");
            session_start();
            $username = $_SESSION["username"];
            echo $username;
            ?></span>
        <span id="span_logout"><a href='logout.php' id='logout'>登出</a></span>
        <span id="span_index"><a href='index.php' id='index'>回到主页</a></span>
        <span id="span_notebook"><a href='vocanotebook.php' id='notebook'>生词本</a></span>
    </div>
    <hr />
        
    </div>
    <?php
    //连接数据库
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');
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
            $_SESSION["showtranslation"] = '';

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
    echo "</span></div>
    ";

    $_SESSION['recentword'] = $recentword;
    
    //获取当前应学单词
    $sql = "select Word, Type, Translation, Soundmark from " . $recentbook . " where Wordid='" . $recentword . "'";
    $result = $mySQLi->query($sql);
    if ($result->num_rows > 0) {
        $res = $result->fetch_array();
        $Word = $res["Word"];
        $_SESSION["Word"]=$Word;
        $Type = $res["Type"];
        $_SESSION["Type"]=$Type;
        $Translation = $res["Translation"];
        $_SESSION["Translation"]=$Translation;
        $Soundmark = $res["Soundmark"];
        $_SESSION["Soundmark"]=$Soundmark;
    }

    //若已经没有返回值则说明已经学完，提示并返回主页
    else {
        $sql = "UPDATE User SET Recentword='1' WHERE Username='" . $username . "'";
        $result = $mySQLi->query($sql);
        echo "
            <script>
                alert('恭喜你已经学完了这本书！');
                window.location.href='index.php';
            </script>";
        exit();
    }
    echo "  
    <div id='div_main'>
        <div id='div_word'>
            <span id='span_word'>" . $Word . "</span>
            <br/>
        ";


    ?>
    <form id='form_showtranslation' name='form_showtranslation' action='showtranslation.php' method='POST'>
        <?php
        //根据SESSION中showtranslation的值显示“显示释义”或“隐藏释义”
        if($_SESSION['showtranslation']==''){
            echo"<input id='btn_showtranslation' type='submit' name='submit_showtranslation' value='显示释义'>";
        }else{
            echo"<input id='btn_hidetranslation' type='submit' name='submit_showtranslation' value='隐藏释义'>";
        }
        ?>
        
    </form>
    <?php
    echo "
    <audio id='pronounce' src='/pronounce/" . $Word . "--_gb_1.mp3'></audio>
    ";
    ?>

    </div>

    <?php
    //点击按钮显示中文释义
    if ($_SESSION['showtranslation'] == 'showtranslation') {
    ?>
        <div id='div_translation'>
            <span id='span_soundmark'>
                <?php echo $Soundmark; ?>
                <img src="/image/pronounce.png" width="23px" onclick="play()" alt="pronounce.png">
            </span>
            <br />
            <span id='span_type'> <?php echo $Type; ?> </span>
            <br />
            <span id='span_translation'><?php echo $Translation ?> </span>
            <br />
        </div>

        <div id='div_insertnotebook'>
            <form id='form_insertnotebook' name='form_insertnotebook' action='insertnotebook.php' method='POST'>
                <input id='btn_insertnotebook' type='submit' name='submit_insertnotebook' value='加入生词本'>
            </form>
        </div>
    <?php
    }
    if($_SESSION["isInsert"]==1){
        echo "<p class='p_insertnotebook'>加入生词本成功~<p>";
    }else if($_SESSION["isInsert"]==2){
        echo "<p class='p_insertnotebook'>生词本中该单词已存在！<p>";
    }
    //阅后即焚
    $_SESSION["isInsert"]=0;
    ?>
    </div>
    <div id='div_before'>
        <form id='form_before' name='form_before' action='before.php' method='POST'>
            <input id='btn_before' type='submit' name='submit_before' value='←'>
        </form>
    </div>

    <div id='div_next'>
        <form id='form_next' name='form_next' action='next.php' method='POST'>
            <input id='btn_next' type='submit' name='submit_next' value='→'>
        </form>
    </div>
    
</body>

</html>