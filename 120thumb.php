<?php
//session_start();
//if(isset($_GET['id']))
    {
//include 'php/safe.php';
for($i=0;$i<10;$i++){
$pid = "1";
if($pid == ""){echo "pid is null";}
conn();
$res = mysql_query("Select pname, pimage from p_detail where pid='" . $pid . "'");
    if(!$pd = mysql_fetch_array($res)){ echo "select name";}
$res = mysql_query("Select pprice from products where pid='" . $pid . "'");
    if(!$pp = mysql_fetch_array($res)){ echo "select price";}
//@mysql_close($conn);
?>
<div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
   <a href="#">
        <span class="label label-danger">Rs. <?php echo $pp[0]; ?>/-</span>
       <img src="<?php echo $pd[1]; ?>" width="100px" height="80px"/><?php echo $pd[0]; ?></a><br>
       <a href="#"><span class="label label-success">Buy</span></a>
       <a href="#"><span class="label label-success">Cart</span></a>
</div>
<?php
}
}
?>