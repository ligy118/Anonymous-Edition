<?php
//$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
//sae时注释掉
if (mysql_query("CREATE DATABASE app_ligy118",$con))
{
    echo "Database created";
}
else
{
    echo "Error creating database: " . mysql_error();
}
//注释end
mysql_select_db("app_ligy118", $con);
$sql = "CREATE TABLE neirong
(
zhujian int,
yonghu text(15),
time datetime,
neirong text(1000)
)";
mysql_query($sql,$con);
mysql_select_db("app_ligy118", $con);
$sql = "CREATE TABLE guanliyuan
(
zhanghu text(15),
mima text(1000)
)";
mysql_query($sql,$con);
mysql_select_db("app_ligy118", $con);
$sql = "CREATE TABLE quan_ju_bian_liang
(
name text(15),
shuzhi int
)";
mysql_query($sql,$con);
mysql_select_db("app_ligy118", $con);
$sql = "CREATE TABLE killcookie
(
zhanghu text
)";
mysql_query($sql,$con);
mysql_close($con);
?>