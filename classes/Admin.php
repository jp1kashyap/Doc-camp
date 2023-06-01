<?php
include_once 'DbConfig.php';

class Admin extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}

	public function signin()
	{	
		extract($_POST);
		$query="SELECT id,name,email,password FROM admin WHERE email=? and password=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ss",$email,$password);
		$stmt->execute();
		$stmt->bind_result($id,$name,$email,$password);
		$json = array();
		if($stmt->fetch()) {
			$json = array('id'=>$id, 'name'=>$name,'email'=>$email,'password'=>$password);
		}else{
			$json = array('error'=>'no record found');
		}
		/* close statement */
		$stmt->close();
		return $json;
	}
}