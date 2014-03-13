

	include_once ("../../admin/authconfig.php");	

	$v_access=$_GET['access'];
	$group_num = $_COOKIE['access_num'];
	$flag=0;
	for ($i=0;$i<$group_num;$i++) {
	$gname="access_".$i;
	$group = $_COOKIE[$gname];
	if ($group==$curgroup) {$flag=1;}
	}
	if ($flag==0) { //no access to this folder
	  echo "<meta http-equiv=\"refresh\" content=\"0; URL=$url_root/forbidden.php\">";
	  exit;		
	}


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
<p align="center" class="style3">This is the index page of protected folder<br> "<font color=red><? echo "$v_access"; ?></font>"</p>
<p align="center">&nbsp;</p><p align="center">
<a href="redir.php?filename=sample.html">Go to sample.html </a><br>
</p>
<p align="center">
<a href="redir.php?filename=sample.pdf">Go to sample.pdf</a> </p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><a href="<? echo "$url_root/logout.php"; ?>">Logout</a></p>
<p align="center">&nbsp;</p></td>
  </tr>
</table></td>
  </tr>
</tbody>
</table>
</body>
</html>

