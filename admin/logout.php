<?php
session_start();
error_reporting(E_ALL); 
ini_set("display_errors", 0); 
date_default_timezone_set('Asia/Colombo');
$_SESSION['admin']="0";
echo("<script language=\"javascript\">"); 
echo("top.location.href = \"index.php\";");
echo("</script>");