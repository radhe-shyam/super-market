<?php
if(isset($_GET['id']))
    {
include 'php/safe.php';
$pid = safe($_GET['id']);
if($pid == ""){
header("Location:index.php");}
conn();
$res = mysql_query("Select pname, pimage, pdesc, pf, cid, pdesc from p_detail where pid='" . $pid . "'");
$pd = mysql_fetch_array($res);
$res = mysql_query("Select pprice, pquantity, pavail, powner from products where pid='" . $pid . "'");
$pp = mysql_fetch_array($res);
$res = mysql_query("Select name from shop where email='" . $pp[3] . "'");
$row = mysql_fetch_array($res);
$res = mysql_query("Select cname from category where cid='" . $pd[4] . "'");
$cn = mysql_fetch_array($res);
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

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

<script type="text/javascript">

$(document).ready(function(e) {
    var is_pro_added = 1;
	
	
	
		$('#buy').click(function(e) {
						
			if(!$('#cart_pro div').hasClass('current_product') ){ 
			
				alert('added to cart');
				
				product_price = 100;
					
				cart_total_amt = product_price + parseInt($('#cart_amt').html())
				
				$('#cart_amt').html(cart_total_amt);
			
				product_html= '<div class="col-sm-1 col-xs-1 current_product" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;"><a href="#" style="margin-left:2px;"><span class="label label-danger">Rs. <span id="pro_item1">100</span>/-</span><img src="p/1_2"/>Apple'+is_pro_added+' MacBook</a><br><span id="current_pro">1</span><br><a href="#" style="margin-left:2px;" class="add_item"><span class="label label-success" onClick="quantity_incr();">+</span></a><a href="#" style="margin-left:2px;" class="less_item"><span class="label label-success" onClick="quantity_decr();">-</span></a><a href="#" style="margin-left:2px;"><span class="label label-success" onClick="remove_product(this);">Remove</span></a></div>';
				
				$('#cart_pro').append($('#cart_pro').html() + product_html);
			
			 }
			
			is_pro_added++;
		});
		
		
		$('#continue_shop').click(function(e) {
            
			$('#cart').slideUp();
			
        });	
	
	
});

function quantity_incr(){
	
		pro_quantity=document.getElementById('current_pro');
		quantity= parseInt(pro_quantity.innerHTML);
		pro_quantity.innerHTML = quantity + 1;
		
		pro_price = document.getElementById('pro_item1');
		price = parseInt(pro_price.innerHTML);
		
		cart_amt = document.getElementById('cart_amt');
		cart_value = parseInt(cart_amt.innerHTML);
		
		cart_amt.innerHTML = price + cart_value;
	}
	
function quantity_decr(){

		pro_quantity=document.getElementById('current_pro');
		quantity= parseInt(pro_quantity.innerHTML);
		if(quantity>1){
	
			pro_quantity.innerHTML = quantity - 1;
			
			pro_price = document.getElementById('pro_item1');
			price = parseInt(pro_price.innerHTML);
			
			cart_amt = document.getElementById('cart_amt');
			cart_value = parseInt(cart_amt.innerHTML);
			
			cart_amt.innerHTML = cart_value - price;
	
		}else{
			
			alert('you cannot decrease below this.');
			
		}
		
		

}

function remove_product(a){
	
		is_remove = confirm('Do you want to remove this product from cart ?');
		
		if(is_remove){
			
			pro_price = document.getElementById('pro_item1');
			price = parseInt(pro_price.innerHTML);
			
			quantity = document.getElementById('current_pro');
			quantity = parseInt(quantity.innerHTML);
			
			cart_amt = document.getElementById('cart_amt');
			cart_value = parseInt(cart_amt.innerHTML);
			
			cart_amt.innerHTML = cart_value - price * quantity;
			
			
			$(a).parent().parent().remove();
			
		}
	}

</script>
</head>
<body>
    <div class="container-fluid">

    <?php @include 'header.php';?>
    
        <div class="row"> 
            <div class="col-sm-2 col-md-2 col-lg-2 pull-left"><!seller notification category division starts here>   
            </div><!seller notification category division finishes here>   
            
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 m0 panel panel-default" style="text-align:justify;">        
                <div class="row panel-heading">
                    Home > <?php echo $cn[0];?> > <b>Samsung Galaxy Tab 3 Neo</b>
                </div>
                <input id="pid" type="hidden" value="<?php echo $pid; ?>"/>
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
                        <div id="buy" class="pull-right" style="text-align:center; cursor: pointer;"><div class="btn-success" style="border-radius:50%; padding: 15px 15px 15px 15px;"><b>Buy Now</b><br>in just<br> Rs. <div class="badge"><?php echo $pp[0]; ?>/-</div></div>
                            from<br><a class="badge"><?php echo $row[0]; ?></a>
                        </div>
                    </div>
                </div>
               <!-- <div class="panel-info">
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
                </div> -->
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
