<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>欢迎来到Starlight单词</title>
    <style>
        html {
            background-color: #F5FFFA;
        }
        #root{
            background-color: #008B8B;
        }
        #top {
            height: 70px;
           
        }

        #recentbook {
            height: 50px;
        }

        #continuelearn {
            height: 50px;
            text-align: center;
        }

        #span_register,
        #span_login,
        #span_divide,
        #span_username {
            float: left;
            margin-left: 30px;
            margin-top: 20px;
            font-size: 20px;
            color:#F0F8FF;
            font-weight: bold;
        }

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

        #span_welcome {
            text-align: center;
            display: block;
            font-size: 40px;
            letter-spacing: 5px;
        }

        #span_madebymer,
        #span_choosebook {
            text-align: center;
            display: block;
            margin: 20px auto;
            font-size: 20px;
        }

        #span_recentbook {
            text-align: center;
            display: block;

            font-size: 30px;
        }

        #select_recentbook,
        #select_changebook {
            width: 200px;
            height: 40px;
            font-size: 20px;
            text-align: center;
            text-align-last: center;
            margin-top: 40px;
        }

        #select_recentbook {
            margin-top: 20px;
        }

        #btn_startlearn,
        #btn_continue,
        #btn_changebook {
            width: 250px;
            height: 70px;
            background-color: #FFFFFF;
            text-align: center;
            font-size: 23px;
            letter-spacing: 8px;
            text-indent: 8px;
            margin: 30px auto;
            border-radius: 10px;
            cursor: pointer;
        }

        #btn_startlearn:hover {
            background-color: aliceblue;
        }

        #btn_continue:hover {
            background-color: aliceblue;
        }

        #btn_changebook:hover {
            background-color: aliceblue;
        }

        #btn_continue {
            margin-bottom: 50px;
        }

        #hr2 {
            width: 500px;
        }

        #div_continuelearn {
            height: auto;
            text-align: center;
        }

        #form_changebook {
            text-align: center;
        }

        #form_choosebook {
            text-align: center;
        }

        #div_nologin {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #div_main {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
    </style>
</head>

<body>
    <div id="root">
        <div id="top">
            <?php
            session_start();
            if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
                $username = $_SESSION['username'];
                echo "<span id='span_username'>欢迎用户：" . $username . "</span>";
                echo "<span id='span_logout'><a href='logout.php' id='logout'>登出</a></span>";
                echo "<span id='span_notebook'><a href='vocanotebook.php' id='notebook'>生词本</a></span>";
            } else {
                echo "<span id='span_login'><a href='login.html'>登录</a></span><span id='span_divide'>|</span>";
                echo "<span id='span_register'><a href='register.html'>注册</a></span>";
            }
            ?>
        </div>
        <hr />

        <?php
        //已经登录
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
            echo "
            <div id='div_main'>
                <div id='recentbook'>
                    <span id='span_recentbook'>当前单词书：";

            switch ($_SESSION['recentbook']) {
                case "Word_cet4":
                    echo "四级词汇";
                    break;
                case "Word_cet6":
                    echo "六级词汇";
                    break;
                case "Word_graduate":
                    echo "考研词汇";
                    break;
                case "Word_ielts":
                    echo "雅思词汇";
                    break;
                default:
                    echo $_SESSION["recentbook"];
            }
            echo "  </span>
                </div>";

            //若当前无进行中的单词书
            if ($_SESSION['recentbook'] == "当前无任何进行中的单词书") {
        ?>
                <div id='choosebook'>
                    <span id='span_choosebook'>选择单词书：</span>
                    <form id='form_choosebook' action='learn.php' name='recentbook' method='POST'>
                        <select name='recentbook' id='select_recentbook'>
                            <option value='Word_cet4'>四级词汇</option>
                            <option value='Word_cet6'>六级词汇</option>
                            <option value='Word_graduate'>考研词汇</option>
                            <option value='Word_ielts'>雅思词汇</option>
                        </select><br />
                        <input id='btn_startlearn' type='submit' name='startlearn' value='开始学习'>
                    </form>
                </div>
            <?php
            } else {
                //若有进行的单词书，则提供继续学习或者修改渠道
            ?>
                <div id='div_continuelearn'>
                    <a href='learn.php'>
                        <button id='btn_continue'>继续学习</button>
                    </a>
                    <hr/ id='hr2'>
                </div>
                <div id='changebook'>
                    <form id='form_changebook' action='learn.php' name='changebook' method='POST'>
                        <select name='changebook' id='select_changebook'>
                            <option value='Word_cet4'>四级词汇</option>
                            <option value='Word_cet6'>六级词汇</option>
                            <option value='Word_graduate'>考研词汇</option>
                            <option value='Word_ielts'>雅思词汇</option>
                        </select><br />
                        <input id='btn_changebook' type='submit' name='change' value='修改单词书'>
                    </form>
                </div>

            <?php
            }
            ?>
            </div>
        <?php
        }

        //未登录
        else {
        ?>
        
        <div id='div_nologin'>
            <span id='span_welcome'>欢迎来到Starlight单词！</span><br />
            <span id='span_madebymer'>Made by 1752117 牟容昊</span>
        </div>

        <?php
        }
        ?>

    </div>

</body>

</html>