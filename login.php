<center>
    <?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    //读取用户的输入
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "") {
        echo "<script>alert('用户名不能为空!');</script>";
        echo "正在跳转回登录页……";
        header('Refresh:0.5; url=login.html');
        exit;
    }

    if(strstr($username,"'")||strstr($username,"#")||strstr($username,"--")||strstr($password,"'")||strstr($password,"#")||strstr($password,"--")){
        echo "监测到非法字符，跳转回登录页";
        header('Refresh:0.5; url=login.html');
        exit;
    }

    //使用面向对象进行数据库的连接，在创建对象的时候就自动的连接数据
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');

    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('连接错误' . $mySQLi->connect_error);
    }
    //设置字符集
    $mySQLi->set_charset('utf8');

    $sql = "select*from User where Username='" . $username . "'";

    $result = $mySQLi->query($sql);

    if ($result->num_rows > 0) {
        $res = $result->fetch_array();
        $pass = $res["Password"];
        //验证密码是否正确
        if (md5($password) == $pass) {
            //密码正确，将当前用户名带回
            $_SESSION["username"] = $username;
            //若Recentbook为空，则说明是新用户
            if($res["Recentbook"]==NULL){
                $_SESSION["recentbook"]="当前无任何进行中的单词书";
            }
            else{
                $_SESSION["recentbook"]=$res["Recentbook"];
                $_SESSION["recentword"]=$res["Recentword"];
            }
            $result->free();
            $mySQLi->close();
            echo "登录成功！正在跳转回主页……";
            header('Refresh:0.5; url=index.php');
        } else {
            $result->free();
            $mySQLi->close();
            echo "<script>alert('密码错误,请重试！');</script>";
            echo "正在跳转回登录页……";
            header('Refresh:0.5; url=login.html');
        }
    } else {
        $result->free();
        $mySQLi->close();
        echo "<script>alert('找不到该用户！');</script>";
        echo "正在跳转回登录页……";
        header('Refresh:0.5; url=login.html');
    }
    ?>
    <center>