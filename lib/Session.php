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

class Session{
    
	//initialize session sitewide
	public static function init(){
		@session_start();
	}
    	
	//set session
	public static function set_session( $key, $value ){
		$_SESSION[$key] = $value;
	}
	
	//get the session
	public static function get_session( $key, $type = false ){
		if( isset($_SESSION[$key]) ){
			if (!$type) {
				return $_SESSION[$key];
			} else if ($type = 'flash') {
				$session = $_SESSION[$key];
				unset($_SESSION[$key]);
				return $session;
			}
			
		}
	}

	//check if  session exists
	public static function has_session( $key ){
		if( isset($_SESSION[$key]) ){
			return true;
		}
		return false;
	}
	
	//unset the session
	public static function destroy_session(){
		$_SESSION = array();
		session_destroy();
		//header( 'Location: ' . URL . 'login' );
	}
}
