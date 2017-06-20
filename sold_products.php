<?php
session_start();
if(!isset($_SERVER['HTTP_REFERER']))
    { @header('Location:index.php'); die();}
if(!isset($_SESSION['shop_name']))
    { @header('Location:'.$_SERVER['HTTP_REFERER']);die();}
//$ref = explode("/",$_SERVER['HTTP_REFERER']);
//if($ref[3] != "apanamarket.com")
//    { @header('Location:'.$_SERVER['HTTP_REFERER']);die();}
include 'php/safe.php';
conn();
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
                <legend>Sold Products</legend>
                <?php 
                $iso1 = mysql_query("select iid, sino, ono from invoice where semail='" . $_SESSION['email'] . "'");
                if(mysql_num_rows($iso1) != 0){
                    $gsum = 0;
                    while ($iso = mysql_fetch_array($iso1)) {
                        $eao1 = mysql_query("SELECT bemail, badd, odate from order_det where ono='" . $iso['ono'] . "'");
                        $eao = mysql_fetch_array($eao1);
                        $cname1 = mysql_query("SELECT name from u_details where email='" . $eao['bemail'] . "'");
                        $cname = mysql_fetch_array($cname1);
                        
                ?>
                <table border="0" width="100%" class="table table-hover">
                    <tr>
                        <td colspan="4">Order No. : <?php echo $iso['ono'];?></td>
                        <td align="right">Date : <?php echo date("F j, Y ", $eao['odate']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Customer Details :<br>Name : </b> <?php echo $cname['name']; ?><br><b>Address : </b><?php echo $eao['badd']; ?><br><b>Email : </b><?php echo $eao['bemail']; ?></td>
                        <td align="right">Invoice No. : <?php echo $iso['sino'];?></td>
                    </tr>
                    
                <tr><td colspan="5">
                <table border="1" width="100%" class="table">
                    <tr align="center">
                        <td>S. No
                        <td>Description
                        <td>Price/Unit
                        <td>Qty
                        <td>Price
                    </tr>
                    <?php 
                    $i = 1;
                    $sum = 0;
                    $ppp1 = mysql_query("SELECT pid,pprice, pqty from invoice_det where iid='" . $iso['iid'] . "'");
                    while($ppp = mysql_fetch_array($ppp1)){
                    ?>
                    <tr align="center">
                        <td><?php echo $i;?></td>
                        <td align="left"><?php $pn = mysql_fetch_array(mysql_query("select pname from p_detail where pid='" . $ppp['pid'] . "'"));
                        echo $pn['pname'] ?></td>
                        <td><?php echo $ppp['pprice'];?></td>
                        <td><?php echo $ppp['pqty'];?></td>
                        <td><?php echo $ppp['pprice']*$ppp['pqty'];
                        $sum += $ppp['pprice'] * $ppp['pqty'];
                            ?></td>
                    </tr>
                    
                    <?php 
                    
                    $i++;
                        }
                    $gsum += $sum;
                        ?>
                    <tr align="center"><td colspan="4">Total<td><?php echo $sum;?></tr>
                </table></td>
                </tr>
                    </table><hr>
                <?php
                    }?>
                    <table border="1" width="100%" class="table">
                    <tr align="center"><td colspan="4">Total Sales<td><?php echo $gsum;?></tr>   
                    </table><hr>
                  <?php  }
            else {echo '<big class="list-group-item list-group-item-success">No selling yet</big>';}?>
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
