<?
	include_once ("../auth_member.php");
	include_once ("../admin/authconfig.php");
	include_once ("../check_member.php");	


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
.style2 {
	font-size: 10pt;
	font-weight: bold;
	color: #660000;
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
<table border="0" width="291" align=center height="67">
<center>
    </center>    
  <tr>
    <td width="269" height="63" align="center">
<p align="center">&nbsp;</p>
<p align="center"><span class="style2">Welcome, <font color=red><? echo $check['name']; ?></font> </span></p>
<p align="center">&nbsp;</p>
<p align="center">This is the first time you log in, please click the link below to enter the membership area. </p>
<p align="center">&nbsp;</p><p align="center"><a href="index.php">Continue to Membership Area</a> </p>
<p align="center"></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p></td>
  </tr>
</table></td>
  </tr>
</tbody>
</table>
</body>
</html>
