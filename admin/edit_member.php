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
.style23 {
	font-size: 10pt;
	color: #000099;
}
.style25 {font-family: Arial; font-size: 10pt; }
.style27 {
	font-size: 10px;
	color: #999999;
}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
.style29 {color: #000099}
.style30 {
	font-family: Verdana;
	font-size: 8pt;
	color: #000099;
}
.style33 {font-size: 8pt; color: #000099; }
.style36 {	font-family: Verdana;
	font-size: 8pt;
	color: #666666;
}
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
 <form name="form1" method="post" action="edit_member.php">
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
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="800"></td>
        <td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="795" align="center" valign="top"><p align="center"><br>
                <span class="style21">Edit Member Account </span></p>

              <?
              	

				  $v_sbm=$_POST['sbm'];
				  $v_username=$_GET['username'];
				  $connection = mysql_connect($dbhost, $dbusername, $dbpass);
				  $SelectedDB = mysql_select_db($dbname);
				  
				  $result = mysql_query("select name,passwd,email,address,city,state,zip,country,phone,signup,reg_validate from authuser where uname='$v_username'");				  
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$v_name=$row[0];
					$v_pass=$row[1];
					$v_email=$row[2];
					$v_address=$row[3];
					$v_city=$row[4];
					$v_state=$row[5];
					$v_zip=$row[6];
					$v_country=$row[7];
					$v_phone=$row[8];
					$v_signup=$row[9];
					$v_reg_validate=$row[10];
					}

				  $result1 = mysql_query("select access_name from memberaccess where uname='$v_username'"); //get access_name for this username
				  	$p=0;
					while($row1 = mysql_fetch_array($result1, MYSQL_NUM)) {
					$s_accessname[$p]=$row1[0];
					$p++;
					}
				  				  
				  if($v_sbm=='Submit') {
				  $v_username=$_POST['username'];
				  $v_password=$_POST['password'];
				  $v_password1=$_POST['password1'];
				  $v_pass1=$_POST['pass1'];
				  $v_name=$_POST['name'];
				  $v_email=$_POST['email'];
				  $v_address=$_POST['address'];
				  $v_city=$_POST['city'];
				  $v_state=$_POST['state'];
				  $v_zip=$_POST['zip'];
				  $v_country=$_POST['country'];
				  $v_phone=$_POST['phone'];
				  $v_semail=$_POST['semail'];
				  $v_access=$_POST['access'];
				  $v_accessck=$_POST['accessck'];
				  $v_anum=$_POST['access_num'];
				  $v_signup=$_POST['signup'];
				  $v_reg_validate=$_POST['reg_validate'];
				  
				  $validemail=verifyemailaddress($v_email);			
				  $g=0;

				  if((trim($v_password)<>'')&&(strlen($v_password)) < 6 ){   
				  $err=$err.'Password is less than 6 characters.<br>';
				  $g=1;					  
				  }
				  elseif((trim($v_password)<>'')&&(ereg('[^A-Za-z0-9]', $v_password))){
				  $err=$err.'Password contains special characters.<br>';
				  $g=1;				  
				  }    
				  elseif($v_password<>$v_password1) {
				  $err=$err.'Confirm password doesn\'t match.<br>';
				  $g=1;
				  }
				  if(trim($v_name)=='') {
				  $err=$err.'Name field is blank.<br>';
				  $g=1;
				  }
				  if(trim($v_email)=='') {
				  $err=$err.'Email field is blank.<br>';
				  $g=1;
				  }
				  elseif($validemail<>1) {
				  $err=$err.'Not a valid email address.<br>';
				  $g=1;
				  }  
				  //check if email already exists
				  $result=mysql_query("select distinct email from authuser where uname='$v_username'");
				  while($row = mysql_fetch_array($result, MYSQL_NUM)) {
				  $v_cemail=$row[0];
				  }
				  $result=mysql_query("select email from authuser");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if((strtolower($row[0])==strtolower($v_email))&&(trim($v_email)<>'')&&(strtolower($row[0])<>strtolower($v_cemail))) {$err_email="This email address(<font color=red>$v_email</font>) already exists, please use different one.<br>"; $g=1; }
					}
				  $err=$err.$err_email;
				  
				  if ($g==1) {
				  print "<table width=421 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 3px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
						<tr><td width=50 align=center><img src=error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>$err</font></font></font>";
				  print "</td></tr></table>";
				  }
				  else {	
				  	$updatepass='';
				    if ((trim($v_password) <> '')&&($v_password==$v_password1)) {
						$newenpass=base64_encode($v_password);
						$updatepass="passwd='$newenpass',";
					}
					mysql_query("update authuser set $updatepass name='$v_name',email='$v_email',address='$v_address',city='$v_city',state='$v_state',zip='$v_zip',country='$v_country',phone='$v_phone' where uname='$v_username'");
				
					if($v_signup <> '1') {
					mysql_query("delete from memberaccess where uname='$v_username'");
					$active=0;
					for($j=0;$j<$v_anum;$j++) {
					if(strtolower($v_accessck[$j])=='on') {					
					mysql_query("insert into memberaccess (uname,access_name) values ('$v_username','$v_access[$j]')");
					$active=1;
					}
					}//end of FOR statement
					mysql_query("update authuser set status=$active where uname='$v_username'");
					}//end of if($v_signup<>1)
					
					if($v_semail=='Yes') {
					//send email to member to notify the account creation
					$result=mysql_query("select subject,contents from emailtemplates where name='editmember'");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$v_subject=trim($row[0]);
					$v_message=nl2br(trim($row[1]));
					}
					if(trim($v_password) == '') {
					$v_password=base64_decode($v_pass1);
					}
					else
					$subject = "$v_subject";
					$headers = "From: $v_emailfrom\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
					$v_message = ereg_replace("\\<%username%>","$v_username",$v_message);
					$v_message = ereg_replace("\\<%password%>","$v_password",$v_message);
					$v_message = ereg_replace("\\<%weburl%>","$url_root",$v_message);						
					mail($v_email, $v_subject, $v_message, $headers);
					}
					$getip=getip();
					mysql_query("insert into log (uname,ctime,ip,activity) values ('$v_username',now(),'$getip','Member account($v_username) has been modified.')");
					mysql_close($connection);
				  echo "<meta http-equiv=\"refresh\" content=\"0; URL=message.php?msg=editmember\">";
				  exit;		
				  }
				}



