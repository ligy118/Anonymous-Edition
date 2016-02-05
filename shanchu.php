<?php
$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("app_ligy118", $con);

$result = mysql_query("SELECT * FROM neirong");
// if(!empty($_POST['shanchu'])){ //点击提交按钮后才执行
$sc=$_POST['shanchu'];
$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db("app_ligy118", $con);
mysql_query("DELETE FROM neirong WHERE zhujian='".$sc."'");
mysql_close($con);
//   }
?>
<meta http-equiv="refresh" content="0;url=guanliyuan.php">