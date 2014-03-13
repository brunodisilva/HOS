<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	setcookie ("LMUSERNAME", $_POST['username']);
	setcookie ("LMPASSWORD", $_POST['password']);
 
  	include_once ("auth_member.php");
	include_once ("admin/authconfig.php");
 
        $username =  $_POST['username'];
        $password =  $_POST['password'];

	$Auth = new auth();
	$detail = $Auth->authenticate($username, $password,$dbhost,$dbusername,$dbpass,$dbname);
	if (($detail==0)||($detail['uname'] == $adminusername))
	{
	?><HEAD>
		<SCRIPT language="JavaScript1.1">
		<!--
			location.replace("<? echo "$failure"; ?>");
		//-->
		</SCRIPT>
	  </HEAD>
	<?
	}
	else 
	{
		$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		$result = mysql_query("select distinct welcome from authuser where uname='$username'");
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$v_welcome=$row[0];
		}
		if ($v_welcome=='1'){
		mysql_query("update authuser set welcome='0' where uname='$username'");
		mysql_close($connection);
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=$welcome\">";
		exit;		
		}
		else {
		mysql_close($connection);
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=$success\">";
		exit;		
		}

	  }
?>
