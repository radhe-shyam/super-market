<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Apana Market  -- BHARAT KA LOCAL BAZAAR --</title>
<link rel="icon" href="images/icon.png" type="image/png">
</head>
<body>
    <div class="container-fluid">
    <?php session_start();
    if(!isset($_SESSION['user']))
    { @header('Location:index.php'); die();}
    if(!isset($_SESSION['shop_name']))
    { @header('Location:index.php'); die();}
    @include 'header.php';
    require_once 'php/safe.php';
    conn();
    ?>
        <div class="row"> 
            <?php @include 'whats_new.php'; ?>   
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">    
                            <div class="row">
                <div class="panel-primary panel"><!market category division starts here>
                    <div class="panel-heading">Add new product information</div>
                <div class="panel-body">
                    <form id="os" role="form" action="php/pr.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="c">Choose category :</label>
                                <select name="ct" class="form-control" placeholder="Choose Category" required autofocus>
                                    <option></option>
                                <?php
                                $res = mysql_query("Select cid,cname from category");
                                while($row = mysql_fetch_array($res)){
                                echo "<option value=" . $row[0] . '>' . $row[1] . "</option>"; }
                                @mysql_free_result($res);
                                @mysql_close($conn); ?>
                                </select><br>
                                <label>Product Name :</label>
                                <input required type="text" class="form-control" name="pn" placeholder="Enter product name"><br>
                                <label>Product Image :</label>
                                <input required type="file"  name="pi"><br>
                                <label>Product Price :</label>
                                <input required type="number" class="form-control" name="pp" placeholder="Enter product price"><br>
                                <label>Product Quantity :</label>
                                <input required type="number" class="form-control" name="pq" placeholder="Enter product quantity"><br>
                                <label>About Product : </label>
                                <textarea required class="form-control" name="pd" placeholder="Enter product description here" rows="6"><?php echo $row[1]; ?></textarea><br>
                                
                                <div id="ef">
                                   <!-- <div id='ef'><label>Extra Feature :</label><input  type='button' value='Remove' class="pull-right btn-xs"><br>
                                        <label>Feature title :</label>
                                        <input required type="text" class="form-control" name="ft" placeholder="Give feature a title"><br>
                                        <label>Feature Description :</label>
                                        <textarea required class="form-control" name="fd" placeholder="Give feature description in detail" rows="3"></textarea><br>
                                    </div> -->
                                </div>
                                
                                <input type="button" class="btn btn-block" value="Add more features"/>
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
                        <input type="submit" id="r" class="btn btn-success" value="Add">
                        <input type='reset' class='btn btn-default' value="Clear">
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
