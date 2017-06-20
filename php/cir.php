<?php
session_start();
include 'safe.php';
if(isset($_GET['id']))
{
    $pid = safe($_GET['id']);
    if($pid == ""){
        header("Location:../index.php");}
    if(isset($_SESSION['items'])){
        if(isset($_SESSION['items'][$pid])){
            $_SESSION['bill'] -= end(explode(";",$_SESSION['items'][$pid]));
            unset($_SESSION['items'][$pid]);
            echo $_SESSION['bill'];
            }
        }
}
?>