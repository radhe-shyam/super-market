
<?php

session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    @header('Location:../index.php');
    die();
}
define("A_P_P", "http://localhost/apanamarket.com/checkout.php");
if (!($_SERVER['HTTP_REFERER'] == A_P_P)) {
    @header('Location:../index.php');
    die();
} else {
    include 'safe.php';
    conn();
    $row = mysql_fetch_array(mysql_query("SELECT max(ono) from order_det"));
    $oid = (int) $row[0] + 1;
    foreach ($_SESSION['items'] as $key => $value) {
    $r = explode(";",$value);
    $res = mysql_query("Select powner from products where pid='" . $key . "'");
    $po = mysql_fetch_array($res);
    $res = mysql_query("Select name,address from shop where email='" . $po['powner'] . "'");
    $na = mysql_fetch_array($res);
    $ena = $po['powner'] . ";" . $na['name']. ";" . $na['address'];
    $row = mysql_fetch_array(mysql_query("SELECT pavail from products where pid='".$key."'"));
    $cur = $row[0] - $r[3];
    mysql_query("update products set pavail = '" . $cur . "' where pid='" . $key . "'");
    if(isset($c_item[$ena]))
        {
        $c_item[$ena] .= ";" . $key . ";" . $r[1] . ";" . $r[4]/$r[3] . ";" . $r[3] . ";" . $r[4];
        }
    else {
        $c_item[$ena] = $key . ";" . $r[1] . ";" . $r[4]/$r[3] . ";" . $r[3] . ";" . $r[4];
        }
}
$res = mysql_query("Select name, email, address from u_details where email='" . $_SESSION['email'] . "'");
$nea = mysql_fetch_array($res);
mysql_query("insert into order_det values('" . $oid . "','" . $_SESSION['email'] . "','" . $nea['address'] . "','". time() . "')");

foreach ($c_item as $key => $value) {
                $shop = explode(";",$key);
                $product = explode(";",$value);
                
                $row = mysql_fetch_array(mysql_query("SELECT max(sino) from invoice where semail='" . $shop[0] . "'"));
                $iid = (int) $row[0] + 1;
                
                $row = mysql_fetch_array(mysql_query("SELECT max(iid) from invoice"));
                $ino = (int) $row[0] + 1;
                
                mysql_query("insert into invoice values('" . $ino . "','" . $iid . "','" . $shop[0] . "','". $oid . "')");
                
                $sum = 0;
                for($i=0; $i<count($product); $i+=5){
                mysql_query("insert into invoice_det values('" . $ino . "','" . $product[$i+0] . "','" . $product[$i+2] . "','". $product[$i+3] . "')"); 
                }
}
    unset($_SESSION['items']);
    $_SESSION['bill'] = 0;
    
}
header("Location:../index.php");
?>