<div class="panel-success panel col-sm-2 pull-right hidden-xs" style="height: 700px; overflow: hidden;">
    <div class="panel-heading badge">Recent transactions</div>
    <div class="panel-body"><?php
        //include 'php/safe.php';
          conn();
        $tob = mysql_query("SELECT ono, bemail FROM order_det order by odate desc limit 7");
        while ($tob1 = mysql_fetch_array($tob)) {
            $naam = mysql_fetch_array(mysql_query("select name from u_details where email='" . $tob1['bemail'] . "'"));
            $tsn = mysql_query("SELECT distinct semail FROM invoice where ono= '" . $tob1['ono'] . "' limit 10");
            while ($tsn1 = mysql_fetch_array($tsn)) {
                $snaam = mysql_fetch_array(mysql_query("select name from shop where email='" . $tsn1['semail'] . "'"));
                ?>
        <a href="shop.php?id=<?php echo $tsn1['semail']; ?>"><b><?php echo $naam['name'];?></b> shopped in <b><?php echo $snaam['name']; ?></b></a><hr>
        <?php
            }
         }?>
    </div>
</div> 