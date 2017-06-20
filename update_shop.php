<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
</head>
<body>
    <div class="container-fluid">
    <?php session_start();
    require_once 'php/safe.php';
    if(!isset($_SESSION['user']))
    { @header('Location:index.php');}
    if(!isset($_SESSION['shop_name']))
    { @header('Location:index.php');}
    @include 'header.php';
    conn();
    $res = mysql_query("Select name, about, expert, address, contact from shop where email='" . $_SESSION['email'] . "'");
    $row = mysql_fetch_array($res);
    ?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>   
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                            <div class="row">
                <div class="panel-primary panel">
                    <div class="panel-heading">Update information of the Shop</div>
                <div class="panel-body">
                    <form id="os" role="form" action="php/sr.php" method="POST">
                            <div class="form-group">
                                <label>Shop name :</label>
                                <input required type="text" class="form-control" name="sn" placeholder="Enter shop name" value="<?php echo $row[0]; ?>"><br>
                                <label>About shop : </label>
                                <textarea required class="form-control" name="as" placeholder="Enter shop description here (Max. 2000 letters)" rows="6"><?php echo $row[1]; ?></textarea><br>
                                <label>Shop Expertise : </label>
                                <textarea required class="form-control" name="se" placeholder="Enter the shop expertise, like in which type of products you are expert. Eg. Furniture, Grocery, Stationary etc." rows="3"><?php echo $row[2]; ?></textarea><br>
                                <label>Shop address : </label>
                                <textarea required class="form-control" name="sa" placeholder="Enter shop address" rows="3"><?php echo $row[3]; ?></textarea><br>
                                <label id="rdj" for="cn">Contact No. : </label>
                                <input required type="number" class="form-control" name="cn" placeholder="Enter shop's contact number" value="<?php echo $row[4]; @mysql_free_result($res); @mysql_close(); ?>"><br>
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
                        <a href="shop.php"><input type='button' class='btn btn-default' value="Cancel"></a>
                    </form>            
                    
                </div>    
            </div>  
            </div>
            </div>
            <?php @include 'recent.php'; ?>        

        </div>
        <?php @include 'footer.php';?>
    </div>
</body>
</html>
