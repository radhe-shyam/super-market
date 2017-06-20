
<div class="panel-success panel col-sm-2 col-md-2 col-lg-2 pull-left hidden-xs" style="height: 700px; overflow: hidden;">
    <div class="panel-heading badge">Whats new</div>
    <div class="panel-body">
        <?php
        //include 'php/safe.php';
        conn();
        $res = mysql_query("SELECT pid, powner, pprice FROM products order by time desc limit 6");
        while ($wpid = mysql_fetch_array($res)) {
            $sr = mysql_query("Select pname from p_detail where pid='" . $wpid[0] . "'");
            if (!$wpd = mysql_fetch_array($sr)) {
                echo "";
            }
            $sr = mysql_query("Select name from shop where email='" . $wpid[1] . "'");
            if (!$s = mysql_fetch_array($sr)) {
                echo "";
            }
            ?>
            <a href="product_details.php?id=<?php echo $wpid[0]; ?>"><b><?php echo $s[0]; ?></b> launched <?php echo substr($wpd[0], 0, 20); ?> @ Rs. <?php echo $wpid[2]; ?>/-</a>
            <hr>
<?php } ?>
    </div>
</div>