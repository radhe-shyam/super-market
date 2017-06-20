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
        if ($ref == "update_shop.php")
            echo "<script>alert('Your shop is now updated.'); window.location=\"../shop.php\"</script>";
        else if ($ref == "open_shop.php")
            echo "<script>alert('Your shop is now online.'); window.location=\"../shop.php\"</script>";
        else {
            echo "<script>alert('Sorry, it seems that u are not secure connection.'); window.location=\"../index.php\"</script>";
            die();
        }
        conn();
        mysql_query("update shop set name='" . $sn . "', about='" . safe($_POST['as']) . "', expert='" . safe($_POST['se']) . "', address='" . safe($_POST['sa']) . "', contact='" . safe($_POST['cn']) . "' where email='" . $_SESSION['email'] . "'");
        //mysql_query("insert into shop values ('" . safe($_POST['sn']) . "','" . safe($_POST['as']) . "','" . safe($_POST['se']) . "','" . safe($_POST['sa']) . "','" . safe($_POST['cn']) . "','" . $_SESSION['email'] . "');");
        $_SESSION['shop_name'] = $sn;
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