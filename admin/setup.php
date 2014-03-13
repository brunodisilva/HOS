<?	
//Login Manager Set Up
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

$v_sbm=$_POST['sbm'];
$v_dbhost=$_POST['dbhost'];
$v_dbname=$_POST['dbname'];
$v_dbusername=$_POST['dbusername'];
$v_dbpass=$_POST['dbpass'];
$v_dbdump=$_POST['dbdump'];
$v_mpp=$_POST['mpp'];
$v_emailfrom=$_POST['emailfrom'];
$v_droot=$_POST['droot'];
$v_root=$_POST['root'];
	
if ($v_sbm==" Save ") {
$filename = "authconfig.php";
$contents ="<?\r\n"."$"."dbhost="."\"".$v_dbhost."\";\r\n";
$contents.="$"."dbname="."\"".$v_dbname."\";\r\n";
$contents.="$"."dbusername="."\"".$v_dbusername."\";\r\n";
$contents.="$"."dbpass="."\"".$v_dbpass."\";\r\n";
$contents.="$"."mpp=$v_mpp;\r\n";
$contents.="$"."v_emailfrom="."\"".$v_emailfrom."\";\r\n";
$contents.="$"."droot="."\"".$v_droot."\";\r\n";
$contents.="$"."url_root=\"".$v_root."\";\r\n";
$contents.="$"."signup_activate=\"".$v_root."/reg_activate.php\";\r\n";
$contents.="$"."adminusername="."\"admin\";\r\n";
$contents.="$"."alogout="."\"logout.php\";\r\n";
$contents.="$"."resultpage = "."\"../authenticate.php\";\r\n";	
$contents.="$"."resultpage1 = "."\"authenticate_admin.php\";\r\n";
$contents.="$"."admin = "."\"index.php\";\r\n";
$contents.="$"."welcome = "."\"".$v_root."/members/welcome.php\";\r\n";
$contents.="$"."success = "."\"".$v_root."/members/index.php\";\r\n";
$contents.="$"."failure = "."\"failed.php\";\r\n";
$contents.="$"."GonxAdmin["."\"dbhost\"] = \"$v_dbhost\";\r\n";
$contents.="$"."GonxAdmin["."\"dbname\"] = \"$v_dbname\";\r\n";
$contents.="$"."GonxAdmin["."\"dbuser\"] = \"$v_dbusername\";\r\n";
$contents.="$"."GonxAdmin["."\"dbpass\"] = \"$v_dbpass\";\r\n";
$contents.="$"."GonxAdmin["."\"dbtype\"] = \"mysql\";\r\n";
$contents.="$"."GonxAdmin["."\"compression\"] = array(\"bz2\",\"zlib\");\r\n";
$contents.="$"."GonxAdmin["."\"compression_default\"] = \"zlib\";\r\n";
$contents.="$"."GonxAdmin["."\"locale\"] = \"en\";\r\n";
$contents.="$"."GonxAdmin["."\"pagedisplay\"] = 10;\r\n";
$contents.="$"."GonxAdmin["."\"mysqldump\"] = \"$v_dbdump\";\r\n";
$contents.="require_once(\"libs/db.class.php\");\r\n";
$contents.="require_once(\"libs/gonxtabs.class.php\");\r\n";
$contents.="require_once(\"libs/backup.class.php\");\r\n";
$contents.="require_once(\"libs/locale.class.php\");\r\n";
$contents.="?>";

//connect to DB for testing
$link = mysql_connect($v_dbhost, $v_dbusername, $v_dbpass);
$SelectedDB = mysql_select_db($v_dbname);
if (!$link) {
print "<p align=center><font face=arial color=red size=2>Error: ".mysql_error()."<br></font></p>";
}
elseif (!$SelectedDB) {
print "<p align=center><font face=arial color=red size=2>Database \"$v_dbname\" doesn't exist.<br></font></p>";
}
elseif (is_writable($filename)) {
$fp = fopen($filename,'w');
fwrite($fp,$contents);
fclose($fp);
//chmod($filename,0777);

//run createdb.sql 
  $sql_file="createdb.sql";
  @set_time_limit(10000);
  $sql_query = addslashes(fread(fopen($sql_file, "r"), filesize($sql_file)));
  $sql_query = ereg_replace("'#","'Num",$sql_query);
  $pieces = split_sql($sql_query);
  for ($i=0; $i<count($pieces); $i++){
    $pieces[$i] = stripslashes(trim($pieces[$i]));
    if(!empty($pieces[$i]) && $pieces[$i] != "#"){
      $result = mysql_query($pieces[$i],$link) or die ("Can't insert ".$pieces[$i]." MYSQL ERROR: ".mysql_error());
    //  echo "\n\n<br><br>\n\n" . $pieces[$i] . "\n\n<br><br>\n\n";
    }
  }

//remove setup.php
mysql_close($link);
print "<p align=center><font face=arial color=blue size=2>You have successfully configured Login Manager V3.0, click the link below to login to admin control panel.<br><br>Username: admin<br>Password: admin123<br><br><font color=red size=2>Change your admin password by clicking \"Change Password\" in admin control panel.<br><br><br><a href=login.php>Login to admin panel</a></font></font></p>";
unlink("setup.php");
exit;
}
else {
print "<p align=center><font face=arial color=red size=2>Unable to create authconfig.php file.<br></font></p>";
} 
}
?>

