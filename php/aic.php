<?php
session_start();
include 'safe.php';
if(isset($_GET['id']))
{
    $pid = safe($_GET['id']);
    if($pid == ""){
        header("Location:../index.php");}
    conn();
    $res = mysql_query("Select pname, pimage from p_detail where pid='" . $pid . "'");
    $pd = mysql_fetch_array($res);
    $res = mysql_query("Select pprice, pavail from products where pid='" . $pid . "'");
    $pp = mysql_fetch_array($res);
    if(isset($_SESSION['items'])){
        if(isset($_SESSION['items'][$pid])){
            echo "b";
            }
        else{
            $_SESSION['items'][$pid] = $pp['pavail']-1 . ";" . substr($pd['pname'], 0, 20) . ";" . $pd['pimage'] . ";1;" . $pp['pprice'];
            $_SESSION['bill'] += $pp['pprice'];
            echo "a".$_SESSION['bill'].";".$pp['pprice'].";".$pd['pimage'].";".substr($pd['pname'], 0, 20).";".$pid;
            }
        }
    else{
        $_SESSION['items']= array($pid => $pp['pavail']-1 . ";" . substr($pd['pname'], 0, 20) . ";" . $pd['pimage'] . ";1;" . $pp['pprice']);
        $_SESSION['bill'] += $pp['pprice'];
        echo "a".$_SESSION['bill'];
        }
}
?>