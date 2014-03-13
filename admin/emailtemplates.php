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
.style50 {
	font-family: Arial;
	font-size: 10pt;
	font-weight: bold;
	color: #000099;
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
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style50">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="emailtemplates.php">Email Templates</a></span></div></td>
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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="1500"></td>
        <td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="691" valign="top"><p align="center"><br>
                <span class="style21">                <br>
                Email Templates </span></p>
              <table width="442" height="35" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="430" height="35"><ul>
                    <li><span class="style20">Edit the following email templates, these will be the email contents sent to the users.</span></li>
                    <li><span class="style20">Use &lt;%username%&gt;, &lt;%password%&gt;,&lt;%weburl%&gt; to indicate user account and website information.</span></li>
                    <li><span class="style20">Must use the code: <font face=verdana size=1 color=blue>&lt;%weburl%&gt;/login.php?username=&lt;%username%&gt;&vcode=&lt;%code%&gt;</font> in "Creation of Signup Account" section, for activating signup account.</span></li>
                  </ul></td>
                </tr>
              </table>
			<?
			$v_sbm=$_POST['sbm'];
			$v_addmember=$_POST['addmember'];
			$v_editmember=$_POST['editmember'];
			$v_signup=$_POST['signup'];
			$v_lostpass=$_POST['lostpass'];
			$v_add_subject=$_POST['add_subject'];
			$v_add_message=$_POST['add_message'];
			$v_edit_subject=$_POST['edit_subject'];
			$v_edit_message=$_POST['edit_message'];
			$v_signup_subject=$_POST['signup_subject'];
			$v_signup_message=$_POST['signup_message'];
			$v_lostpass_subject=$_POST['lostpass_subject'];
			$v_lostpass_message=$_POST['lostpass_message'];
			
			
		    $connection = mysql_connect($dbhost, $dbusername, $dbpass);
		    $SelectedDB = mysql_select_db($dbname);
			
		  if ($v_sbm=='  Save  ') {
		  $g=0;
		  $err="";
		  if(trim($v_add_subject)=='') {
		  $err .="Subject of \"Add New Member\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_add_message)=='') {
		  $err .="Contents of \"Add New Member\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_edit_subject)=='') {
		  $err .="Subject of \"Edit Member\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_edit_message)=='') {
		  $err .="Contents of \"Edit Member\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_signup_subject)=='') {
		  $err .="Subject of \"Creation of Signup Account\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_signup_message)=='') {
		  $err .="Contents of \"Creation of Signup Account\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_lostpass_subject)=='') {
		  $err .="Subject of \"LostPassword Retrieval\" is blank.<br>";
		  $g=1;
		  }
		  if(trim($v_lostpass_message)=='') {
		  $err .="Contents of \"LostPassword Retrieval\" is blank.<br>";
		  $g=1;
		  }
		  else {			
			mysql_query("delete from emailtemplates where name='$v_addmember'");
			mysql_query("insert into emailtemplates (name,subject,contents) values ('addmember','$v_add_subject','$v_add_message')");
			mysql_query("delete from emailtemplates where name='$v_editmember'");
			mysql_query("insert into emailtemplates (name,subject,contents) values ('editmember','$v_edit_subject','$v_edit_message')");
			mysql_query("delete from emailtemplates where name='$v_signup'");
			mysql_query("insert into emailtemplates (name,subject,contents) values ('signup','$v_signup_subject','$v_signup_message')");
			mysql_query("delete from emailtemplates where name='$v_lostpass'");
			mysql_query("insert into emailtemplates (name,subject,contents) values ('lostpass','$v_lostpass_subject','$v_lostpass_message')");

			mysql_close($connection);
			print "<br><br><p align=center><font face=arial color=blue size=2>Email templates has been updated.</font>";
			exit;
			}
			} //end of IF($v_sbm=='  Save  ')
			
			
			$res1=mysql_query("select name,subject,contents from emailtemplates");
			while($row = mysql_fetch_array($res1, MYSQL_NUM)) {
			if($row[0]=='addmember') {
			$v_add_subject=$row[1];
			$v_add_message=$row[2];
			}
			elseif($row[0]=='editmember') {
			$v_edit_subject=$row[1];
			$v_edit_message=$row[2];			
			}
			elseif($row[0]=='signup') {
			$v_signup_subject=$row[1];
			$v_signup_message=$row[2];			
			}
			elseif($row[0]=='lostpass') {
			$v_lostpass_subject=$row[1];
			$v_lostpass_message=$row[2];			
			}			
			}

		  if ($g==1) {
		  print "<table align=center width=390 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
				<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>$err</font></font></font>";
		  print "</td></tr></table>";
		  }

		   ?>                             
			  <form method="post" action="emailtemplates.php">
                <table width="390" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Add New Member Account</div></td>
				</tr>
				<tr>
                  <td width="386" height="116" valign="top">    
					<br>              
				   <table width="386" height="106" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="36">&nbsp;</td>
                      <td valign="top"><div align="left" class="style20">Subject:</div></td>
                      <td valign="top"><div align="left">
                        <input type="hidden" name="addmember" value="addmember">
						<input type="text" name="add_subject" value="<? echo "$v_add_subject"; ?>" size="40" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td width="10" height="19"><div align="center">
                        <p>&nbsp;</p>
                          </div></td>
                      <td width="83" height="19" valign="top"><div align="left" class="style20">Contents:</div></td>
                      <td width="293" height="19" valign="top"><div align="left">
                        <textarea name="add_message" cols="30" rows="7" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo "$v_add_message"; ?></textarea>
                        <br>
                        <br>
                      </div></td>
                    </tr>
                  </table></td>
		        </tr>
              </table>  
              <p>&nbsp;</p>
              <table width="390" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Edit Member Account</div></td>
				</tr>
				<tr>
                  <td width="386" height="116" valign="top">    
					<br>              
				   <table width="386" height="106" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="36">&nbsp;</td>
                      <td valign="top"><div align="left" class="style20">Subject:</div></td>
                      <td valign="top"><div align="left">
                        <input type="hidden" name="editmember" value="editmember">
						<input type="text" name="edit_subject" value="<? echo "$v_edit_subject"; ?>" size="40" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td width="10" height="19"><div align="center">
                        <p>&nbsp;</p>
                          </div></td>
                      <td width="83" height="19" valign="top"><div align="left" class="style20">Contents:</div></td>
                      <td width="293" height="19" valign="top"><div align="left">
                        <textarea name="edit_message" cols="30" rows="7" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo "$v_edit_message"; ?></textarea>
                        <br>
                        <br>
                      </div></td>
                    </tr>
                  </table></td>
		        </tr>
              </table>  
              <p>&nbsp;</p>
              <table width="390" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Creation of Signup Account</div></td>
				</tr>
				<tr>
                  <td width="386" height="116" valign="top">    
					<br>              
				   <table width="386" height="106" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="36">&nbsp;</td>
                      <td valign="top"><div align="left" class="style20">Subject:</div></td>
                      <td valign="top"><div align="left">
                        <input type="hidden" name="signup" value="signup">
						<input type="text" name="signup_subject" value="<? echo "$v_signup_subject"; ?>" size="40" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td width="10" height="19"><div align="center">
                        <p>&nbsp;</p>
                          </div></td>
                      <td width="83" height="19" valign="top"><div align="left" class="style20">Contents:</div></td>
                      <td width="293" height="19" valign="top"><div align="left">
                        <textarea name="signup_message" cols="30" rows="7" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo "$v_signup_message"; ?></textarea>
                        <br>
                        <br>
                      </div></td>
                    </tr>
                  </table></td>
		        </tr>
              </table>  
              <p>&nbsp;</p>
              <table width="390" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">LostPassword Retrieval</div></td>
				</tr>
				<tr>
                  <td width="386" height="116" valign="top">    
					<br>              
				   <table width="386" height="106" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="36">&nbsp;</td>
                      <td valign="top"><div align="left" class="style20">Subject:</div></td>
                      <td valign="top"><div align="left">
                        <input type="hidden" name="lostpass" value="lostpass">
						<input type="text" name="lostpass_subject" value="<? echo "$v_lostpass_subject"; ?>" size="40" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
                      </div></td>
                    </tr>
                    <tr>
                      <td width="10" height="19"><div align="center">
                        <p>&nbsp;</p>
                          </div></td>
                      <td width="83" height="19" valign="top"><div align="left" class="style20">Contents:</div></td>
                      <td width="293" height="19" valign="top"><div align="left">
                        <textarea name="lostpass_message" cols="30" rows="7" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"><? echo "$v_lostpass_message"; ?></textarea>
                        <br>
                        <br>
                      </div></td>
                    </tr>
                  </table></td>
		        </tr>
              </table>  
              <p>&nbsp;</p>
              <p align="center">
                <input type="submit" name="sbm" value="  Save  ">
              </p>
              <p>&nbsp;</p>
              </form>
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
