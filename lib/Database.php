<?php
/*
*********************************************
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*********************************************
*/

//use PDO so that we can use its functions + db type independent setup
class Database extends PDO{

	public function __construct( $db_driver, $db_host, $db_name, $db_username, $db_password ){
		//construct db connection using PDO method
		parent::__construct( $db_driver . ':host=' . $db_host . '; dbname=' . $db_name, $db_username, $db_password ); 
		$this->loadTables();
	}

	//select statement
	public function select( $sql, $array = array(), $fetch_mode = PDO::FETCH_ASSOC ){
		ini_set('memory_limit', '1024M');
		
		$set_utf8 = $this->prepare("SET NAMES utf8");
		$set_utf8->execute(); 
		
		$query = $this->prepare( $sql );
		foreach( $array as $key=>$value ){
			$query->bindValue( "$key", $value );
		}
		
		$query->execute();
		
		return $query->fetchAll( $fetch_mode );
	}
	
	//insert statement
	public function insert( $table, $data ){
		//sort by key
		$log_data = "";
		ksort($data);
		
		$field_names  = implode( '`, `', array_keys($data) );
		$field_values = ':' . implode( ', :', array_keys($data) );
		
		$sql = "INSERT INTO $table (`". $field_names ."`) VALUES (". $field_values .")";
		
		$query = $this->prepare( $sql );
		
		foreach( $data as $key => $value ){
			$query->bindValue( ":$key", $value );
			
			$log_data .= '[ '. $key .' ] => ' . $value . "\n";
		}
		

		
		$swl = $query->execute();
		$last_id = $this->lastInsertId();
		 
		if( !$swl ){ 
			echo "\nPDO::errorInfo():\n"; 
			print_r($query->errorInfo()); 
		}else{
			if( !empty($_SESSION['BGN_SITE_USER_ID']) && !empty($_SESSION['BGN_CMS_SITE']) ){
				$_SESSION['BGN_CMS_CHANGES_COMMITTED'] = 1;
			}
			return $last_id;
		}
	}

	//update statement
	public function update( $table, $data, $where ){
		//sort by key
		ksort($data);
		$log_data = "";
		
		$field_details = NULL;
		foreach( $data as $key=> $value ){
			$field_details .= "`$key`=:$key,";
		}
		$field_details = rtrim( $field_details, ',' );
		
		$sql = "UPDATE ". $table ." SET ". $field_details ." WHERE ". $where;
		$query = $this->prepare( $sql );
		
		foreach($data as $key => $value){
			$query->bindValue( ":$key", $value );
			$log_data .= '[ '. $key .' ] => ' . $value . "\n";
		}
		
		$swl = $query->execute();	
		if (!$swl) { 
			echo "\nPDO::errorInfo():\n"; 
			print_r($query->errorInfo()); 
		}else{
			if( !empty($_SESSION['BGN_SITE_USER_ID']) && !empty($_SESSION['BGN_CMS_SITE']) ){
				$_SESSION['BGN_CMS_CHANGES_COMMITTED'] = 1;
			}
			return $swl;
		}
	}
	
	//delete statement
	public function delete( $table, $where, $limit = 1 ){
		$log_data = "";
		$sql = "DELETE FROM ". $table ." WHERE ". $where ." LIMIT ". $limit;
		
		if( !empty($_SESSION['BGN_SITE_USER_ID']) && !empty($_SESSION['BGN_CMS_SITE']) ){
			$_SESSION['BGN_CMS_CHANGES_COMMITTED'] = 1;
		}
		return $this->exec( $sql );
	}

	/**
	 * Loads the table and store it as a constant
	 * 
	 * @return void
	 */
	private function loadTables()
	{
		$query = $this->prepare("show tables");
		$query->execute();
		$result = $query->fetchAll();
		foreach ($result as $table) {
			$constant = "TABLE_" . strtoupper($table[0]);
			$dbTable = "";
			if (defined('DB_PREFIX') && DB_PREFIX != "") {
				$dbTable =  DB_PREFIX . '.' . $table[0];
			} else {
				$dbTable = $table[0];
			}
			define( $constant, $dbTable );
		}
	}
}