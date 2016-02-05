<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('prc');
?>
<html>
<head><h1>nimingban</h1></head>
<body>
<form action="index.php" method="post">
    <label>内容<br></label>
    <textarea cols="50" rows="5" name="neirong"></textarea>
    <br>
    <input type="submit" value="确定"  name="submit" />
    <input type="reset" value="重置"  name="reset" />
</form>
<?php
if(!empty($_POST['neirong'])){
    $con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("app_ligy118", $con);
    $zhujiani = 0;
    $result = mysql_query("SELECT * FROM neirong");
    while($row = mysql_fetch_array($result))
    {
        if($zhujiani<$row['zhujian'])
        {
            $zhujiani=$row['zhujian'];
        }
    }
    $zhujiani++;
    $sql="INSERT INTO neirong (yonghu, time, neirong,zhujian)
VALUES
('yonghu','date(‘Y-m-d H:i:s’)','$_POST[neirong]','$zhujiani')";//yonghu即cookies,待添加

    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error());
    }
    mysql_close($con);
}
?>
<br>
<?php
$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
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
    $tm[$n]=$row['time'];
    $nr[$n]=$row['neirong'];
    $n++;
}
for($i=$n-1;$i>=0;$i--)
{
    echo $zj[$i].' '."用户XXX " .  $tm[$i]."说 ".$nr[$i];
    echo "<br /><br />";
}

mysql_close($con);
?>
</body>
</html>