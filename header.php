<?php
//if(session_status() == PHP_SESSION_NONE){
session_start();
if(!isset($_SESSION['bill'])){
    $_SESSION['bill']=0;
}
?>
<div class="navbar" role="navigation" style="text-align: center; margin-bottom: 1px;">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="." style="margin-left: -30px"><img src="images/main_logo.png" style="width: 200px; height: 38px;" /></a>
    </div>
        <form action="search.php" method="GET">
            <div class="input-group pull-left" style="width: 240px; margin-top: 10px; text-align: center; margin-bottom: 0;">
                <input required type="text" class="form-control" placeholder="Search in market.." name="s" value="<?php if (isset($_GET['s'])) echo $_GET['s'];?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Search</button>
                </span>
            </div></form>
        <div class="pull-right " >
      <a  class="btn btn-default"  style="border:none; border-bottom: red solid 1px;" href="index.php">Explore Market</a>
<?php 
if (isset($_SESSION['user']))
    { 
    ?>
    <a id="lg" class="btn btn-default" style="border:none; border-bottom: red solid 1px;" href="#" onclick="$('#cart').slideUp();$('#login').slideToggle();">Hi, <?php echo $_SESSION['user'];?></a>
      <a href="#" class="btn btn-default"  style="border:none; border-bottom: red solid 1px;" onclick="$('#login').slideToggle();$('#cart').slideUp();">Settings</a>
      <a href="#" class="btn btn-default"  style="border:none; border-bottom: red solid 1px;" onclick="$('#login').slideUp();$('#cart').slideToggle();">Cart <span class='label label-danger bill'>Rs. <?php echo $_SESSION['bill']; ?></span></a>
        </div>
  </div>
         <div id="bar">
             <?php $i = array('default','primary','success','info','warning','danger'); shuffle($i);?>
         <a href='search.php?s=Electronic' ><span class="label label-<?php echo $i[0]; ?>">Electronic</span></a>
         <a href='search.php?s=Books' ><span class="label label-<?php echo $i[1]; ?>">Books</span></a>
         <a href='search.php?s=Fashion' ><span class="label label-<?php echo $i[2]; ?>">Fashion</span></a>
         <a href='search.php?s=Home & Kitchen' ><span class="label label-<?php echo $i[3]; ?>">Home & Kitchen</span></a>
         <a href='search.php?s=Mobile' ><span class="label label-<?php echo $i[4]; ?>">Mobile</span></a>
         <a href='search.php?s=Shoes' ><span class="label label-<?php echo $i[5]; ?>">Shoes</span></a>
         <a href='category.php' ><span class="label label-<?php echo $i[0]; ?>">More</span></a>
         </div>
</div>
  <div id="login" style="display:none; text-align: right; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row col-sm-12">
      <?php
      if(!isset($_SESSION['shop_name']))
        {?>
      <a href="open_shop.php"><input type="button" class="btn btn-primary" value="Open Shop"></a>
      <?php
        }
      else
        {?>
      <a href="add_product.php"><input type="button" class="btn btn-primary" value="Add Product"></a>
      <a href="sold_products.php"><input type="button" class="btn btn-primary" value="Sold Products"></a>
      <a href="stock.php"><input type="button" class="btn btn-primary" value="Stock"></a>
      <a href="shop.php?id=<?php echo $_SESSION['email'];?>"><input type="button" class="btn btn-primary" value="Shop Profile"></a>
      <a href="update_shop.php"><input type="button" class="btn btn-primary" value="Update shop"></a>
        <?php
        } ?>
        <a href="purchased_pro.php"><input type="button" class="btn btn-primary" value="Purchased Products"></a>
        <a href="update_profile.php"><input type="button" class="btn btn-primary" value="Update profile"></a>
        <a href="php/logout.php"><input type="button" class="btn btn-default" value="Logout"></a>
  </div> 
<?php 

}
 else 
     {
    ?>
      <a id="lg" class="btn btn-default" style="border: none; border-bottom: red solid 1px;" href="#" onclick="$('#Register').slideUp();$('#cart').slideUp();$('#login').slideToggle(); $('#u').focus();">Login</a>
      <a href="#" class="btn btn-default" style="border:none; border-bottom: red solid 1px;" onclick="$('#login').slideUp();$('#cart').slideUp();$('#Register').slideToggle(); $('#rn').focus();">Register</a>
      <a href="#" class="btn btn-default" style="border:none; border-bottom: red solid 1px;" onclick="$('#Register').slideUp();$('#login').slideUp();$('#cart').slideToggle();">Cart <span class='label label-danger bill'>Rs. <?php echo $_SESSION['bill']; ?></span></a>
    </div>
  </div>
         <div id="bar">
             <?php $i = array('default','primary','success','info','warning','danger'); shuffle($i);?>
         <a href='search.php?s=Electronic' ><span class="label label-<?php echo $i[0]; ?>">Electronic</span></a>
         <a href='search.php?s=Books' ><span class="label label-<?php echo $i[1]; ?>">Books</span></a>
         <a href='search.php?s=Fashion' ><span class="label label-<?php echo $i[2]; ?>">Fashion</span></a>
         <a href='search.php?s=Home & Kitchen' ><span class="label label-<?php echo $i[3]; ?>">Home & Kitchen</span></a>
         <a href='search.php?s=Mobile' ><span class="label label-<?php echo $i[4]; ?>">Mobile</span></a>
         <a href='search.php?s=Shoes' ><span class="label label-<?php echo $i[5]; ?>">Shoes</span></a>
         <a href='category.php' ><span class="label label-<?php echo $i[0]; ?>">More</span></a>
         </div>
</div>
  <div id="login" style="display:none; border-bottom: darkgray double 2px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row col-sm-12">
    <form class="navbar-form navbar-right">
      <fieldset>
        <legend align="center">Login</legend>
        <input id="u" required type="email" placeholder="Email address" class="form-control" >
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
<div id="cart" style="display:none; border-bottom: darkgray double 1px; padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px;" class="row panel-body">
    <legend align="center">Cart<a href="checkout.php" class="pull-right btn-primary btn">COD Payment</a></legend>
        <?php
        if (isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $key => $value) {
                $det = explode(";", $value);
                ?>
                <div class="col-sm-1 col-xs-1 current_product" style="width: 115px; padding-left:0px; text-align: center;">
                    <a href="product_details.php?id=<?php echo $key; ?>">
                        <span class="label label-danger prc">Rs. <?php echo $det[4]; ?></span>
                        <img src="<?php echo $det[2]; ?>" height="80px" width="100px"/><?php echo $det[1]; ?></a>
                    <br>
                    <span class="badge q" title="Quantity"><?php echo $det[3]; ?></span>
                    <br>
                    <span title="Click to increase quanity" style="cursor: pointer;" class="btn-success label pos" onclick="inc(this,<?php echo $key; ?>)">+</span>
                    <span title="Click to decrease quanity" style="cursor: pointer;" class="label btn-danger neg" onclick="dec(this,<?php echo $key; ?>)">-</span>
                    <span title="Click to remove product" style="cursor: pointer;" class="label btn-danger rem" onclick="rem(this,<?php echo $key; ?>)">Remove</span>
                </div>
            <?php }
        }
        ?>
</div>