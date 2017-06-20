<?php
session_start();
if(isset($_SERVER['HTTP_REFERER']))
{
    header("Location:".$_SERVER['HTTP_REFERER']);
    session_destroy();
}
    echo "Its a SPAM. It seems that you are not in secure connection."
?>