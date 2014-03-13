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
.style48 {font-family: Arial; font-size: 10pt; color: #0000CC; }
.style50 {
	font-family: Arial;
	font-size: 10pt;
	font-weight: bold;
	color: #000099;
}
.style52 {color: #000099; font-weight: bold; }
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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="750"></td>
        <td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="735" valign="top"><p align="center"><br>
                <span class="style21">Member Search </span></p>

			<form method="get" action="memberlist.php">
				<?  
				$err=$_GET['err'];
				if ($err==1) {
				  print "<table width=460 align=center border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
						<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>Please Select Access Name.</font></font></font>";
				  print "</td></tr></table>";
				  }
				?>
              <table width="450" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				<tr><td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Search by Member</div></td>
				</tr>
				<tr>
                  <td width="450" height="273">                   
				   <table width="450" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="143" colspan="4"><table width="320" height="137" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="320" height="137" background="backgrd2.gif"><table width="315" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="5" colspan="2"><div align="center"><img src="spc.gif" width="8" height="1"></div></td>
                              </tr>
                            <tr>
                              <td width="110" height="30"><div align="right"><span class="style48"><span class="style52">Keywords:</span></span></div></td>
                              <td width="205"><div align="left"><span class="style48"><span class="style52">
                                  &nbsp;&nbsp;<input type=text name="keyword" value="" style="border: 1px solid #808080; padding-left: 0; padding-right: 0; padding-top: 0; padding-bottom: 0; background-color: #ECEAE6" size="25" height="18">
                              </span></span></div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><div align="center"><img src="spc.gif" width="8" height="1"></div></td>
                              </tr>
                            <tr>
                              <td height="19"><div align="right"><span class="style48"><span class="style52">Search from:</span></span></div></td>
                              <td><div align="left"><span class="style48">
                                  &nbsp;<input name="type" type="radio" value="1" checked>
                                  <span class="style26">Admin created member</span></span></div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><div align="center"><img src="spc.gif" width="1" height="1"></div></td>
                              </tr>
                            <tr>
                              <td height="25">&nbsp;</td>
                              <td><div align="left"><span class="style48"><span class="style22"><span class="style27"><span class="style29"><span class="style33"><span class="style20">
                                  &nbsp;<input name="type" type="radio" value="2">
  Registered(Signed up)member </span></span></span></span></span></span></div></td>
                            </tr>
                            <tr>
                              <td height="24"><div align="right"><span class="style48"><span class="style52">Member Status:</span></span></div></td>
                              <td><span class="style48"> 
                                &nbsp;<input name="status" type="radio" value="1" checked>
                                <span class="style26">Active member</span></span></td>
                            </tr>
                            <tr>
                              <td height="24">&nbsp;</td>
                              <td><span class="style48">
                                  &nbsp;<input name="status" type="radio" value="2">
                                  <span class="style26">Pending/Inactive member</span></span></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="29" height="20">&nbsp;</td>
                      <td width="57"><div align="right"> </div></td>
                      <td width="179"><input name="by" type="radio" value="1" checked>
                          <span class="style20">List all</span>
                          <div align="left" class="style20"></div>
                          <div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33"></span></span></span></span></div></td>
                      <td width="183">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="20">&nbsp;</td>
                      <td><div align="left" class="style20">
                          <div align="right"> </div>
                      </div></td>
                      <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33"><span class="style20">
                          <input name="by" type="radio" value="2">
        By member's username </span></span></span></span></span></div></td>
                      <td width="183" rowspan="2"><input type="submit" name="sbmt1" value="  Search  "></td>
                    </tr>
                    <tr>
                      <td height="21">&nbsp;</td>
                      <td><div align="right"> </div></td>
                      <td><div align="left"><span class="style20">
                          <input name="by" type="radio" value="3">
        By member's full name </span></div></td>
                     </tr>
                    <tr>
                      <td height="20">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><span class="style20">
                        <input name="by" type="radio" value="4">
By member's email </span></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="19">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
		        </tr>
              </table>       
			  <p>&nbsp;</p>
			  <table width="464" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
			    <tr>
			      <td height="30" bordercolor="#666699" bgcolor="#FFFFCC"><div align="center" class="style50">Search by Access Group <br>
			        (Protected Directory)</div></td>
		        </tr>
			    <tr>
                  <td height="175" valign="top">
                    <table width="450" height="161" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="448" height="161"><table width="320" height="137" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="320" height="137" background="backgrd2.gif"><table width="315" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="116" height="27">&nbsp;</td>
                                    <td width="199">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td><div align="right"><span class="style48"><span class="style52">Access Name:</span></span></div></td>
                                    <td><div align="left"><span class="style48"><span class="style52"> &nbsp;&nbsp;
                                      <select name="accessname" style="border: 1px solid #808080; padding-left: 0; padding-right: 0; padding-top: 0; padding-bottom: 0; background-color: #ECEAE6">
                                      <option selected value=0>-------Select-------</option>
                                       <?
									   	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		  								$SelectedDB = mysql_select_db($dbname);
										$result = mysql_query("select distinct access_name from authaccess order by 1");
										while($row = mysql_fetch_array($result, MYSQL_NUM)) {
										print "<option value=$row[0]>$row[0]</option>";
										}
										mysql_close($connection);
									   ?>
							            </select>
                                    </span></span></div></td>
                                  </tr>
                                  <tr>
                                    <td height="26">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="19" colspan="2"><div align="center"><span class="style48"><span class="style52">
                                      <input type="submit" name="sbmt2" value="  Search  ">
                                    <input type="hidden" name="init_row" value="0">
									<input type="hidden" name="sort" value="create_time">
									<input type="hidden" name="sq" value="desc">
									</span></span></div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><div align="center"><img src="spc.gif" width="1" height="1"></div></td>
                                  </tr>
                                  <tr>
                                    <td height="24">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
		        </tr>
              </table>
			  </form>
  			  <p>&nbsp;</p>
          </tr>
        </table></td>
      </tr>
</table>
		    <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>		    </td>

</body>
</html>
