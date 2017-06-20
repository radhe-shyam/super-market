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
$ipqa1 = mysql_query("select pid, pprice, pquantity, pavail from products where powner='" . $_SESSION['email'] . "'");
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
                <legend>STOCK</legend>
                <table border="1" width="100%" class="table">
                    <tr align="center">
                        <td>Name
                        <td>Price
                        <td>Total Qty.
                        <td>Available Qty.
                    </tr>
                    <?php
                    while ($ipqa = mysql_fetch_array($ipqa1)) {
                    ?>
                    <tr align="center">
                        <td align="left"><?php $pn = mysql_fetch_array(mysql_query("select pname from p_detail where pid='" . $ipqa['pid'] . "'"));
                        echo $pn['pname'] ?></td>
                        <td><?php echo $ipqa['pprice'];?></td>
                        <td><?php echo $ipqa['pquantity'];?></td>
                        <td><?php echo $ipqa['pavail'];?></td>
                        <td class="btn btn-success"><a href="update_product.php?id=<?php echo $ipqa['pid'];?>">Change</a>
                        <td class="btn btn-danger"><a href="php/prem.php?id=<?php echo $ipqa['pid'];?>" >Remove</a>
                    </tr>
                    <?php } ?>
                </table>
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
