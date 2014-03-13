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
$message=$_GET['msg'];

if($message=='1') {
$message= "You account has already been activated.";
$return="<a href=\"login.php\">Login</a>";
}
if($message=='2') {
$message= "Congradulations, you account has been activated.";
$return="<a href=\"login.php\">Login</a>";
}
if($message=='3') {
$message="Sorry, the validation code is incorrect.";
$return="<a href=\"javascript:history.go(-1);\">Back</a>";
}

?>
<body link="#be2a65" text="#5c5c5c">
<center><br>
<br><br><br>

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
<p align="center" class="style2"><? echo "$message"; ?></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><font face=arial><font size=2><font color=blue><? echo "$return"; ?></font></font></font></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p><p align="center">
<font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font>
<br>
  <br>
</font></p>
</td>
  </tr>
</table></td>
  </tr>
</tbody>
</table>
</body>
</html>