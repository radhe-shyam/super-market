<?php
if(session_status() == PHP_SESSION_NONE){
session_start();}
/*if( isset( $_SESSION['user'] ) )
   {
      echo "logged in as " . $_SESSION['user'];
   }
   else
   {
      echo "not logged in";
   }*/
   /*
@include 'php/safe.php';
$conn = @mysql_connect(DB_ADDRESS,VIEW_USER,VIEW_PASSWORD) or die("something went wrong");
mysql_select_db('AM');

*/
?>
<div class="navbar" role="navigation" style="text-align: center; margin-bottom: 1px;">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="." style="margin-left: -30px"><img src="images/main_logo.png" style="width: 200px; height: 38px;" /></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <div class="input-group" style="float: none; width: 240px; margin-top: 10px; text-align: center; margin-bottom: 0;">
                <input type="text" class="form-control" placeholder="Search in market..">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                </span>
            </div>
        </li>
      <li><a href="index.php">Explore Market</a></li>
<?php 
if (isset($_SESSION['user']))
    { 
    ?>
    <li><a id="lg" href="#" onclick="$('#cart').hide(1);$('#login').toggle(1);">Hi, <?php echo $_SESSION['user'];?></a></li>
      <li><a href="#" onclick="$('#login').toggle(1);$('#cart').hide(1);">Settings</a></li>
      <li><a href="#" onclick="$('#login').hide(1);$('#cart').toggle(1);">Cart <span class='label label-danger' id="cart_amt"><?php if(isset($_SESSION['cart'])){ echo 'Rs '.$total_amt.' '; }else{ echo 'Rs. 0'; }?></span></a></li>
    </ul>
  </div>
         <div id="bar">
         <a href='#' ><span class="label label-default">Electronic</span></a>
         <a href='#' ><span class="label label-primary">Books</span></a>
         <a href='#' ><span class="label label-success">Fashion</span></a>
         <a href='#' ><span class="label label-info">Home & Kitchen</span></a>
         <a href='#' ><span class="label label-warning">Mobile</span></a>
         <a href='#' ><span class="label label-success">Offers</span></a>
         <a href='#' ><span class="label label-danger">More</span></a>
         </div>
</div>
  <div id="login" style="display:none; text-align: right; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row col-sm-12">
      <?php
      if(!isset($_SESSION['shop_name']))
        {?>
      <a href="open_shop.php"><input type="button" class="btn btn-success" value="Open Shop"></a>
      <?php
        }
      else
        {?>
      <a href="open_shop.php"><input type="button" class="btn btn-success" value="Manage shop"></a>
        <?php
        } ?>
        <a href="php/logout.php"><input type="button" class="btn btn-default" value="Logout"></a>
  </div> 
<?php 

}
 else 
     {
    ?>
      <li><a id="lg" href="#" onclick="$('#Register').slideUp();$('#cart').slideUp();$('#login').toggle();">Login</a></li>
      <li><a href="#" onclick="$('#login').slideUp();$('#cart').slideUp();$('#Register').toggle();">Register</a></li>
      <li><a href="#" onclick="$('#Register').slideUp();$('#login').slideUp();$('#cart').toggle();">Cart <span class='label label-danger'><?php if(isset($_SESSION['cart'])){ echo 'Rs <span id="cart_amt"> '.$total_amt.' </span> '; }else{ echo 'Rs. <span id="cart_amt"> 0 </span>'; }?></span></a></li>
    </ul>
  </div>
         <div id="bar">
         <a href='#' ><span class="label label-default">Electronic</span></a>
         <a href='#' ><span class="label label-primary">Books</span></a>
         <a href='#' ><span class="label label-success">Fashion</span></a>
         <a href='#' ><span class="label label-info">Home & Kitchen</span></a>
         <a href='#' ><span class="label label-warning">Mobile</span></a>
         <a href='#' ><span class="label label-success">Offers</span></a>
         <a href='#' ><span class="label label-danger">More</span></a>
         </div>
</div>
  <div id="login" style="display:none; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row col-sm-12">
    <form class="navbar-form navbar-right">
      <fieldset>
        <legend align="center">Login</legend>
        <input id="u" required type="text" placeholder="Email address" class="form-control" >
        <input id="p" required type="password" placeholder="Password" class="form-control">
        <input id="s" type="submit" class="btn btn-success" value="Login">
        <font color="red"><b><div id="ip"></div></b></font>
      </fieldset>
    </form>
  </div> 
  <div id="Register" style="display:none; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row col-sm-12">
    <form class="navbar-form navbar-right">
      <fieldset>
        <legend align="center">Register</legend>
        <input id="rn" required type="text" placeholder="Your Name"  class="form-control">
        <input id="re" required type="email" placeholder="Email address" class="form-control"> 
        <input id="rp" required type="password" placeholder="Password"  class="form-control">
        <input id="rs" type="submit" class="btn btn-success" value="Register">
        <font color="red"><b><div id="mar"></div></b></font>
      </fieldset>
    </form>
  </div> 
 <?php 
     }
     ?>
<div id="cart" style="display:none; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row panel-body">
    <legend align="center">Cart</legend>
        <?php //for($i=0; $i<4; $i++){@include 'cp.php';}  ?>
    <legend>&nbsp;</legend>
	<div id="cart_pro">
    <?php
    /*<div class="col-sm-1 col-xs-1 current_product" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;"><a href="#" style="margin-left:2px;"><span class="label label-danger">Rs. <span id="pro_item1">100</span>/-</span><img src="p/1_2"/>AppleMacBook</a><br><span id="current_pro">1</span><br><a href="#" style="margin-left:2px;" class="add_item"><span class="label label-success" onClick="quantity_incr();">+</span></a><a href="#" style="margin-left:2px;" class="less_item"><span class="label label-success" onClick="quantity_decr();">-</span></a><a href="#" style="margin-left:2px;"><span class="label label-success" onClick="remove_product(this);">Remove</span></a></div>
    
    <div class="col-sm-1 col-xs-1 current_product" style="width: 115px; margin-top: 10px; padding-left:7px; text-align: center;"><a href="#" style="margin-left:2px;"><span class="label label-danger">Rs. <span id="pro_item1">100</span>/-</span><img src="p/1_2"/>AppleMacBook</a><br><span id="current_pro">1</span><br><a href="#" style="margin-left:2px;" class="add_item"><span class="label label-success" onClick="quantity_incr();">+</span></a><a href="#" style="margin-left:2px;" class="less_item"><span class="label label-success" onClick="quantity_decr();">-</span></a><a href="#" style="margin-left:2px;"><span class="label label-success" onClick="remove_product(this);">Remove</span></a></div>
   */ ?>
    </div>
<div style="clear: both;padding-top: 22px; text-align:right;"><button>Pay now</button> <button id="continue_shop">Continue Shopping</button></div>
</div>
