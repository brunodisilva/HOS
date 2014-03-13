<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com

	session_start();
    require_once ('authconfig.php');

	setcookie ("USERNAME", "",time()-3600);
	setcookie ("PASSWORD", "",time()-3600);	
	setcookie (session_name(),"",0,"/");
	session_destroy();

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
