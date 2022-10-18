<?php
class Model{
	function __construct(){
		//make db connection using the constant values set
		
		$this->db = new Database( DB_DRIVER, DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD );
		//$this->db2 = new Database( DB_DRIVER, DB_HOST, DB_NAME2, DB_USERNAME2, DB_PASSWORD2 );

		$query = $this->db->prepare( "SET NAMES utf8" );
		$query->execute();
		
	}	
}
