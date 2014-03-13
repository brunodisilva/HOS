<?

define ('_CONNECTION_ERROR_',"DB Connection error.");

class backup extends db{


	var $backupdir = "backup";
	var $compression = "bz2";
	var $color1 = "#FFFF99";
	var $color2 = "#CCCCFF";
	var $color3 = "#FFFFFF";
	var $mysqldump = true;
	var $default_sort_order = "DateDesc";
	var $file_mod = "0777";

	function backup(){
		global $GonxAdmin;
		$this->compression = $GonxAdmin["compression_default"];
	}


	function tables_menu(){
		global $GONX;
		
		$color3 = $this->color3;
		$color2 = $this->color2;
		$color1 = $this->color1;
		
		$res = "\n<form action='?go=backuptables' method='post'>
				<table width=500 cellpadding=\"3\" style=\"border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">
				<tr bgcolor=\"$color1\">
				<th width=150 align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face=arial size=2>Table</font></th>
				<th width=50 align=center><font face=arial size=2>Rows</font></th>
				<th width=70 align=center><font face=arial size=2>&nbsp;&nbsp;Create_time</font></th>
				<th width=70 align=center><font face=arial size=2>&nbsp;&nbsp;Update_time</font></th>
				<th width=70 align=center><font face=arial size=2>&nbsp;&nbsp;Check_time</font></th>
				</tr>\n\n";

        $result =  $this->query('SHOW TABLE STATUS');
		$i = 0;		$bgcolor = $color2;
        while ($table = @$this->fetch_array($result)) {
			if ($table["Update_time"]!=$table["Create_time"]) {
			    $l1 = "<label for=\"tables$i\">";
				$l2 = "</label>";
			} else {
				$l1 = $l2 = "";
			};
			$res .= "<tr bgcolor=\"$bgcolor\">
					<th align=left><input type='checkbox' id='tables$i' name='tables[]' value='".$table["Name"]."' />&nbsp;&nbsp;<font face=\"Verdana\" size=1 color=#006600><b>".strtoupper($table["Name"])."</b></font></th>
					<td align=center><font face=Verdana size=1 color=#006600>".$table["Rows"]."</font></td>
					<td align=center><font face=Verdana size=1 color=#006600>$l1".$table["Create_time"]."$l2</font></td>
					<td align=center><font face=Verdana size=1 color=#006600>$l1".$table["Update_time"]."$l2</font></td>
					<td align=center><font face=Verdana size=1 color=#006600>".$table["Check_time"]."</font></td>
					</tr>";
			if ($bgcolor==$color3) {
			    $bgcolor = $color2;
			} else $bgcolor = $color3;
			$i++;
		}
		
		$res .= "</table><br>&nbsp;<input type='checkbox' name='structonly' value='Yes'><font face=arial size=2> Only backup table structure</font><br><br>
				<p align=left><input type='submit' value='Backup DB'></p></form><br><br><br><br><br><br>";
		return $res;
	}
	

