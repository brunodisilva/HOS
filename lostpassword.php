<html>

<head>

<title>Lost password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="#999999">
<? 
		$v_sbm=$_POST['sbm'];
		$v_username=$_POST['username'];
		$v_email=$_POST['email'];
		if ($v_sbm=="Retrieve Password") {
		require_once ('admin/authconfig.php');
		$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		
		$result0=mysql_query("select distinct uname, passwd, email from authuser where uname='$v_username' and uname<>'admin'");
		while($row0 = mysql_fetch_array($result0, MYSQL_NUM)) {
		$v0=$row0[0];
		$u0=base64_decode($row0[1]);
		$v_email=$row0[2];
		}
		$count = mysql_num_rows($result0);
		if ($count==0) {
		$result1=mysql_query("select distinct uname, passwd from authuser where email='$v_email'");
		while($row1 = mysql_fetch_array($result1, MYSQL_NUM)) {
		$v1=$row1[0];
		$u1=base64_decode($row1[1]);
		}
		}
		if(($u0=='')&&($u1=='')) {
		$flag=1;
		$msg1= "No username or email address matches, please try again.";
		}
		elseif ($u0<>'') {
		$pass=$u0;
		$username=$v0; 
		}
		elseif ($u1<>'') {
		$pass=$u1;
		$username=$v1; 
		}
		if ($pass<>'') {
					//send email for lost password
					$result=mysql_query("select subject,contents from emailtemplates where name='lostpass'");
					while($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$v_subject=trim($row[0]);
					$v_message=nl2br(trim($row[1]));
					}
					$subject = "$v_subject";
					$headers = "From: $v_emailfrom\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";	
					$v_message = ereg_replace("\\<%username%>","$username",$v_message);
					$v_message = ereg_replace("\\<%password%>","$pass",$v_message);
					$v_message = ereg_replace("\\<%weburl%>","$url_root",$v_message);				
					mail($v_email, $v_subject, $v_message, $headers);
		$getip=getip();
		mysql_query("insert into log (uname,ctime,ip,activity) values ('$username',now(),'$getip','Send password to member($username).')");
		$flag=2;
		$msg2="Please check your email for the login information.";
		}
		mysql_close($connection);
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
<p>&nbsp;</p>
  <center>
  <form name="form1" method="post" action="lostpassword.php">
  <table border="1" align="center" width="482" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolor="#333333">
    <tr>
      <td width="100%">

<p align="center"><b><font size="2" face="Arial" color="#000080"><br>
<br>
Lost Password<br>
</font></b></p>
<? 
if ($flag==1) {
echo "<br><p align=center><font face=arial size=2 color=blue>$msg1</font></p><br><br><br><br>"; 
exit;
}
elseif ($flag==2) {
echo "<br><p align=center><font face=arial size=2 color=blue>$msg2</font></p><br><br><br><br>"; 
exit;
}
?>
<p align="center"><font color="#000099" size="2" face="Arial">To retrieve your password, please enter your 
  Login ID or Email Address</font></p>
        <br>
          <center>
		  
          <table border="0" align="center" width="67%" cellspacing="0" cellpadding="0">
            <tr>
    <td width="33%" height="25">
      <font face="Arial" size="2" color="#800000">Username:</font>
          </td>
    <td width="67%"><font face="Arial" size="2"><input type="text" name="username" size="27" value="--login ID--" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1"></font></td>
            </tr>
            <tr>
    <td width="33%">
          </td>
    <td width="67%"></td>
            </tr>
            <tr>
              <td height="20" colspan="2" align="left"><font face="Arial" size="2" color="#000099">OR</font> </td>
            </tr>
            <tr>
              <td align="left"><font face="Arial" size="2" color="#800000">Email Address:</font></td>
              <td align="left"><font face="Arial" size="2">
                <input type="text" name="email" size="27" value="--Email--" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
              </font></td>
            </tr>
            <tr>
    <td colspan="2" align="center"></td>
            </tr>
            <tr>
    <td colspan="2" align="center">&nbsp;
      <p></td>
            </tr>
            <tr>
    <td colspan="2" align="center"><font face="Arial" size="2">
	<input type="submit" value="Retrieve Password" name="sbm" style="color: #800000"></font></td>
            </tr>
          </table>
        <p>
        <p>
		<p align="center">
		<font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font><br>
          <br>
      </td>
    </tr>
</table></form>
</body>

</html>
