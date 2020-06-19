<center>
    <?php
    header("Content-Type:text/html;charset=UTF-8");
    //检查用户的输入是否符合要求
    $username = $_POST["username"];
    $password = $_POST["passwd"];
    $repasswd = $_POST["repasswd"];
    $type = $_POST["usertype"];
    if ($username == "" || $password == "" || $repasswd == "") {
        echo "<script>alert('用户名或密码不能为空!');</script>";
        echo "正在跳转回注册页……";
        header('Refresh:0.5; url=register.html');
        exit;
    } elseif ($password != $repasswd) {
        echo "<script>alert('两次输入的密码不一致,请重新输入!');</script>";
        echo "正在跳转回注册页……";
        header('Refresh:0.5; url=register.html');
        exit;
    }

    $mySQLi = new MySQLi('localhost', 'root', '123456', 'StarlightWord');
    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('数据库连接错误' . $mySQLi->connect_error);
    }
    //设置字符集
    $mySQLi->set_charset('utf8');

    //检查用户名是否重复
    $sql = "select username from User where Username='" . $username . "'";
    $result = $mySQLi->query($sql);
    if ($result->num_rows > 0) {
        $result->free();
        $mySQLi->close();
        echo "<script>alert('用户名已经被使用!');</script>";
        echo "正在跳转回注册页……";
        header('Refresh:0.5; url=register.html');
        exit;
    }

    //用户数据各项检测均正确,则将用户数据插入数据库
    $sql = "INSERT INTO User(Username,Password) VALUES ('" . $username . "', '" . md5($password) . "')";
    if ($mySQLi->query($sql)) {
        $sqlnew="CREATE TABLE `".$username."` (`Wordid` int NOT NULL AUTO_INCREMENT,`Word` varchar(20) NOT NULL,`Type` varchar(10) NOT NULL,`Translation` varchar(50) NOT NULL,`Soundmark` varchar(50) NOT NULL,PRIMARY KEY(`Wordid`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1";
        if ($mySQLi->query($sqlnew)){
            $mySQLi->close();
            echo "注册成功！正在跳转到登录页……";
            header('Refresh:0.5; url=login.html');
        }
    } else {
        $result->free();
        $mySQLi->close();
        echo "注册失败!请重试!";
        header('Refresh:0.5; url=register.html');
    }

    ?>
    <center>