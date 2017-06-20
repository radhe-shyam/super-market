<?php
//session_start();
#echo str_replace(" ","%","radhe shyam jangid");
#echo time();
//echo time()."<br>";
//echo date("j \of Y, \a\\t g.i A", time());

//$i= strstr("radhe jangid shyam", " ", true);
//echo end(explode("/",$_SERVER['REQUEST_URI']));
//select  distinct c.cname from products a, p_detail b, category c where a.pid=b.pid and c.cid=b.cid and a.powner='radhe@gmail.com'
        
//select cname from category where cid in(select distinct cid from p_detail where pid in(select pid from products where powner='radhe@gmail.com') )

?>
<html>
<head>
<title>Sending email using PHP</title>
</head>
<body>
<?php
   $to = "radhe.the.rdj@gmail.com";
   $subject = "This is subject";
   $message = "This is simple text message.";
   $header = "From:radhe.the.rdj@gmail.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )  
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
</body>
</html>