<?	
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com


require_once ('auth.php');
require_once ('authconfig.php');
require_once ('check.php');
	
@extract($_GET);@extract($_POST);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
error_reporting(0);
	
		if ($check["uname"] != $adminusername)
	{
		print "<font face=\"Arial, Helvetica, sans-serif\" size=\"5\" color=\"#FF0000\">";
		print "<b>Illegal Access</b>";
		print "</font><br>";
  		print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#000000\">";
		print "<b>You do not have permission to view this page.</b></font>";
		exit; 
	}	
?>

<html>
<head>
<title>Login Manager Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style10 {
	font-family: Arial;
	font-size: 12pt;
	font-weight: bold;
	color: #FF6633;
}
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
.style31 {
	font-family: Arial;
	font-size: 9pt;
	color: #333333;
}
.style33 {color: #FF0000}
.style35 {font-family: Arial; color: #000099; font-size: 10pt; font-weight: bold; }
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="743" align="center" cellpadding="0" cellspacing="0" bordercolor="#111111" id="AutoNumber1" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
      <tr>
        <td width="164" height="750" valign="top" bgcolor="#FFFFCC"><table width="164" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="158" height="60" bgcolor="#FFFFCC"><div align="center"><span class="style10"><br>
                  <img src="lmlogo.jpg" width="137" height="43"><br> 
            </span></div></td>
          </tr>
          <tr>
            <td height="7" bgcolor="#FFFFCC"><div align="center"><img src=line.gif width=158 height="1" border=0></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="index.php">View Status</a> </span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="group.php">Protected Directory</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="search.php">Member Search</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="add_member.php">Add New Member</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="register_access.php">Signup Access</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="mailnotify.php">Mail Notification</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="emailtemplates.php">Email Templates</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="changepwd.php">Change Password</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="backup.php">Backup/Restore DB</a></span></div></td>
          </tr>
          <tr>
            <td height="32" bgcolor="#FFFFCC"><div align="left"><span class="style35">&nbsp;<img src="bullet.gif" width="11" height="10"><a href="<? echo $alogout; ?>">Logout</a></span></div></td>
          </tr>
        </table></td>
        <td valign="top"><img src="vert_line.gif" border="0" width="2" height="750"></td>
		<td width="577" valign="top"><table width="577" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="577" height="489" valign="top"><p align="center"><span class="style21"><br>
              Backup/Restore Database </span></p>
              <table width="550" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
				  <tr>
                  <td>
<?
$locale = gonxlocale::init();
if (!isset($locale) or $locale=="") {
    $locale = $GonxAdmin["locale"];
}
require_once("locale/".$locale.".php");
$menus = array(	"create"=>$GONX["create"],
				"list"=>$GONX["list"]);

$res =  $GONX["header"];
if (!isset($go)) {
    $go = "monitor";
}

$t = new gonxtabs();
$res .= $t->create($menus,$go,755);

switch($go){
	case "create": 
		$page = "<li><a href=\"?go=generate\" class=tab-s><u>Click here to backup whole database</u></b></a><br><br></li>
		<li><span class=tab-s><font face=arial color=blue size=2>OR select tables to backup:</font></span></li>";
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page .= $b->tables_menu();
	break;
	
	case "backuptables":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->tables_backup($tables,$structonly);
		$page = $page.$b->listbackups();
	break;
	
	case "generate":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->generate();
		$page = $page.$b->listbackups();
	break;
	
    case "list":
		$b = new backup;
		$page = $b->listbackups();
	break;
	
	case "delete":
		$b = new backup;
		$page = $b->delete($fname);
		$page = $page.$b->listbackups();
	break;
	
	case "import":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->import($bfile);
		$page = $page. $b->listbackups();
	break;
	
	case "importfromfile":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->importfromfile();
		$page = $page.$b->listbackups();
	break;
	
	case "optimize":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->optimize();
	break;
	
	
	case "monitor":
		$b = new backup;
		$b->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page = $b->monitor();
	break;
	
	
	case "getbackup":
		$b = new backup;
		$b->getbackup($bfile);
	break;
	
	default:
		$page = $GONX['homepage'];
		
		$db = new db;
		$db->dbconnect($GonxAdmin["dbhost"],$GonxAdmin["dbuser"],$GonxAdmin["dbpass"],$GonxAdmin["dbname"]);
		$page .= $db->signature();

$table = "<br/><br/><table width=\"100%\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=#CCCCCC>
	<tr><td align=\"center\"><b>".$GONX["compression"]."</b></td></tr>\n\r";
foreach($GonxAdmin["compression"] as $v){
	$isdef = get_extension_funcs($v);
}
$table .= "</table><br/>\n\r";
		$page .= $table;
	break;
} // switch


$res .= $t->block($page,755 );

echo $res;
?>				  
				  
				  </td>
                </tr>
              </table>              
              <blockquote>&nbsp;              </blockquote>              

          </tr>
        
		</table>
		
      </tr>
</table>
            <p align="center"><font color="#999999" size="1" face="Verdana">Designed By</font> <font color="#999999" size="1" face="Verdana"><u>Easebay Resources</u></font></p>            
            </td>

</body>
</html>
