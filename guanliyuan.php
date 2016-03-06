<?php
header("Content-type:text/html;charset=utf-8");
?>
<?php
session_name( "Zjmainstay" );
session_start();
$ok_to_browse = ( $_SESSION['admin_user'] == "Y" );
if (!$ok_to_browse ) {
    header("Content-type: text/html; charset=utf-8");
    exit('拒绝非法访问！');
}else{
    $_SESSION['admin_user'] = "Y";
    session_write_close();
}
?>

<?php
echo" <form action='jiefeng.php' method='post'>

                    解封此cookie <input type='text' name='jiefeng' >
                    <input type='submit' value='解封' >
                    <br>
                    </form>";
//$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("app_ligy118", $con);

$result = mysql_query("SELECT * FROM neirong");
/*     if(!empty($_POST['shanchu'])){ //点击提交按钮后才执行
            $sc=$_POST['shanchu'];
            $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
         mysql_select_db("app_ligy118", $con);
         mysql_query("DELETE FROM neirong WHERE zhujian='".$sc."'");
         mysql_close($con);
      }*/
$n = 0;
while($row = mysql_fetch_array($result))
{
    $zj[$n]=$row['zhujian'];
    $tm[$n]=$row['time'];
    $nr[$n]=$row['neirong'];
    $yh[$n]=$row['yonghu'];
    $n++;
}
for($i=$n-1;$i>=0;$i--)
{
    echo $zj[$i].' '."用户 ".$yh[$i]." " .  $tm[$i]."说 ".$nr[$i];
    echo" <form action='shanchu.php' method='post'>
                    <input type = 'hidden' name='shanchu' value =  $zj[$i]>
                    <input type='submit' value='删除' /></form>";
    echo" <form action='fengjin.php' method='post'>
                    <input type = 'hidden' name='fengjin' value =  $yh[$i]>
                    <input type='submit' value='封禁此cookie' /></form>";
    //      <form action="guanliyuan.php" method="post">
    //<input type="int" name="shanchu" value="$i" />
    //<input type="submit" name="button" value="删除" />
    //</form>
    echo "<br />";
}
mysql_close($con);
?>
