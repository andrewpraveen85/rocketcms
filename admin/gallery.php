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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Submit")) {
  $insertSQL = sprintf("INSERT INTO gallery (heading, `description`) VALUES (%s, %s)",
                       GetSQLValueString($_POST['heading'], "text"),
                       GetSQLValueString($_POST['description'], "text"));

  mysql_select_db($database_odf, $odf);
  $Result1 = mysql_query($insertSQL, $odf) or die(mysql_error());
  $recordid=mysql_insert_id();
  $target = "../gallery/";
  $ad1 = $_FILES['fileField']['name'];
  echo $ad1;
  if (strlen($ad1)>0){
	 $fileExt =  end(explode(".", $ad1));
	 $ad1 = $recordid.".".$fileExt;
  	 $target = $target.$ad1;
     move_uploaded_file($_FILES['fileField']['tmp_name'], $target);
     $updateSQL = "UPDATE gallery SET img_src='gallery/".$ad1."' WHERE id=".$recordid;
     mysql_select_db($database_odf, $odf);
     $Result1 = mysql_query($updateSQL, $odf) or die(mysql_error());
  }else {
     $deleteSQL = "DELETE FROM gallery WHERE id=".$recordid;
     mysql_select_db($database_odf, $odf);
     $Result1 = mysql_query($deleteSQL, $odf) or die(mysql_error());
  }

  $insertGoTo = "gallery.php";
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_odf, $odf);
$query_gallery = "SELECT * FROM gallery ORDER BY id DESC";
$gallery = mysql_query($query_gallery, $odf) or die(mysql_error());
$row_gallery = mysql_fetch_assoc($gallery);
$totalRows_gallery = mysql_num_rows($gallery);

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
    <td colspan="2" scope="row"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left"><a href="dashboard.php"><img src="../images/dashnoard.png" width="230" height="60" /></a></td>
        <td align="center">&nbsp;</td>
        <td align="right"><a href="logout.php"><img src="../images/logout.png" width="230" height="60" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td><form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
              <tr valign="baseline">
                <td><input name="fileField" type="file" class="login_textbox" id="fileField" /></td>
              </tr>
              <tr valign="baseline">
                <td><input placeholder="Heading" name="heading" type="text" class="login_textbox" value="" size="32" /></td>
              </tr>
              <tr valign="baseline">
                <td><textarea placeholder="Description" name="description" cols="50" rows="5" class="login_textbox"></textarea></td>
              </tr>
              <tr valign="baseline">
                <td><input name="MM_insert" type="submit" class="login_textbox" value="Submit" /></td>
              </tr>
            </table>
          </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <th width="9%" align="left">ID</th>
              <th width="6%" align="left">Image</th>
              <th width="26%" align="left">Heading</th>
              <th width="52%" align="left">Description</th>
              <th width="7%" align="left">&nbsp;</th>
            </tr>
            <?php do { ?>
              <tr>
                <td valign="top" class="login_box"><?php echo $row_gallery['id']; ?></td>
                <td valign="top" class="login_box"><img src="../<?php echo $row_gallery['img_src']; ?>" alt="<?php echo $row_gallery['heading']; ?>" width="75" height="75" /></td>
                <td valign="top" class="login_box"><?php echo $row_gallery['heading']; ?></td>
                <td valign="top" class="login_box"><?php echo $row_gallery['description']; ?></td>
                <td valign="top" class="login_box"><a href="del_gallery.php?id=<?php echo $row_gallery['id']; ?>">Remove</a></td>
              </tr>
              <?php } while ($row_gallery = mysql_fetch_assoc($gallery)); ?>
          </table></td>
      </tr>
    </table></td>
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
mysql_free_result($gallery);
?>
