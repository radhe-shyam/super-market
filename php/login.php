<?php
session_start();
require 'safe.php';
$u = safe($_POST['u']);
$p = safe($_POST['p']);
if($u != "" && @$p != "")
{
conn();
$res = mysql_query("Select name from users where email='" . $u . "' and password='" . $p . "'");
if(mysql_num_rows($res) == 1)
    {
    $row = mysql_fetch_array($res);
    $_SESSION['user'] = $row[0];
    $_SESSION['email'] = $u;
    echo "1";
    $res = mysql_query("Select name from shop where email='" . $u . "'");
    if($row = mysql_fetch_array($res))
        {
        if($row[0] != "")
            $_SESSION['shop_name'] = @$row[0];
        }
    }
mysql_free_result($res);
//mysql_close($conn);
}
?>