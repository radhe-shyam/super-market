<?php
/*session_start();
if(isset($_GET['id']))
    {
include 'php/safe.php';
conn();
$res = mysql_query("Select pname, pimage, pdesc, pf, cid, pdesc from p_detail where pid='" . $_GET['id'] . "'");
//echo "Select pname, pimage, pdesc, pf from p_detail where pid='" . $_GET['id'] . "'" . "<br>";
$pd = mysql_fetch_array($res);
$res = mysql_query("Select pprice, pquantity, pavail, powner from products where pid='" . $_GET['id'] . "'");
//echo "Select pprice, pquantity, pavail, powner from products where pid='" . $_GET['id'] . "'<br>";
$pp = mysql_fetch_array($res);
$res = mysql_query("Select name from shop where email='" . $pp[3] . "'");
//echo "Select name from shop where email='" . $pp[3] . "'<br>";
$row = mysql_fetch_array($res);
$res = mysql_query("Select cname from category where cid='" . $pd[4] . "'");
//echo "Select name from shop where email='" . $pp[3] . "'<br>";
$cn = mysql_fetch_array($res);
@mysql_close($conn);
$pf = explode('<',$pd[3]);
$c = count($pf);*/
?>
<div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
   <a href="#">
        <span class="label label-danger">Rs. 59999999/-</span>
       <img src="p/1_2"/>Apple MacBook</a><br>
       <a href="#"><span class="label label-success">+</span></a>
       <a href="#"><span class="label label-success">Remove</span></a>
</div>
<?php
    //}
?>