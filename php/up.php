
<?php

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    @header('Location:../index.php');
    die();
}
    @require 'safe.php';
    $pn = safe($_POST['pn']);
    if ($_POST['c'] == $_SESSION['securimage_code_disp']['default'] && $pn != "") {
        
        
            echo "<script>alert('Product updated.'); window.location=\"../stock.php\"</script>";
        
        conn();
        $ct = safe($_POST['ct']);
        $pp = safe($_POST['pp']);
        $pq = safe($_POST['pq']);
        $pd = safe($_POST['pd']);
        mysql_query("update products set pprice='" . $pp ."',pquantity='".$pq."',pavail='" .$pq."' where pid='" .$_POST['pid']."'");

        @mysql_close($conn);
    } 
    else {
        echo "<script>alert('Operation failed. Please enable the JAVA script in your browser and try again.');window.location=\"" . $_SERVER['HTTP_REFERER'] . "\";</script>";
    }
    unset($_SESSION['securimage_code_disp']);
    unset($_SESSION['securimage_code_ctime']);
    unset($_SESSION['securimage_code_value']);
?>