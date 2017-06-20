<div class="row">
    <div class="panel panel-success" style="border:none;" >
        <div class="panel-heading badge" style="margin-left:15px;">Top 10 lowest price products</div>
        <div class="panel-body" style=" overflow-x: auto;">
            <div style="width:1150px">
                <?php
                //include 'php/safe.php';
                conn();
                $res = mysql_query("Select pid, pprice from products order by pprice limit 10");
                while ($pid = mysql_fetch_array($res)) {
                    $resd = mysql_query("Select pname, pimage from p_detail where pid='" . $pid[0] . "'");
                    if (!$pd = mysql_fetch_array($resd)) {
                        echo "";
                    }
                    ?>
                    <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                        <a href="product_details.php?id=<?php echo $pid[0]; ?>"><span class="label label-danger">Rs. <?php echo $pid[1]; ?></span>
                            <img src="<?php echo $pd[1]; ?>" width="100px" height="80px"/><?php echo substr($pd[0], 0, 20); ?></a><br>
                        <a href="#" class="buy"><input type="hidden" value="<?php echo $pid['pid']; ?>" /><span class="label label-success">Buy</span></a>
                        <a href="#" class="buy"><input type="hidden" value="<?php echo $pid['pid']; ?>" /><span class="label label-success">Cart</span></a>
                    </div>
                    <?php
                }
                ?>
            </div>  
        </div>
    </div>
</div>
