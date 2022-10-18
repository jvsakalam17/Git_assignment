<?php

class members_Model extends Model{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        session_start();     
        $this->csrf();
        
    }

    //login
    public function loginMembers($user, $pass)
	{
		$query = $this->db->prepare("SELECT * FROM ".TABLE_MEMBERS." WHERE username = :username AND password = :password");       
		$query->execute( 
            [
                "username" => $user,
                "password" => $pass        
            ]
        );

		if( $query->rowCount()>0 ):
            $_SESSION["user"] = $user;
            $_SESSION["CSRF_TOKEN"] = md5(uniqid().date("Y-d-m H:i:s"));
            unset($_SESSION["auth"]);                    
            header("location:view_members");  

        else:
            $_SESSION["auth"] = "wrong";
		endif;     
	}

    //logout statement
    public function logout()
	{
		session_destroy();
        
	}
    
    //csrf validation
    public function csrf()
    {
        $url = $_SERVER['REQUEST_URI'];

        if(!isset($_SESSION["CSRF_TOKEN"]) && $url != "/mvc/members/login"):
           header("location:login");
           
        else:
            if(isset($_POST["csrf"])):
                if($_SESSION["CSRF_TOKEN"] != $_POST["csrf"]):
                   header("HTTP/1.0 404 Not Found"); 
                   exit;                  
                endif;
            endif;
        endif;

    }
    

    //view all members statement
    public function getMembers()
	{
		$query = $this->db->prepare("SELECT * FROM ".TABLE_MEMBERS);
		$query->execute();
        return $query->fetchAll();
	}
   
    //update view action statement
    public function viewSelectMember($id)
	{
        $query = $this->db->prepare("SELECT * FROM ".TABLE_MEMBERS." WHERE member_id = :id");
		$query->execute(
            [
                "id" => $id
            ]
        );        
        
        if( $query->rowCount()>0 ):
            return $query->fetch();
        endif;
       
	}
}