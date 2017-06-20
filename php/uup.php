<?php
session_start();
if(!isset($_SESSION['user']))
   { 
    @header('Location:../index.php');
    die();
   }
   else
   {
    @require 'safe.php';
    $sn = safe($_POST['sn']);
    if( $_POST['c'] == $_SESSION['securimage_code_disp']['default'] && $sn != "" )
        {
        $ref = end(explode('/',$_SERVER['HTTP_REFERER']));
        if ($ref == "update_profile.php")
            echo "<script>alert('Your profile is now updated.'); window.location=\"../index.php\"</script>";
        else {
            echo "<script>alert('Sorry, it seems that u are not secure connection.'); window.location=\"../index.php\"</script>";
            die();
        }
        conn();
        mysql_query("update u_details set name='" . $sn . "', address='" . safe($_POST['sa']) . "' where email='" . $_SESSION['email'] . "'");
        mysql_query("update users set name='" . $sn . "', password='" . safe($_POST['sp']) . "' where email='" . $_SESSION['email'] . "'");
        $_SESSION['user'] = $sn;
        @mysql_close($conn);
        }
    else
        {
        echo "<script>alert('Operation failed. Please enable the JAVA script in your browser and try again.');window.location=\"". $_SERVER['HTTP_REFERER'] . "\";</script>";
        }
    unset($_SESSION['securimage_code_disp']);
    unset($_SESSION['securimage_code_ctime']);
    unset($_SESSION['securimage_code_value']);
   }
?>