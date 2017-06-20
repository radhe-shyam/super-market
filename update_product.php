<?php
session_start();
    if(!isset($_SESSION['user']))
    { @header('Location:index.php'); die();}
    if(!isset($_SESSION['shop_name']))
    { @header('Location:index.php'); die();}
    if(!isset($_GET['id']))
    { @header('Location:index.php'); die();}
    if(!isset($_SERVER['HTTP_REFERER']))
    { @header('Location:index.php'); die();}
    if($_SERVER['HTTP_REFERER'] != "http://localhost/apanamarket.com/stock.php")
    { @header('Location:index.php'); die();}
include 'php/safe.php';
$pid = safe($_GET['id']);
if($pid == ""){
header("Location:test.php");}
conn();
$res = mysql_query("Select pname, pimage, pdesc, pf, cid from p_detail where pid='" . $pid . "'");
if(!$pd = mysql_fetch_array($res)){
    header("Location:index.php");
    die();}  
$res = mysql_query("Select pprice, pquantity, pavail, powner from products where pid='" . $pid . "'");
$pp = mysql_fetch_array($res);
$res = mysql_query("Select name from shop where email='" . $pp[3] . "'");
$row = mysql_fetch_array($res);
$res = mysql_query("Select cname from category where cid='" . $pd['cid'] . "'");
$cn = mysql_fetch_array($res);
$pf = explode('<',$pd['pf']);
$c = count($pf);
?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
</head>
<body>
    <div class="container-fluid">
        <?php @include 'header.php'; ?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>   
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                            <div class="row">
                <div class="panel-primary panel">
                    <div class="panel-heading">Update product information</div>
                <div class="panel-body">
                    <form id="os" role="form" action="php/up.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="c">Choose category :</label>
                                <input type="hidden" value="<?php echo $pid;?>" name="pid"/>
                                <select name="ct" class="form-control" placeholder="Choose Category" required autofocus>
                                <?php
                                $res = mysql_query("Select cid,cname from category");
                                while($row = mysql_fetch_array($res)){
                                    if($row['cid'] == $pd['cid']){
                                    echo "<option value=" . $row[0] . ' selected>' . $row['cname'] . "</option>";}
                                    else{
                                        echo "<option value=" . $row[0] . '>' . $row['cname'] . "</option>"; }
                                }
                                //@mysql_free_result($res);
                                //@mysql_close($conn); 
                                ?>
                                </select><br>
                                <label>Product Name :</label>
                                <input required type="text" class="form-control" name="pn" placeholder="Enter product name" value="<?php echo $pd['pname'];?>"><br>
                                <label>Product Price :</label>
                                <input required type="number" class="form-control" name="pp" placeholder="Enter product price" value="<?php echo $pp['pprice'];?>"><br>
                                <label>Product Quantity :</label>
                                <input required type="number" class="form-control" name="pq" placeholder="Enter product quantity" value="<?php echo $pp['pquantity'];?>"><br>
                                <label>About Product : </label>
                                <textarea required class="form-control" name="pd" placeholder="Enter product description here" rows="6"><?php echo $pd['pdesc']; ?></textarea><br>
                                
                                <div id="ef">
                                    <?php 
                                    for($i=0;$i<$c-1;$i+=2){
                                    ?>
                                    <div>
                                        <label>Extra Feature :</label>
                                        <!input  type="button" value="Remove" class="pull-right btn-xs r">
                                        <br>
                                        <label>Feature title :</label>
                                        <input required type="text" class="form-control" name="ft<?php echo $i/2; ?>" placeholder="Give feature a title" value="<?php echo $pf[$i]; ?>">
                                               <br>
                                        <label>Feature Description :</label>
                                        <textarea required class="form-control" name="fd<?php echo $i/2; ?>" placeholder="Give feature description in detail" rows="3"><?php echo $pf[$i+1]; ?></textarea>
                                        <br>
                                    </div>
                                    <?php } ?>
                                </div>
                                
                                <!input type="button" class="btn btn-block" value="Add more features"/>
                                <?php
                                    require_once 'captcha/securimage.php';
                                    $options = array();
                                    $options['input_name'] = 'c';
                                    if (!empty($_SESSION['ctform']['captcha_error'])) {
                                        $options['error_html'] = $_SESSION['ctform']['captcha_error'];
                                        }
                                    echo Securimage::getCaptchaHtml($options);
                                ?>
                                <label id="e" for="captcha_code" style="color:red;"></label>
                            </div>
                        <input type="submit" id="r" class="btn btn-success" value="Update">
                        <a href="stock.php" class='btn btn-default' >Clear</a>
                    </form>            
                    
                </div>    
            </div><!market category division finishes here>  
            </div>
            </div>
            <?php @include 'recent.php'; ?>        
        </div>
        <?php @include 'footer.php';?>
    </div>
</body>
</html>

 */ ?>