?>
  <table border="1" cellpadding="0" cellspacing="0" width="421"  bordercolor="#000000"   style="border-style: solid; border-width: 0">
    <tr>
      <td width="100%">
&nbsp;        <div align="center">
          <center>

          <table border="0" cellpadding="3" width="390">
            <tr>
    <td width="131"><div align="left"><span class="style23"><font face="Arial" size="2">Username</font></span><font    face="Arial" size="2" color="#FF0000">*</font></div></td>
    <td width="241"><div align="left"><font face="Arial" size=2>
        <input size="30"  value="<? echo "$v_username"; ?>" disabled  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
   	    <input type="hidden" name="username" value="<? echo "$v_username"; ?>">
    </font></div></td>
            </tr>
            <tr>
              <td colspan="2"><div align="left" class="style36">Leave password field blank if you don't want to change.<br>
                Password must be at least 6 characters. (No special character)</span></div></td>
              </tr>
            <tr>
              <td><div align="left"><span class="style23"><font face="Arial" size="2">Password</font></span><font   face="Arial" size="2"  color="#FF0000">*</font><span class="style25"></span></div></td>
              <td><div align="left"><font face="Arial" size="2">
                  <input name="password"   type="password"   value="<? echo "$v_password"; ?>"   size="30"  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
              	  <input name="pass1" type="hidden"  value="<? echo "$v_pass"; ?>">
			  </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font face="Arial" size="2">Confirm  Password</font></span><font   face="Arial" size="2" color="#FF0000">*</font></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="password1"   type="password"  value="<? echo "$v_password1"; ?>"   size="30"  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
    </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font face="Arial" size="2">Full  name</font></span><font   face="Arial" size="2" color="#FF0000">*</font></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="name" size="30"  value="<? echo "$v_name"; ?>"    style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
    </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font face="Arial" size="2">Email   address</font></span><font   face="Arial" size="2" color="#FF0000">*</font>
    </div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="email" size="30" value="<? echo "$v_email"; ?>"  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
    </font></div></td>
			</tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">Address</font></span></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="address" size="30"  value="<? echo "$v_address"; ?>"    style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
    </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">City</font></span></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="city" size="30"  value="<? echo "$v_city"; ?>"    style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
    </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">State</font></span></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="state" size="30"  value="<? echo "$v_state"; ?>"    style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
    </font></div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">Zip  Code</font></span></div></td>
    <td width="241">
      <div align="left"><font face="Arial" size="2">
        <input name="zip" size="30" value="<? echo "$v_zip"; ?>"   style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
        </font>
      </div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">Country</font></span></div></td>
    <td width="241">
      <div align="left"><font face="Arial" size="2">
        <select name="country" size="1" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
          <option <? if($v_country=='United States'){echo 'selected';} ?>>United States</option>
          <option <? if($v_country=='Afghanistan'){echo 'selected';} ?>>Afghanistan</option>
          <option <? if($v_country=='Albania'){echo 'selected';} ?>>Albania</option>
          <option <? if($v_country=='Algeria'){echo 'selected';} ?>>Algeria</option>
          <option <? if($v_country=='American Samoa'){echo 'selected';} ?>>American Samoa</option>
          <option <? if($v_country=='Andorra'){echo 'selected';} ?>>Andorra</option>
          <option <? if($v_country=='Angola'){echo 'selected';} ?>>Angola</option>
          <option <? if($v_country=='Anguilla'){echo 'selected';} ?>>Anguilla</option>
          <option <? if($v_country=='Antarctica'){echo 'selected';} ?>>Antarctica</option>
          <option <? if($v_country=='Antigua And Barbuda'){echo 'selected';} ?>>Antigua And Barbuda</option>
          <option <? if($v_country=='Argentina'){echo 'selected';} ?>>Argentina</option>
          <option <? if($v_country=='Armenia'){echo 'selected';} ?>>Armenia</option>
          <option <? if($v_country=='Aruba'){echo 'selected';} ?>>Aruba</option>
          <option <? if($v_country=='Australia'){echo 'selected';} ?>>Australia</option>
          <option <? if($v_country=='Austria'){echo 'selected';} ?>>Austria</option>
          <option <? if($v_country=='Azerbaijan'){echo 'selected';} ?>>Azerbaijan</option>
          <option <? if($v_country=='Bahamas'){echo 'selected';} ?>>Bahamas</option>
          <option <? if($v_country=='Bahrain'){echo 'selected';} ?>>Bahrain</option>
          <option <? if($v_country=='Bangladesh'){echo 'selected';} ?>>Bangladesh</option>
          <option <? if($v_country=='Barbados'){echo 'selected';} ?>>Barbados</option>
          <option <? if($v_country=='Belarus'){echo 'selected';} ?>>Belarus</option>
          <option <? if($v_country=='Belgium'){echo 'selected';} ?>>Belgium</option>
          <option <? if($v_country=='Belize'){echo 'selected';} ?>>Belize</option>
          <option <? if($v_country=='Benin'){echo 'selected';} ?>>Benin</option>
          <option <? if($v_country=='Bermuda'){echo 'selected';} ?>>Bermuda</option>
          <option <? if($v_country=='Bhutan'){echo 'selected';} ?>>Bhutan</option>
          <option <? if($v_country=='Bolivia'){echo 'selected';} ?>>Bolivia</option>
          <option <? if($v_country=='Bosnia and Herzegovina'){echo 'selected';} ?>>Bosnia and Herzegovina</option>
          <option <? if($v_country=='Botswana'){echo 'selected';} ?>>Botswana</option>
          <option <? if($v_country=='Bouvet Island'){echo 'selected';} ?>>Bouvet Island</option>
          <option <? if($v_country=='Brazil'){echo 'selected';} ?>>Brazil</option>
          <option <? if($v_country=='British Indian Ocean Territory'){echo 'selected';} ?>>British Indian Ocean Territory</option>
          <option <? if($v_country=='Brunei'){echo 'selected';} ?>>Brunei</option>
          <option <? if($v_country=='Bulgaria'){echo 'selected';} ?>>Bulgaria</option>
          <option <? if($v_country=='Burkina Faso'){echo 'selected';} ?>>Burkina Faso</option>
          <option <? if($v_country=='Burundi'){echo 'selected';} ?>>Burundi</option>
          <option <? if($v_country=='Cambodia'){echo 'selected';} ?>>Cambodia</option>
          <option <? if($v_country=='Cameroon'){echo 'selected';} ?>>Cameroon</option>
          <option <? if($v_country=='Canada'){echo 'selected';} ?>>Canada</option>
          <option <? if($v_country=='Cape Verde'){echo 'selected';} ?>>Cape Verde</option>
          <option <? if($v_country=='Cayman Islands'){echo 'selected';} ?>>Cayman Islands</option>
          <option <? if($v_country=='Central African Republic'){echo 'selected';} ?>>Central African Republic</option>
          <option <? if($v_country=='Chad'){echo 'selected';} ?>>Chad</option>
          <option <? if($v_country=='Chile'){echo 'selected';} ?>>Chile</option>
          <option <? if($v_country=='China'){echo 'selected';} ?>>China</option>
          <option <? if($v_country=='Christmas Island'){echo 'selected';} ?>>Christmas Island</option>
          <option <? if($v_country=='Cocos (Keeling) Islands'){echo 'selected';} ?>>Cocos (Keeling) Islands</option>
          <option <? if($v_country=='Columbia'){echo 'selected';} ?>>Columbia</option>
          <option <? if($v_country=='Comoros'){echo 'selected';} ?>>Comoros</option>
          <option <? if($v_country=='Congo'){echo 'selected';} ?>>Congo</option>
          <option <? if($v_country=='Cook Islands'){echo 'selected';} ?>>Cook Islands</option>
          <option <? if($v_country=='Costa Rica'){echo 'selected';} ?>>Costa Rica</option>
          <option <? if($v_country=='Croatia (Hrvatska)'){echo 'selected';} ?>>Croatia (Hrvatska)</option>
          <option <? if($v_country=='Cuba'){echo 'selected';} ?>>Cuba</option>
          <option <? if($v_country=='Cyprus'){echo 'selected';} ?>>Cyprus</option>
          <option <? if($v_country=='Czech Republic'){echo 'selected';} ?>>Czech Republic</option>
          <option <? if($v_country=='D.P.R. Korea'){echo 'selected';} ?>>D.P.R. Korea</option>
          <option <? if($v_country=='Dem Rep of Congo (Zaire)'){echo 'selected';} ?>>Dem Rep of Congo (Zaire)</option>
          <option <? if($v_country=='Denmark'){echo 'selected';} ?>>Denmark</option>
          <option <? if($v_country=='Djibouti'){echo 'selected';} ?>>Djibouti</option>
          <option <? if($v_country=='Dominica'){echo 'selected';} ?>>Dominica</option>
          <option <? if($v_country=='Dominican Republic'){echo 'selected';} ?>>Dominican Republic</option>
          <option <? if($v_country=='East Timor'){echo 'selected';} ?>>East Timor</option>
          <option <? if($v_country=='Ecuador'){echo 'selected';} ?>>Ecuador</option>
          <option <? if($v_country=='Egypt'){echo 'selected';} ?>>Egypt</option>
          <option <? if($v_country=='El Salvador'){echo 'selected';} ?>>El Salvador</option>
          <option <? if($v_country=='Equatorial Guinea'){echo 'selected';} ?>>Equatorial Guinea</option>
          <option <? if($v_country=='Eritrea'){echo 'selected';} ?>>Eritrea</option>
          <option <? if($v_country=='Estonia'){echo 'selected';} ?>>Estonia</option>
          <option <? if($v_country=='Ethiopia'){echo 'selected';} ?>>Ethiopia</option>
          <option <? if($v_country=='Falkland Islands (Malvinas)'){echo 'selected';} ?>>Falkland Islands (Malvinas)</option>
          <option <? if($v_country=='Faroe Islands'){echo 'selected';} ?>>Faroe Islands</option>
          <option <? if($v_country=='Fiji'){echo 'selected';} ?>>Fiji</option>
          <option <? if($v_country=='Finland'){echo 'selected';} ?>>Finland</option>
          <option <? if($v_country=='France'){echo 'selected';} ?>>France</option>
          <option <? if($v_country=='French Guiana'){echo 'selected';} ?>>French Guiana</option>
          <option <? if($v_country=='French Polynesia'){echo 'selected';} ?>>French Polynesia</option>
          <option <? if($v_country=='French Southern Territories'){echo 'selected';} ?>>French Southern Territories</option>
          <option <? if($v_country=='Gabon'){echo 'selected';} ?>>Gabon</option>
          <option <? if($v_country=='Gambia'){echo 'selected';} ?>>Gambia</option>
          <option <? if($v_country=='Georgia'){echo 'selected';} ?>>Georgia</option>
          <option <? if($v_country=='Germany'){echo 'selected';} ?>>Germany</option>
          <option <? if($v_country=='Ghana'){echo 'selected';} ?>>Ghana</option>
          <option <? if($v_country=='Gibraltar'){echo 'selected';} ?>>Gibraltar</option>
          <option <? if($v_country=='Greece'){echo 'selected';} ?>>Greece</option>
          <option <? if($v_country=='Greenland'){echo 'selected';} ?>>Greenland</option>
          <option <? if($v_country=='Grenada'){echo 'selected';} ?>>Grenada</option>
          <option <? if($v_country=='Guadeloupe'){echo 'selected';} ?>>Guadeloupe</option>
          <option <? if($v_country=='Guam'){echo 'selected';} ?>>Guam</option>
          <option <? if($v_country=='Guatemala'){echo 'selected';} ?>>Guatemala</option>
          <option <? if($v_country=='Guinea'){echo 'selected';} ?>>Guinea</option>
          <option <? if($v_country=='Guinea-Bissau'){echo 'selected';} ?>>Guinea-Bissau</option>
          <option <? if($v_country=='Guyana'){echo 'selected';} ?>>Guyana</option>
          <option <? if($v_country=='Haiti'){echo 'selected';} ?>>Haiti</option>
          <option <? if($v_country=='Heard and McDonald Islands'){echo 'selected';} ?>>Heard and McDonald Islands</option>
          <option <? if($v_country=='Honduras'){echo 'selected';} ?>>Honduras</option>
          <option <? if($v_country=='Hong Kong SAR, PRC'){echo 'selected';} ?>>Hong Kong SAR, PRC</option>
          <option <? if($v_country=='Hungary'){echo 'selected';} ?>>Hungary</option>
          <option <? if($v_country=='Iceland'){echo 'selected';} ?>>Iceland</option>
          <option <? if($v_country=='India'){echo 'selected';} ?>>India</option>
          <option <? if($v_country=='Indonesia'){echo 'selected';} ?>>Indonesia</option>
          <option <? if($v_country=='Iran'){echo 'selected';} ?>>Iran</option>
          <option <? if($v_country=='Iraq'){echo 'selected';} ?>>Iraq</option>
          <option <? if($v_country=='Ireland'){echo 'selected';} ?>>Ireland</option>
          <option <? if($v_country=='Israel'){echo 'selected';} ?>>Israel</option>
          <option <? if($v_country=='Italy'){echo 'selected';} ?>>Italy</option>
          <option <? if($v_country=='Jamaica'){echo 'selected';} ?>>Jamaica</option>
          <option <? if($v_country=='Japan'){echo 'selected';} ?>>Japan</option>
          <option <? if($v_country=='Jordan'){echo 'selected';} ?>>Jordan</option>
          <option <? if($v_country=='Kazakhstan'){echo 'selected';} ?>>Kazakhstan</option>
          <option <? if($v_country=='Kenya'){echo 'selected';} ?>>Kenya</option>
          <option <? if($v_country=='Kiribati'){echo 'selected';} ?>>Kiribati</option>
          <option <? if($v_country=='Korea'){echo 'selected';} ?>>Korea</option>
          <option <? if($v_country=='Kuwait'){echo 'selected';} ?>>Kuwait</option>
          <option <? if($v_country=='Kyrgyzstan'){echo 'selected';} ?>>Kyrgyzstan</option>
          <option <? if($v_country=='Lao'){echo 'selected';} ?>>Lao</option>
          <option <? if($v_country=='Latvia'){echo 'selected';} ?>>Latvia</option>
          <option <? if($v_country=='Lebanon'){echo 'selected';} ?>>Lebanon</option>
          <option <? if($v_country=='Lesotho'){echo 'selected';} ?>>Lesotho</option>
          <option <? if($v_country=='Liberia'){echo 'selected';} ?>>Liberia</option>
          <option <? if($v_country=='Libya'){echo 'selected';} ?>>Libya</option>
          <option <? if($v_country=='Liechtenstein'){echo 'selected';} ?>>Liechtenstein</option>
          <option <? if($v_country=='Lithuania'){echo 'selected';} ?>>Lithuania</option>
          <option <? if($v_country=='Luxembourg'){echo 'selected';} ?>>Luxembourg</option>
          <option <? if($v_country=='Macao'){echo 'selected';} ?>>Macao</option>
          <option <? if($v_country=='Macedonia'){echo 'selected';} ?>>Macedonia</option>
          <option <? if($v_country=='Madagascar'){echo 'selected';} ?>>Madagascar</option>
          <option <? if($v_country=='Malawi'){echo 'selected';} ?>>Malawi</option>
          <option <? if($v_country=='Malaysia'){echo 'selected';} ?>>Malaysia</option>
          <option <? if($v_country=='Maldives'){echo 'selected';} ?>>Maldives</option>
          <option <? if($v_country=='Mali'){echo 'selected';} ?>>Mali</option>
          <option <? if($v_country=='Malta'){echo 'selected';} ?>>Malta</option>
          <option <? if($v_country=='Marshall Islands'){echo 'selected';} ?>>Marshall Islands</option>
          <option <? if($v_country=='Martinique'){echo 'selected';} ?>>Martinique</option>
          <option <? if($v_country=='Mauritania'){echo 'selected';} ?>>Mauritania</option>
          <option <? if($v_country=='Mauritius'){echo 'selected';} ?>>Mauritius</option>
          <option <? if($v_country=='Mayotte'){echo 'selected';} ?>>Mayotte</option>
          <option <? if($v_country=='Mexico'){echo 'selected';} ?>>Mexico</option>
          <option <? if($v_country=='Micronesia'){echo 'selected';} ?>>Micronesia</option>
          <option <? if($v_country=='Moldova'){echo 'selected';} ?>>Moldova</option>
          <option <? if($v_country=='Monaco'){echo 'selected';} ?>>Monaco</option>
          <option <? if($v_country=='Mongolia'){echo 'selected';} ?>>Mongolia</option>
          <option <? if($v_country=='Montserrat'){echo 'selected';} ?>>Montserrat</option>
          <option <? if($v_country=='Morocco'){echo 'selected';} ?>>Morocco</option>
          <option <? if($v_country=='Mozambique'){echo 'selected';} ?>>Mozambique</option>
          <option <? if($v_country=='Myanmar'){echo 'selected';} ?>>Myanmar</option>
          <option <? if($v_country=='Namibia'){echo 'selected';} ?>>Namibia</option>
          <option <? if($v_country=='Nauru'){echo 'selected';} ?>>Nauru</option>
          <option <? if($v_country=='Nepal'){echo 'selected';} ?>>Nepal</option>
          <option <? if($v_country=='Netherlands'){echo 'selected';} ?>>Netherlands</option>
          <option <? if($v_country=='Netherlands Antilles'){echo 'selected';} ?>>Netherlands Antilles</option>
          <option <? if($v_country=='New Caledonia'){echo 'selected';} ?>>New Caledonia</option>
          <option <? if($v_country=='New Zealand'){echo 'selected';} ?>>New Zealand</option>
          <option <? if($v_country=='Nicaragua'){echo 'selected';} ?>>Nicaragua</option>
          <option <? if($v_country=='Niger'){echo 'selected';} ?>>Niger</option>
          <option <? if($v_country=='Nigeria'){echo 'selected';} ?>>Nigeria</option>
          <option <? if($v_country=='Niue'){echo 'selected';} ?>>Niue</option>
          <option <? if($v_country=='Norfolk Island'){echo 'selected';} ?>>Norfolk Island</option>
          <option <? if($v_country=='Northern Mariana Islands'){echo 'selected';} ?>>Northern Mariana Islands</option>
          <option <? if($v_country=='Norway'){echo 'selected';} ?>>Norway</option>
          <option <? if($v_country=='Oman'){echo 'selected';} ?>>Oman</option>
          <option <? if($v_country=='Pakistan'){echo 'selected';} ?>>Pakistan</option>
          <option <? if($v_country=='Palau'){echo 'selected';} ?>>Palau</option>
          <option <? if($v_country=='Panama'){echo 'selected';} ?>>Panama</option>
          <option <? if($v_country=='Papua new Guinea'){echo 'selected';} ?>>Papua new Guinea</option>
          <option <? if($v_country=='Paraguay'){echo 'selected';} ?>>Paraguay</option>
          <option <? if($v_country=='Peru'){echo 'selected';} ?>>Peru</option>
          <option <? if($v_country=='Philippines'){echo 'selected';} ?>>Philippines</option>
          <option <? if($v_country=='Pitcairn'){echo 'selected';} ?>>Pitcairn</option>
          <option <? if($v_country=='Poland'){echo 'selected';} ?>>Poland</option>
          <option <? if($v_country=='Portugal'){echo 'selected';} ?>>Portugal</option>
          <option <? if($v_country=='Puerto Rico'){echo 'selected';} ?>>Puerto Rico</option>
          <option <? if($v_country=='Qatar'){echo 'selected';} ?>>Qatar</option>
          <option <? if($v_country=='Reunion'){echo 'selected';} ?>>Reunion</option>
          <option <? if($v_country=='Romania'){echo 'selected';} ?>>Romania</option>
          <option <? if($v_country=='Russia'){echo 'selected';} ?>>Russia</option>
          <option <? if($v_country=='Rwanda'){echo 'selected';} ?>>Rwanda</option>
          <option <? if($v_country=='Saint Kitts And Nevis'){echo 'selected';} ?>>Saint Kitts And Nevis</option>
          <option <? if($v_country=='Saint Lucia'){echo 'selected';} ?>>Saint Lucia</option>
          <option <? if($v_country=='Samoa'){echo 'selected';} ?>>Samoa</option>
          <option <? if($v_country=='San Marino'){echo 'selected';} ?>>San Marino</option>
          <option <? if($v_country=='Sao Tome and Principe'){echo 'selected';} ?>>Sao Tome and Principe</option>
          <option <? if($v_country=='Saudi Arabia'){echo 'selected';} ?>>Saudi Arabia</option>
          <option <? if($v_country=='Senegal'){echo 'selected';} ?>>Senegal</option>
          <option <? if($v_country=='Seychelles'){echo 'selected';} ?>>Seychelles</option>
          <option <? if($v_country=='Sierra Leone'){echo 'selected';} ?>>Sierra Leone</option>
          <option <? if($v_country=='Singapore'){echo 'selected';} ?>>Singapore</option>
          <option <? if($v_country=='Slovak Republic'){echo 'selected';} ?>>Slovak Republic</option>
          <option <? if($v_country=='Slovenia'){echo 'selected';} ?>>Slovenia</option>
          <option <? if($v_country=='Solomon Islands'){echo 'selected';} ?>>Solomon Islands</option>
          <option <? if($v_country=='Somalia'){echo 'selected';} ?>>Somalia</option>
          <option <? if($v_country=='South Africa'){echo 'selected';} ?>>South Africa</option>
          <option <? if($v_country=='Spain'){echo 'selected';} ?>>Spain</option>
          <option <? if($v_country=='Sri Lanka'){echo 'selected';} ?>>Sri Lanka</option>
          <option <? if($v_country=='St Helena'){echo 'selected';} ?>>St Helena</option>
          <option <? if($v_country=='St Pierre and Miquelon'){echo 'selected';} ?>>St Pierre and Miquelon</option>
          <option <? if($v_country=='Sudan'){echo 'selected';} ?>>Sudan</option>
          <option <? if($v_country=='Suriname'){echo 'selected';} ?>>Suriname</option>
          <option <? if($v_country=='Svalbard And Jan Mayen Islands'){echo 'selected';} ?>>Svalbard And Jan Mayen Islands</option>
          <option <? if($v_country=='Swaziland'){echo 'selected';} ?>>Swaziland</option>
          <option <? if($v_country=='Sweden'){echo 'selected';} ?>>Sweden</option>
          <option <? if($v_country=='Switzerland'){echo 'selected';} ?>>Switzerland</option>
          <option <? if($v_country=='Syria'){echo 'selected';} ?>>Syria</option>
          <option <? if($v_country=='Taiwan Region'){echo 'selected';} ?>>Taiwan Region</option>
          <option <? if($v_country=='Tajikistan'){echo 'selected';} ?>>Tajikistan</option>
          <option <? if($v_country=='Tanzania'){echo 'selected';} ?>>Tanzania</option>
          <option <? if($v_country=='Thailand'){echo 'selected';} ?>>Thailand</option>
          <option <? if($v_country=='Togo'){echo 'selected';} ?>>Togo</option>
          <option <? if($v_country=='Tokelau'){echo 'selected';} ?>>Tokelau</option>
          <option <? if($v_country=='Tonga'){echo 'selected';} ?>>Tonga</option>
          <option <? if($v_country=='Trinidad And Tobago'){echo 'selected';} ?>>Trinidad And Tobago</option>
          <option <? if($v_country=='Tunisia'){echo 'selected';} ?>>Tunisia</option>
          <option <? if($v_country=='Turkey'){echo 'selected';} ?>>Turkey</option>
          <option <? if($v_country=='Turkmenistan'){echo 'selected';} ?>>Turkmenistan</option>
          <option <? if($v_country=='Turks And Caicos Islands'){echo 'selected';} ?>>Turks And Caicos Islands</option>
          <option <? if($v_country=='Tuvalu'){echo 'selected';} ?>>Tuvalu</option>
          <option <? if($v_country=='Uganda'){echo 'selected';} ?>>Uganda</option>
          <option <? if($v_country=='Ukraine'){echo 'selected';} ?>>Ukraine</option>
          <option <? if($v_country=='United Arab Emirates'){echo 'selected';} ?>>United Arab Emirates</option>
          <option <? if($v_country=='United Kingdom'){echo 'selected';} ?>>United Kingdom</option>
          <option <? if($v_country=='Uruguay'){echo 'selected';} ?>>Uruguay</option>
          <option <? if($v_country=='Uzbekistan'){echo 'selected';} ?>>Uzbekistan</option>
          <option <? if($v_country=='Vanuatu'){echo 'selected';} ?>>Vanuatu</option>
          <option <? if($v_country=='Vatican City State (Holy See)'){echo 'selected';} ?>>Vatican City State (Holy See)</option>
          <option <? if($v_country=='Venezuela'){echo 'selected';} ?>>Venezuela</option>
          <option <? if($v_country=='Vietnam'){echo 'selected';} ?>>Vietnam</option>
          <option <? if($v_country=='Virgin Islands (British)'){echo 'selected';} ?>>Virgin Islands (British)</option>
          <option <? if($v_country=='Virgin Islands (US)'){echo 'selected';} ?>>Virgin Islands (US)</option>
          <option <? if($v_country=='Wallis And Futuna Islands'){echo 'selected';} ?>>Wallis And Futuna Islands</option>
          <option <? if($v_country=='Western Sahara'){echo 'selected';} ?>>Western Sahara</option>
          <option <? if($v_country=='Yemen'){echo 'selected';} ?>>Yemen</option>
          <option <? if($v_country=='Yugoslavia'){echo 'selected';} ?>>Yugoslavia</option>
          <option <? if($v_country=='Zambia'){echo 'selected';} ?>>Zambia</option>
          <option <? if($v_country=='Zimbabwe'){echo 'selected';} ?>>Zimbabwe</option>
        </select>
        </font>
      </div></td>
            </tr>
            <tr>
    <td width="131"><div align="left"><span class="style23"><font size="2" face="Arial">Phone</font></span></div></td>
    <td width="241"><div align="left"><font face="Arial" size="2">
      <input name="phone" size="30"  value="<? echo "$v_phone"; ?>"  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6" >
    </font></div></td>
            </tr>
            <tr>
    <td width="131"></td>
    <td width="241"></td>
            </tr>
          
  
            <tr>
              <td height="25" colspan="2" align="left"><img src="line.gif" width="360" height="1"></td>
            </tr>
            <tr>
    <td colspan="2">
      <p align="left" class="style22"><font face="Arial" size="2" color="#000099">
	  <?
	  if ($v_signup=='1') {
	  print "This member account can access to the following membership areas: ";
	  }
	  else {
	  print "Select protected directory(access name) for this member account: ";
	  }
	  ?>
	  </font></td>
            </tr>
  <center>
          <center>
		  <?
		if ($v_signup=='1') {
		$result=mysql_query("select a.access_name from authaccess a, authuser b where a.access_name <> '' and a.signup=1 and a.signup=b.signup and b.reg_validate=1 and b.uname='$v_username' order by 1");
		}
		else {
		$result=mysql_query("select access_name from authaccess where access_name <> '' order by 1");
		}
		$k=0;
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
		print "<tr>";
		$s='';
		$t='';
		$fg=0;
		for ($t=0;$t<$p;$t++){
		if($row[0]==$s_accessname[$t]) {$fg=1;}
		}
		if(($fg==1)||(strtolower($v_accessck[$k])=='on')) {$s='checked';}
		if($v_signup=='1'){
		print "<td width=131><div align=right><img src=tick.gif border=0></div></td><td width=259><div align=left><font face=Arial size=2 color=blue>$row[0]</font></div></td></tr>";
		}
		else {
		print "<td width=131><div align=right><input type=checkbox name=accessck[$k] $s></div></td>";
		print "<td width=259><div align=left><font face=Arial size=2 color=blue>$row[0]</font></div></td></tr>";
		print "<input type=hidden name=access[$k] value=$row[0]>";
		$k++;
		}
		} 
		print "<input type=hidden name=access_num value=$k>";
		mysql_free_result($result);
  		mysql_close($connection);
		?>  
            <tr>
    <td width="131"></td>
    <td width="241"></td>
            </tr>
          </center>
  </center>
            <tr>
    <td colspan="2">
      <p align="left" class="style22"><font face="Arial" size="2"><span class="style29">Notify user  of account modification:</span>          &nbsp;&nbsp;&nbsp;
          <select size="1" name="semail" style="border: 1px solid #808080; padding-left: 0; padding-right: 0; padding-top: 1; padding-bottom: 1; background-color: #ECEAE6">
          <option <? if($v_semail=='No') {echo 'selected'; }?>>No</option>
          <option <? if($v_semail=='Yes') {echo 'selected'; }?>>Yes</option>
        </select>
      </font></td>
            </tr>
            <tr>
    <td width="131"></td>
    <td width="241"></td>
            </tr>
            <tr>
    <td colspan="2" align="center"><font face="Arial" size="2"><br>
      <input type="hidden" name="signup" value="<? echo "$v_signup"; ?>">
	  <input type="hidden" name="reg_validate" value="<? echo "$v_reg_validate"; ?>">
	  <input  type="submit" value="Submit"  name="sbm"><br>
      </font></td>
            </tr>
            <tr>
    <td colspan="2" align="center"></td>
            </tr>
            <tr>
    <td colspan="2" align="center">
      <p align="left"><font face="Arial" size="2"><font  color="#FF0000"><br>
      * </font></font><span class="style30">Required
      field</span><span class="style33"></span><font face="Arial" size="2"><font  face="vernada" size="2"  color="#000080"><br>
      </font></font></p>
    </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>          
              <blockquote>
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