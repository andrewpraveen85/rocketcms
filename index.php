<?php require_once('Connections/odf.php'); ?>
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
$query_HOME = "SELECT `values` FROM config WHERE constants = 'HOME'";
$HOME = mysql_query($query_HOME, $odf) or die(mysql_error());
$row_HOME = mysql_fetch_assoc($HOME);
$totalRows_HOME = mysql_num_rows($HOME);

mysql_select_db($database_odf, $odf);
$query_BUSINESS = "SELECT `values` FROM config WHERE constants = 'BUSINESS'";
$BUSINESS = mysql_query($query_BUSINESS, $odf) or die(mysql_error());
$row_BUSINESS = mysql_fetch_assoc($BUSINESS);
$totalRows_BUSINESS = mysql_num_rows($BUSINESS);

mysql_select_db($database_odf, $odf);
$query_ABOUTUS = "SELECT `values` FROM config WHERE constants = 'ABOUTUS'";
$ABOUTUS = mysql_query($query_ABOUTUS, $odf) or die(mysql_error());
$row_ABOUTUS = mysql_fetch_assoc($ABOUTUS);
$totalRows_ABOUTUS = mysql_num_rows($ABOUTUS);

mysql_select_db($database_odf, $odf);
$query_CONTACTUS = "SELECT `values` FROM config WHERE constants = 'CONTACTUS'";
$CONTACTUS = mysql_query($query_CONTACTUS, $odf) or die(mysql_error());
$row_CONTACTUS = mysql_fetch_assoc($CONTACTUS);
$totalRows_CONTACTUS = mysql_num_rows($CONTACTUS);

mysql_select_db($database_odf, $odf);
$query_FOOTER = "SELECT `values` FROM config WHERE constants = 'FOOTER'";
$FOOTER = mysql_query($query_FOOTER, $odf) or die(mysql_error());
$row_FOOTER = mysql_fetch_assoc($FOOTER);
$totalRows_FOOTER = mysql_num_rows($FOOTER);

mysql_select_db($database_odf, $odf);
$query_gallery = "SELECT * FROM gallery ORDER BY id DESC";
$gallery = mysql_query($query_gallery, $odf) or die(mysql_error());
$row_gallery = mysql_fetch_assoc($gallery);
$totalRows_gallery = mysql_num_rows($gallery);

