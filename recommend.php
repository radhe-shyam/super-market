<div class="row">
    <div class="panel panel-success" style="border:none;" >
        <div class="panel-heading badge" style="margin-left:15px;">Recommended products</div>
        <div class="panel-body" style=" overflow-x: auto;">
            <div style="width:1150px">
                <?php
                //include 'php/safe.php';
                conn();
                if (isset($_SESSION['email'])) {
                    $res = mysql_query("Select recom from u_details where email='" . $_SESSION['email'] . "'");
                    $pd = mysql_fetch_array($res);
                    $arr = explode('#', $pd[0]);
                    foreach ($arr as $val) {
                        if ($val == "")
                            break;
                        $res = mysql_query("Select pname, pimage from p_detail where pid='" . $val . "'");
                        if ($pd = mysql_fetch_array($res)) {
        
                        $res = mysql_query("Select pprice from products where pid='" . $val . "'");
                        if (!$pp = mysql_fetch_array($res)) {
                            echo "";
                        }
                        ?>
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="product_details.php?id=<?php echo $val; ?>">
                                <span class="label label-danger">Rs. <?php echo $pp[0]; ?></span>
                                <img src="<?php echo $pd[1]; ?>" width="100px" height="80px"/><?php echo substr($pd[0], 0, 20); ?></a><br>
                            <a href="#" class="buy"><input type="hidden" value="<?php echo $val; ?>" /><span class="label label-success">Buy</span></a>
                            <a href="#" class="buy"><input type="hidden" value="<?php echo $val; ?>" /><span class="label label-success">Cart</span></a>
                        </div>
                        <?php
                      }

                    }
                } else {
                    $res = mysql_query("Select pid, pname, pimage from p_detail limit 10");
                    while ($pid = mysql_fetch_array($res)) {
                        $resd = mysql_query("Select pname, pimage from p_detail where pid='" . $pid[0] . "'");
                        if (!$pd = mysql_fetch_array($resd)) {
                            echo "";
                        }
                        $resp = mysql_query("Select pprice from products where pid='" . $pid[0] . "'");
                        if (!$pp = mysql_fetch_array($resp)) {
                            echo "";
                        }
                        ?>
                        <div class="col-sm-1 col-xs-1" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;">
                            <a href="product_details.php?id=<?php echo $pid[0]; ?>"><span class="label label-danger">Rs. <?php echo $pp[0]; ?></span>
                                <img src="<?php echo $pd[1]; ?>" width="100px" height="80px"/><?php echo substr($pd[0], 0, 20); ?></a><br>
                            <a href="#" class="buy"><input type="hidden" value="<?php echo $pid['pid']; ?>" /><span class="label label-success">Buy</span></a>
                            <a href="#" class="buy"><input type="hidden" value="<?php echo $pid['pid']; ?>" /><span class="label label-success">Cart</span></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>  
        </div>
    </div>
</div>
