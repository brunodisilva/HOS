<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com


    require_once ('auth.php');
    require_once ('authconfig.php');
    require_once ('check.php');
	
	
	if ($check["uname"] != 'admin')
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.
		print "<font face=\"Arial, Helvetica, sans-serif\" size=\"5\" color=\"#FF0000\">";
		print "<b>Illegal Access</b>";
		print "</font><br>";
  		print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#000000\">";
		print "<b>You do not have permission to view this page.</b></font>";
		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}	

?>

<html>
<head>
<title>Login Manager Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style10 {
	font-family: Arial;
	font-size: 12pt;
	font-weight: bold;
	color: #FF6633;
}
.style20 {font-family: Arial; color: #000099; font-size: 10pt; }
.style21 {
	font-family: Arial;
	font-size: 12pt;
	font-weight: bold;
	color: #660000;
}
.style22 {font-family: Arial}
.style27 {font-size: 10px}
.style29 {font-size: 10pt}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style33 {color: #FF0000}
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
.style50 {
	font-family: Arial;
	font-size: 10pt;
	font-weight: bold;
	color: #000099;
}
.style52 {font-size: 10pt; color: #000099; }
.style53 {
	color: #FF0000;
	font-family: Arial;
	font-size: 9pt;
}
.style54 {color: #000099}
.style57 {
	color: #999999;
	font-family: Verdana;
	font-size: 8pt;
}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="743" align="center" cellpadding="0" cellspacing="0" bordercolor="#111111" id="AutoNumber1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
      <tr>
        <td width="164" height="299" valign="top" bgcolor="#FFFFCC"><table width="164" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="158" height="60" bgcolor="#FFFFCC"><div align="center"><span class="style10"><br>
                  <img src="lmlogo.jpg" width="137" height="43"><br> 
            </span></div></td>
          </tr>
          <tr>
            <td height="7" bgcolor="#FFFFCC"><div align="center"><img src=line.gif width=158 height="1" border=0></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="index.php">View Status</a> </span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="group.php">Protected Directory</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="search.php">Member Search</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="add_member.php">Add New Member</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="register_access.php">Signup Access</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="mailnotify.php">Mail Notification</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style50">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="emailtemplates.php">Email Templates </a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="changepwd.php">Change Password</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="backup.php">Backup/Restore DB</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="<? echo $alogout; ?>">Logout</a></span></div></td>
          </tr>
        </table></td>
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="700"></td>
        <td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="691" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Mail Notification</span></p>
			<form method="post" name="mailnofity" action="mailnotify.php">
              <table width="450" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Message</div></td>
				</tr>
				<tr>
                  <td width="450" height="273">    
			<?
			$v_username=$_POST['username'];
			$v_accessname=$_POST['accessname'];
			$v_subject=$_POST['subject'];
			$v_message=$_POST['message'];
			$v_sbm=$_POST['sbm'];
			$v_select=$_POST['select'];
			
		    $connection = mysql_connect($dbhost, $dbusername, $dbpass);
		    $SelectedDB = mysql_select_db($dbname);
			
		  if ($v_sbm=='  Send Mail  ') {
		  $g=0;
		  if((trim($v_select)=='')||(($v_select=='1')&&(trim($v_username)==''))||((trim($v_select)=='2')&&(trim($v_accessname)==''))) {
		  $err='Recipient field is blank.<br>';
		  $g=1;
		  }
		  elseif(trim($v_subject)=='') {
		  $err='Subject field is blank.<br>';
		  $g=1;
		  }
		  elseif(trim($v_message)=='') {
		  $err=$err.'Message field is blank.<br>';
		  $g=1;
		  }
		  else {			
			$headers = "From: $v_emailfrom\r\n";
			//$headers .= "\nMIME-Version: 1.0\n" ."Content-Type: text/html;\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";

			if ($v_select=='1') {		
			$res1=mysql_query("select distinct email from authuser where uname='$v_username'");
			while($row = mysql_fetch_array($res1, MYSQL_NUM)) {
			$v_subject=stripslashes($v_subject);
			$v_message=stripslashes($v_message);
			mail($row[0], $v_subject, $v_message, $headers);
			$getip=getip();
			mysql_query("insert into log (uname,ctime,ip,activity) values ('$v_username',now(),'$getip','Admin sends email notification to member ($v_username).')");
			}
			}
			elseif ($v_select=='2') {
			//send mail to regular member
			$res2=mysql_query("select distinct uname from memberaccess where access_name='$v_accessname'");
			while($row = mysql_fetch_array($res2, MYSQL_NUM)) {
			$res3=mysql_query("select distinct email from authuser where uname='$row[0]' and uname <> 'admin'");			
			while($row1 = mysql_fetch_array($res3, MYSQL_NUM)) {
			$v_message=stripslashes($v_message);
			mail($row1[0], $v_subject, $v_message, $headers);
			$getip=getip();
			mysql_query("insert into log (uname,ctime,ip,activity) values ('$row[0]',now(),'$getip','Admin sends email notification to member ($row[0]).')");
			}
			}
			}
			elseif ($v_select=='3') {
			//send mail to active signup memeber
			$res4=mysql_query("select distinct email,uname from authuser where signup='1' and reg_validate='1' and uname <> 'admin'");
			while($row2 = mysql_fetch_array($res4, MYSQL_NUM)) {
			$v_message=stripslashes($v_message);
			mail($row2[0], $v_subject, $v_message, $headers);
			$getip=getip();
			mysql_query("insert into log (uname,ctime,ip,activity) values ('$row2[1]',now(),'$getip','Admin sends email notification to member ($row2[1]).')");
			}			
			}
			mysql_close($connection);
			print "<p align=center><font face=arial color=blue size=2>Mail notification has been sent.</font></p>";
			exit;
			}
			}
		  if ($g==1) {
		  print "<table align=center width=421 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
				<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>$err</font></font></font>";
		  print "</td></tr></table>";
		  }

			$result1=mysql_query("select distinct uname from authuser where uname<>'admin' order by 1");
			$result2=mysql_query("select distinct access_name from authaccess order by 1");
		   ?> <br>              
				   <table width="450" height="431" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="6" height="28">&nbsp;</td>
                      <td width="100" rowspan="3"><div align="right"> <span class="style50">Recipient<span class="style33">*</span>:</span> </div></td>
                      <td width="134"><div align="left" class="style20"></div>
                          <div align="left">
                              <input name="select" type="radio" value="1" <? if($v_select=='1') {echo "checked";} ?>>
                          <span class="style22"><span class="style27"><span class="style52">By Member </span></span></span></div></td>
                      <td width="208">
                        <select name="username" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                          <option value=''>-------Select-------</option>
						  <? 		
						  $ds='';	
						  while($row = mysql_fetch_array($result1, MYSQL_NUM)) {
						  if(trim($row[0])==trim($v_username)) {$ds="selected";}
						  print "<option value=$row[0] $ds>$row[0]</option>";
						  $ds='';
						  }
						  ?>
                        </select>                      </td>
                    </tr>
                    <tr>
                      <td height="26">&nbsp;</td>
                      <td><input name="select" type="radio" value="2" <? if($v_select=='2') {echo "checked";} ?>>
                        <span class="style20">By Access Name</span> </td>
                      <td><select name="accessname" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                        <option value=''>-------Select-------</option>
						  <? 	
						  $ds='';		
						  while($row = mysql_fetch_array($result2, MYSQL_NUM)) {
						  if(trim($row[0])==trim($v_accessname)) {$ds="selected";}
						  print "<option value=$row[0] $ds>$row[0]</option>";
						  $ds='';
						  }
						  ?>						
                      </select></td>
                    </tr>
                    <tr>
                      <td height="26">&nbsp;</td>
                      <td colspan="2"><input name="select" type="radio" value="3" <? if($v_select=='3') {echo "checked";} ?>>
                        <span class="style20">All Active Registration Member </span> </td>
                      </tr>
                    <tr>
                      <td height="53">&nbsp;</td>
                      <td><div align="right" class="style50">Subject<span class="style33">*</span>:</div></td>
                      <td colspan="2">
                      &nbsp;&nbsp;<input name="subject" type="text" value="<? echo "$v_subject"; ?>" size="30" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">                      </td>
                     </tr>
                    <tr>
                      <td height="19">&nbsp;</td>
                      <td rowspan="2" valign="top"><div align="left" class="style20">
                          <div align="right"><strong>Message<span class="style33">*</span>:<br>
                            </strong></div>
                      </div>                        
                      <div align="right"> </div>                      <div align="right"></div></td>
                      <td colspan="2" rowspan="2" valign="top"><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33"><span class="style20">
                          </span></span></span></span></span></div>                        <div align="left">
                             &nbsp;&nbsp;<textarea name="message" cols="30" rows="7" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo "$v_message"; ?></textarea>
                            <span class="style20">
                      </span></div></td>
                     </tr>
                    <tr>
                      <td height="19">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="74" colspan="4"><div align="center">
                          <table width="381" border="0">
                            <tr>
                              <td width="375" height="58"><strong><span class="style53">*</span></strong><span class="style53"><span class="style54">Required field </span></span></td>
                            </tr>
                          </table>
                          <p>&nbsp;                            </p>
                          <p>
                            <input type="submit" name="sbm" value="  Send Mail  ">
</p>
                          <p>&nbsp;                                </p>
                      </div></td>
                     </tr>
                  </table></td>
		        </tr>
              </table>  </form>     
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
            </td>
          </tr>
        </table></td>
      </tr>
</table>
                <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>

<?
mysql_close($connection);
?>
</body>
</html>
