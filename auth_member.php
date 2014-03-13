<?
//Login Manager
//
//Member Management System, Version 3.0
//Easebay Resources, 2002-2004.
//Website: www.easebayresources.com
//Email: services@easebayresources.com


class auth{	
	// AUTHENTICATE
	function authenticate($username, $password,$dbhost,$dbusername,$dbpass,$dbname) {
		$enpass=base64_encode("$password");
		$query = "SELECT * FROM authuser WHERE uname='$username' AND passwd='$enpass' AND status <> '0'";
        $UpdateRecords = "UPDATE authuser SET lastlogin = NOW(), logincount = logincount + 1 WHERE uname='$username' and status='1'";
	    $connection = mysql_connect($dbhost, $dbusername, $dbpass);
	    $SelectedDB = mysql_select_db($dbname);
		$result = mysql_query($query); 
		$numrows = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		// CHECK IF THERE ARE RESULTS
		if ($numrows == 0) {
			return 0;
		}

		else {

			$Update = mysql_query($UpdateRecords);
			return $row;
		}
	} // End: function authenticate


	function page_check($username, $password,$dbhost,$dbusername,$dbpass,$dbname) {
		$enpass=base64_encode("$password");
		$query = "SELECT * FROM authuser WHERE uname='$username' AND passwd='$enpass' AND status <> '0'";
	    $connection = mysql_connect($dbhost, $dbusername, $dbpass);
	    $SelectedDB = mysql_select_db($dbname);
		$result = mysql_query($query); 
		$numrows = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		if ($numrows == 0) {
			return false;
		}
		else {
			return $row;
		}
	} // End: function page_check
	


} // End: class auth
?>
