<?
require_once ('admin/authconfig.php');
?>

<html>
<head>
<title>Signup Account Activation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
A:hover {text-decoration: none; color: #FF0000}
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
.style2 {
	font-size: 10pt;
	color: #000099;
}
body {
	background-color: #999999;
}
--></style>

</head>
<?
$v_username=$_GET['username'];
$v_vcode=$_GET['vcode'];
$v_sbm=$_GET['sbm'];
if($v_sbm==' Submit ') {
$connection = mysql_connect($dbhost, $dbusername, $dbpass);
$SelectedDB = mysql_select_db($dbname);
$result=mysql_query("select distinct validate_key, reg_validate from authuser where uname='$v_username'");
while($row = mysql_fetch_array($result, MYSQL_NUM)) {
$v=$row[0];
$u=$row[1];
}

if($u=='1') {
mysql_close($connection);
echo "<META http-EQUIV='Refresh' content='0; URL=validate_message.php?msg=1'>";
exit; 
}
elseif(trim($v)==trim($v_vcode)) {
$result=mysql_query("update authuser set reg_validate='1', status='1' where uname='$v_username'");
$getip=getip();
mysql_query("insert into log (uname,ctime,ip,activity) values ('$v_username',now(),'$getip','Signup account ($v_username) has been activated.')");
mysql_close($connection);
echo "<META http-EQUIV='Refresh' content='0; URL=validate_message.php?msg=2'>";
exit; 
}
else {
mysql_close($connection);
echo "<META http-EQUIV='Refresh' content='0; URL=validate_message.php?msg=3'>";
exit; 
}
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
<body link="#be2a65" text="#5c5c5c">
<center><br>
<br><br><br>
<form name="form1" method="get" action="reg_activate.php">
<table align="center"  border="1" width="378" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolor="#333333">
  <tbody>
    <tr>
      <td bgcolor="white" width="393">
<table border="0" width="301" align=center height="94">
  <tr>
    <td width="295" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
<center>
    </center>    
  <tr>
    <td align="center" height="63">
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center" class="style2">To activate your registration account, please enter the validation code:</p>
Validation Code: <font color=red><? echo "$v_vcode"; ?></font>
<p align="center">
  <input type="text" name="vcode" value="" style="font-family: Arial; color: #0000FF; font-size: 8pt; background-color: #CCCCCC">
</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">
  <input type="hidden" name="username" value="<? echo "$v_username"; ?>">
  <input type="submit" name="sbm" value=" Submit ">
</p>
<p align="center">&nbsp;</p>
<p align="center">
<font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font><br>
  <br>
</p></td>
  </tr>
</table></td>
  </tr>
</tbody>
</table></form>
</body>
</html>