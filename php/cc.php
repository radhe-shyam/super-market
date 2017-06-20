<?php
session_start();
if ($_SESSION['securimage_code_disp']['default'] == $_POST['c']) 
    echo "1";
?>