<html>
<head>
<title>Login Manager Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style20 {font-family: Arial; color: #000099; font-size: 10pt; }
.style21 {
	font-family: Arial;
	font-size: 12pt;
	font-weight: bold;
	color: #660000;
}
.style22 {font-family: Arial}
.style23 {
	font-size: 10pt;
	color: #000099;
}
.style25 {font-family: Arial; font-size: 10pt; }
.style26 {color: #000099}
.style27 {font-size: 10px}
.style29 {font-size: 10pt}
a:link       { color: #0000cc }
a:visited    { color: #0000cc }
a:hover      { color: #ff0000 }
a:active     { color: #00CC99 }
a            { color: #F4f4f4; text-decoration: none;  font-style: bold;  font-family: arial; 
               font-size: 12 }
.style33 {color: #FF0000}
.style39 {font-size: 8pt; color: #999999; }
.style40 {font-family: Arial; color: #FF0000; font-size: 10pt; }
.style42 {color: #0000FF}
.style43 {color: #0000FF; font-size: 9pt; }
.style44 {font-size: 9pt}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form method="post" name="form1" action="setup.php">
<table width="683" align="center" cellpadding="0" cellspacing="0" bordercolor="#111111" id="AutoNumber1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
      <tr>
        <td width="650" valign="top"><table width="682" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="682" valign="top"><p align="center"><span class="style21"><br>
              Login Manager V3.0 Setup </span></p>
              <table width="498" border="0" align="center">
                <tr>
                  <td width="460" height="43"><div align="left"><span class="style40"><span class="style43">* Authconfig.php must be set to &quot;chmod 777&quot; </span></span><span class="style42"><br>
                  <span class="style25"><span class="style44">* This file (setup.php) will be removed after configuring the application</span></span></span></div></td>
                </tr>
              </table>            
              <table width="501" align="center" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
                <tr>
                  <td width="528" height="349" bordercol= width="575">
                    <table width="493" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr bgcolor="#FFFFCC">
                        <td width="4" height="34"><div align="left"></div></td>
                        <td width="239"><div align="left" class="style22 style23">
                            <div align="left">Mysql DB Hostname </div>
                        </div></td>
                        <td width="263"><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="dbhost" type="text" value="localhost" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td height="36"><div align="left"></div></td>
                        <td><div align="left" class="style20">
                            <div align="left">Mysql DB Username </div>
                        </div></td>
                        <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="dbusername" type="text" value="root" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr bgcolor="#FFFFCC">
                        <td height="34"><div align="left"></div></td>
                        <td><div align="left"><span class="style20">Mysql DB Password </span></div></td>
                        <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="dbpass" type="password" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr>
                        <td height="33"><div align="left"></div></td>
                        <td><div align="left" class="style25 style26">
                            <div align="left">Mysql DB Name </div>
                        </div></td>
                        <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="dbname" type="text" value="loginmanager" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr bgcolor="#FFFFCC">
                        <td height="34"><div align="left"></div></td>
                        <td><div align="left"><span class="style20">Mysql DB Mysqldump Path <br>
                                  <span class="style39">(For DB backup/restore)</span></span></div></td>
                        <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="dbdump" type="text" value="/usr/bin/mysqldump" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr>
                        <td height="34"><div align="left"></div></td>
                        <td><div align="left"><span class="style20">Show Number of Records Per Page <span class="style39"><br>
              (To display member list)</span> </span></div></td>
                        <td><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="mpp" type="text" value="20" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr bgcolor="#FFFFCC">
                        <td height="34"><div align="left"></div></td>
                        <td bgcolor="#FFFFCC"><div align="left"><span class="style20">System Email Sender Address </span></div></td>
                        <td bgcolor="#FFFFCC"><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="emailfrom" type="text" value="admin@yourdomain.com" size=40>
                        </span></span></span></span></div></td>
                      </tr>
                      <tr bgcolor="#FFFFCC">
                        <td height="34" bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style20">Path to Login Manager Folder<span class="style22"><span class="style27"><span class="style29"><span class="style33"><span class="style39"><br>
(No forward slash at the end)</span> </span></span></span></span> </span></td>
                        <td bgcolor="#FFFFFF"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                          <input name="droot" type="text" value="<? echo $_SERVER['DOCUMENT_ROOT']; ?>" size=40>
                        </span></span></span></span></td>
                      </tr>
                      <tr bgcolor="#FFFFCC">
                        <td height="34" bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFCC"><div align="left"><span class="style20">URL of Login Manager Folder<span class="style22"><span class="style27"><span class="style29"><span class="style33"><span class="style39"><br>
                        (No forward slash at the end)</span> </span></span></span></span> </span></div></td>
                        <td bgcolor="#FFFFCC"><div align="left"><span class="style22"><span class="style27"><span class="style29"><span class="style33">
                            <input name="root" type="text" value="<? echo "http://".$_SERVER[HTTP_HOST]; ?>" size=40>
                            </span></span></span></span></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <blockquote>              
                <p><span class="style40"> </span></p>
                <p align="center">
                  <input type="submit" name="sbm" value=" Save ">
</p>
                <p align="center">&nbsp;</p>
                <p align="center"><font color="#999999" size="1" face="Verdana">Designed By </font><font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font><br>
                  <br>
                </p>
              </blockquote>              
            </td>
          </tr>
        </table></td>
      </tr>
</table>
</form>
</body>
</html>
<?
  function split_sql($sql){
    $sql = trim($sql);
    $sql = ereg_replace("#[^\n]*\n", "", $sql);
    $buffer = array();
    $ret = array();
    $in_string = false;
  
    for($i=0; $i<strlen($sql)-1; $i++){
      if($sql[$i] == ";" && !$in_string){
        $ret[] = substr($sql, 0, $i);
        $sql = substr($sql, $i + 1);
        $i = 0;
      }
      if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\"){
        $in_string = false;
      }
      elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")){
        $in_string = $sql[$i];
      }
      if(isset($buffer[1])){
        $buffer[0] = $buffer[1];
      }
      $buffer[1] = $sql[$i];
    }
    if(!empty($sql)){
      $ret[] = $sql;
    }
    return($ret);
  }
 ?>