<?php require_once('../Connections/odf.php'); ?>
<?php
if ($_SESSION['admin']!="1") {
	echo("<script language=\"javascript\">"); 
	echo("top.location.href = \"index.php\";");
	echo("</script>");	
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if(isset($_POST['button']) && $_POST['button']=='Submit'){
	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['editor'])."' WHERE constants='ABOUTUS'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());
}


mysql_select_db($database_odf, $odf);
$query_ABOUTUS = "SELECT `values` FROM config WHERE constants = 'ABOUTUS'";
$ABOUTUS = mysql_query($query_ABOUTUS, $odf) or die(mysql_error());
$row_ABOUTUS = mysql_fetch_assoc($ABOUTUS);
$totalRows_ABOUTUS = mysql_num_rows($ABOUTUS);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="images/rocketcms.png" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Rocket CMS : P+P Solutions</title>
<script src="ckeditor.js"></script>
<script src="home.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="8%" scope="col"><img src="images/rocketcms.jpg" width="100" height="100" /></td>
    <td width="92%" scope="col"><img src="images/header.png" width="600" height="100" /></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><hr /></th>
  </tr>
  <tr>
    <th colspan="2" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <td colspan="2" scope="row"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left"><a href="dashboard.php"><img src="../images/dashnoard.png" width="230" height="60" /></a></td>
        <td align="center">&nbsp;</td>
        <td align="right"><a href="logout.php"><img src="../images/logout.png" width="230" height="60" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td><textarea name="editor" id="editor"><?php echo $row_ABOUTUS['values']; ?></textarea></td>
        </tr>
        <tr>
          <td><input name="button" type="submit" class="login_textbox" id="button" value="Submit" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <th colspan="2" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2" scope="row"><hr /></th>
  </tr>
  <tr>
    <th colspan="2" scope="row"><img src="images/footer.png" width="587" height="30" /></th>
  </tr>
</table>
<script>
	initSample();
</script>

</body>
</html>
<?php
mysql_free_result($ABOUTUS);
?>
