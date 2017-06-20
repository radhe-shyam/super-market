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
            $det = explode(";",$_SESSION['items'][$pid]);
            if($det[0] == "0"){
                echo "f";
            }
            else{
                $det[4] += $r = $det[4]/$det[3];
                $_SESSION['bill'] += $r;
                $det[3] += 1;
                $det[0] -= 1;
                $_SESSION['items'][$pid] = $det[0] . ";" . $det[1] . ";" . $det[2] . ";" . $det[3] . ";" . $det[4];
                echo "t".$_SESSION['bill'].";".$det[3].";".$det[4];
                }
            }
        }
}
?>