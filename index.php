<?php header("Content-type:text/html;charset=utf-8");?>
<html>
<head><h1>nimingban</h1></head>
<body>
<form action="index.php" method="post">
    <label>内容<br></label>
    <textarea cols="50" rows="10" name="neirong"></textarea>
    <br>
    <input type="submit" value="确定"  name="submit" />
    <input type="reset" value="重置"  name="reset" />
</form>
<?php echo $_POST["neirong"]; ?><br>
</body>
</html>