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
	

	$droot=$_SERVER['DOCUMENT_ROOT'];
	if ($check["uname"] != 'admin')
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
.style25 {font-family: Arial; font-size: 10pt; }
.style26 {color: #000099}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
.style38 {
	font-size: 10pt;
	color: #000099;
}
.style39 {font-family: Arial; font-size: 10pt; color: #000099; }
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
 <form name="form1" method="post" action="register_access.php">
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
            <td width="577" height="593" align="center" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Signup Member Access Area </span></p>

              <?
				  $v_sbm=$_POST['sbm'];  
				  if($v_sbm=='Submit') {
				  $connection = mysql_connect($dbhost, $dbusername, $dbpass);
				  $SelectedDB = mysql_select_db($dbname);
				  $v_access=$_POST['access'];
				  $v_accessck=$_POST['accessck'];
				  $v_anum=$_POST['access_num'];

					mysql_query("update authaccess set signup=''");
					mysql_query("update authuser set status='0' where signup='1' and reg_validate='1'");
					for($j=0;$j<$v_anum;$j++) {
					if(strtolower($v_accessck[$j])=='on') {					
					mysql_query("update authaccess set signup='1' where access_name='$v_access[$j]'");
					mysql_query("update authuser set status='1' where signup='1' and reg_validate='1'");
					}
					}//end of FOR statement
					
				  mysql_close($connection);
				  echo "<meta http-equiv=\"refresh\" content=\"0; URL=message.php?msg=reg_access\">";
				  exit;		
				  }
				?>
	<table width="456" border="0" align="center">
                  <tr>
                    <td width="450" height="105"><ul>
                      <li><span class="style40 style22 style38">This is the default access area for signup members. </span></li>
                      <li><span class="style40 style22 style38">Select protected areas(directory name) below which apply to signup member, after submitting the result, all signup member will have the same access to these directories.</span></li>
                    </ul></td>
                  </tr>
  	</table>
				
  <table border="1" cellpadding="0" cellspacing="0" width="394"  bordercolor="#000000"   style="border-style: solid; border-width: 0">
    <tr>
      <td height="29" bgcolor="#FFFFCC"><div align="center"><span class="style22"><font face="Arial" size="2"><span class="style26"><b>Available Protected Member Access Area</b></span></font></span></div></td>
    </tr>
    <tr>
      <td width="100%">
<div align="center">
          <center>
          <table border="0" cellpadding="3" width="390">
          <center>
            <tr>
    <td colspan="2"></td>
    <td width="70"></td>
            </tr>
          </center>
            <tr>
    <td colspan="2"></td>
    <td width="70"></td>
            </tr>

			  <?	
				$connection = mysql_connect($dbhost, $dbusername, $dbpass);
				$SelectedDB = mysql_select_db($dbname);		
							    
				$result=mysql_query("select access_name, signup from authaccess where access_name <> '' order by 1");
				$k=0;
				while($row = mysql_fetch_array($result, MYSQL_NUM)) {
				print "<tr><td width=131><div align=right>";
				$s='';
				if($row[1]=='1') {$s='checked';}
				print "<input type=checkbox name=accessck[$k] $s></div></td>";
				print "<td width=259><div align=left><font face=Arial size=2 color=blue>$row[0]</font></div></td></tr>";
				print "<input type=hidden name=access[$k] value=$row[0]>";
				$k++;
				} 
				print "<input type=hidden name=access_num value=$k>";
				mysql_free_result($result);
				mysql_close($connection);
				?>  

            <tr>
    <td colspan="3" align="center"><font face="Arial" size="2"><br>
      <input  type="submit" value="Submit"  name="sbm"><br>
      </font></td>
            </tr>
            <tr>
    <td colspan="3" align="center"></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>              
              <blockquote>
                <p align="left">&nbsp;</p>
                <p align="left">&nbsp;</p>
                <p align="left">&nbsp;</p>

            </blockquote>              </td>
          </tr>
        </table></td>
      </tr>
</table>
</form>
                <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>

</body>
</html>
<?
function verifyemailaddress($email_address)
{
	return (eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]+$", $email_address));	
}
?>