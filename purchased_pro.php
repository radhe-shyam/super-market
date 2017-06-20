<?php
session_start();
if(!isset($_SERVER['HTTP_REFERER']))
    { @header('Location:index.php'); die();}
if(!isset($_SESSION['email']))
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
                <legend>Purchased Products</legend>
                <?php 
                $oad1 = mysql_query("select ono, badd, odate from order_det where bemail='" . $_SESSION['email'] . "'");
                if(mysql_num_rows($oad1) != 0){
                    $gsum = 0;
                    while ($oad = mysql_fetch_array($oad1)) {
                        $iss1 = mysql_query("SELECT iid, sino, semail from invoice where ono='" . $oad['ono'] . "'");
                        $osum = 0;
                        
                ?>
                <table border="0" width="100%" class="table table-hover">
                            <tr>
                                <td colspan="4">Order No. : <?php echo $oad['ono']; ?></td>
                                <td align="right">Date : <?php echo date("F j, Y ", $oad['odate']); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5"><b>Customer Details :<br>Shipping Address : </b><?php echo $oad['badd']; ?></td>
                            </tr>

                            <?php
                            while ($iss = mysql_fetch_array($iss1)) {
                                $na = mysql_fetch_array(mysql_query("SELECT name, address from shop where email='" . $iss['semail'] . "'"));
                                $ppp1 = mysql_query("SELECT pid, pprice, pqty from invoice_det where iid='" . $iss['iid'] . "'");
                                ?>
                                <tr><td colspan="5">
                                        <table border="0" width="100%" class="table table-hover">
                                            <tr>
                                                <td colspan=4><b>Seller Details :<br>Name : </b><?php echo $na['name']; ?><br><b>Address : </b><?php echo $na['address']; ?><br><b>Email : </b><?php echo $iss['semail']; ?></td>
                                                <td>Invoice No. :  <?php echo $iss['sino']; ?></td>
                                            </tr>
                                            <tr><td colspan="5">
                                                    <table border="1" width="100%" class="table table-hover">
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
                                                        while ($ppp = mysql_fetch_array($ppp1)) {
                                                            ?>
                                                            <tr align="center">
                                                                <td><?php echo $i; ?></td>
                                                                <td align="left"><?php
                                                                    $pn = mysql_fetch_array(mysql_query("select pname from p_detail where pid='" . $ppp['pid'] . "'"));
                                                                    echo $pn['pname']
                                                                    ?></td>
                                                                <td><?php echo $ppp['pprice']; ?></td>
                                                                <td><?php echo $ppp['pqty']; ?></td>
                                                                <td><?php
                                                                    echo $ppp['pprice'] * $ppp['pqty'];
                                                                    $sum += $ppp['pprice'] * $ppp['pqty'];
                                                                     
                                                                    ?></td>
                                                            </tr>
            <?php } 
            $osum += $sum;
            ?>
                                                        <tr align="center"><td colspan="4">Total<td><?php echo $sum; ?></tr>
                                                    </table></td></tr>
                                        </table></td></tr>
                            
                
                <?php
                }
                $gsum += $osum;
                    
                ?>
                <tr align="center"><td colspan="4">Total order amount<td><?php echo $osum; ?></tr>
               </table><hr>
                
                <?php 
                    }?>
                <table border="1" width="100%" class="table table-hover">
                    <tr align="center"><td colspan="4">Total Purchased<td><?php echo $gsum; ?></tr>
                </table> 
               <hr>
                <?php
                    }
            else {echo '<big class="list-group-item list-group-item-success">You have not purchased anything yet.</big>';}?>
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
