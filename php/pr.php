
<?php

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    @header('Location:../index.php');
    die();
}
define("A_P_P", "http://localhost/apanamarket.com/add_product.php");
define("U_P_P", "http://localhost/apanamarket.com/update_product.php");
if (!((($_SERVER['HTTP_REFERER'] == A_P_P) || ($_SERVER['HTTP_REFERER'] == U_P_P)) && isset($_SESSION['user']))) {
    @header('Location:../index.php');
    die();
} else {
    @require 'safe.php';
    $pn = safe($_POST['pn']);
    if ($_POST['c'] == $_SESSION['securimage_code_disp']['default'] && $pn != "") {
        $ref = end(explode('/', $_SERVER['HTTP_REFERER']));
        if ($ref == "update_shop.php")
            echo "<script>alert('Your shop is now updated.'); window.location=\"../shop.php\"</script>";
        else if ($ref == "add_product.php")
            echo "<script>alert('Your product is online now.'); window.location=\"../shop.php\"</script>";
        else {
            echo "<script>alert('Sorry, it seems that u are not in secure connection.'); window.location=\"../index.php\"</script>";
            die();
        }
        conn();
        $row = mysql_fetch_array(mysql_query("SELECT max(pid) from p_detail"));
        $pid = (int) $row[0] + 1;
        move_uploaded_file($_FILES['pi']['tmp_name'], '../p/' . $pid . '_0.png');
        $ct = safe($_POST['ct']);
        $pp = safe($_POST['pp']);
        $pq = safe($_POST['pq']);
        $pd = safe($_POST['pd']);
        $catn = mysql_fetch_array(mysql_query("select cname from category where cid='". $ct ."'"));
        mysql_query("insert into search values('".$catn['cname']."','".$pid."')");
        mysql_query("insert into search values('".$pn."','".$pid."')");
        //foreach ($_FILES as $key => $value) {
        //echo $key,"->",$value,"<br>";}
        unset($_POST['ct']);
        unset($_POST['pn']);
        unset($_POST['pi']);
        unset($_POST['pp']);
        unset($_POST['pq']);
        unset($_POST['pd']);
        unset($_POST['c']);
        $l = count($_POST);
        $pf = "";
        for ($i = 0; $i < $l / 2; $i++) {
            $pf = $pf . safe($_POST["ft" . $i]) . "<" . safe($_POST["fd" . $i]) . "<";
            mysql_query("insert into search values('".safe($_POST["ft" . $i])."','".$pid."')");
        }
        mysql_query("insert into p_detail values('" . $pid . "','" . $ct . "','" . $pn . "','p/" . $pid . "_0.png','" . $pd . "','" . $pf . "')");
        mysql_query("insert into products values('" . $pid . "','" . $pp . "','" . $pq . "','" . $pq . "','" . $_SESSION['email'] . "','" . time() . "')");
        @mysql_close($conn);
    } else {
        echo "<script>alert('Operation failed. Please enable the JAVA script in your browser and try again.');window.location=\"" . $_SERVER['HTTP_REFERER'] . "\";</script>";
    }
    unset($_SESSION['securimage_code_disp']);
    unset($_SESSION['securimage_code_ctime']);
    unset($_SESSION['securimage_code_value']);
}
?>