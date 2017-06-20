<?php
session_start();
include 'safe.php';
conn();
mysql_query("delete from products where pid='".$_GET['id']."'");
mysql_query("delete from p_detail where pid='".$_GET['id']."'");
mysql_query("delete from search where pid='".$_GET['id']."'");
echo "delete from search where pid='".$_GET['id']."'";
header("Location:../stock.php");
?>