	function tables_backup($tables,$structonly){
		global $GONX;
		foreach($tables as $v){
            $res = $this-> query("SHOW CREATE TABLE " . $this -> dbName . "." .$v);
            while ($resu[] = $this -> get_data()) {
            } 
		}

        foreach($resu as $key => $val) {
			$tbl_name_status = $this->valid_table_name($val[0]);
            if (trim($val[0]) !== "" and $tbl_name_status) {
                $Dx_Create_Tables .= "
					# Drop table '" . $val[0] . "' if exist
					<xquery>
					DROP TABLE IF EXISTS " . $val[0] . ";
					</xquery>
					# create table '" . $val[0] . "'
					<xquery>
					" . $val[1] . " ;
					</xquery>\r\n";
		if ($structonly!="Yes") {
                $query = "Insert into `$val[0]` (";
				$this -> query("LOCK TABLES $val[0] WRITE");
                $qresult = $this -> query("Select * from $val[0]");
                while ($line = $this -> fetch_array($qresult)) {
                    unset($fields, $values);
					$j = 0;
                    while (list($col_name, $col_value) = each($line)) {
                        if (!is_int($col_name)) {
                            $fields .= "`$col_name`,";
							$values .= "'" . $this->escape_string($col_value) . "',";
                        } 
                    } 

                    $fields = substr($fields, 0, strlen($fields)-1);
                    $values = substr($values, 0, strlen($values)-1);
                    $myquery = $query . $fields . ") values (" . $values . ");";
                    $Dx_Create_Tables .= "\r\n<xquery>
						" . $myquery . "
						</xquery>\r\n" ;
                } 
				$this -> query("UNLOCK TABLES;");		    
		}
            } elseif (!$tbl_name_status){
				$err_msg .= "<font color=red>".$GONX["ignoredtables"]." ".$val[0]." - ".$GONX["reservedwords"].".</font><br>\n";
			}
        } 
		
		if (!is_dir($this->backupdir)) {
		    @mkdir($this->backupdir,0755);
		}
		if (sizeof($tables)==1) {
		    $prefix = "[".$tables[0]."]";
		} else $prefix = "[".sizeof($tables)."tables]";
		switch($this->compression){
			case "bz2": 
				$fname = $this->dbName."-$prefix-".date("Y-m-d H-i-s").".bz2";
				touch($this->backupdir."/".$fname);
				$fp = bzopen($this->backupdir."/".$fname, "w");
				bzwrite($fp, $Dx_Create_Tables);
				bzclose($fp);
			break;
			
		    case "zlib": 
				$fname = $this->dbName."-$prefix-".date("Y-m-d H-i-s").".gz";
				touch($this->backupdir."/".$fname);
				$fp = gzopen($this->backupdir."/".$fname, "w");
				gzwrite($fp, $Dx_Create_Tables);
				gzclose($fp);
			break;
		
			default:
				$fname = $this->dbName."-$prefix-".date("Y-m-d H-i-s").".sql";
				touch($this->backupdir."/".$fname);
				$fp = fopen($this->backupdir."/".$fname, "w");
				fwrite($fp, $Dx_Create_Tables);
				fclose($fp);
			break;
		} 
        return "<font color=red>$err_msg".$GONX["backup"]." ".$this->dbName." ".$GONX["iscorrectcreat"]." : ".$this->backupdir."/$fname</font>";
	}
	

