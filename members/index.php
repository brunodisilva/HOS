<?
	include_once ("../auth_member.php");
	include_once ("../admin/authconfig.php");
	include_once ("../check_member.php");	

	session_register("membership");
	$HTTP_SESSION_VARS["membership"]='auth';

	$USERNAME = $_COOKIE['LMUSERNAME'];
	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
	$SelectedDB = mysql_select_db($dbname);
	
	$result0=mysql_query("SELECT signup from authuser where uname='$USERNAME' and reg_validate=1 and status=1");
	while($row = mysql_fetch_array($result0, MYSQL_NUM)) {
	$v=$row[0];
	}
	if($v=='1') {
	$query = "SELECT access_name, access_desc FROM authaccess WHERE signup=1 order by 1";
	}
	else {
	$query = "SELECT a.access_name, a.access_desc FROM authaccess a, memberaccess b WHERE b.uname='$USERNAME' and a.access_name=b.access_name order by 1";
	}
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	

	$getip=getip();
	mysql_query("insert into log (uname,ctime,ip,activity) values ('$USERNAME',now(),'$getip','Login to membership index page.')");
?>
<html>
<head>
<title>Member Area</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
A:hover {text-decoration: none; color: #FF0000}
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
.style3 {
	font-size: 10pt;
	font-weight: bold;
	color: #000099;
}
body {
	background-color: #999999;
}
--></style>
</head>
<body link="#be2a65" text="#5c5c5c">
<center><br>
<br><br><br>
<table align="center"  border="1" width="378" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolor="#333333">
  <tbody>
    <tr>
      <td bgcolor="white" width="393">
<table border="0" width="291" align=center>
<center>
    </center>    
  <tr>
    <td width="269" height="63" align="center">
<p align="center">&nbsp;</p>
<p align="center"></p>
<p align="center" class="style3">Membership Access Group</p>
You can access to the following membership protected areas:
<hr noshade width="240"><br><br>
<table width=240 align=center><tr><td align=left>
 <ul>
  <?
	while ($thisrow=mysql_fetch_row($result))  //get one row at a time
	{
	$url=$thisrow[0]."/index.php?access=$thisrow[1]";
	print "<li><a href=\"$url\">$thisrow[1]</a><br><br>";
	}
	mysql_free_result($result);
  	mysql_close($connection);
?> </ul>
</td></tr></table>

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><a href="../logout.php">Logout</a></p>
<p align="center">&nbsp;</p></td>
  </tr>
</table></td>
  </tr>
</tbody>
</table>
</body>
</html>