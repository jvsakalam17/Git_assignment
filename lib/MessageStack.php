<?php
class MessageStack{

	function create_message_stack( $message, $data_array=array(), $msg_type ){
		$nm = '';
		$notice_msg = explode( "[MESSAGE_SPLIT]", $message ); 
		
		foreach( $notice_msg as $notice ){
			if( trim($notice)!="" ){
				$nm .= '<li> '. $notice .' </li>';
			}
		}
		
		if( !empty($data_array) ){
			Session::set_session( 'MESSAGE_STACK_DATA', $data_array );
		}
		Session::set_session( 'MESSAGE_STACK_HEADER', $nm );
		Session::set_session( 'MESSAGE_STACK_TYPE', $msg_type );
	}
	
	public function get_message_stack_header(){
		$msg_stack_header='';
		if( isset($_SESSION['MESSAGE_STACK_HEADER']) && !empty($_SESSION['MESSAGE_STACK_HEADER']) ){
			$msg_stack_header = $_SESSION['MESSAGE_STACK_HEADER'];
			$_SESSION['MESSAGE_STACK_HEADER']='';
		}
		return $msg_stack_header;
	}

	public function get_message_stack_data(){
		$msg_stack_data='';
		if( isset($_SESSION['MESSAGE_STACK_DATA']) && !empty($_SESSION['MESSAGE_STACK_DATA']) ){
			$msg_stack_data = $_SESSION['MESSAGE_STACK_DATA'];
			$_SESSION['MESSAGE_STACK_DATA']='';		
		}
		return $msg_stack_data;
	}

	public function get_message_stack_type(){
		$msg_stack_type='';
		if( isset($_SESSION['MESSAGE_STACK_TYPE']) && !empty($_SESSION['MESSAGE_STACK_TYPE']) ){
			$msg_stack_type = $_SESSION['MESSAGE_STACK_TYPE'];
			$_SESSION['MESSAGE_STACK_TYPE']='';		
		}
		return $msg_stack_type;
	}
}