	function generate(){
		global $GONX;
        $result =  @$this->list_tables($this->dbName);
        while ($table = @$this->fetch_row($result)) {
            $res = $this-> query("SHOW CREATE TABLE " . $this -> dbName . "." . $table[0]);

            while ($resu[] = $this -> get_data()) {
            } 
        } 
        foreach($resu as $key => $val) {
			$tbl_name_status = $this->valid_table_name($val[0]);
            if (trim($val[0]) !== "" and $tbl_name_status) {
                $Dx_Create_Tables .= "
					# Drop table '" . $val[0] . "' if exist
					<xquery>
					DROP TABLE IF EXISTS " . $val[0] . ";
					</xquery>
					# create table '" . $val[0] . "'
					<xquery>
					" . $val[1] . " ;
					</xquery>\r\n";

                $query = "Insert into `$val[0]` (";
				$this -> query("LOCK TABLES $val[0] WRITE");
                $qresult = $this -> query("Select * from $val[0]");
                while ($line = $this -> fetch_array($qresult)) {
                    unset($fields, $values);
					$j = 0;
                    while (list($col_name, $col_value) = each($line)) {
                        if (!is_int($col_name)) {
                            $fields .= "`$col_name`,";
							$values .= "'" . $this->escape_string($col_value) . "',";
                        } 
                    } 

                    $fields = substr($fields, 0, strlen($fields)-1);
                    $values = substr($values, 0, strlen($values)-1);
                    $myquery = $query . $fields . ") values (" . $values . ");";
                    $Dx_Create_Tables .= "\r\n<xquery>
						" . $myquery . "
						</xquery>\r\n" ;
                } 
				$this -> query("UNLOCK TABLES;");
            }  elseif (!$tbl_name_status){
				$err_msg .= "<font color=red>Ignored table ".$val[0]." - Reserved SQL word.</font><br>\n";
			}
        } 
		
		if (!is_dir($this->backupdir)) {
		    @mkdir($this->backupdir,octdec($this->file_mod));
		}
		switch($this->compression){
			case "bz2": 
				$fname = $this->dbName."-".date("Y-m-d H-i-s").".bz2";
				touch($this->backupdir."/".$fname);
				$fp = bzopen($this->backupdir."/".$fname, "w");
				bzwrite($fp, $Dx_Create_Tables);
				bzclose($fp);
			break;
			
		    case "zlib": 
				$fname = $this->dbName."-".date("Y-m-d H-i-s").".gz";
				touch($this->backupdir."/".$fname);
				$fp = gzopen($this->backupdir."/".$fname, "w");
				gzwrite($fp, $Dx_Create_Tables);
				gzclose($fp);
			break;
		
			default:
				$fname = $this->dbName."-".date("Y-m-d H-i-s").".sql";
				touch($this->backupdir."/".$fname);
				$fp = fopen($this->backupdir."/".$fname, "w");
				fwrite($fp, $Dx_Create_Tables);
				fclose($fp);
			break;
		} 
        return "<font color=red>$err_msg".$GONX["backup"]." ".$this->dbName." ".$GONX["iscorrectcreat"]." : ".$this->backupdir."/$fname</font>";
	}


	function import($bfile = ""){
		global $GONX,$GonxAdmin;
		set_time_limit(0);

		if (isset($_GET["importdump"])) {
		    if (is_file($this->backupdir."/".$bfile)) {
				switch($GonxAdmin["compression_default"]){
					case "bz2": 
						$bz = bzopen($this->backupdir."/".$bfile, "r");
						while (!feof($bz)) {
	  						  $contents .= bzread($bz, 4096);
						}
						bzclose($bz);
					break;
					
				    case "zlib": 
						$bz = gzopen($this->backupdir."/".$bfile, "r");
						$contents = gzread($bz, filesize($this->backupdir."/".$bfile)*1000); // just a hack coz feof doesn't wrk for me
						gzclose($bz);
					break;
				
					default:
						$bz = fopen($this->backupdir."/".$bfile, "r");
						$contents = fread($bz, filesize($this->backupdir."/".$bfile)*1000); // just a hack coz feof doesn't wrk for me
						fclose($bz);
					break;
				}
				
				$contents = str_replace("<xquery>", "", $contents);
				$contents = str_replace("</xquery>", "", $contents);

				touch($this->backupdir."/temp.sql");
				$fp = fopen($this->backupdir."/temp.sql", "w");
				fwrite($fp, $contents);
				fclose($fp); unset($contents);

				@shell_exec($GonxAdmin["mysqldump"]." --host ".$GonxAdmin["dbhost"]." --user=".$GonxAdmin["dbuser"]." --pass=".$GonxAdmin["dbpass"]." --databases ".$GonxAdmin["dbname"]." < ".$this->backupdir."/temp.sql");

				@unlink($this->backupdir."/temp.sql");
				return "<font color=red> $bfile ".$GONX["iscorrectimport"]." </font>";
			} else return FALSE;
		}

		if (is_file($this->backupdir."/".$bfile)) { // File existe, import it
			switch($GonxAdmin["compression_default"]){
				case "bz2": 
					$bz = bzopen($this->backupdir."/".$bfile, "r");
					while (!feof($bz)) {
  						  $contents .= bzread($bz, 4096);
					}
					bzclose($bz);
				break;
				
			    case "zlib": 
					$bz = gzopen($this->backupdir."/".$bfile, "r");
					$contents = gzread($bz, filesize($this->backupdir."/".$bfile)*1000); 
					gzclose($bz);
				break;
			
				default:
					$bz = fopen($this->backupdir."/".$bfile, "r");
					$contents = fread($bz, filesize($this->backupdir."/".$bfile)*1000); 
				break;
			} 

            preg_match_all("'<xquery[?>]*?>(.*?)</xquery>'si" , $contents, $requetes);
			unset($contents);
            foreach($requetes[1] as $key => $val) {
                $this -> query(trim($val));
            }
			return "<font color=red> $bfile ".$GONX["iscorrectimport"]." </font>";
		} else {	
			return false;
		}
	}
	

