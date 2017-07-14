<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_odf = "localhost";
$database_odf = "rocketcms";
$username_odf = "root";
$password_odf = "";
$odf = mysql_pconnect($hostname_odf, $username_odf, $password_odf) or trigger_error(mysql_error(),E_USER_ERROR);

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 0);
date_default_timezone_set('Asia/Colombo');

?>
