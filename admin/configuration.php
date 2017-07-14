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
	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['title'])."' WHERE constants='TITLE'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());
	
	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['keywords'])."' WHERE constants='METAKEYWORDS'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());

	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['description'])."' WHERE constants='METADESCRIPTION'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());
	
	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['footer'])."' WHERE constants='FOOTER'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());

	$updateSQL = "UPDATE `config` SET `values`='".htmlentities($_POST['contactemail'])."' WHERE constants='CONTACTEMAIL'";
	mysql_select_db($database_odf, $odf);
	$Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());
}

mysql_select_db($database_odf, $odf);
$query_title = "SELECT `values` FROM config WHERE constants = 'TITLE'";
$title = mysql_query($query_title, $odf) or die(mysql_error());
$row_title = mysql_fetch_assoc($title);
$totalRows_title = mysql_num_rows($title);

mysql_select_db($database_odf, $odf);
$query_keywords = "SELECT `values` FROM config WHERE constants = 'METAKEYWORDS'";
$keywords = mysql_query($query_keywords, $odf) or die(mysql_error());
$row_keywords = mysql_fetch_assoc($keywords);
$totalRows_keywords = mysql_num_rows($keywords);

mysql_select_db($database_odf, $odf);
$query_description = "SELECT `values` FROM config WHERE constants = 'METADESCRIPTION'";
$description = mysql_query($query_description, $odf) or die(mysql_error());
$row_description = mysql_fetch_assoc($description);
$totalRows_description = mysql_num_rows($description);

mysql_select_db($database_odf, $odf);
$query_FOOTER = "SELECT `values` FROM config WHERE constants = 'FOOTER'";
$FOOTER = mysql_query($query_FOOTER, $odf) or die(mysql_error());
$row_FOOTER = mysql_fetch_assoc($FOOTER);
$totalRows_FOOTER = mysql_num_rows($FOOTER);

mysql_select_db($database_odf, $odf);
$query_CONTACTEMAIL = "SELECT `values` FROM config WHERE constants = 'CONTACTEMAIL'";
$CONTACTEMAIL = mysql_query($query_CONTACTEMAIL, $odf) or die(mysql_error());
$row_CONTACTEMAIL = mysql_fetch_assoc($CONTACTEMAIL);
$totalRows_CONTACTEMAIL = mysql_num_rows($CONTACTEMAIL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="images/rocketcms.png" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Rocket CMS : P+P Solutions</title>
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
    <th colspan="2" scope="row"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left"><a href="dashboard.php"><img src="../images/dashnoard.png" width="230" height="60" /></a></td>
        <td align="center">&nbsp;</td>
        <td align="right"><a href="logout.php"><img src="../images/logout.png" width="230" height="60" /></a></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td colspan="2" scope="row"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="18%">Title:</td>
          <td width="82%"><input name="title" type="text" class="login_textbox" id="title" value="<?php echo $row_title['values']; ?>" size="100" /></td>
        </tr>
        <tr>
          <td>Keywords:</td>
          <td><input name="keywords" type="text" class="login_textbox" id="keywords" value="<?php echo $row_keywords['values']; ?>" size="100" /></td>
        </tr>
        <tr>
          <td>Description:</td>
          <td><input name="description" type="text" class="login_textbox" id="description" value="<?php echo $row_description['values']; ?>" size="100" /></td>
        </tr>
        <tr>
          <td>Footer:</td>
          <td><input name="footer" type="text" class="login_textbox" id="footer" value="<?php echo $row_FOOTER['values']; ?>" size="100" /></td>
        </tr>
        <tr>
          <td>Contact Email:</td>
          <td><input name="contactemail" type="text" class="login_textbox" id="contactemail" value="<?php echo $row_CONTACTEMAIL['values']; ?>" size="100" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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
</body>
</html>
<?php
mysql_free_result($title);

mysql_free_result($keywords);

mysql_free_result($description);

mysql_free_result($FOOTER);

mysql_free_result($CONTACTEMAIL);
?>
