<?php require_once('../Connections/odf.php'); ?>
<?php
$deleteSQL = "DELETE FROM gallery WHERE id=".$_GET['id'];
mysql_select_db($database_odf, $odf);
$Result1 = mysql_query($deleteSQL, $odf) or die(mysql_error());

$deleteGoTo = "gallery.php";
header(sprintf("Location: %s", $deleteGoTo));