	function importfromfile(){
		global $GONX,$HTTP_POST_FILES;
		@set_time_limit(0);

		
		$bfile = $HTTP_POST_FILES["backupfile"];
		$pathinfo = pathinfo($bfile["name"]);
		$compression = $pathinfo["extension"];
				
		if ($bfile["error"]==0) { // File existe, import it
			switch($compression){
				case "bz2": 
					$bz = bzopen($bfile["tmp_name"], "r");
					$contents = bzread($bz, $bfile["size"]); 
					bzclose($bz);
				break;
				
			    case "gz": 
					$gz = gzopen($bfile["tmp_name"], "r");
					$contents = gzread($gz, $bfile["size"]); 
					bzclose($gz);
				break;
			
				default:
					$f = fopen($bfile["tmp_name"], "r");
					$contents = fread($f, $bfile["size"]); 
					fclose($f);
				break;
			} 
			

            preg_match_all("'<xquery[?>]*?>(.*?)</xquery>'si" , $contents, $requetes);
            foreach($requetes[1] as $key => $val) {
                $this -> query(trim($val));
            }
			return "<font color=red> ".$bfile["name"]." ".$GONX["iscorrectimport"]." </font>";
		} else {	// Erronous file, read dir, and list available backup file.
			return $this->listbackups();
		}
	}
	
