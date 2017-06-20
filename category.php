<?php
session_start();
include 'php/safe.php';
if(isset($_GET['id'])){
$sid = safe($_GET['id']);
if($sid == ""){
header("Location:index.php"); die();}
conn();
$res = mysql_query("Select name from shop where email='" . $sid . "'");
if(!$sd = mysql_fetch_array($res)){
    header("Location:index.php");
    die();}
?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Chrome Stores</title>
<link rel="icon" href="c/a" type="image/png">
<style>
   @media(max-width: 720px){
        h1{font-size:1.6em}
    }
    .p0{padding:0 0 0 0;}
    .m0{margin:0 0 0 0;}


    .br{border:red solid 1px;}
    .by{border:yellow solid 1px;}
    .bg{border:green solid 1px;}
    .rb{border-radius: 50%;}
    .tc{text-align:center;}
</style>
</head>
<body>
    <div class="container-fluid">
    <?php
    @include 'header.php'; ?>
        <div class="row">
            <?php @include 'whats_new.php'; ?> 
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" style="border-top: #777 1px dotted; border-radius: 0.17%;">
                <a href="shop.php?id=<?php echo $sid;?>"><h1 align="center" class="m0" style="color:#777; border-bottom: #777 1px dotted;"><b><?php echo $sd['name'];?></b></h1></a>
                <form action="search.php" method="GET">
                <div class="input-group" style=" margin-top: 5px; text-align: center; margin-bottom: 5px;">
                    <input type="text" class="form-control" placeholder="Search in store.." name="s">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search</button>
                        </span>
                </div></form>

                <div class="row m0">
                    <?php
                    if (isset($_GET['c']))
                    {   
                        $cid = safe($_GET['c']);
                        $res = mysql_query("Select cname from category where cid='" . $cid . "'");
                        if(!$cn = mysql_fetch_array($res)){ echo "<script>window.location=\"index.php\";</script>"; die();}
                        $res = mysql_query("Select pid, pimage, pname from p_detail where cid='" . $cid . "'");
                        if(!mysql_num_rows($res)){ echo "<script>window.location=\"index.php\";</script>"; die();}
                        ?>
                    
                    <div class="row">
                            <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                                <div class="panel-heading badge" style="margin-left:15px;">Explore in <?php echo $cn['cname']; ?></div>
                                <div class="panel-body">

                                            <?php
                                            while ($pid = mysql_fetch_array($res)) {
                                                $resd = mysql_query("Select pprice from products where pid='" . $pid['pid'] . "' and powner='" . $sid . "'");
                                                if ($pd = mysql_fetch_array($resd)){
                                                ?>
                                                <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                                                    <a href="product_details.php?id=<?php echo $pid['pid']; ?>"><span class="label label-danger">Rs. <?php echo $pd['pprice']; ?></span>
                                                        <img src="<?php echo $pid['pimage']; ?>" width="100px" height="80px"/><?php echo substr($pid['pname'], 0, 20); ?></a><br>
                                                    <a href="#" id="buy"><span class="label label-success">Buy</span></a>
                                                    <a href="#" id="buy"><span class="label label-success">Cart</span></a>
                                                </div>
                                                <?php }
                                            }
                                            ?>
                                </div>
                            </div><!market category division finishes here>
                        </div>
                       
                    
                    <?php
                    }
                    else{
                    $res = mysql_query("select cname,cid from category where cid in(select distinct cid from p_detail where pid in(select pid from products where powner='" .$sid . "') )");
                    ?>

                    <div class="row">
                            <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                                <div class="panel-heading badge" style="margin-left:15px;">Explore <?php if (isset($cn['cname'])) echo " in ".$cn['cname']; else echo "by category"; ?></div>
                                <div class="panel-body">

                                    <?php while ($sd = mysql_fetch_array($res)) { ?>
                                        <a href="<?php echo end(explode("/", $_SERVER['REQUEST_URI'])) . "&c=" . $sd['cid']; ?>"><div title="<?php echo $cn['cname']; ?>" class="col-sm-1 col-xs-1" style="width: 100px; height: 100px; margin: 10px 10px 0 0; text-align: center; border-radius: 50%; border:#5cb85c 1px solid; color: #5cb85c;">
                                                <span class="label label-success"><?php $i = substr($sd['cname'], 0, 10); echo $i . ".."; ?></span><h1 align="center"><?php echo $i[0]; ?></h1>
                                            </div></a>
                                    <?php } ?>

                                </div>
                            </div><!market category division finishes here>
                        </div>
                        
                        <?php }
                        include 'recommend.php';
                        include 'top10.php';?>


                </div>
            </div>
            <?php @include 'recent.php'; ?> 
            </div>
        <?php @include 'footer.php';?>
    </div>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
 <?php }
    else if(isset ($_GET['c']))
    {
conn();
?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
<style>
   @media(max-width: 720px){
        h1{font-size:1.6em}
    }
    .p0{padding:0 0 0 0;}
    .m0{margin:0 0 0 0;}


    .br{border:red solid 1px;}
    .by{border:yellow solid 1px;}
    .bg{border:green solid 1px;}
    .rb{border-radius: 50%;}
    .tc{text-align:center;}
</style>
</head>
<body>
    <div class="container-fluid">
    <?php
    @include 'header.php'; ?>
        <div class="row">
            <?php @include 'whats_new.php'; ?> 
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div class="row m0">
                    <?php
                        $cid = safe($_GET['c']);
                        $res = mysql_query("Select cname from category where cid='" . $cid . "'");
                        if(!$cn = mysql_fetch_array($res)){ echo "<script>window.location=\"index.php\";</script>"; die();}
                        $res = mysql_query("Select pid, pimage, pname from p_detail where cid='" . $cid . "'");
                        if(!mysql_num_rows($res)){ echo "<script>window.location=\"index.php\";</script>"; die();}
                        ?>
                    <div class="row">
                            <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                                <div class="panel-heading badge" style="margin-left:15px;">Explore in <?php echo $cn['cname']; ?></div>
                                <div class="panel-body">

                                            <?php
                                            while ($pid = mysql_fetch_array($res)) {
                                                $resd = mysql_query("Select pprice from products where pid='" . $pid['pid'] . "'");
                                                if ($pd = mysql_fetch_array($resd)){
                                                ?>
                                                <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                                                    <a href="product_details.php?id=<?php echo $pid['pid']; ?>"><span class="label label-danger">Rs. <?php echo $pd['pprice']; ?></span>
                                                        <img src="<?php echo $pid['pimage']; ?>" width="100px" height="80px"/><?php echo substr($pid['pname'], 0, 20); ?></a><br>
                                                    <a href="#" id="buy"><span class="label label-success">Buy</span></a>
                                                    <a href="#" id="buy"><span class="label label-success">Cart</span></a>
                                                </div>
                                                <?php }
                                            }
                                            ?>
                                </div>
                            </div><!market category division finishes here>
                        </div>
                       
                    
                    <?php
              
                    
                        include 'recommend.php';
                        include 'top10.php';?>


                </div>
            </div>
            <?php @include 'recent.php'; ?> 
            </div>
        <?php @include 'footer.php';?>
    </div>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
 <?php }
    else
    {
conn();
?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
<style>
   @media(max-width: 720px){
        h1{font-size:1.6em}
    }
    .p0{padding:0 0 0 0;}
    .m0{margin:0 0 0 0;}


    .br{border:red solid 1px;}
    .by{border:yellow solid 1px;}
    .bg{border:green solid 1px;}
    .rb{border-radius: 50%;}
    .tc{text-align:center;}
</style>
</head>
<body>
    <div class="container-fluid">
    <?php
    @include 'header.php'; ?>
        <div class="row">
            <?php include 'whats_new.php'; ?>
                <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                    <?php 
                    $res = mysql_query("select cname,cid from category where cid in(select distinct cid from p_detail where pid in(select pid from products))");
                    ?>
                    
                    
                    <div class="row">
                        <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                            <div class="panel-heading badge" style="margin-left:15px;">Explore by category</div>
                            <div class="panel-body">

                                <?php while ($sd = mysql_fetch_array($res)) { ?>
                                    <a href="category.php?c=<?php echo $sd['cid'];?>"><div title="<?php echo $sd['cname']; ?>" class="col-sm-1 col-xs-1" style="width: 100px; height: 100px; margin: 10px 10px 0 0; text-align: center; border-radius: 50%; border:#5cb85c 1px solid; color: #5cb85c;">
                                            <span class="label label-success"><?php $i = substr($sd['cname'], 0, 10);
                                echo $i . ".."; ?></span><h1 align="center"><?php echo $i[0]; ?></h1>
                                        </div></a>
                                <?php } ?>
                            </div>    
                        </div><!market category division finishes here>  
                    </div>
                    <?php include 'recommend.php'; ?>
                    <?php include 'top10.php'; ?>
                    
                    
                    
                </div>
            <?php @include 'recent.php'; ?>
            </div>
        <?php @include 'footer.php';?>
    </div>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
 <?php }
    
       ?>
