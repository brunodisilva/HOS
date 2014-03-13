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
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
-->
</style>


</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="774" align="center" cellpadding="0" cellspacing="0" bordercolor="#111111" id="AutoNumber1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
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
        <td width="4" valign="top"><img src="vert_line.gif" border="0" width="2" height="650"></td>
        <td width="604" valign="top">
		<form name="form1" method="post" action="edit_group.php">
		<table width="604" border="0" cellspacing="0" cellpadding="0">
		  <tr>
            <td width="604" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Edit Access Description </span></p>
              	<?php
					$connection = mysql_connect($dbhost, $dbusername, $dbpass);
					$SelectedDB = mysql_select_db($dbname);
					$v_acname=$_GET['acname'];
					$v_sbm=$_POST['sbm'];
					
					if ($v_sbm=='Submit') {
					$s_accessname=$_POST['accessname'];
					$s_accesspath=$_POST['accesspath'];
				  	$s_accessdesc=$_POST['accessdesc'];
					  
					$err=0;
					$v_err='';
					if(trim($s_accessdesc)==''){
					$v_err='Access description field is empty.<br>'; 
					$err=1;
					}
					else {
					mysql_query("update authaccess set access_desc='$s_accessdesc' where access_name='$s_accessname'");
  		  			mysql_close($connection);					
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=message.php?msg=editgroup\">";
					exit;					
					}
					} //end of IF ($v_sbm=='Submit') statement
					
					$result=mysql_query("select access_name,access_path,access_desc from authaccess where access_name = '$v_acname'");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$s_accessname=$row[0];
					$s_accesspath=$row[1];
					$s_accessdesc=$row[2];
					}
					
					if($err==1) {
					print "<p align=center>"; 
					print "<table width=470 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">";
					print "<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=red><font face=arial><font size=2>$v_err</font></font></font>";
					print "</td></tr></table>";
					print "</p>";
					}

				  ?>
                <table width="521" border="0" align="center">
                  <tr>
                    <td width="496"><ul>
                      <li><span class="style40 style20">Access description is the text which will be shown on the membership index page.</span></li>
                      <li><span class="style40 style20">Edit the description text area as it will be shown after user login.(No special characters) </span></li>
                    </ul></td>
                  </tr>
              </table>
				<table width="476" align="center" cellpadding="0" cellspacing="0" border="1">
					  <tr bgcolor="#FFFFCC">
					    <td height="37"><strong><span class="style20">&nbsp;&nbsp;Access Name</span></strong></td>
					    <td>&nbsp;&nbsp;<font face="arial narrow" size=2 color="blue"><? echo "$s_accessname"; ?></font>
						<input type="hidden" name="accessname" value="<? echo "$s_accessname"; ?>">
						</td>
			      </tr>
					  <tr bgcolor="#FFFFCC">
					    <td height="37"><strong><span class="style20">&nbsp;&nbsp;Directory Path </span></strong></td>
					    <td>&nbsp;&nbsp;<font face="arial narrow" size=2 color="blue"><? echo "$s_accesspath"; ?></font>
						<input type="hidden" name="accesspath" value="<? echo "$s_accesspath"; ?>">
						</td>
			      </tr>
					  <tr bgcolor="#FFFFCC">
                      <td width="117" height="37"><div align="left"><strong><span class="style20">&nbsp;&nbsp;Description</span></strong></div></td>
                      <td><div align="center"><strong></strong></div>                        
                        <div align="left">
                          <p><br>
						  &nbsp;&nbsp;<textarea name="accessdesc" wrap="VIRTUAL" cols="30" rows="5" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo trim("$s_accessdesc"); ?></textarea>
						  <br>
						  <br>
                          </p>
                        </div></td>
                    </tr>

              </table>
              <blockquote>
                <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><div align="center">
                      <input type="submit" name="sbm" value="Submit">
                    </div></td>
                  </tr>
                </table>
                <p align="left">
                <p align="left">                                
                <p align="left">

				
				
				</p>
              </blockquote>             


          </tr>
        </table>
		</form>
		</td>
      </tr>
</table>

              <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p></td>

</body>
</html>
<? mysql_close($connection); ?>