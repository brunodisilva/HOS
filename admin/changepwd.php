<?	
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();
	require_once ('authconfig.php');
	$v_sbm=$_POST['submit'];
	$v_password=$_POST['password'];
	$v_password1=$_POST['password1'];
				  	
	if ($v_sbm=="Submit") {
	$g=0;
	  if(trim($v_password)=='') {
	  $err=$err.'Password field is blank.<br>';
	  $g=1;
	  }
	  elseif(strlen($v_password) < 6 ){   
	  $err=$err.'Password is less than 6 characters.<br>';
	  $g=1;					  
	  }
	  elseif(ereg('[^A-Za-z0-9]', $v_password)){
	  $err=$err.'Password contains special characters.<br>';
	  $g=1;				  
	  }    
	  elseif((trim($v_password1)=='')||($v_password<>$v_password1)) {
	  $err=$err.'Confirm password doesn\'t match.<br>';
	  $g=1;
	  }	
	  
	  if($g==0) {
	  	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		$enpass=base64_encode("$v_password");
		mysql_query("update authuser set passwd='$enpass' where uname='$adminusername'");
		mysql_close($connection);
			setcookie ("USERNAME", "");
			setcookie ("PASSWORD", "");	
			$_SESSION=array();
			session_destroy();
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">";
		exit;					
	  }
	}

	
    require_once ('auth.php');
    require_once ('check.php');
	
		if ($check["uname"] != $adminusername)
	{
		print "<font face=\"Arial, Helvetica, sans-serif\" size=\"5\" color=\"#FF0000\">";
		print "<b>Illegal Access</b>";
		print "</font><br>";
  		print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#000000\">";
		print "<b>You do not have permission to view this page.</b></font>";
		exit; 
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
.style21 {
	font-family: Arial;
	font-size: 12pt;
	font-weight: bold;
	color: #660000;
}
.style22 {font-family: Arial}
.style23 {
	font-size: 10pt;
	color: #000099;
	font-weight: bold;
}
.style25 {font-family: Arial; font-size: 10pt; }
.style26 {
	color: #000099;
	font-weight: bold;
}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
.style37 {
	font-family: Arial;
	font-size: 9pt;
	color: #000099;
}
.style40 {font-family: Arial; font-size: 10pt; color: #000099; }
.style36 {	font-family: Verdana;
	font-size: 8pt;
	color: #666666;
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
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="emailtemplates.php">Email Templates</a></span></div></td>
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
            <td width="577" height="638"><p align="center"><span class="style21"><br>
              <br>
            </span><span class="style21">Change Admin Password </span></p>
              <form name="form1" method="post" action="changepwd.php">
			  	<?
				if ($g==1) {
				  print "<table width=440 align=center border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
						<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>$err</font></font></font>";
				  print "</td></tr></table>";
				 }
				 ?>
                <table width="497" border="0" align="center">
                  <tr>
                    <td width="454" height="105"><ul>
                      <li><span class="style40">To prevent from unauthorized access to admin control panel, it's recommended to change admin password immediately after setting up the application. </span></li>
                      <li><span class="style40">Write down the password, it won't be displayed again.</span></li>
                      <li><span class="style37">You will be redirected to login page after changing password</span>.</li>
                    </ul></td>
                  </tr>
                </table>			  
                <table width="430" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				  <tr>
                  <td width="430">
				  <table width="430" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC">
                   
                    <tr>
                      <td height="19">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td width="201">&nbsp;</td>
                      <td width="50">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="29" height="34">&nbsp;</td>
                      <td width="148"><div align="left" class="style22 style23">New Password* </div></td>
                      <td colspan="2"><div align="left">
                        <input type="password" name="password" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td height="33">&nbsp;</td>
                      <td><div align="left" class="style25 style26">Confirm Password* </div></td>
                      <td colspan="2"><div align="left">
                        <input type="password" name="password1" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td height="19">&nbsp;</td>
                      <td colspan="3"><span class="style36">Password must be at least 6 characters. (No special character)</span></td>
                      </tr>
                    <tr>
                      <td height="94" colspan="4"><div align="center"><span class="style37"><br>
                        </span><br>
                        <input type="submit" name="submit" value="Submit">
</div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
				  </td>
                </tr>
              </table></form>              
              <blockquote>              
                <table border=0 align="center">
				<tr>
                    <td width="412" height="17"><span class="style37">* Required Field </span></td>
				</tr>
				</table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </blockquote>              
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
            </td>
          </tr>
        </table></td>
      </tr>
</table>
              <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>

</body>
</html>
