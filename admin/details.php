<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

    $logrows=15;
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
		
		$v_uname=$_GET['uname'];
		$v_action=$_GET['action'];
		
		$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		$result = mysql_query("select name,email,address,city,state,zip,country,phone from authuser where uname='$v_uname'");
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$v_name=$row[0];
		$v_email=$row[1];
		$v_address=$row[2];
		$v_city=$row[3];
		$v_state=$row[4];
		$v_zip=$row[5];
		$v_country=$row[6];
		$v_phone=$row[7];
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
.style40 {font-family: Verdana; font-size: 8pt; color: #000099; }
.style43 {
	font-family: Arial;
	font-size: 9pt;
}
.style44 {
	color: #000099;
	font-weight: bold;
}
.style46 {
	font-family: Arial;
	font-size: 9pt;
	font-weight: bold;
	color: #000099;
}
.style49 {color: #0000FF}
.style50 {
	font-size: 8pt;
	font-family: Arial, Helvetica, sans-serif;
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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="650"></td>
        <td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="645" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Member Profile and Activity Log </span></p>
			  <table width="452" align="center" cellpadding="0" cellspacing="0" border="1">
				<tr bgcolor="#FFFFCC">
                  <td><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;Username</strong></div>
                  </div></td>
                  <td width="129" height="21"><div align="left" class="style43 style49">&nbsp;<? echo "$v_uname"; ?>
                      </div></td>
			      <td width="88" class="style43"><div align="left"><span class="style44">&nbsp;Full Name </span></div></td>
			      <td width="135"><div align="left" class="style43 style49">&nbsp;<? echo "$v_name"; ?></div></td>
				</tr>
				<tr bgcolor="#FFFFCC">
                  <td><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;Email</strong></div>
                  </div></td>
                  <td height="17" colspan="3"><div align="left" class="style43 style49">&nbsp;<? echo "$v_email"; ?>
                      </div></td>
		        </tr>
				<tr bgcolor="#FFFFCC">
                  <td><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;Address</strong></div>
                  </div></td>
                  <td height="17" colspan="3"><div align="left" class="style43 style49">&nbsp;<? echo "$v_address"; ?>
                      </div></td>
		        </tr>
				<tr bgcolor="#FFFFCC">
                  <td><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;City</strong></div>
                  </div></td>
                  <td height="21"><div align="left" class="style43 style49">&nbsp;<? echo "$v_city"; ?>
                      </div></td>
			      <td height="21"><div align="left"><span class="style46">&nbsp;State</span></div></td>
			      <td height="21"><div align="left" class="style43 style49">&nbsp;<? echo "$v_state"; ?></div></td>
				</tr>
				<tr bgcolor="#FFFFCC">
                  <td><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;Zip Code </strong></div>
                  </div></td>
                  <td height="21"><div align="left" class="style43 style49">&nbsp;<? echo "$v_zip"; ?>
                      </div></td>
			      <td height="21"><div align="left"><span class="style46">&nbsp;Country</span></div></td>
			      <td height="21"><div align="left" class="style43 style49">&nbsp;<? echo "$v_country"; ?></div></td>
				</tr>
				<tr bgcolor="#FFFFCC">
				  <td width="90"><div align="left" class="style40 style43">
                      <div align="left"><strong>&nbsp;Phone</strong></div>
				  </div></td>
				  <td height="21" colspan="3"><div align="left" class="style43 style49">&nbsp;<? echo "$v_phone"; ?>
                      </div>				    <div align="left"></div>                    <div align="left"></div></td>
		        </tr>
				<?
				$v_keyword=trim($_GET['keyword']);
				$v_type=$_GET['type'];
				$v_status=$_GET['status'];
				$v_by=$_GET['by'];
				$v_accessname=$_GET['accessname'];
				$v_sbmt1=$_GET['sbmt1'];
				$v_sbmt2=$_GET['sbmt2'];
				$v_init_row=$_GET['init_row'];
				$v_sort=$_GET['sort'];
				$v_sq=$_GET['sq'];
				$v_action=$_GET['action'];
				$v_username=$_GET['username'];

					$tg=0;
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if($tg==0){$bgclr='#ECECFF'; $tg=1;}
					else{$bgclr='#FFFFFF'; $tg=0;}			
				print "<tr bgcolor=$bgclr>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;$row[0]</font></div></td>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;$row[1]</font></div></td>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;$row[2]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[3]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[4]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[5]</font></div></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;</font></div></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;</font></div></td>
			   	  </tr>";
				 }
			  ?>   
			  </table>  
			  <table width="456" border="0" align="center">
                <tr>
                  <td width="468">
                    <div align="right"><br>
                      <a href="details.php?action=delwhole&type=1&status=1&by=1&sbmt1=1&init_row=0&sort=ctime&sq=desc&uname=<? echo "$v_uname"; ?>" onClick="return confirm('Are you sure to clean up whole database log?')"><font face=arial size=1 color=#006600><u>Clean up whole DB log</u></font></a>&nbsp;&nbsp;<a href="details.php?action=delthis&type=1&status=1&by=1&sbmt1=1&init_row=0&sort=ctime&sq=desc&uname=<? echo "$v_uname"; ?>"><font face=arial size=1 color=#006600><u>Clean up log for this member</u></font></a> </div>
                  </div></td>
                </tr>
              </table>	
		<?	  		
		if($v_action=='delthis') {
		mysql_query("delete from log where uname='$v_uname'");
		print "<table width=\"458\" border=\"0\" align=\"center\"><tr><td><font face=arial size=2 color=red>Log has been cleaned up for this member.</font></td></tr></table>";	
		}
		elseif ($v_action=='delwhole') {
		mysql_query("delete from log");
		print "<table width=\"458\" border=\"0\" align=\"center\"><tr><td><font face=arial size=2 color=red>Whole database log has been cleaned up.</font></td></tr></table>";	
		}
		?>		  

			  <table width="454" align="center" cellpadding="0" cellspacing="0" border="1">
                <tr bgcolor="#FFFFCC">
                  <td width="86"><div align="left" class="style40 style43">
                      <div align="center"><strong>Time</strong></div>
                  </div></td>
                  <td width="132" height="23"><div align="left" class="style40 style43">
                      <div align="center"><strong>From (IP Address)</strong></div>
                  </div></td>
                  <td width="228" height="23"><div align="left" class="style40 style43">
                      <div align="center"><strong>Activity</strong></div>
                  </div></td>
                </tr>
                <?
					$tg=0;
					$result=mysql_query("select date_format(ctime,'%Y-%m-%d (%H:%i:%s)'),ip,activity from log where uname='$v_uname' order by $v_sort $v_sq limit $v_init_row,$logrows");
					$result1=mysql_query("select * from log where uname='$v_uname'");
					$count = mysql_num_rows($result1); 
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if($tg==0){$bgclr='#ECECFF'; $tg=1;}
					else{$bgclr='#FFFFFF'; $tg=0;}			
				print "<tr bgcolor=$bgclr>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>$row[0]</font></div></td>
				  <td><div align=\"left\">&nbsp;&nbsp;&nbsp;<font face=Verdana size=1 color=#006600>&nbsp;$row[1]</font></div></td>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>$row[2]</font></td>
			   	  </tr>";
				 }
			  ?>
              </table>
			  <p>&nbsp;</p>
			  
			  	<?
				if ($count<>0) {
				print "<table align=center border=0><tr><td>";
				if ($v_init_row==0) {
				print "<img src=nav_previous_inact.jpg border=0>";
				}
				else {
				$plnk=$v_init_row-$logrows;
				print "<a href=details.php?uname=$v_uname&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&init_row=$plnk&sort=$v_sort&sq=$v_sq><img src=nav_previous.jpg border=0></a>";
				}
				print "&nbsp;</td><td align=center><font color=blue><font face=arial><font size=2>";
				for($k=1;$k<=ceil($count/$logrows);$k++){
				if ($k<>($v_init_row/$logrows)+1) {
				$link=($k-1)*$logrows;
				print "<a href=details.php?uname=$v_uname&init_row=$link&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&sort=$v_sort&sq=$v_sq><font face=\"arial\"><font size=2><font color=blue><u>$k</u></font></font></font></a> ";
				}
				else {
				print "<font face=\"arial\"><font size=2><font color=#808080>$k</font></font></font> ";
				}
				}
				print "</font></font></font></td><td>&nbsp;";
				if ($v_init_row+$logrows>=$count) {
				print "<img src=nav_next_inact.jpg border=0>";
				}
				else {
				$nlnk=$v_init_row+$logrows;
				print "<a href=details.php?uname=$v_uname&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&init_row=$nlnk&sort=$v_sort&sq=$v_sq><img src=nav_next.jpg border=0></a>";
				}
				print "</td></tr></table>";
				} //end of if $count<>0
				?>
			  <p>&nbsp;</p>
		    <p align="center">&nbsp;</p>
		    <p align="center">&nbsp;</p>
		    <p align="center">&nbsp;</p>
		    <p align="center">&nbsp;</p>
		    <p align="center">&nbsp;</p>
          </tr>
        </table>
		
		</td>
      </tr>
</table>
		    <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>		    </td>

<?
mysql_close($connection);
?>
</body>
</html>
