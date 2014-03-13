<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();
    require_once ('authconfig.php');

	if($HTTP_SESSION_VARS["loginmanager"] =='auth') {
	echo "<META http-EQUIV='Refresh' content='0; URL=index.php'>";
	exit;
	} 

?>
<html>
<head>
<title>Login Manager Admin Control</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
a            { color: #000099; text-decoration: none }
a:hover      { color: #FF0B06; text-decoration: underline }
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
--></style>
</head>

<body bgcolor="#FFFFCC" text="#000000">
<p align="center">&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="302" background="backgrd.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center"><font color="#000066" size="3" face="Arial"><b>Login Manager V3.0<br>
        </b> <font size="2">(Admin Control Panel)</font></font></div></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
      </tr>
      <tr>
        <td>
          <form name="Sample" method="post" action=<? print "$resultpage1"; ?>>
            <table width="220" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr bgcolor="#FFFFCC">
                <td colspan="2" valign="middle">
                  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3"></font></div></td>
              </tr>
              <tr bgcolor="#FFFFCC">
                <td width="37%" height="31" valign="middle"><div align="left"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;<font color="#663300" face="Arial">Login ID </font></font></b></div></td>
                <td width="63%" valign="middle"><div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> &nbsp;
                            <input type="text" name="username" maxlength="15" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #FFFFFF" size="20">
                </font></b></div></td>
              </tr>
              <tr bgcolor="#FFFFCC">
                <td width="37%" height="31" valign="middle"><div align="left"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;<font color="#663300" face="Arial">Password</font></font></b></div></td>
                <td width="63%" valign="middle"><div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> &nbsp;
                            <input type="password" name="password" maxlength="15" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1; background-color: #FFFFFF" size="20">
                </font></b></div></td>
              </tr>
              <tr valign="middle" bgcolor="#FFFFCC">
                <td height="52" colspan="2"><p>&nbsp;</p></td>
              </tr>
              <tr valign="middle" bgcolor="#FFFFCC">
                <td colspan="2">
                  <div align="center">
                    <input type="submit" name="Login" value="Login" style="color: #800000">
                </div></td>
              </tr>
            </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>
</body>
</html>
