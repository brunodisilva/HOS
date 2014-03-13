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
.style40 {font-family: Verdana; font-size: 8pt; color: #000099; }
.style43 {
	font-family: Arial;
	font-size: 9pt;
}
.style44 {font-family: Arial; font-size: 8pt; color: #000099; }
.style45 {font-size: 9pt}
.style46 {font-family: Arial; color: #000099; font-size: 9pt; }
-->
</style>
<script language="javascript">
function del() {
var agree1=confirm("Are you sure to delete this member account permanently?");
if (agree1) {
	return true;
	}
else
	return false ;
}
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="793" align="center" cellpadding="0" cellspacing="0" bordercolor="#111111" id="AutoNumber1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
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
        <td width="627" valign="top"><table width="630" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="630" height="641" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Member Information </span></p>
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
				
				$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		  		$SelectedDB = mysql_select_db($dbname);
		  	
				$sg='';	
				$txt='';
				$by='';
				$st='';
				$type='';
				
				if (($v_type=='1')&&($v_status=='1')) {$type="and signup=0"; $st="status=1"; $sg="active";}
				if (($v_type=='1')&&($v_status=='2')) {$type="and signup=0"; $st="status=0"; $sg="pending";}
				if (($v_type=='2')&&($v_status=='1')) {$type="and signup=1"; $st="reg_validate=1"; $sg="active registered";}
				if (($v_type=='2')&&($v_status=='2')) {$type="and signup=1"; $st="reg_validate=0"; $sg="inactive registered";}



				if ($v_by=='2') {
					$by="and uname='$v_keyword'";
					}
					elseif ($v_by=='3') {
					$by="and name='$v_keyword'";
					}
					elseif ($v_by=='4') {
					$by="and email='$v_keyword'";
					}
				
				if ($v_action=='del') {
				//delete this member account
				mysql_query("delete from authuser where uname='$v_username'");
				mysql_query("delete from memberaccess where uname='$v_username'");
				//delete log for this member account
				mysql_query("delete from log where uname='$v_username'");
				$txt=2;
				}
				
				if (($v_sbmt1=="  Search  ")||($v_sbmt1=="1")) {
				$result = mysql_query("select uname,name,email,date_format(lastlogin,'%Y-%m-%d (%H:%i:%s)'),logincount,date_format(create_time,'%Y-%m-%d (%H:%i:%s)') from authuser where $st $type $by and uname<>'admin' order by $v_sort $v_sq limit $v_init_row,$mpp");
				$result_count = mysql_query("select distinct uname from authuser where $st $type $by and uname<>'admin' ");
				$count = mysql_num_rows($result_count); 
				$v_sbmt1="1";
				}//end of sbmt1
				elseif (($v_sbmt2=="  Search  ")||($v_sbmt2=="1")) {
				$v_accessname=$_GET['accessname'];
				if ($v_accessname<>'0') {
				$result = mysql_query("select a.uname,a.name,a.email,date_format(a.lastlogin,'%Y-%m-%d (%H:%i:%s)'),a.logincount,date_format(a.create_time,'%Y-%m-%d (%H:%i:%s)') from authuser a, memberaccess b where a.uname=b.uname and b.access_name='$v_accessname' and a.uname<>'admin' order by $v_sort $v_sq limit $v_init_row,$mpp");
				$result_count = mysql_query("select distinct a.uname from authuser a, memberaccess b where a.uname=b.uname and b.access_name='$v_accessname' and a.uname<>'admin' ");
				$count = mysql_num_rows($result_count); 				
				$txt=1;
				$v_sbmt2="1";
				}
				else {
				mysql_close($connection);
				echo "<meta http-equiv=\"refresh\" content=\"0; URL=search.php?err=1\">";
				exit;		
				}				
				}//end of sbmt2
				
				
				?>              
			  <p align="center"><span class="style20">Search Result:</span> <font face=arial><font size=2><font color=red><? echo "$count "; if($txt<>1) {echo "$sg";} ?></font></font></font> <span class="style20"> member record(s) found</span> 
              <? 
			  if($txt==1) {
			  echo "<br><br><font face=arial><font size=2><font color=blue>Access Name(Protected Directory): </font><font color=red>$v_accessname</font></font></font>";
			   }
			  elseif($txt==2) {
			  echo "<br><br><font face=arial><font size=2><font color=red>User($v_username) has been deleted.</font></font></font>";			  
			  }
			  ?></p>
			  <form method="get" action="memberlist.php">
			  <table width="605" align="center" cellpadding="0" cellspacing="0" border="0">
			  <tr>
			  <td width=257 height="32" valign="middle"><span class="style40">Sort by: 
			  <select name="sort" style="color: #0000FF; font-family: Arial; font-size: 8pt; background-color: #FFFFCC">
			  <option value=uname <? if($v_sort=='uname') {echo "selected";} ?>>Username</option>
			  <option value=name <? if($v_sort=='name') {echo "selected";} ?>>Full Name</option>
			  <option value=email <? if($v_sort=='email') {echo "selected";} ?>>Email</option>
			  <option value=lastlogin <? if($v_sort=='lastlogin') {echo "selected";} ?>>Last Login Time</option>
			  <option value=logincount <? if($v_sort=='logincount') {echo "selected";} ?>>Login Count</option>
			  <option value=create_time <? if($v_sort=='create_time') {echo "selected";} ?>>Created Time</option>
			  </select>&nbsp;
			  <select name="sq" style="color: #0000FF; font-family: Arial; font-size: 8pt; background-color: #FFFFCC">
			  <option value=asc <? if($v_sq=='asc') {echo "selected";} ?>>Ascending</option>
			  <option value=desc <? if($v_sq=='desc') {echo "selected";} ?>>Descending</option>
			  </select>
			  </span></td>
			  <td width=330 valign="middle" align="left">
				<input type="hidden" name="keyword" value=<? echo "$v_keyword"; ?>>
				<input type="hidden" name="type" value=<? echo "$v_type"; ?>>
				<input type="hidden" name="status" value=<? echo "$v_status"; ?>>
				<input type="hidden" name="by" value=<? echo "$v_by"; ?>>
				<input type="hidden" name="sbmt1" value=<? echo "$v_sbmt1"; ?>>
				<input type="hidden" name="sbmt2" value=<? echo "$v_sbmt2"; ?>>
				<input type="hidden" name="accessname" value=<? echo "$v_accessname"; ?>>
				<input type="hidden" name="init_row" value=0>
				<input type="submit" name="Submit" value="Submit" style="color: #0000FF; font-family: Arial; font-size: 8pt; background-color: #FFFFFF"></td>
			  </tr>
			  </table>
			  <table width="608" align="center" cellpadding="0" cellspacing="0" border="1">
				<tr bgcolor="#FFFFCC">
				  <td width="73" height="40"><div align="left" class="style40 style43">
				    <div align="center"><strong>Username</strong></div>
				  </div></td>
			      <td width="101"><div align="left" class="style40 style43">
			        <div align="center"><strong>Full Name </strong></div>
			      </div></td>
			      <td width="154"><div align="left" class="style44 style45">
			        <div align="center"><strong>Email</strong></div>
			      </div></td>
			      <td width="77"><div align="left" class="style46">
			        <div align="center"><strong>Last Login<br>
			          Time
			        </strong></div>
			      </div></td>
			      <td width="46"><div align="left" class="style46">
			        <div align="center"><strong>Login <br>
		            Count</strong></div>
			      </div></td>
				  <td width="72"><div align="left" class="style46">
			        <div align="center"><strong>Created Time</strong></div>
			      </div></td>
			      <td width="31"><div align="left" class="style46">
			        <div align="center"><strong>Edit</strong></div>
			      </div></td>
			      <td width="36"><div align="left" class="style46">
			        <div align="center"><strong>Delete</strong></div>
			      </div></td>
				</tr>
				<?
					$tg=0;
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if($tg==0){$bgclr='#ECECFF'; $tg=1;}
					else{$bgclr='#FFFFFF'; $tg=0;}			
				print "<tr bgcolor=$bgclr>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;&nbsp;<a href=details.php?uname=$row[0]&type=1&status=1&by=1&sbmt1=1&init_row=0&sort=ctime&sq=desc><u>$row[0]</u></a></font></div></td>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;$row[1]</font></div></td>
				  <td><div align=\"left\"><font face=Verdana size=1 color=#006600>&nbsp;$row[2]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[3]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[4]</font></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600>&nbsp;$row[5]</font></div></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600><a href=edit_member.php?username=$row[0]><u>Edit</u></a></font></div></td>
				  <td><div align=\"center\"><font face=Verdana size=1 color=#006600><a href=memberlist.php?action=del&username=$row[0]&keyword=$v_keyword&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&sbmt2=$v_sbmt2&accessname=$v_accessname&init_row=$v_init_row&sort=$v_sort&sq=$v_sq onclick=\"return del();\"><u>Delete</u></a></font></div></td>
			   	  </tr>";
				 }
			  ?>   
			  </table>  </form>   
			  <br>
			  
			  	<?
				if ($count<>0) {
				print "<table align=center border=0><tr><td>";
				if ($v_init_row==0) {
				print "<img src=nav_previous_inact.jpg border=0>";
				}
				else {
				$plnk=$v_init_row-$mpp;
				print "<a href=memberlist.php?keyword=$v_keyword&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&sbmt2=$v_sbmt2&accessname=$v_accessname&init_row=$plnk&sort=$v_sort&sq=$v_sq><img src=nav_previous.jpg border=0></a>";
				}
				print "&nbsp;</td><td align=center><font color=blue><font face=arial><font size=2>";
				for($k=1;$k<=ceil($count/$mpp);$k++){
				if ($k<>($v_init_row/$mpp)+1) {
				$link=($k-1)*$mpp;
				print "<a href=memberlist.php?init_row=$link&keyword=$v_keyword&type=$v_type&status=$v_status&by=$v_by&accessname=$v_accessname&sbmt1=$v_sbmt1&sbmt2=$v_sbmt2&sort=$v_sort&sq=$v_sq><font face=\"arial\"><font size=2><font color=blue><u>$k</u></font></font></font></a> ";
				}
				else {
				print "<font face=\"arial\"><font size=2><font color=#808080>$k</font></font></font> ";
				}
				}
				print "</font></font></font></td><td>&nbsp;";
				if ($v_init_row+$mpp>=$count) {
				print "<img src=nav_next_inact.jpg border=0>";
				}
				else {
				$nlnk=$v_init_row+$mpp;
				print "<a href=memberlist.php?keyword=$v_keyword&type=$v_type&status=$v_status&by=$v_by&sbmt1=$v_sbmt1&sbmt2=$v_sbmt2&accessname=$v_accessname&init_row=$nlnk&sort=$v_sort&sq=$v_sq><img src=nav_next.jpg border=0></a>";
				}
				print "</td></tr></table>";
				} //end of if $count<>0
				?>
				
				
</td>
          </tr>
        </table>
		
		</td>
      </tr>
</table>
		    <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>

<?
mysql_close($connection);
?>
</body>
</html>
