<?php
session_start();
if(!isset($_SERVER['HTTP_REFERER']))
    { @header('Location:index.php?ref'); die();}
if(!(isset($_SESSION['email'])))
    { echo '<script>alert("You must be login"); window.location="index.php";</script>';die();}
if($_SESSION['bill'] == "0")
    { echo '<script>alert("You must have something in your cart to order."); window.location="index.php";</script>';die();}
$ref = explode("/",$_SERVER['HTTP_REFERER']);
if($ref[3] != "apanamarket.com")
    { @header('Location:'.$_SERVER['HTTP_REFERER']);die();}
include 'php/safe.php';
conn();
$row = mysql_fetch_array(mysql_query("SELECT address from u_details where email='" . $_SESSION['email'] . "'"));
if ($row[0] == ""){
    echo "<script>alert('Please provide your address.'); window.location=\"update_profile.php\"</script>";
    die();
    }

$row = mysql_fetch_array(mysql_query("SELECT max(ono) from order_det"));
$oid = (int) $row[0] + 1;
foreach ($_SESSION['items'] as $key => $value) {
    $r = explode(";",$value);
    $res = mysql_query("Select powner from products where pid='" . $key . "'");
    $po = mysql_fetch_array($res);
    $res = mysql_query("Select name,address from shop where email='" . $po['powner'] . "'");
    $na = mysql_fetch_array($res);
    $ena = $po['powner'] . ";" . $na['name']. ";" . $na['address'];
    if(isset($c_item[$ena]))
        {
        $c_item[$ena] .= ";" . $key . ";" . $r[1] . ";" . $r[4]/$r[3] . ";" . $r[3] . ";" . $r[4];
        }
    else {
        $c_item[$ena] = $key . ";" . $r[1] . ";" . $r[4]/$r[3] . ";" . $r[3] . ";" . $r[4];
        }
}
//pid->name->price/unit->qty->price
//avail->name->image->qty->totalprice

$res = mysql_query("Select name, email, address from u_details where email='" . $_SESSION['email'] . "'");
$nea = mysql_fetch_array($res);

?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
<style>
    .br{ border:red solid 1px;}
    .bg{ border:green solid 1px;}
    .m0{margin:0 0 0 0;}
    .p0{padding:0 0 0 0;}
</style>
</head>
<body>
    <div class="container-fluid">
    <?php @include 'header.php';?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>  
            
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 m0 panel panel-default table-responsive" style="text-align:center;">        
                <table border="0" width="100%" class="table table-hover">
                    <legend>INVOICE</legend>
                    <tr>
                        <td colspan="4">Order No. : <?php echo $oid;?></td>
                        <td align="right">Date : <?php echo date("F j, Y ", time()); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"><b>Customer Details :<br>Name : </b> <?php echo $nea['name']; ?><br><b>Address : </b><?php echo $nea['address']; ?></td>
                    </tr>
                </table><hr>
                <?php
                foreach ($c_item as $key => $value) {
                $shop = explode(";",$key);
                $product = explode(";",$value);
                
                ?>
                <table border="0" width="100%" class="table table-hover">
                    <tr>
                        <td colspan=4><b>Seller Details :<br>Name : </b><?php echo $shop[1];?><br><b>Address : </b><?php echo $shop[2];?><br><b>Email : </b><?php echo $shop[0];?></td>
                        <td>Invoice No. :  <?php $row = mysql_fetch_array(mysql_query("SELECT max(sino) from invoice where semail='" . $shop[0] . "'"));
                                                  $iid = (int) $row[0] + 1;
                                                  echo $iid;?></td>
                    </tr>
                </table>
                <table border="1" width="100%" class="table table-hover">
                    <tr align="center">
                        <td>S. No
                        <td>Description
                        <td>Price/Unit
                        <td>Qty
                        <td>Price
                    </tr>
                    <?php
                    $sum = 0;
                    for($i=0; $i<count($product); $i+=5){?>
                    <tr align="center">
                        <td><?php echo $i/5+1;?></td>
                        <td align="left"><?php echo $product[$i+1];?></td>
                        <td><?php echo $product[$i+2];?></td>
                        <td><?php echo $product[$i+3];?></td>
                        <td><?php echo $product[$i+4]; $sum += $product[$i+4];?></td>
                    </tr>
                    <?php } ?>
                    <tr align="center"><td colspan="4">Total<td><?php echo $sum;?></tr>
                </table>
                <hr>
                <?php
                }
                ?>
                <table border="1" width="100%" class="table table-hover">
                    <tr align="center"><td colspan="4">Total Payment<td><?php echo $_SESSION['bill']; ?></tr>
                </table>    
               
                <hr>
                <a href="php/co.php" class="pull-right btn-success btn" onclick="alert('Thank You for purchasing.')">Confirm Order</a>
                <a href="index.php" class="pull-right btn-primary btn">Continue Shopping</a><br><br>
                <hr>
            </div>

            <?php @include 'recent.php'; ?>       

        </div>
        <?php @include 'footer.php';?>
    </div>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="js/jquery-2.1.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
