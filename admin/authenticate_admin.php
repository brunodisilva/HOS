<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com


	setcookie ("USERNAME", $_POST['username']);
	setcookie ("PASSWORD", $_POST['password']);
 
  	include_once ("auth.php");
	include_once ("authconfig.php");
 
        $username =  $_POST['username'];
        $password =  $_POST['password'];

	$Auth = new auth();
	$detail = $Auth->authenticate($username, $password,$dbhost,$dbusername,$dbpass,$dbname);

	if ($detail['uname'] == $adminusername) {
	?><HEAD>
		<SCRIPT language="JavaScript1.1">
		<!--
			location.replace("<? echo $admin; ?>");
		//-->
		</SCRIPT>
	  </HEAD>
	<?
	}
	else
	{
	?>
<style type="text/css">
<!--
a            { color: #000099; text-decoration: none }
a:hover      { color: #FF0B06; text-decoration: underline }
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
.style1 {
	font-size: 10pt;
	font-family: arial;
	color: #FF0000;
}
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
            <table width="327" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
              <tr bgcolor="#FFFFCC">
                <td width="289" valign="middle">
                  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3"></font></div></td>
              </tr>
              <tr bgcolor="#FFFFCC">
                <td valign="middle"><div align="left"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;</font></b></div>                  <div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;</font><span class="style1">
 Invalid admin loginID/password, Please try again.</span> </b></div>                  <div align="left"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;</font></b></div>                  <div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> &nbsp;
                                
            </font></b></div></td>
              </tr>
              <tr valign="middle" bgcolor="#FFFFCC">
                <td height="52"><p align="center"><a href="javascript:history.go(-1)"><u>Back</u> </a></p>                </td>
              </tr>
              <tr valign="middle" bgcolor="#FFFFCC">
                <td>
                  <div align="center">
                </div></td>
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center"><font color="#660000" size="1" face="Verdana">By Easebay Resources</a></font></p>
</body>

	<?
	}
	?>
