<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
</head>
<body>
    <div class="container-fluid">
    <?php session_start();
    @include 'php/safe.php';
    if(!isset($_SESSION['user']))
    { @header('Location:index.php');}
    if(isset($_SESSION['shop_name']))
    { @header('Location:shop.php');}
    @include 'header.php'?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>    
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                            <div class="row">
                <div class="panel-primary panel"><!market category division starts here>
                    <div class="panel-heading">Add information of the Shop</div>
                <div class="panel-body">
                    <form id="os" role="form" action="php/sr.php" method="POST">
                            <div class="form-group">
                                <label>Shop name :</label>
                                <input required autofocus type="text" class="form-control" name="sn" placeholder="Enter shop name"><br>
                                <label>About shop : </label>
                                <textarea required class="form-control" name="as" placeholder="Enter shop description here (Max. 2000 letters)" rows="6"></textarea><br>
                                <label>Shop Expertise : </label>
                                <textarea required class="form-control" name="se" placeholder="Enter the shop expertise, like in which type of products you are expert. Eg. Furniture, Grocery, Stationary etc." rows="3"></textarea><br>
                                <label>Shop address : </label>
                                <textarea required class="form-control" name="sa" placeholder="Enter shop address" rows="3"></textarea><br>
                                <label id="rdj" for="cn">Contact No. : </label>
                                <input required type="number" class="form-control" name="cn" placeholder="Enter shop's contact number"><br>
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
                        <input type="submit" id="r" class="btn btn-success" value="Submit">
                        <input type='reset' class='btn btn-default' value="clear">
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
