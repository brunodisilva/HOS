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


<script language="javascript">
function verify() {
var agree=confirm("Are you sure to delete selected directory?");
if (agree) {
var agree1=confirm("Warning: After deleting protected directory, all protected files under this directory will be removed, continue?");
	if (agree1)
	return true ;
	else
	return false ;
}
else
	return false ;
}

function open_window() {
OpenWin = this.open("help.htm", 'instruction','toolbar=no,scrollbars=no,location=no,directies=no,status=no,menu=no,width=550,height=450');
}
</script>

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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="650"></td>
        <td width="608" valign="top">
		<form method="post" action="group.php">
		<table width="604" border="0" cellspacing="0" cellpadding="0">
		  <tr>
            <td width="604" valign="top"><p align="center"><br>
                <span class="style21"><br>
                Protected Directory</span></p>
              	<?php
				  $connection = mysql_connect($dbhost, $dbusername, $dbpass);
				  $SelectedDB = mysql_select_db($dbname);
				  $v_add=$_GET['add'];
				  $v_delete=$_POST['delete'];
				  if($v_add==1) {
				  print "<div align=center><font color=red><font face=arial><font size=2>New protected directory has been created.</font></font></font></div>";
				  }
				  if($v_delete=='Delete') {
				  $v_sel=$_POST['sel'];
				  $v_dnum=$_POST['sel_num'];
				  $v_access_name=$_POST['access_name'];
				  $v_access_path=$_POST['access_path'];
				  $df=0;
				  for ($j=0;$j<$v_dnum;$j++) {
				  if(strtoupper($v_sel[$j])=='ON') 
				  {
				  mysql_query("delete from authaccess where access_name='$v_access_name[$j]'");
				  mysql_query("delete from memberaccess where access_name='$v_access_name[$j]'");
				  $result1=mysql_query("select distinct uname from authuser where uname<>'admin' and signup ='0'");
				  while($row = mysql_fetch_array($result1, MYSQL_NUM)) {
				  $exist_access=mysql_query("select * from memberaccess where uname='$row[0]'");
				  $numrows=0;
				  $numrows = mysql_num_rows($exist_access);
				  if ($numrows == 0) {		 	
				  mysql_query("update authuser set status=0 where uname='$row[0]' and signup ='0'");
				  }
				  }
				  deldir($v_access_path[$j]);
				  $df=1;
				  }
				  }
				  
				  if($df==0) {
				  print "<table width=578 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
						<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=red><font face=arial><font size=2>Please select a protected directory to be deleted.</font></font></font>";
				  print "</td></tr></table>";
				  }
				  else {
				  print "<div align=center><font color=red><font face=arial><font size=2>Selected access directory has been deleted.</font></font></font></div>";
				  }
				  }
				  ?>
                <table width="563" border="0">
                  <tr>
                    <td width="568"><ul>
                      <li><span class="style40 style20">This is the area where administrator setup membership protected directories, click <a href="javascript:open_window();" class="style40"><u>here</u></a> for the help. </span></li>
                      <li><span class="style40 style20">Membership directories are protected by .htaccess file.</span></li>
                      <li><span class="style40 style20">Membership directories can be used on both regular member(admin-created member) and signup member, depends on administrator's setting, click "Signup Access" to set default directories for signup members.</span></li>
                    </ul></td>
                  </tr>
              </table>
				<table width="595" align="center" cellpadding="0" cellspacing="0" border="1">
					  <tr bgcolor="#FFFFCC">
                      <td width="18" height="37"><div align="left"><strong>&nbsp;</strong></div></td>
                      <td width="67"><div align="center"><strong><span class="style20">Access Name</span></strong></div></td>
                      <td width="183"><div align="center"><strong><span class="style20">Directory Path </span></strong></div></td>
                      <td width="218"><div align="center"><strong><span class="style20">Description</span></strong></div></td>
					   <td width="91"><div align="center"><strong><span class="style20">Created Time </span></strong></div></td>
                    </tr>
                    <?php
					$result=mysql_query("select access_name,access_path,access_desc,date_format(create_time,'%Y-%m-%d') from authaccess where access_name <> '' order by create_time desc");
					$i=0;
					$tg=0;
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if($tg==0){$bgclr='#ECECFF'; $tg=1;}
					else{$bgclr='#FFFFFF'; $tg=0;}	
					print "<tr bgcolor=$bgclr>	
                      <td align=center><input type=checkbox name=sel[$i]></td>
                      <td width=70><font face=Verdana size=1 color=#006600>$row[0]&nbsp;</font>
					  <input type=hidden name=access_name[$i]  value='$row[0]'>
					  </td>
                      <td width=100><font face=Verdana size=1 color=#006600>$row[1]&nbsp;</font></td>
                      <input type=hidden name=access_path[$i]  value='$row[1]'>
					  <td width=200><font face=Verdana size=1 color=#006600><a href=\"edit_group.php?acname=$row[0]\"><u>$row[2]</u></a>&nbsp;</font></td>
					  <td width=70 align=center><font face=Verdana size=1 color=#006600>$row[3]&nbsp;</font></td>
                      </tr>";
					$i++;

					}
					mysql_free_result($result);
  		  			mysql_close($connection);
					?>
              </table>
             
              <blockquote>
                <p align="left">
				<table width=200 border=0 align="center">
					  <tr><td width="95">
			          <div align="center">
			            <input type="button" name="add" value=" Add " onClick="location.href='add_group.php';">
		              </div>
					</td><td width="95">
			          <div align="center">
					    <input type="hidden" name="sel_num" value="<?php echo $i; ?>">
			            <input type="submit" name="delete" value="Delete" onClick="return verify()">
		              </div>
					
				</td></tr></table>
				
				
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
<?php
function deldir($dir)
{
  $handle = opendir($dir);
  while (false!==($FolderOrFile = readdir($handle)))
  {
     if($FolderOrFile != "." && $FolderOrFile != "..") 
     {  
       if(is_dir("$dir/$FolderOrFile")) 
       { deldir("$dir/$FolderOrFile"); }  // recursive
       else
       { unlink("$dir/$FolderOrFile"); }
     }  
  }
  closedir($handle);
  if(rmdir($dir))
  { $success = true; }
  return $success;  
}
?>