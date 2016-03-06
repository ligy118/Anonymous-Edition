<?php
//$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("app_ligy118", $con);
$jf=$_POST['jiefeng'];
mysql_query("DELETE FROM killcookie WHERE zhanghu='$jf' ");
if (!mysql_query($sql, $con)) {
    die('Error: ' . mysql_error());
}
mysql_close($con);
