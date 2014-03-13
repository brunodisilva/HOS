<?	
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();
	
    require_once ('auth.php');
    require_once ('authconfig.php');
    require_once ('check.php');
	session_register("loginmanager");
	$HTTP_SESSION_VARS["loginmanager"]='auth';
	
		if ($check["uname"] != $adminusername)
	{
		print "<font face=\"Arial, Helvetica, sans-serif\" size=\"5\" color=\"#FF0000\">";
		print "<b>Illegal Access</b>";
		print "</font><br>";
  		print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#000000\">";
		print "<b>You do not have permission to view this page.</b></font>";
		exit; 
	}	
	
		$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		$result_count1 = mysql_query("select * from authuser where status=1 and signup=0 and uname<>'admin' ");
		$count1 = mysql_num_rows($result_count1); 
		$result_count2 = mysql_query("select * from authuser where status=0 and signup=0 and uname<>'admin' ");
		$count2 = mysql_num_rows($result_count2); 
		$result_count3 = mysql_query("select * from authuser where reg_validate=1 and signup=1 and uname<>'admin' ");
		$count3 = mysql_num_rows($result_count3); 
		$result_count4 = mysql_query("select * from authuser where reg_validate=0 and signup=1 and uname<>'admin' ");
		$count4 = mysql_num_rows($result_count4); 				
		mysql_close($connection);				
				
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
.style23 {
	font-size: 10pt;
	color: #000099;
}
.style25 {font-family: Arial; font-size: 10pt; }
.style26 {color: #000099}
.style27 {font-size: 10px}
.style29 {font-size: 10pt}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style31 {
	font-family: Arial;
	font-size: 9pt;
	color: #333333;
}
.style33 {color: #FF0000}
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="650"></td>
		<td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="643" valign="top"><p align="center"><span class="style21"><br>
                  <br>
              View Status </span></p>
              <table width="450" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">
				  <table width="480" border="0">
                    <tr>
                      <td width="33">&nbsp;</td>
                      <td width="221"><strong><span class="style20">Member Type </span></strong></td>
                      <td width="117"><div align="center"><strong><span class="style20">Statistics</span></strong></div></td>
                      <td width="91"><div align="center"><strong><span class="style20">Action</span></strong></div></td>
                    </tr>
                  </table>
				</div></td>
			    </tr>
				  <tr>
                  <td bordercol= width="575">
				  <table width="478" border="0" cellspacing="0" cellpadding="0">
                   
                    <tr>
                      <td height="19">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td width="97">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="39" height="34">&nbsp;</td>
                      <td width="223"><div align="left" class="style22 style23">Active Member</div></td>
                      <td width="119"><div align="center"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style33"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style29"><? echo "$count1"; ?></span></span></span></span></span></span></span></span></span></span></div></td>
                      <td><div align="center"><span class="style31"><a href="memberlist.php?type=1&status=1&by=1&sbmt1=1&init_row=0&sort=create_time&sq=desc"><u>(view)</u></a></span></div></td>
                    </tr>
                    <tr>
                      <td height="33">&nbsp;</td>
                      <td><div align="left" class="style25 style26">Pending Member</div></td>
                      <td><div align="center"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style33"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><? echo "$count2"; ?></span></span></span></span></span></span></span></span></span></div></td>
                      <td><div align="center"><span class="style31"><a href="memberlist.php?type=1&status=2&by=1&sbmt1=1&init_row=0&sort=create_time&sq=desc"><u>(view)</u></a></span></div></td>
                    </tr>
                    <tr>
                      <td height="36">&nbsp;</td>
                      <td><div align="left" class="style20">Active Registered  Member</div></td>
                      <td><div align="center"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style33"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style29"><? echo "$count3"; ?></span></span></span></span></span></span></span></span></span></span></div></td>
                      <td><div align="center"><span class="style31"><a href="memberlist.php?type=2&status=1&by=1&sbmt1=1&init_row=0&sort=create_time&sq=desc"><u>(view)</u></a></span></div></td>
                    </tr>
                    <tr>
                      <td height="34">&nbsp;</td>
                      <td><div align="left" class="style20">Inactive Registered  Member</div></td>
                      <td><div align="center"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style33"><span class="style22"><span class="style27"><span class="style27"><span class="style29"><span class="style29"><? echo "$count4"; ?></span></span></span></span></span></span></span></span></span></span></div></td>
                      <td><div align="center"><span class="style31"><a href="memberlist.php?type=2&status=2&by=1&sbmt1=1&init_row=0&sort=create_time&sq=desc"><u>(view)</u></a></span></div></td>
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
              </table>              
              <blockquote>
                <table width="475" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="475"><p align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style26"><strong>Active Member: </strong></span>Created by admin, can access to one or more protected directories. </span></span></span></p>
                      <p align="left" class="style25"><span class="style26"><strong>Pending Member:</strong></span> Created by admin, has not been assigned membership (no access to member protected directory). </p>
                      <p align="left" class="style25"><span class="style26"><strong>Active<span class="style20"> Registered(Signup) Member</span>:</strong></span> Users registered online by themselves, has validated email address. </p>
                      <p align="left" class="style25"><span class="style26"><strong>Inactive <span class="style20">Registered(Signup) Member</span>: </strong></span> Users registered online by themselves, but didn't validate email address, account is inactive.</p>
                    </td>
                  </tr>
                </table>
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
