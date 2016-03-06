<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('prc');
?>
<html>
<head><h1>nimingban</h1></head>
<body>
<?php
echo "<a href='guanliyuandenglu.php' >管理员登录</a><br>";

$cookieboo=false;
$killcookieboo=false;
if(isset($_COOKIE['name']))
{
    $cookieboo=true;
    $con = mysql_connect("localhost","root","");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("app_ligy118", $con);
    $result = mysql_query("SELECT * FROM killcookie");
    while($row = mysql_fetch_array($result))
    {
        if($row['zhanghu']==$_COOKIE['name']) {
            setcookie("name");
            $killcookieboo=true;
        }
    }
    if($killcookieboo)
    {
        echo $_COOKIE['name']." 你被封禁了!<br>";
    }
    else
    {
        echo "欢迎回来".$_COOKIE['name']."<br>"  ;
    }

}
if(!$cookieboo)
{
    //$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    $con = mysql_connect("localhost","root","");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("app_ligy118", $con);
    $result = mysql_query("SELECT * FROM quan_ju_bian_liang");
    while($row = mysql_fetch_array($result))
    {
        if($row['name']=="cookie") {
            $numcookies=$row['shuzhi'];
         }
    }
    mysql_close($con);
    if($numcookies>0)
    {
        setcookie("name",time(),time()+2592000,"/");
        echo "你得到了饼干:".$_COOKIE['name']."<br>";
        //$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
        $con = mysql_connect("localhost","root","");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("app_ligy118", $con);
        $numcookies--;
        mysql_query("UPDATE quan_ju_bian_liang SET shuzhi=$numcookies
        WHERE name='cookie'");

        mysql_close($con);
    }
}
?>
<form action="index.php" method="post">
    <label>内容<br></label>
    <textarea cols="50" rows="5" name="neirong"></textarea>
    <br>
    <input type="submit" value="确定"  name="submit" />
    <input type="reset" value="重置"  name="reset" />
</form>
<?php
if(!empty($_POST['neirong'])){
    if (!isset($_COOKIE['name']) || $killcookieboo ) {
        echo '请先获取cookies或向管理员申请解封!<br>';
    }
    else {
        //$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
        $con = mysql_connect("localhost","root","");
        if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("app_ligy118", $con);
        $result = mysql_query("SELECT * FROM quan_ju_bian_liang ");
        while($row = mysql_fetch_array($result))
        {
            if($row['name']=="zhujian")
            {
                $zhujian=$row['shuzhi'];
            }

        }
        $zhujian++;
        mysql_query("UPDATE quan_ju_bian_liang SET shuzhi=$zhujian
        WHERE name='zhujian'");

        $yonghu=$_COOKIE['name'];
        $sql = "INSERT INTO neirong (yonghu, time, neirong,zhujian)
VALUES
('$yonghu','date(‘Y-m-d H:i:s’)','$_POST[neirong]','$zhujian')";//yonghu即cookies,待添加

        if (!mysql_query($sql, $con)) {
            die('Error: ' . mysql_error());
        }
        mysql_close($con);
    }
}
?>
<br>
<?php
//$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("app_ligy118", $con);

$result = mysql_query("SELECT * FROM neirong");
$n = 0;
while($row = mysql_fetch_array($result))
{
    $zj[$n]=$row['zhujian'];
    $yh[$n]=$row['yonghu'];
    $tm[$n]=$row['time'];
    $nr[$n]=$row['neirong'];
    $n++;
}
for($i=$n-1;$i>=0;$i--)
{
    echo $zj[$i].' '.$yh[$i] ." ".  $tm[$i]."说 ".$nr[$i];
    echo "<br /><br />";
}


mysql_close($con);

?>
</body>
</html>