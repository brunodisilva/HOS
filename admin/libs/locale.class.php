<?

class gonxlocale{
	function locale(){
	}

	function init(){
		global $locale,$GonxAdmin,$HTTP_SESSION_VARS;
		if (session_is_registered('gonxlocale') and !isset($_GET["locale"])) {
		    $locale = $HTTP_SESSION_VARS["gonxlocale"];
		} elseif (!isset($_GET["locale"])) {
		    $locale = $GonxAdmin["locale"];
			session_register('gonxlocale');
			$gonxlocale = $locale;
		} elseif (isset($_GET["locale"])) {
			if (is_file("locale/".$_GET["locale"].".php")) {
				session_register('gonxlocale');
				$HTTP_SESSION_VARS["gonxlocale"] = $_GET["locale"];
			}
		}
		return $locale;
	}
	
	
	function menu(){
		global $go,$locale;
		$locale_menu = "";
		$d = dir("./locale");
		while (false !== ($entry = $d->read())) {
		   if ($entry!="." and $entry!=".." and ereg("(.*).php$",$entry,$regs)) {
		   		if ($locale == $regs[1]) {
		   		    $sel = "selected";
		   		}else $sel="";
		       $locale_menu .= "\t<option value=$regs[1] $sel>$regs[1]</option>\n";
		   }
		}
		$locale_menu = "<input type=\"hidden\" name=\"ChgLocale\" value=\"en\">";
		$d->close();
		return $locale_menu;
	}
}

?>