<?php
session_name( "Zjmainstay" );
session_start();
$ok_to_browse = ( $_SESSION['admin_user'] == "Y" );
if (!$ok_to_browse ) {
//验证账号密码
    $boo=true;
    if($boo)
    {
        $_SESSION['admin_user'] = "Y";
        session_write_close();
    }
    else
    {
        ;
        //继续验证密码；
    }
}else{
    $_SESSION['admin_user'] = "Y";  //延续session的使用
    session_write_close();
}


?>
<meta http-equiv="refresh" content="0;url=guanliyuan.php">
