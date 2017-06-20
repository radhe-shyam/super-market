<?php
define("DB_ADDRESS", "localhost");
define("VIEW_USER", "root");
define("VIEW_PASSWORD", "");
//define("A_P_P","http://localhost/am/add_product.php"); //This variable is also defined in php/pr.php file
//define("U_P_P","http://localhost/am/update_product.php"); //This variable is also defined in php/pr.php file
define("O_S_P","http://localhost/am/open_shop.php");
define("U_S_P","http://localhost/am/update_shop.php");
function safe($m){
return htmlspecialchars(mysql_real_escape_string(stripslashes($m)));
}
function conn(){
    $conn = @mysql_connect(DB_ADDRESS,VIEW_USER,VIEW_PASSWORD) or die("something went wrong by login page");
    @mysql_select_db('AM');
}
?>
