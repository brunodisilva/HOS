<?
require_once ('admin/authconfig.php');
?>
<html>
<head>
<title>User Sign up</title>
<style type="text/css">
<!--
.style6 {
	color: #666666;
	font-family: Verdana;
}
body {
	background-color: #999999;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<style type="text/css">
<!--
A:hover {text-decoration: none; color: #FF0000}
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
.style5 {color: #333333}
.style8 {
	color: #666666;
	font-size: 8pt;
}
.style10 {font-family: Verdana; font-size: 8pt; }
.style12 {font-family: Verdana; font-size: 8pt; color: #666666; }
-->
</style>
<body>

<p>&nbsp;</p>

<div align="center">

  <center>

  <table border="1" width="482" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolor="#333333">

    <tr>


      <td width="478">



<p align="center"><b><font size="2" face="Arial" color="#000080"><br>

</font></b></p>



<p align="center"><b><font color="#000080" face="Arial" size="2">Sign Up Form</font></b></p>

        <div align="center">

          <center>
<?
              	

				  $v_sbm=$_POST['sbm'];
				  
				  $connection = mysql_connect($dbhost, $dbusername, $dbpass);
				  $SelectedDB = mysql_select_db($dbname);
				  if($v_sbm==' Submit ') {
				  $v_username=$_POST['username'];
				  $v_password=$_POST['password'];
				  $v_password1=$_POST['password1'];
				  $v_name=$_POST['name'];
				  $v_email=$_POST['email'];
				  $v_address=$_POST['address'];
				  $v_city=$_POST['city'];
				  $v_state=$_POST['state'];
				  $v_zip=$_POST['zip'];
				  $v_country=$_POST['country'];
				  $v_phone=$_POST['phone'];


				  $validemail=verifyemailaddress($v_email);			
				  $g=0;
				  if(trim($v_username)=='') {
				  $err='Username field is blank.<br>';
				  $g=1;
				  }
				  if(trim($v_password)=='') {
				  $err=$err.'Password field is blank.<br>';
				  $g=1;
				  }
				  elseif(strlen($v_password) < 6 ){   
				  $err=$err.'Password is less than 6 characters.<br>';
				  $g=1;					  
				  }
				  elseif(ereg('[^A-Za-z0-9]', $v_password)){
				  $err=$err.'Password contains special characters.<br>';
				  $g=1;				  
				  }    
				  elseif((trim($v_password1)=='')||($v_password<>$v_password1)) {
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
				  //check if username already exists
				  $result=mysql_query("select uname,email from authuser");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					if(strtolower($row[0])==strtolower($v_username)) {$err_username="Username(<font color=red>$v_username</font>) already exists.<br>"; $g=1; }
					elseif((strtolower($row[1])==strtolower($v_email))&&(trim($v_username)<>'')&&(trim($v_email)<>'')) {$err_email="This email address(<font color=red>$v_email</font>) already exists, please use different one.<br>"; $g=1; }
					}
				  $err=$err.$err_username.$err_email;
				  
				  if ($g==1) {
				  print "<table width=412 border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse; border: 1px solid #FF0000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\" bordercolor=#111111 id=\"AutoNumber1\">
						<tr><td width=50 align=center><img src=admin/error.jpg border=0></td><td><font color=blue><font face=arial><font size=2>$err</font></font></font>";
				  print "</td></tr></table>";
				  }
				  
				  
				  else {		
				  	$reg_key=RandomString(7); //generate validate key 
					//$vdlink= $signup_activate."?username=".$v_username."&vcode=".$reg_key;
					//send email to member for activating account
					$result=mysql_query("select subject,contents from emailtemplates where name='signup'");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$v_subject=trim($row[0]);
					$v_message=nl2br(trim($row[1]));
					}
					$subject = "$v_subject";
					$headers = "From: $v_emailfrom\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
					$v_message = ereg_replace("\\<%username%>","$v_username",$v_message);
					$v_message = ereg_replace("\\<%password%>","$v_password",$v_message);
					$v_message = ereg_replace("\\<%weburl%>","$url_root",$v_message);
					$v_message = ereg_replace("\\<%code%>","$reg_key",$v_message);						
					//$message .=	"<br><br><a href=$vdlink>$vdlink</a>";			
					if (mail($v_email, $v_subject, $v_message, $headers)) {
					$enpass=base64_encode("$v_password");
					mysql_query("insert into authuser (uname,passwd,name,email,address,city,state,zip,country,phone,create_time,logincount,welcome,signup,status,reg_validate,validate_key) values ('$v_username','$enpass','$v_name','$v_email','$v_address','$v_city','$v_state','$v_zip','$v_country','$v_phone',now(),'0','1','1','0','0','$reg_key')");
					$getip=getip();
					mysql_query("insert into log (uname,ctime,ip,activity) values ('$v_username',now(),'$getip','User($v_username) signed up registration form, waiting to activate the account.')");
					mysql_close($connection);
				  	echo "<br><br><p align=center><font face=\"Arial\" size=\"2\" color=\"#800000\">Your registration account has been created, please check your email to activate your account.</font><br><br><br><br><br></p>";
				  	exit;
				  	}
					else {
				  	echo "<br><br><p align=center><font face=\"Arial\" size=\"2\" color=\"#800000\">Fails to create registration account.</font><br><br><br><br><br></p>";
					exit;
					}
				  }	
				}



?>
<form name="signup" method="post" action="signup_form.php">
<table border="0" width="363">

  <tr>

    <td width="132"><font face="Arial" size="2" color="#800000">Username</font><font face="Arial" size="2" color="#FF0000">*</font></td>

    <td width="241"><font face="Arial" size="2"><input type="text" name="username" value="<? echo "$v_username"; ?>" size="35" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font face="Arial" size="2" color="#800000">Password</font><font face="Arial" size="2" color="#FF0000">**</font></td>

    <td width="241"><font face="Arial" size="2"><input type="password" name="password" value="<? echo "$v_password"; ?>" size="35" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font face="Arial" size="2" color="#800000">Confirm Password</font><font face="Arial" size="2" color="#FF0000">**</font></td>

    <td width="241"><font face="Arial" size="2"><input type="password" name="password1" size="35" value="<? echo "$v_password"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font face="Arial" size="2" color="#800000">Full name</font><font face="Arial" size="2" color="#FF0000">*</font></td>

    <td width="241"><font face="Arial" size="2"><input name="name" size="35"  value="<? echo "$v_name"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font face="Arial" size="2" color="#800000">Email address</font><font face="Arial" size="2" color="#FF0000">*</font></td>

    <td width="241"><font face="Arial" size="2"><input name="email" size="35" value="<? echo "$v_email"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">Address</font></td>

    <td width="241"><font face="Arial" size="2"><input name="address" size="35" value="<? echo "$v_address"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">City</font></td>

    <td width="241"><font face="Arial" size="2"><input name="city" size="35" value="<? echo "$v_city"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">State</font></td>

    <td width="241"><font face="Arial" size="2"><input name="state" size="35" value="<? echo "$v_state"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

    <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">Zip Code</font></td>

    <td width="241"><font face="Arial" size="2"><input name="zip" size="35" value="<? echo "$v_zip"; ?>" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">Country</font></td>

    <td width="241">

    <font face="Arial" size="2">
  <select name="country" size="1">
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

    </td>

  </tr>

  <tr>

    <td width="132"><font size="2" face="Arial" color="#800000">Phone</font></td>

    <td width="241"><font face="Arial" size="2"><input name="phone" size="35" value="<? echo "$v_phone"; ?>"  style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>

  </tr>

  <tr>

    <td colspan="2" align="center"><br>

      <font face="Arial" size="2"><br>

      <input type="submit" value=" Submit " name="sbm"></font></td>


  </tr>
</table>
</form>
          </center>

        </div>

<p align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font face="Arial" size="2" color="#FF0000">*&nbsp;</font><span class="style5 style6"><span class="style8">Required fields</span></span><span class="style10"></span><font face="Arial" size="2" color="#000080"><br>
</font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font face="Arial" size="2" color="#FF0000">**</font><span class="style5"><span class="style12">Password must be at least 6 characters. (No special character)</span><font face="Arial" size="2"><br>
</font>
</span></p>
<p align="left">&nbsp; </p>
<p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font><br>
  <font face="Arial" size="2" color="#000080"><br>
</font></p></td>

    </tr></form>
  </table><br>

  </center>

</div>
</body>



</html>
<?
function verifyemailaddress($email_address)
{
	return (eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]+$", $email_address));	
}

// function to generate random strings 
function RandomString($length=32) 
{ 
$randstr=''; 
srand((double)microtime()*1000000); 
$chars = array ('1','2','3','4','5','6','7','8','9','0'); 
for ($rand = 0; $rand <= $length; $rand++) 
{ 
$random = rand(0, count($chars) -1); 
$randstr .= $chars[$random]; 
} 
return $randstr; 
} 


function getip() {
if (getenv(HTTP_X_FORWARDED_FOR)) {
$ip=getenv(HTTP_X_FORWARDED_FOR);
}
else {
$ip=getenv(REMOTE_ADDR);
}
return $ip;
}
?>