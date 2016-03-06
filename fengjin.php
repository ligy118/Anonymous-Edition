<?php
$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("app_ligy118", $con);
$sql = "INSERT INTO killcookie (zhanghu)
VALUES
('$_POST[fengjin]')";

if (!mysql_query($sql, $con)) {
    die('Error: ' . mysql_error());
}
mysql_close($con);
?>
<meta http-equiv="refresh" content="0;url=guanliyuan.php">