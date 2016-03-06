<?php
session_name( "Zjmainstay" );
session_start();
$ok_to_browse = ( $_SESSION['admin_user'] == "Y" );
if (!$ok_to_browse ) {
//验证账号密码
    if(empty($_POST['zhanghu']))
    {
        echo "
            <form action='guanliyuandenglu.php' method='post'>
            用户名:
            <input type='text' name='zhanghu' ><br />
            密码：
            <input type='text' name='mima' ><br />
            <input type='submit' name='submit' value='提交'>
            </form>";
    }
    else
    {
        $boo=false;//没有serson或帐号密码错误;
        //$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
        $con = mysql_connect("localhost","root","");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("app_ligy118", $con);
        $result = mysql_query("SELECT * FROM guanliyuan");
        while($row = mysql_fetch_array($result))
        {
            if($row['zhanghu']==$_POST["zhanghu"]&&$row['mima']==$_POST["mima"]) {
                $boo=true;
            }
        }
        mysql_close($con);
    }

    if($boo)
    {
        $_SESSION['admin_user'] = 'Y';
        session_write_close();
    }
    else
    {
        echo "
            <form action='guanliyuandenglu.php' method='post'>
            用户名:
            <input type='text' name='zhanghu' ><br />
            密码：
            <input type='text' name='mima' ><br />
            <input type='submit' name='submit' value='提交'>
            </form>";
        //继续验证密码；
    }
}else{
    $_SESSION['admin_user'] = "Y";  //延续session的使用
    session_write_close();
}


?>
<meta http-equiv="refresh" content="0;url=guanliyuan.php">
