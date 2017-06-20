<?php
session_start();
if(isset($_GET['id']))
    {
include 'php/safe.php';
$pid = safe($_GET['id']);
if($pid == ""){
header("Location:index.php");}
conn();
$res = mysql_query("Select pname, pimage, pdesc, pf, cid, pdesc from p_detail where pid='" . $pid . "'");
if(!$pd = mysql_fetch_array($res)){
    header("Location:index.php");
    die();}  
$res = mysql_query("Select pprice, pquantity, pavail, powner from products where pid='" . $pid . "'");
$pp = mysql_fetch_array($res);
$res = mysql_query("Select name from shop where email='" . $pp[3] . "'");
$row = mysql_fetch_array($res);
$res = mysql_query("Select cname from category where cid='" . $pd[4] . "'");
$cn = mysql_fetch_array($res);

if(isset($_SESSION['email'])){
    $rpid = $pid;
    $res = mysql_query("Select recom from u_details where email='" . $_SESSION['email'] . "'");
    $rec = mysql_fetch_array($res);
    $str = $rec[0];
    $arr = explode('#',$rec[0]);
    $k = (string)array_search($rpid, $arr);
            if( $k != "" ){
                $arr = array_merge(array_slice($arr,0,$k),array_slice($arr,$k+1));
                }
    for($i=0;$i<9;$i++)
        {
           $rpid = $rpid . "#". $arr[$i] ;
        }
    mysql_query("update u_details set recom='". $rpid ."' where email='" . $_SESSION['email'] . "'");
}

@mysql_close($conn);
$pf = explode('<',$pd[3]);
$c = count($pf);
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
            <div class="col-sm-2 col-md-2 col-lg-2 pull-left"><!seller notification category division starts here>   
            </div><!seller notification category division finishes here>   
            
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 m0 panel panel-default" style="text-align:justify;">        
                <div class="row panel-heading">
                    Home > <?php echo $cn[0];?> > <b><?php echo $pd[0];?></b>
                </div>
                <div class="row panel-body">
                    <div class="col-xs-12 col-sm-5">
                        <img class="img-responsive center-block" src="<?php echo $pd[1];?>"/>
                    </div>
                    <div class="col-xs-12 col-sm-7">
                        <h3><?php echo $pd[0];?></h3>
                        <h4></h4>
                        <ul class="pull-left">
                            <?php
                            for($i=0;$i<$c-1;$i+=2){
                            echo "<li>" . $pf[$i] . "</li>";
                            }
                            ?>
                        </ul>
                        <div class="pull-right" style="text-align:center; cursor: pointer;">
                            <div class="btn-success buy" style="border-radius:50%; padding: 15px 15px 15px 15px;">
                                <b>Buy Now</b>
                                <br>in just<input type="hidden" value="<?php echo $pid; ?>" />
                                <br> Rs. <div class="badge"><?php echo $pp[0]; ?></div>
                            </div>
                            from<br><a href="shop.php?id=<?php echo $pp[3];?>" class="badge"><?php echo $row[0]; ?></a>
                        </div>
                    </div>
                </div>
               <?php /* <div class="panel-info">
                  <div class="panel-heading">Also availabe at</div>
                    <div class="panel-body" style=" overflow-x: auto;">
                        <div style="width:480px">
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="#">
                                <span class="label label-danger">Future Stores</span></a>
                                    <img src="c/a" width="90px" height="90px"/><b>Rs. 5,99,999/-</b><br>
                                   <a href="#"><span class="label label-success">Buy</span></a>
                                    <a href="#"><span class="label label-success">Cart</span></a>
                        </div>
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="#">
                                <span class="label label-danger">Future Stores</span></a>
                                    <img src="c/a" width="90px" height="90px"/><b>Rs. 5,99,999/-</b><br>
                                   <a href="#"><span class="label label-success">Buy</span></a>
                                    <a href="#"><span class="label label-success">Cart</span></a>
                        </div>
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="#">
                                <span class="label label-danger">Future Stores</span></a>
                                    <img src="c/a" width="90px" height="90px"/><b>Rs. 5,99,999/-</b><br>
                                   <a href="#"><span class="label label-success">Buy</span></a>
                                    <a href="#"><span class="label label-success">Cart</span></a>
                        </div>
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="#">
                                <span class="label label-danger">Future Stores</span></a>
                                    <img src="c/a" width="90px" height="90px"/><b>Rs. 5,99,999/-</b><br>
                                   <a href="#"><span class="label label-success">Buy</span></a>
                                    <a href="#"><span class="label label-success">Cart</span></a>
                        </div>
                        </div>
                    </div>
                </div> */ ?>
               <div class="panel-info">
                    <div class="panel-heading">Description</div>
                    <div class="panel-body"><?php echo $pd[5]; ?></div>
                </div>
               <?php
                for($i=0;$i<$c-1;$i+=2){
                ?>           
                <div class="panel-info">
                    <div class="panel-heading"><?php echo $pf[$i]; ?></div>
                    <div class="panel-body"><?php echo $pf[$i+1]; ?></div>
                </div>
                <?php }
                ?>
            </div>

<div class="col-sm-2 pull-right"><!buyer notification category division starts here> 
</div><!buyer notification category division finishes here>        

        </div>
        <?php @include 'footer.php';?>
    </div>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="js/jquery-2.1.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
 else {
     header("Location:index.php");
}
?>
