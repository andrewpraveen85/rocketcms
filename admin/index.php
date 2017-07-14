<?php require_once('../Connections/odf.php'); ?>
<?php
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

if(isset($_POST['submit']) && $_POST['submit']=='Submit'){
	mysql_select_db($database_odf, $odf);
	$query_username = "SELECT `values` FROM config WHERE constants = 'USERNAME'";
	$username = mysql_query($query_username, $odf) or die(mysql_error());
	$row_username = mysql_fetch_assoc($username);
	$totalRows_username = mysql_num_rows($username);
	
	mysql_select_db($database_odf, $odf);
	$query_password = "SELECT `values` FROM config WHERE constants = 'PASSWORD'";
	$password = mysql_query($query_password, $odf) or die(mysql_error());
	$row_password = mysql_fetch_assoc($password);
	$totalRows_password = mysql_num_rows($password);
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	if($username==$row_username['values'] && $password==$row_password['values']){
		$_SESSION['admin']=1;
		echo("<script language=\"javascript\">"); 
		echo("top.location.href = \"dashboard.php\";"); 
		echo("</script>");
	}else{
		header("location:index.php?msg=err");
	}
}
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
    <th colspan="2" scope="row"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <th width="37%" scope="col">&nbsp;</th>
          <td width="26%" class="login_box" scope="col"><table width="100%" border="0" cellspacing="2" cellpadding="2">
				<?php if((!isset($_GET['msg'])) || ($_GET['msg']<>"err")){?>
                <tr>
                  <th colspan="2" scope="row">&nbsp;</th>
                </tr>
                <?php } ?>
                <?php if((isset($_GET['msg'])) && ($_GET['msg']=="err")){?>
                <tr>
                  <th class="errmsg" colspan="2" scope="row">Login Failed! Try again.</th>
                </tr>
                <?php } ?>
            <tr>
              <th width="28%" rowspan="3" scope="row"><img src="images/admin_icon.png" width="100" height="100" /></th>
              <th width="72%" scope="row"><input name="username" type="text" class="login_textbox" id="username" placeholder="Username" required="required" /></th>
            </tr>
            <tr>
              <th scope="row"><input name="password" type="password" class="login_textbox" id="password" required="required" placeholder="Password" /></th>
            </tr>
            <tr>
              <th scope="row"><input name="submit" type="submit" class="login_textbox" id="submit" value="Submit" /></th>
            </tr>
          </table></td>
          <th width="37%" scope="col">&nbsp;</th>
        </tr>
      </table>
    </form></th>
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
mysql_free_result($username);

mysql_free_result($password);
?>
