<?
class gonxtabs{
	function gonxtabs(){
	}

	function create($menus,$go,$tablewidth="100%"){
		$result = "\n\n<!-- GONX TABS --><br>
	<table cellSpacing=\"0\" cellPadding=\"0\" border=\"0\">
      <tr height=\"24\">
        <td>&nbsp;</td>\n";
		
		$mk = array_keys($menus);
		$i = 1;
		foreach($menus as $k=>$v){
			if ($k==$go) {
				$m{$i} = "stab_sb_gif";
				$t{$i} = "class=\"tab-s\"";
			} else {
				$m{$i} = "stab_ub_gif";
				$t{$i} = "class=\"tab-g\"";
			}

			if (($i-1)>=0 and $mk[$i-1]==$go) {
			    $mx{$i} = "stab_mus_gif";
			} elseif (($i-2)>=0 and $mk[$i-2]==$go) {
			    $mx{$i} = "stab_msu_gif";
			} else {
			    $mx{$i} = "stab_muu_gif";
			}
				

			// First Tab
			if ($i==1) {
				$mx{$i} = "stab_bs_gif";
				$width = 1;
			} else {
				$width = 14;
			}
			
			if (ereg("^http://",$k)) {
			    $lien = "$k";
			} else {
				$lien = "?go=$k";
			}
			
			$result .="        <td vAlign=\"center\" noWrap>
        </td>
        <td vAlign=\"center\" noWrap>
        &nbsp;&nbsp;<img src=\"bullet.gif\" border=\"0\"> <a ".$t{$i}." accessKey=\"$i\" href=\"$lien\"><font face=arial color=#339900 size=2><u>$v</u></font></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n\n";


			$i++;
		}

		// Latest tab
		$result .= "      
    <td align=right> <!-- GONX LOCALE -->\n".gonxlocale::menu()."\n<!-- /GONX LOCALE -->\n</td>
  </tr>
</table>
<!-- /GONX TABS -->\n\n";
		return $result;
	}
	

	function block($content = "",$tablewidth="100%"){
		global $locale;
		if ($locale=="ar") {
		    $dir = " dir=rtl";
		}else $dir="";
$res =  "<!-- GONX CONTENT --><HR align=left width=\"100%\" color=#aaaaaa noShade SIZE=1>
<table cellpadding='0' cellspacing='0' border='0' bgColor ='#FFFFFF' width='530' align=left>
 <tr>
    <td></td>
    <td></td>
    <td></td>
 </tr>
  <tr>
    <td width='5' height='100%'></td>
    <td>
      <table cellpadding='2' cellspacing='3' border='0' width='100%' height='100%'>
        <tr> 
          <td$dir>\n$content\n</td>
        </tr>
      </table>
    </td>
    <td width='5' height='100%'></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<!-- /GONX CONTENT -->

</body>
</html>";
		return $res;
	}
	
}

?>