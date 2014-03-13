<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();
   	require_once ('admin/authconfig.php');
		
	$username = $_COOKIE['LMUSERNAME'];
	setcookie ("LMUSERNAME", "",time()-3600);
	setcookie ("LMPASSWORD", "",time()-3600);	
	setcookie (session_name(),"",0,"/");
	session_destroy();

	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
	$SelectedDB = mysql_select_db($dbname);
	$getip=getip();
	mysql_query("insert into log (uname,ctime,ip,activity) values ('$username',now(),'$getip','Member ($username) has been logged out.')");
	mysql_close($connection);
	
	
	function getip() {
	if (getenv(HTTP_X_FORWARDED_FOR)) {
	$ip=getenv(HTTP_X_FORWARDED_FOR);
	}
	else {
	$ip=getenv(REMOTE_ADDR);
	}
	return $ip;
	}
?>

<html>

<head>
<title>Logout</title>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
redirTime = "10";
redirURL = "logout.html";
function redirTimer() { self.setTimeout("self.location.href = redirURL;",redirTime); }
//  End -->
</script>

</head>

<body onload="redirTimer()">
</body>

</html>
