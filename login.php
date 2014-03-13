<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();

    require_once ('admin/authconfig.php');
	if($HTTP_SESSION_VARS["membership"] =='auth') {
	echo "<META http-EQUIV='Refresh' content='0; URL=members/index.php'>";
	exit;
	} 

?>

<html>
<head>
<title>Login Manager: Member Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
A:hover {text-decoration: none; color: #FF0000}
body,table {font-size: 9pt; font-family: arial}
input { font-size: 10pt; color: #000000; background-color: #FBFBFF; padding-top:  3px}
.c { font-family: arial; font-size: 9pt; font-style: normal; line-height: 12pt;  font-weight: normal; font-variant: normal; text-decoration: none}
.style1 {font-size: 9pt}
.style3 {font-size: 10pt}
body {
	background-color: #999999;
}
--></style>
    <script>
        function rememberCheck(frm){
            if (frm.elements['remember'].checked){
                setPassCookie(
                    frm.elements['username'].value,
                    frm.elements['password'].value
                );
            }
        }
        function setPassCookie(login, pass){
                document.cookie = '';
                tm = "Saturday, 18-Jun-2025 23:59:59 GMT";
                setCookie('cred0', login, tm);
                setCookie('cred1', pass, tm);
        }

        caution = 1;

        function setCookie(name, value, expires, path, domain, secure) { 
                var curCookie = name + "=" + escape(value) + 
                        ((expires) ? "; expires=" + expires : "") + 
                        ((path) ? "; path=" + path : "") + 
                        ((domain) ? "; domain=" + domain : "") + 
                        ((secure) ? "; secure" : "") 
                document.cookie = curCookie 
        }    

        function getCookie(name) { 
                var prefix = name + "=" 

                var cookieStartIndex = document.cookie.indexOf(prefix) 
                if (cookieStartIndex == -1) 
                        return null 
                var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length) 
                if (cookieEndIndex == -1) 
                        cookieEndIndex = document.cookie.length 
                return unescape(document.cookie.substring(cookieStartIndex + prefix.length, cookieEndIndex)) 
        }        
        
       function deleteCookie(name, path, domain) { 
             if (getCookie(name)) { 
                     document.cookie = name + "=" +  
                     ((path) ? "; path=" + path : "") + 
                     ((domain) ? "; domain=" + domain : "") + 
                     "; expires=Thu, 01-Jan-1970 00:00:01 GMT" 
             }
       }

       function rememberedValues(){
            var cred0 = getCookie('cred0');
            var cred1 = getCookie('cred1');
            if (cred0 && cred0.length && cred1 && cred1.length){
                document.forms['login'].elements['username'].value=cred0;
                document.forms['login'].elements['password'].value=cred1;
                document.forms['login'].elements['remember'].checked = true;
            }
        }

        function deleteClick(){
            deleteCookie('cred0');
            deleteCookie('cred1');
              frm = document.forms['login'];
              frm.elements['username'].value='';
              frm.elements['password'].value='';
              frm.elements['remember'].checked = false;
              rememberCheck(frm);
              //frm.submit();             
        }
        </script>
</head>
<body link="#be2a65" text="#5c5c5c" onload='rememberedValues()'>
<center><br>
<br><br><br>
<table align="center"  border="1" width="378" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolor="#333333">
  <tbody>
    <tr>
      <td bgcolor="white" width="393">
<table border="0" width="269" align=center height="319">
<form method="post" action="authenticate.php" onsubmit='return rememberCheck(this)' name="login"> 
  <tr>
    <td width="91" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="176" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td width="91" height="25"><font face="Arial" color="#800000"><span class="style3">Login ID:</span></font><font face="Arial" size="2" color="#800000">&nbsp;&nbsp;&nbsp;</font></td>

    <td width="176" height="25" align="center">
      <p align="left"><font face="Arial" size="2">
	  <input type="text" name="username"  size="18" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
      </font></p></td>
  </tr>
  <tr>
    <td width="91" height="25"><span class="style3"><font face="Arial" color="#800000">Password:</font></span></td>

    <td width="176" height="25" align="center">
      <p align="left"><font face="Arial" size="2">
        <input type="password" name="password" size="18" style="border: 1px solid #808080; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
      </font></p>
</td>
  </tr>
<center>
  <tr>
    <td colspan="2" align="center" height="21"></td>
  </tr>
    </center>    
<tr>
                <td width="91" height="25" align=center>
                <p align="right"><font face="Arial" size="2"> <input type=checkbox name=remember value=1></font>&nbsp;
              </p>              </td>
<td colspan="2"><center>
  <div align="left" class="style1"><font face="Arial" color="#800000">Remember Password</font></div>            
</tr>
<tr>
  <td height="29" colspan="3" align=center><span class="style1"><font face="arial" color="#800000" size="1">
  <a href="javascript: deleteClick()"><u>Remove Saved Login ID and Password</u></a></font></span></td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="28">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="27"><font face="Arial" size="2">
      <input type="submit" value="   Login  " name=log_in></font></td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="29">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="63">
<p align="center"><font face="Arial" size="2">  <a href="signup_form.php">Signup</a>&nbsp;&nbsp;
&nbsp; <a href="lostpassword.php">Lost password</a><br>
</font></p>
      <p align="center">
	  <font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font>
      <br><br>
</p></td>
  </tr>
</form>
</table></td>
  </tr>
</tbody>
</table>
</body>
</html>