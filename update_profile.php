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
    @include 'header.php';
    conn();
    $res = mysql_query("Select a.name, a.address, b.password from u_details a, users b where a.email='" . $_SESSION['email'] . "' and b.email ='". $_SESSION['email'] . "'");
    $row = mysql_fetch_array($res);
    ?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>   
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                            <div class="row">
                <div class="panel-primary panel">
                    <div class="panel-heading">Update your profile</div>
                <div class="panel-body">
                    <form id="os" role="form" action="php/uup.php" method="POST">
                            <div class="form-group">
                                <label>Name :</label>
                                <input required type="text" class="form-control" name="sn" placeholder="Enter your name" value="<?php echo $row[0]; ?>"><br>
                                <label>Address : </label>
                                <textarea required class="form-control" name="sa" placeholder="Enter your address" rows="3"><?php echo $row[1]; ?></textarea><br>
                                <label>Password : </label>
                                <input required type="password" class="form-control" name="sp" placeholder="Enter your password" value="<?php echo $row[2]; ?>"><br>
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