	/**
	 * backup::listbackups()		List available backup
	 * 
	 * @return 
	 **/
	function listbackups(){
		global $GONX,$GonxAdmin,$page,$orderby;
		$pagesize = $GonxAdmin["pagedisplay"];
		$GonxOrder = array("Date_Descending","Date_Ascending","Name_Descending","Name_Ascending","Size_Descending","Size_Ascending");
		if ($orderby=="" or !in_array($orderby,$GonxOrder )) {
		    $orderby = $this->default_sort_order;
		}
		
		if( !isset( $page ) or ($page<=0) ){

			$page = 1;

			$from = $page-1;

			$to = ($pagesize*$page);

		} elseif ($page ==1){

			$from = 0;

			$to = ($pagesize*($page+1)-$pagesize);

		} else {

			$from = $pagesize * ($page-1);

			$to = ($pagesize*($page+1)-$page *$pagesize);

		}
		$res = "
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
function IECColor1(el) {	
	IEC_obj2.IECColor(el);
	IEC_obj1.IECColor(el);
}


function IECColor2(el){

	IEC_obj1.IECColor(el);
	IEC_obj2.IECColor(el);
	
	if(ConfirmDelete()){
	
		return true;
		
	} else {
	
		document.getElementById(el).style.background = IEC_obj1.BG2;
		document.forms[\"bform\"].reset();
		
		return false;
	}					
}

function IECColorClass(BG1, BG2){

	this.gvar = 10000;
	this.BG1 = BG1;
	this.BG2 = BG2;
	this.IECColor=IECColor;
}

function IECColor(el) {	

	document.getElementById(el).style.background = this.BG1;

	if(this.gvar < 9000 && this.gvar != el)
		document.getElementById(this.gvar).style.background = this.BG2;	
	
	this.gvar = el;
}

IEC_obj1 = new IECColorClass('khaki','#F6F6F6'); 
IEC_obj2 = new IECColorClass('#CF2B5A','#F6F6F6');


//-->
</script>
<form method=get action=\"?\" name=bform><b>".$GONX["selectbackupfile"]." :</b><br/><br/>\n";
		if (!is_dir($this->backupdir)) {
		    @mkdir($this->backupdir,octdec($this->file_mod));
		}
		$d = dir($this->backupdir);
		$i = $BackupSize = 0;
		while (false !== ($entry = $d->read())) {
			if ($entry!="." and $entry!=".." and (ereg(".bz2$",$entry) or ereg(".gz$",$entry) or ereg(".sql$",$entry))) {
				$mtime = date ("Y-m-d(H:i:s)", filemtime($this->backupdir."/".$entry));
				$time = filemtime($this->backupdir."/".$entry);
				$size = filesize($this->backupdir."/".$entry);
				$fsize = round($size/1024);
				
				$GonxBackups[$i]["fname"] = $entry;
				$GonxBackups[$i]["mtime"] = $mtime;
				$GonxBackups[$i]["time"] = $time;
				$GonxBackups[$i]["fsize"] = $fsize;
				$GonxBackups[$i]["size"] = $size;			
				$BackupSize += $fsize;
				$i++;
			}
		}
		if ($i==0) {
		    $res .= "<ul><li>".$GONX["nobckupfile"]."</li></ul>";
		} else {
			/**
			* Pagination
			*/
			$allpages = round(sizeof($GonxBackups)/$pagesize); 

			$all_rest = $allpages - $allpages*$pagesize;

			if ($all_rest > 0) {$allpages++; }

			if ($page<$allpages)
			{
				$next = "<a href=\"?option=databaseAdmin&go=list&amp;page=".($page+1)."&orderby=$orderby\" class=tab-s>".$GONX["next"]."</a>";
			} else $next="";
			if ($page>1)
			{
				$prev = "<a href=\"?option=databaseAdmin&go=list&amp;page=".($page-1)."&orderby=$orderby\" class=tab-s>".$GONX["prev"]."</a>";
			} else $prev ="";
			$links = "";
			for ($i=0; $i<$allpages; $i++)
			{
				if (($i+1) == $page)
				{
					$links .= "<span class=tab-s> ".($i+1)." </span>";
				} else {
					$links .= "<a href=\"?option=databaseAdmin&go=list&amp;page=".($i+1)."&orderby=$orderby\" class=tab-g> ".($i+1)." </a>";
				}
			}
			/**
			* Order by
			*/
			$OrderMenu = "<select class=button OnChange=\"location.href='?option=databaseAdmin&go=list&page=$page&orderby='+ChgOrder.options[selectedIndex].value\" name=\"ChgOrder\" style=\"color: #0000FF; font-family: Arial; font-size: 8pt; background-color: #FFFFCC\">\n";
			foreach($GonxOrder as $v){
				if ($v==$orderby) {
				    $sel = " selected";
				} else $sel ="";
				$OrderMenu .= "<option$sel value=\"$v\">$v</option>\n";
			}
			$OrderMenu .= "</select>\n";
			switch($orderby){
				case "Date_Descending": 
					usort($GonxBackups, array("backup","DateSortDesc"));
				break;
				
				case "Date_Ascending": 
					usort($GonxBackups, array("backup","DateSortAsc"));
				break;
				
			    case "Name_Descending": 
					usort($GonxBackups, array("backup","NameSortDesc"));
				break;				
				
			    case "Name_Ascending": 
					usort($GonxBackups, array("backup","NameSortAsc"));
				break;

			    case "Size_Descending": 
					usort($GonxBackups, array("backup","SizeSortDesc"));
				break;
				
			    case "Size_Ascending": 
					usort($GonxBackups, array("backup","SizeSortAsc"));
				break;

				default:
					usort($GonxBackups, array("backup","DateSortDesc"));
				break;
			} // switch
			
			if (is_array($GonxBackups)) {
			    $GonxBackups = array_slice($GonxBackups, $from,$to);
			}
		$color3 = $this->color3;
		$color2 = $this->color2;
		$color1 = $this->color1;
			$res .= "\n\n<br>
			<table width=500 cellpadding=4 style=\"border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">
\t<tr bgcolor=\"$color1\">
			<th></th>
			<th align=left width=170><font face=arial size=2>Backed Up Database</font></th>
			<th width=70><font face=arial size=2>Date</font></th>
			<th><font face=arial size=2>Size</font></th>
			<th><font face=arial size=2>Delete</font><th>
</tr>\n";

			$bgcolor=$color2;
			foreach($GonxBackups as $k=>$v){
				$db = explode("-",$v['fname'] );
				$db = $db[0];
				$res .= "\t<tr id=$k  bgcolor=\"$bgcolor\">
			<td><input type=\"radio\" name=\"bfile\" value=\"".$v['fname']."\"></td>
			<td><font face=Verdana size=1 color=blue><b>".$v['fname']."</b></font></td>
			<td align=center><font face=Verdana size=1 color=#006600>".$v['mtime']."</font></td>
			<td align=center><font face=Verdana size=1 color=#006600>".$v['fsize']." KB</font></td>
			<td align=center><a href=\"?option=databaseAdmin&go=delete&fname=".$v['fname']."\" title=\"".$GONX["delete"]." ".$v['fname']."\" onclick=\"return IECColor2($k);\"><u>Delete</u></a><td>
</tr>\n\n";
			if ($bgcolor==$color3) {
			    $bgcolor = $color2;
			} else $bgcolor = $color3;

			}
		$BackupSize = number_format(($BackupSize/1024),3  );
		$res .= "</table><br><br>\n<font face=arial size=2>&nbsp;Sorted by: $OrderMenu
		</font><br><br><input type=hidden name=go value=import>
		<p align=right>";
		
		if($this->mysqldump)		
		$res .="<p align=left>&nbsp;  <input type=submit name=import value=\"Restore DB\"></p></form><br><br><br><br><br><br>";
		}
		

		$d->close();
		return $res;
	}
	

	/**
	 * backup::NameSortAsc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function NameSortAsc($a, $b) {
	
	    return strcmp($a["fname"], $b["fname"]);
	
	}
	
	/**
	 * backup::NameSortDesc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function NameSortDesc($a, $b) {
	
	    return !strcmp($a["fname"], $b["fname"]);
	
	}
	
	/**
	 * backup::SizeSortAsc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function SizeSortAsc($a, $b) {
	
		return ($a["size"]>$b["size"])?1:-1;
	
	}
	
	/**
	 * backup::SizeSortDesc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function SizeSortDesc($a, $b) {
	
		return ($a["size"]<$b["size"])?1:-1;
	
	}
	
	/**
	 * backup::DateSortAsc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function DateSortAsc($a, $b) {
	
		return ($a["time"]>$b["time"])?1:-1;
	
	}
	
	/**
	 * backup::DateSortDesc()
	 * 
	 * @param $a
	 * @param $b
	 * @return 
	 **/
	function DateSortDesc($a, $b) {

		return ($a["time"]<$b["time"])?1:-1;
	
	}
	
	/**
	 * backup::delete()	delete a backup file based on its name
	 * 
	 * @param $_fname
	 * @return 
	 **/
	function delete($_fname){
		if (is_file($this->backupdir."/".$_fname)) {
			unlink($this->backupdir."/".$_fname);
			return "<font color=red> Backup file $_fname is correctly removed </font>";
		} else return "<font color=red> Error while removing backup file $_fname</font>";
	}
	
	/**
	 * backup::keep()		Keep backup files for a limited period of days and remove all others
	 * 
	 * @param integer $days
	 * @return 
	 **/
	function keep($days = 4){
		if (is_dir($this->backupdir)) {
			$d = dir($this->backupdir);
			while (false !== ($entry = $d->read())) {
				if ($entry!="." and $entry!=".." and (ereg(".bz2$",$entry) or ereg(".gz$",$entry) or ereg(".sql$",$entry))) {
					if ((filemtime($this->backupdir."/".$entry)) < (strtotime('-'.$days.' days'))) {
						$this->delete($entry);
					}
				}
			}
		}
	}
	
	
	/**
	 * backup::monitor()		Return tables status
	 * 
	 * @return 
	 **/
	function monitor(){
	
		$color3 = $this->color3;
		$color2 = $this->color2;
		$color1 = $this->color1;
		
		
		$res = "<font face=\"arial\" size=2 color=#000099> This is the area to backup/restore Login Manager V3.0 Database.<br><br>";
		$res .= "<b>Backup existing database:</b><br>Click the link \"Create a Backup\", choose either \"backup whole database\" or \"backup selected tables\", click the button \"Backup DB\" to save the result.<br><br>";
		$res .= "<b>Restore backed up database:</b><br>Click the link \"List/Import backup\", choose the backed up file you want to restore, then click the button \"Restore DB\".<br><br></font>";
		$res .= "<font face=\"arial\" size=2 color=#000099><b>Table Status:</b></font><br><br>";
		$res .= "<table cellpadding=4  style=\"border-collapse: collapse; border: 1px solid #666699; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">";
        $result=mysql_query("SHOW TABLE STATUS");
		$i = 0;		$bgcolor = $color2; $l1 = $l2 = "";
        while ($line=mysql_fetch_array($result,MYSQL_ASSOC)) {
			$field=array($line['Name'],$line['Row_format'],$line['Rows'],$line['Data_length'],$line['Create_time'],$line['Update_time']);
					$l1 .= "<th><font face=\"arial\" size=2><u>Name</u></font></th><th width=80><font face=\"arial\" size=2><u>Row Format</u></font></th><th><font face=\"arial\" size=2><u>Rows</u></font></th><th width=80><font face=\"arial\" size=2><u>Data Length</u></font></th><th width=80><font face=\"arial\" size=2><u>Create Time</u></font></th><th width=90><font face=\"arial\" size=2><u>Update Time</u></font></th>\n";
					$l2 .= "<td align=left><font face=\"Verdana\" size=1 color=#006600>&nbsp;&nbsp;<b>".strtoupper($line['Name'])."</b></font></td><td align=center><font face=\"Verdana\" size=1 color=#006600>".$line['Row_format']."</font></td><td align=center><font face=\"Verdana\" size=1 color=#006600>".$line['Rows']."</font></td><td align=center><font face=\"Verdana\" size=1 color=#006600>".$line['Data_length']."</font></td><td align=center><font face=\"Verdana\" size=1 color=#006600>".$line['Create_time']."</font></td><td align=center><font face=\"Verdana\" size=1 color=#006600>".$line['Update_time']."</font></td>\n"; 
			if ($i==0) {
			    $res .= "<tr bgcolor=\"$color1\">\n$l1</tr>\n";
			}
			$res .= "<tr bgcolor=\"$bgcolor\">\n$l2</tr>\n";
			if ($bgcolor==$color3) {
			    $bgcolor = $color2;
			} else $bgcolor = $color3;
			$l1 = $l2 = "";
			$i++;
        }
		$res .= "</table><br><br><br><br>";
		return $res;
	}
	
	
	/**
	 * backup::getbackup()
	 * 
	 * @return 
	 **/
	function getbackup($bfile){

		if (is_file($this->backupdir."/".$bfile) and !ereg("../",$bfile)) {
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 			
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".basename($this->backupdir."/".$file));
			header("Content-Description: File Transfer");
			@readfile($this->backupdir."/".$file);
			exit;
		}
	}
	
	
}

?>