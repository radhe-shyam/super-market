<?php
session_start();
if(isset($_GET['id']))
    {
include 'php/safe.php';
$sid = safe($_GET['id']);
if($sid == ""){
header("Location:index.php"); die();}
conn();
$res = mysql_query("Select name, address, contact, expert, about, trust, custo from shop where email='" . $sid . "'");
if(!$sd = mysql_fetch_array($res)){
    header("Location:index.php");
    die();}  
$ta = explode('#',$sd['trust']);
$tc = count($ta)-1;
$hca = explode('#',$sd['custo']);
$hcc = count($hca)-1;

@mysql_close($conn);
//$pf = explode('<',$pd[3]);
//$c = count($pf);
?>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <title><?php echo $sd['name'];?></title>
        <link rel="icon" href="c/a" type="image/png">
        <style>
            @media(max-width: 720px){
                h1{font-size:1.6em}
            }

            .p0{padding:0px 0px 0px 0px;}
            .m0{margin:0px 0px 0px 0px;}
            .tc{text-align:center;}


            .br{border:red solid 1px;}
            .by{border:yellow solid 1px;}
            .bg{border:green solid 1px;}
            .rb{border-radius: 50%;}

        </style>
    </head>
    <body>
        <div class="container-fluid m0">
    <?php @include 'header.php'; ?>
            <div class="row"> 
            <?php @include 'whats_new.php'; ?> 
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 p0" style="border-top: #777 1px dotted; border-radius: 0.17%;">
                    <a href="shop.php?id=<?php echo $sid;?>"><h1 align="center" class="m0" style="color:#777;"><b><?php echo $sd['name'];?></b></h1></a>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-width: 990px; margin: 0 0 0 0; padding:0 0 0 0">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" style="max-height:300px;">
                            <div class="item active"><img src="c/1" alt="..." ></div>
                            <div class="item"><img src="c/2" alt="..."></div>
                            <div class="item"><img src="c/3" alt="..."></div>

                        </div>
                    </div>
                    <div class="row m0" style="height:125px;">

                        <div class="col-xs-1 p0" style="height:125px; width:125px;">
                            <img src="c/a"/>
                        </div>
                        <div class="col-xs-11 pull-right p0 m0 tc" style=" max-width: 158px; max-height:126px;">
                            <a href="#"><div class="glyphicon glyphicon-heart btn btn-default" style=" border-radius: 50%; height: 30px; width: 35px; padding: 4px 0 0 0"></div></a>
                            <ul class="list-inline">
                                <li><?php echo $tc;?> Trusts.</li>
                                <li><?php echo $hcc;?> Happy Buyers.</li>
                                <li>Expert in <?php echo $sd['expert'];?></li>
                            </ul>
                        </div>
                        <div class="col-xs-12" style="max-width: 350px; ">
                            <address><strong><?php echo $sd['name'];?></strong><br><?php $add = explode(',',$sd['address']); foreach($add as $val) echo $val . "<br>" ;?>Cont. No. - <?php echo $sd['contact'];?></address>
                        </div>
                    </div><div class="row m0"></div>
                    <div class="row m0 p0">




                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs m0 p0" role="tablist">
                            <li class="active"><a href="#d" role="tab" data-toggle="tab">Shopper's Desk</a></li>
                            <li><a href="category.php?id=<?php echo $sid;?>">Product Category</a></li>
                            <li><a href="#c" role="tab" data-toggle="tab">Customers</a></li>
                            <li><a href="#po" role="tab" data-toggle="tab">Photos</a></li>
                            <li><a href="#a" role="tab" data-toggle="tab">About</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="d" style="margin-top: 5px;"><?php
                        $res = mysql_query("SELECT pid, pprice, pquantity, time FROM products where powner='" . $sid . "'");
                        while ($pid = mysql_fetch_array($res)) {
                            $p = mysql_query("Select pname from p_detail where pid='" . $pid[0] . "'");
                            if (!$pn = mysql_fetch_array($p)) { echo "";}
                        ?>

                                <div class="panel panel-default" >
                                    <div class="panel-heading">
                                        <img src="c/a" height="40px" width="40px" style="border-radius: 50%;"/>
                                        <b><?php echo $sd['name'];?></b><small><?php echo @date(" \a\\t g:i A \o\\n F j, Y ", $pid['time']); ?></small></div>
                                    <div class="panel-body">
                                        <p>
                                            Added <?php echo $pid['pquantity'] . " " . $pn['pname'] . " in stock at Rs. " . $pid['pprice'] ."/- each.";?>
                                        </p>
                                    </div>
                                </div>



                        <?php } ?>
                            </div>
                            <div class="tab-pane tc" id="c" style="margin-top: 5px;"><?php for($i=0;$i<11;$i++)include 'ci.php'; ?></div>
                            <div class="tab-pane tc" id="po" style="margin-top: 5px;"><?php for($i=0;$i<11;$i++)include 'ph.php'; ?></div>
                            <div class="tab-pane" id="a" style="margin-top: 5px;">
                                <div class="panel panel-default" style="text-align: justify;">
                                    <div class="panel-heading">About the Store</div>
                                    <div class="panel-body">
                                        <big style="margin-left: 50px;">Chrome Stores</big> is a leading destination for online shopping in India, offering some of the best prices and a completely hassle-free experience with options of paying through Cash on Delivery, Debit Card, Credit Card and Net Banking processed through secure and trusted gateways. Now shop for your favorite books, apparel, footwear, lifestyle accessories, baby care products, toys, posters, sports and fitness, mobile phones, laptops, cameras, movies, music, health and beauty, televisions, refrigerators, air-conditioners, washing machines, MP3 players and products from a host of other categories available. Some of the top selling electronic brands on the website are Samsung, HTC, Nokia, Dell, HP, Sony, Canon, Nikon, LG, Toshiba, Philips, Braun, Bajaj and Morphy Richards. Browse through our cool lifestyle accessories, apparel and footwear brands featured on our site with expert descriptions to help you arrive at the right buying decision. Chrome Stores also offers free home delivery for many of our products along with easy EMI options. Get the best prices and the best online shopping experience every time, guaranteed.                                       
                                    </div>
                                </div>  
                                <div class="panel panel-default" >
                                    <div class="panel-heading">Achievements</div>
                                    <div class="panel-body">
                                        <blockquote>
                                            <p>Awarded No. 1 seller in Maharashtra.</p>
                                            <footer class="pull-right">By apanamarket.com</footer>
                                        </blockquote>
                                        <blockquote>
                                            <p>Awarded No. 1 seller of Samsung in India.</p>
                                            <footer class="pull-right">By Samsung - India</footer>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="panel panel-default" >
                                    <div class="panel-heading">Store Owner(s)</div>
                                    <div class="panel-body">
                                        <?php @include 'ci.php'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>




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
        header("Location:index.php");?>
