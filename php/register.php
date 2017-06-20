<?php
session_start();
@require 'safe.php';
if(@$_POST['rn'] != "" && @$_POST['re'] != "" && @$_POST['rp'] != "")
{
conn();
$res = mysql_query("Select name from users where email='" . safe($_POST['re']) . "'");
if(!mysql_num_rows($res))
    {
    mysql_query("insert into users values('" . safe($_POST['rn']) . "','" . safe($_POST['re']) . "','" . safe($_POST['rp']) . "');");
    mysql_query("insert into u_details(name,email,recom) values('" . safe($_POST['rn']) . "','" . safe($_POST['re']) . "','#########');");
    mysql_query("insert into shop(email) values('" . safe($_POST['re']) . "');");
    $_SESSION['user'] = $_POST['rn'];
    $_SESSION['email'] = $_POST['re'];
    echo "1";
    }
else
    echo "0";
@mysql_free_result($res);
@mysql_close($conn);
}
?>