<?

class db{
	/**
     * Constructor
     * @access protected
     */
	function db(){
		
	}
	
	var $hostName = ""; //Name of server
	var $hostport = "";	//Server port
	var $dbName = ""; //Name of databse
	var $dbUser = ""; //Database user name
	var $dbPwd = ""; //Database password
	var $reserved_words = 	array("ADD","ANALYZE","ASC","BDB","BETWEEN","BLOB","CALL","CHANGE","CHECK","COLUMNS","CONSTRAINT","CROSS","CURRENT_TIMESTAMP","DATABASES","DAY_MINUTE","DECIMAL","DELAYED","DESCRIBE","DISTINCTROW","DROP","ENCLOSED",
		"EXIT","FETCH","FOR","FOUND","FULLTEXT","HAVING","HOUR_MINUTE","IGNORE","INFILE","INOUT","INT","INTO","ITERATE","KEYS","LEAVE","LIMIT","LOCALTIME","LONG","LOOP","MATCH","MEDIUMTEXT",
		"MINUTE_SECOND","NOT","NUMERIC","OPTION","ORDER","OUTFILE","PRIVILEGES","READ","REGEXP","REPLACE","RETURN","RLIKE","SENSITIVE","SHOW","SONAME","SQL","SQLWARNING","SQL_SMALL_RESULT","SQL_TSI_HOUR","SQL_TSI_QUARTER","SQL_TSI_YEAR",
		"STRAIGHT_JOIN","TABLES","TIMESTAMPADD","TINYINT","TRAILING","UNION","UNSIGNED","USE","UTC_DATE","VALUES","VARCHARACTER","WHERE","WRITE","ZEROFILL","ALL","AND","ASENSITIVE","BEFORE","BIGINT","BOTH","CASCADE",
		"CHAR","COLLATE","CONDITION","CONTINUE","CURRENT_DATE","CURSOR","DAY_HOUR","DAY_SECOND","DECLARE","DELETE","DETERMINISTIC","DIV","ELSE","ESCAPED","EXPLAIN","FIELDS","FORCE","FRAC_SECOND","GRANT","HIGH_PRIORITY","HOUR_SECOND",
		"IN","INNER","INSENSITIVE","INTEGER","IO_THREAD","JOIN","KILL","LEFT","LINES","LOCALTIMESTAMP","LONGBLOB","LOW_PRIORITY","MEDIUMBLOB","MIDDLEINT","MOD","NO_WRITE_TO_BINLOG","ON","OPTIONALLY","OUT","PRECISION","PROCEDURE",
		"REAL","RENAME","REQUIRE","REVOKE","SECOND_MICROSECOND","SEPARATOR","SMALLINT","SPATIAL","SQLEXCEPTION","SQL_BIG_RESULT","SQL_TSI_DAY","SQL_TSI_MINUTE","SQL_TSI_SECOND","SSL","STRIPED","TERMINATED","TIMESTAMPDIFF","TINYTEXT","TRUE","UNIQUE","UPDATE",
		"USER_RESOURCES","UTC_TIME","VARBINARY","VARYING","WHILE","XOR","ALTER","AS","AUTO_INCREMENT","BERKELEYDB","BINARY","BY","CASE","CHARACTER","COLUMN","CONNECTION","CREATE","CURRENT_TIME","DATABASE","DAY_MICROSECOND","DEC",
		"DEFAULT","DESC","DISTINCT","DOUBLE","ELSEIF","EXISTS","FALSE","FLOAT","FOREIGN","FROM","GROUP","HOUR_MICROSECOND","IF","INDEX","INNODB","INSERT","INTERVAL","IS","KEY","LEADING","LIKE",
		"LOAD","LOCK","LONGTEXT","MASTER_SERVER_ID","MEDIUMINT","MINUTE_MICROSECOND","NATURAL","NULL","OPTIMIZE","OR","OUTER","PRIMARY","PURGE","REFERENCES","REPEAT","RESTRICT","RIGHT","SELECT","SET","SOME","SPECIFIC",
		"SQLSTATE","SQL_CALC_FOUND_ROWS","SQL_TSI_FRAC_SECOND","SQL_TSI_MONTH","SQL_TSI_WEEK","STARTING","TABLE","THEN","TINYBLOB","TO","UNDO","UNLOCK","USAGE","USING","UTC_TIMESTAMP","VARCHAR","WHEN","WITH","YEAR_MONTH");
	
		
	/**
	 * db::dbconnect()		Just connect to DB
	 * 
	 * @param string $hostName
	 * @param string $dbUser
	 * @param string $dbPwd
	 * @param string $dbName
	 * @param string $port
	 * @return 
	 **/
	function dbconnect($hostName="", $dbUser="", $dbPwd="",$dbName="", $port=""){
		global $GonxAdmin;
		if ($hostName!="") {
		    $this->hostName = $hostName;
		}
		if ($dbUser!="") {
		    $this->dbUser = $dbUser;
		}
		if ($dbPwd!="") {
		    $this->dbPwd = $dbPwd;
		}
		if ($dbName!="") {
		    $this->dbName = $dbName;
		}
		if ($port!="") {
		    $this->hostport = $port;
		}
		
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->Link_ID = @mysql_connect($this->hostName, $this->dbUser, $this->dbPwd) or die (_CONNECTION_ERROR_);
				@mysql_select_db($this->dbName) or die (_CONNECTION_ERROR_.$this->error()."<br><br>");
			break;
			} // switch
		return $this->Link_ID;
	}

	/**
	 * db::disconnect()
	 * 
	 * @return 
	 **/
	function disconnect()
	{
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"])
		{
			case "mysql":
				@mysql_close($this->Link_ID);
			break;
		}
	}
	
	/**
	 * db::query()		Query alias
	 * 
	 * @param $query
	 * @return 
	 **/
	function query($query){
		global $GonxAdmin;
		
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->dbQryResult = @mysql_query($query) or die (_QUERY_ERROR_.mysql_error()."<br><br>");
			break;
		} // switch
		return $this->dbQryResult;
	}
	
	/**
	 * db::free_results()
	 * 
	 * @return 
	 **/
	function free_results()
	{
		global $GonxAdmin;
		
		switch($GonxAdmin["dbtype"])
		{
			case "mysql":
				return mysql_free_result ($this->dbQryResult);
			break;
		}
	}
	
	/**
	 * db::fetch_row()		Alias to {DB}_fetch_row()
	 * 
	 * @param string $result
	 * @return 
	 **/
	function fetch_row($result = "")
	{
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->dbResultLine = @mysql_fetch_row($result);
			break;
		} // switch
		
		return $this->dbResultLine;
	}
	
	/**
	 * db::get_data()		Alias to {DB}_fetch_row
	 * 
	 * @param string $result
	 * @return 
	 **/
	function get_data($result = "")
	{
		if ($result!="") {
		    return $this->fetch_row($result);
		} else return $this->fetch_row($this->dbQryResult);
	}
	
	/**
	 * db::fetch_array()		Alias to {DB}_fetch_array()
	 * 
	 * @param string $result
	 * @return 
	 **/
	function fetch_array($result = "")
	{
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->dbResultLine = @mysql_fetch_array($result);
			break;
		} // switch
		return $this->dbResultLine;
	}
	
	/**
	 * db::num_rows()
	 * 
	 * @return 
	 **/
	function num_rows()
	{
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"])
		{
			case "mysql":
				return @mysql_num_rows($this->dbQryResult);
			break;
		}
	}
	
	/**
	 * db::list_tables()
	 * 
	 * @param $dbname
	 * @return 
	 **/
	function list_tables($dbname){
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->dbResultLine = @mysql_list_tables($dbname);
			break;
		} // switch
		return $this->dbResultLine;
	}
	
	
	/**
	 * method get_db_tables : return list of tables
	 * 
	 * @access public
	 * @return void 
	 **/
	function get_db_tables(){
		global $GonxAdmin;
		
		$result = @$this->list_tables($this->dbName);
		if (!$result) {
		    print 'Error '.$GonxAdmin["dbtype"].' : ' . $this->error();
		    exit;
		}
	    while ($row = $this->fetch_row($result)) {
			$Tables[] = $row[0];
	    }
		return $Tables;		
	}
	
	/**
	 * db::list_dbs()
	 * 
	 * @return 
	 **/
	function list_dbs(){
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				$this->dbResultLine = @mysql_list_dbs($this->Link_ID);
			break;
		} // switch
		return $this->dbResultLine;
	}
	
	
	/**
	 * db::get_db_tables()
	 * 
	 * @return 
	 **/
	function get_dbs(){
		global $GonxAdmin;
		
		$result = $this->list_dbs();
	    if (!$result) {
	        print 'Error '.$GonxAdmin["dbtype"].' : ' . $this->error();
	        exit;
	    }
	    while ($row = $this->fetch_row($result)) {
			$DBS[] = $row[0];
	    }
		return $DBS;		
	}

	/**
	 * db::error()
	 * 
	 * @return 
	 **/
	function error(){
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				return @mysql_error();
			break;
		} // switch
	}
	
	/**
	 * db::escape_string()
	 * 
	 * @param string $string
	 * @return 
	 **/
	function escape_string($string = ""){
		global $GonxAdmin;
		switch($GonxAdmin["dbtype"]){
			case "mysql": 
				return mysql_escape_string($string);
			break;
		} // switch
	}
	
	
	/**
	 * db::valid_table_name()
	 * 
	 * @param $tbl_name
	 * @return 
	 **/
	function valid_table_name($tbl_name){
		if (in_array(strtoupper($tbl_name), $this->reserved_words)) {
		    return FALSE;
		}
		return TRUE;
	}
	


	
	
}

?>