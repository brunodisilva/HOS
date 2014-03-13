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
.style36 {
	font-size: 9pt;
	font-family: Verdana;
}
.style39 {font-size: 8pt}
.style40 {
	font-size: 10pt;
	color: #000099;
}
-->
</style>

<script language="javascript">
function update_path() {
document.form1.accesspath.value=document.form1.mroot.value+document.form1.accessname.value;
}

function open_window() {
OpenWin = this.open("help.htm", 'instruction','toolbar=no,scrollbars=no,location=no,directies=no,status=no,menu=no,width=550,height=450');
}

</script>
</head>


<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="add_group.php">
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
            <td width="577" align="center" valign="top"><p align="center">
			<br>
                <div align="center"><span class="style21">Add New Protected Directory </span></div>
                </p>
          <?
		  $v_accessname=$_POST['accessname'];
		  $v_accesspath=$_POST['accesspath'];
		  $v_accessdesc=$_POST['accessdesc'];
		  $v_apply=$_POST['apply'];
		  $v_submit=$_POST['add_access'];
		  
		  $err=0;
		  $v_err='';
		  $mt=strpos($v_accessname, '/');
		  $nt=strpos($v_accessname, ' ');
		  if ($v_submit==' Submit ') {
		  if(trim($v_accessname)==''){
		  $v_err='Access name is empty.<br>'; 
		  $err=1;
		  }
		  elseif(($mt<>'')||($nt<>'')){
		  $v_err='Access name cannot contain "/" or space character.<br>'; 
		  $err=1;
		  }
		  elseif(trim($v_accessdesc)==''){
		  $v_err='Access description is empty.<br>'; 
		  $err=1;
		  }
		  else { //add new group to authaccess table
		  $connection = mysql_connect($dbhost, $dbusername, $dbpass);
		  $SelectedDB = mysql_select_db($dbname);
		  $exist_access=mysql_query("select * from authaccess where access_name='$v_accessname'");
		  $numrows = mysql_num_rows($exist_access);
		  if ($numrows == 0) {		 	
		  $addaccess = mysql_query("INSERT INTO authaccess(access_name,access_path,access_desc,create_time) VALUES ('$v_accessname', '$v_accesspath', '$v_accessdesc', now())");		
		  //create new protected folder, generate index page for that producted folder
		  mkdir("$v_accesspath",0777);
		  chmod("$v_accesspath",0777);
		  copy_dir("templates",$v_accesspath);
			$update_index = "$v_accesspath/index.php";
			chmod("$update_index",0777);
			$stradd='$curgroup='."'".$v_accessname."';";
			$add_line = '<? '.$stradd;
			$file_lines = file($update_index); 
			array_unshift($file_lines,$add_line);  
			$new_content = join('',$file_lines); 
			$fp = fopen($update_index,'w');
			fwrite($fp,$new_content);
			fclose($fp);
			$update_index1 = "$v_accesspath/redir.php";
			chmod("$update_index1",0777);
			$file_lines1 = file($update_index1); 
			array_unshift($file_lines1,$add_line);  
			$new_content1 = join('',$file_lines1); 
			$fp1 = fopen($update_index1,'w');
			fwrite($fp1,$new_content1);
			fclose($fp1);
			
			if ($v_apply==2) {  //apply new access to all existing active users 
			  $exist_access1=mysql_query("select distinct uname from authuser where status=1 and signup=0 and uname<>'admin'");
			  while($row = mysql_fetch_array($exist_access1, MYSQL_NUM)) {
			  mysql_query("INSERT INTO memberaccess(uname,access_name) VALUES ('$row[0]','$v_accessname')");	
				$getip=getip();
				mysql_query("insert into log (uname,ctime,ip,activity) values ('$row[0]',now(),'$getip','Added new access group($v_accessname).')");
			}
			} //end of if($v_apply==2)
			

  		  mysql_close($connection);
		  echo "<meta http-equiv=\"refresh\" content=\"0; URL=group.php?add=1\">";
		  exit;			
			}
		  else {
			$v_err=$v_err.'Access name already exists.<br>'; 
			$err=1;
		  } 

		  }
		 } 
		  if($err==1) {
		 // print "<tr><td align=center>"; 
		  print "<table width=515 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">";
		  print "<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=red><font face=arial><font size=2>$v_err</font></font></font>";
		  print "</td></tr></table>";
		  //print "</td></tr>";
		 }
		  ?>			
              <table width="504" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
                <tr>
                  <td width="575">
				  <table width="504" border="0" cellspacing="2" cellpadding="1">
                    <tr>
                      <td height="23">&nbsp;</td>
                      <td width="137"><strong><span class="style20"><br>
                        Access Name<span class="style53">*</span> </span></strong></td>
                      <td colspan="2" valign="bottom" class="style35"><a href="javascript:open_window();" class="style40">(<u>Help</u>)</a></td>
                    </tr>
                    <tr>
                      <td width="26" height="27">&nbsp;</td>
                      <td colspan="3" valign="top"><p class="style48">
                        <input type=text name="accessname" value="" onChange="javascript:update_path();" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" size="40" height="22">
                        </p>
                        </td>
                      </tr>
                    <tr>
                      <td height="29">&nbsp;</td>
                      <td><strong><span class="style20"><br>
                        Directory Path<span class="style53">*</span> </span></strong></td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="72">&nbsp;</td>
                      <td colspan="3" valign="top"><div align="left"><strong></strong></div>                        <span class="style48">
                      <input type=hidden name="mroot" value="<? echo "$droot/members/"; ?>">
                      <textarea name="accesspath" cols="45" rows="3" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" readonly><? echo "$droot/members/"; ?></textarea>
                        </span></td>
                      </tr>
                    <tr>
                      <td height="21">&nbsp;</td>
                      <td><strong><span class="style20"><br>
                        Access Description<span class="style53">*</span> </span></strong></td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="104">&nbsp;</td>
                      <td colspan="3" valign="top"><div align="left"><strong></strong></div>                        <textarea name="accessdesc" cols="45" rows="5" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6"></textarea>                        &nbsp;</td>
                      </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3"><div align="left"><span class="style35">Apply to Existing Member? </span></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3"> <span class="style20">&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="apply" value="1" checked>
                      Create new protected access only </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3"> <span class="style20">&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="apply" value="2"> 
                      Create new protected access, and apply the access to existing &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;active members(not include signed up members). </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td width="221">&nbsp;</td>
                      <td width="102">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3"><strong><span class="style20"><span class="style53">* </span></span></strong><span class="style55 style20 style36"><span class="style55 style20 style39">Required Field </span></span></td>
                      </tr>
                  </table>
				  </td>
                </tr>
              </table>              
              <blockquote>
                <p align="left">
				
			    <div align="center">
			    <input type=submit name="add_access" value=" Submit ">
&nbsp;&nbsp;&nbsp;			      </div>
				
				</p>
              </blockquote>              
			  <p align="center">&nbsp;</p>
		    </td>
          </tr>
        </table></td>
      </tr>
</table></form>

  <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></a><font face="Arial, Helvetica, sans-serif" size="5"></font></p>
  <p>&nbsp;</p>
</body>
</html>
<?
function copy_dir($_s_dir,$_d_dir) {
       if(!is_dir($_s_dir)) {
         return FALSE;
       }
       $_od = getcwd(); 
       chdir($_s_dir);
       $_d = @opendir("./");
       $_ret = TRUE;
       while (($_l=readdir($_d))!==FALSE) {
         if(substr($_l,0,1)=="." AND strlen($_l)<=2) {
             continue;
         }
         if(is_dir($_l)) { 
             mkdir("$_d_dir/$_l");
             if(!copy_dir("$_s_dir/$_l","$_d_dir/$_l")) {
               $_ret = FALSE;
             }
         }
         else {
             if(!copy($_l,"$_d_dir/$_l")) {
               $_ret = FALSE;
             }
         }
       }
       closedir($_d);
       chdir($_od);
       return $_ret;
   }
?>