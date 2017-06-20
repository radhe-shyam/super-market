<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
        <link rel="icon" href="images/icon.png" type="image/png">
    </head>
     <body>
        <div class="container-fluid">
            <?php 
            @include 'php/safe.php';
            @include 'header.php'; ?>
            <div class="row"> 
                <?php @include 'whats_new.php'; ?> 
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


                                <a href="category.php"><div class="col-sm-1 col-xs-1" style="width: 100px; height: 100px; margin: 10px 10px 0 0; text-align: center; border-radius: 50%; border:#d9534f 1px solid; color: #d9534f;">
                                        <span class="label label-danger">More</span><h1 align="center">>></h1>
                                    </div></a>



                            </div>    
                        </div><!market category division finishes here>  
                    </div>
                    <?php include 'recommend.php'; ?>
                    <?php include 'top10.php'; ?>
                    
                    
                    
                </div>
                <?php @include 'recent.php'; ?> 
            </div>
            <?php @include 'footer.php'; ?>
        </div>
    </body>
</html>