if(isset($_POST['Send']) && $_POST['Send']=='Send'){
	mysql_select_db($database_odf, $odf);
	$query_CONTACTEMAIL = "SELECT `values` FROM config WHERE constants = 'CONTACTEMAIL'";
	$CONTACTEMAIL = mysql_query($query_CONTACTEMAIL, $odf) or die(mysql_error());
	$row_CONTACTEMAIL = mysql_fetch_assoc($CONTACTEMAIL);
	$totalRows_CONTACTEMAIL = mysql_num_rows($CONTACTEMAIL);
	$cu_postemail = $row_CONTACTEMAIL['values'];
	$cu_name=$_POST['cu_name'];
	$cu_email=$_POST['cu_email'];
	$cu_subject=$_POST['cu_subject'];
	$cu_message=$_POST['cu_message'];
	$from="MIME-Version: 1.0" ."\r\n";
	$from.="Content-Type:text/html;charset=iso-8859-1" . "\r\n";	
	$from.="From:".$cu_email. "\r\n" ;
	$subject="[".$cu_subject." from ".$cu_name."]";
	$email=$cu_postemail;
	$message="Name: ".$cu_name."<br>Email: ".$cu_email."<br>Subject: ".$cu_subject."<br>Message: ".$cu_message;
	mail($email,$subject,$message,$from);
	mysql_free_result($CONTACTEMAIL);
	echo("<script language=\"javascript\">"); 
	echo("alert(\"Thank you for your message. We will contact you back soon.\");"); 
	echo("</script>");
	$_POST['Send']='';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $row_title['values']; ?></title>
        <meta name="keywords" content="<?php echo $row_keywords['values']; ?>" />
        <meta name="description" content="<?php echo $row_description['values']; ?>" />
        <link rel="icon" type="image/png" href="images/OTHNIEL LOG_colorO.png" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="contentslider.css" />
    </head>
    <body>
        <div id="templatemo_container">
            <div id="templatemo_left_panel">
                <div id="logo" style="cursor:pointer;" title="<?php echo $row_title['values']; ?>"></div>
                <div id="paginate-slider4" class="pagination">
                    <a class="toc home" title="Home" style="cursor:pointer;">&nbsp;</a>
                    <a class="toc services" title="Business" style="cursor:pointer;">&nbsp;</a>
                    <a class="toc portfolio" title="About Us" style="cursor:pointer;">&nbsp;</a>
                    <a class="toc about" title="Gallery" style="cursor:pointer;">&nbsp;</a>
                    <a class="toc contact" title="Contact Us" style="cursor:pointer;">&nbsp;</a>
                </div>
            </div>
                
            <div id="templatemo_content">
                <div id="slider4" class="sliderwrapper">
                    <div class="contentdiv">
                        <div class="header_01"><?php echo $row_title['values']; ?></div>
                        <div class="em_text"><?php echo html_entity_decode($row_HOME['values']); ?></div>
                    </div>
                        
                    <div class="contentdiv">
                        <div class="header_01">Business</div>
                        <div class="em_text"><?php echo html_entity_decode($row_BUSINESS['values']); ?></div>
                    </div>
                        
                    <div class="contentdiv">
                        <div class="header_01">About Us</div>
                        <div class="em_text"><?php echo html_entity_decode($row_ABOUTUS['values']); ?></div>
                    </div>
                        
                  <div class="contentdiv">
                        <div class="header_01">Gallery</div>
                        <div class="margin_bottom_10"></div>
                        
						<?php do { ?>
						<div class="portfolio">
                            <div class="port_img"><img src="<?php echo $row_gallery['img_src']; ?>" alt="<?php echo $row_gallery['heading']; ?>" width="300" height="225" /></div>
                            <div class="port_content">
                                <div class="header_02"><?php echo html_entity_decode($row_gallery['heading']); ?></div>
                                <p><?php echo html_entity_decode($row_gallery['description']); ?></p>
                            </div>
                            <div class="cleaner"></div>
                        </div>
                        <div class="margin_bottom_10"></div>
       					<?php } while ($row_gallery = mysql_fetch_assoc($gallery)); ?>
                    </div>
                        
                    <div class="contentdiv">
                        <div class="header_01">Contact Us</div>  
                        <div class="em_text"><?php echo html_entity_decode($row_CONTACTUS['values']); ?></div>
                        <div class="contact_form">
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                <label>Name</label><input name="cu_name" type="text" class="input_field" required="required" placeholder="Type your Name" />
                                <div class="margin_bottom_10"></div>
                                <label>Email</label><input name="cu_email" type="email" class="input_field" required="required" placeholder="Type your Email" />
                                <div class="margin_bottom_10"></div>
                                <label>Subject</label><input name="cu_subject" type="text" class="input_field"  placeholder="Type your Subject"/>
                                <div class="margin_bottom_10"></div>
                                <label>Message</label><textarea rows="5" cols="" name="cu_message" required="required" placeholder="Type your Message" style="resize:none"></textarea>
                                <div class="margin_bottom_10"></div>
                                <label>&nbsp;</label>
                                <input type="submit" name="Send" value="Send" class="submit_btn" /> 
                                <input type="reset" name="Cancel" value="Cancel" class="submit_btn" />
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="contentslider.js"></script>
                <script type="text/javascript">
                    featuredcontentslider.init({
                        id: "slider4",
                        contentsource: ["inline", ""],
                        toc: "markup",
                        nextprev: ["", ""],
                        revealtype: "click",
                        enablefade: [true, 0.1],
                        autorotate: [false, 3000],
                        onChange: function(previndex, curindex){}
                    })
                </script>
            </div>
        </div>
        <div style="margin: auto;width: 960px;text-align: center;background-color: #BCBBBB;font-size: smaller;"><?php echo $row_FOOTER['values']; ?></div>
    </body>
</html>
<?php
mysql_free_result($title);
mysql_free_result($keywords);
mysql_free_result($description);
mysql_free_result($HOME);
mysql_free_result($BUSINESS);
mysql_free_result($ABOUTUS);
mysql_free_result($CONTACTUS);
mysql_free_result($gallery);
mysql_free_result($FOOTER);
?>
