<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com


   include ("admin/authconfig.php");

   if (isset($_COOKIE['LMUSERNAME']) && isset($_COOKIE['LMPASSWORD']))
    {
        // Get values from superglobal variables
        $USERNAME = $_COOKIE['LMUSERNAME'];
        $PASSWORD = $_COOKIE['LMPASSWORD'];

        $CheckSecurity = new auth();
        $check = $CheckSecurity->page_check($USERNAME, $PASSWORD,$dbhost,$dbusername,$dbpass,$dbname);
	
		$connection = mysql_connect($dbhost, $dbusername, $dbpass);
		$SelectedDB = mysql_select_db($dbname);
		$result0=mysql_query("SELECT signup from authuser where uname='$USERNAME' and reg_validate=1 and status=1");
		while($row = mysql_fetch_array($result0, MYSQL_NUM)) {
		$v=$row[0];
		}
		if($v=='1') {
		$query = "SELECT access_name FROM authaccess WHERE signup=1";
		}
		else {
		$query = "SELECT access_name FROM memberaccess WHERE uname='$USERNAME'";
		}
		$result = mysql_query($query) or die("Query failed : " . mysql_error());

		//get group_name value
		$i=0;
		while ($thisrow=mysql_fetch_row($result))  //get one row at a time
		 {
		 $gname="access_".$i;
		 setcookie ($gname, $thisrow[0]);
		 $i++;
		  }
		 setcookie ("access_num", $i);
		 
		 mysql_free_result($result);
  		 mysql_close($connection);

    }
    else
    {
        $check = false;
    }

	if ($check == false)
	{

		echo "<META http-EQUIV='Refresh' content='0; URL=$url_root/login.php'>";
		exit; 
	}	


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
