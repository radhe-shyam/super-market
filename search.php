<?php
include 'php/safe.php';
if(isset($_GET['s']))
    $search = trim(safe($_GET['s']));
else
    $search = "";
?>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
        <link rel="icon" href="images/icon.png" type="image/png">
    </head>
    <body>
        <div class="container-fluid">
            <?php 
            @include 'header.php'; ?>
            <div class="row"> 
                <?php @include 'whats_new.php'; ?> 
                <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                        <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                            <div class="panel-heading badge" style="margin-left:15px;">Search Result for "<?php echo $search; ?>"</div>
                            <div class="panel-body">

                                <?php
                                conn();
                                $spid1 = mysql_query("select pid from search where kword like '%" . str_replace(" ","%",$search) . "%' group by pid order by count(pid) desc");
                                if(mysql_num_rows($spid1) == 0)
                                    echo '<big class="list-group-item list-group-item-success">No result found</big>';
                                while ($spid = mysql_fetch_array($spid1)) {
                                    $spp1 = mysql_query("Select pprice from products where pid='" . $spid['pid'] . "'");
                                    $spp = mysql_fetch_array($spp1);
                                    $sni1 = mysql_query("Select pname, pimage from p_detail where pid='" . $spid['pid'] . "'");
                                    if ($sni = mysql_fetch_array($sni1)) {
                                    ?>
                                    <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                                        <a href="product_details.php?id=<?php echo $spid['pid']; ?>"><span class="label label-danger">Rs. <?php echo $spp['pprice']; ?></span>
                                            <img src="<?php echo $sni['pimage']; ?>" width="100px" height="80px"/><?php echo substr($sni['pname'], 0, 20); ?></a><br>
                                        <a href="#" class="buy"><input type="hidden" value="<?php echo $spid['pid']; ?>" /><span class="label label-success">Buy</span></a>
                                        <a href="#" class="buy"><input type="hidden" value="<?php echo $spid['pid']; ?>" /><span class="label label-success">Cart</span></a>
                                    </div>
                                    <?php
                                    }
                                }
                                ?>

                            </div>    
                        </div><!market category division finishes here>  
                    <?php include 'recommend.php'; ?>
                    <?php //include 'top10.php'; ?>
                    
                    
                    
                </div>
                <?php @include 'recent.php'; ?> 
            </div>
            <?php @include 'footer.php'; ?>
        </div>
    </body>
</html>
