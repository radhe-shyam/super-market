            <div class="row">
                <div class="panel-primary panel" style="border:none;"><!market category division starts here>
                    <div class="panel-heading badge" style="margin-left:15px;">Explore by category</div>
                <div class="panel-body">

                        <?php while($sd = mysql_fetch_array($res)){ ?>
                        <a href="<?php echo end(explode("/",$_SERVER['REQUEST_URI']))."&c=". $sd['cid'];?>"><div title="<?php echo $sd['cname']; ?>" class="col-sm-1 col-xs-1" style="width: 100px; height: 100px; margin: 10px 10px 0 0; text-align: center; border-radius: 50%; border:#5cb85c 1px solid; color: #5cb85c;">
                            <span class="label label-success"><?php $i = substr($sd['cname'],0,10); echo $i."..";?></span><h1 align="center"><?php echo $i[0]; ?></h1>
                        </div></a>
                        <?php } ?>
                    
                    
                    <a href="#"><div class="col-sm-1 col-xs-1" style="width: 100px; height: 100px; margin: 10px 10px 0 0; text-align: center; border-radius: 50%; border:#d9534f 1px solid; color: #d9534f;">
                            <span class="label label-danger">More</span><h1 align="center">>></h1>
                        </div></a>
                    
         
          
                </div>    
            </div><!market category division finishes here>  
            </div>
            <?php include 'recommend.php';?>
            <?php include 'top10.php';?>
    
            <!-- <div class="row">
            <div class="panel panel-success" style="border:none;" ><!Recommended for you category starts here>
                 <div class="panel-heading badge" style="margin-left:15px;">Recommended for YOU</div>
                    <div class="panel-body"  style="overflow-x: scroll;">
                        <div style="width:1150px;">
                            <?php //@include './test.php';?>
                        </div>
                    </div>
                </div><!Recommended for you category finishes here>
            </div> -->
           