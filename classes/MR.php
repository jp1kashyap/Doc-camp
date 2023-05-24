<?php
include_once 'DbConfig.php';

class MR extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}

    public function login($query)
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}

	public function checkCodeExist($code){
		$query="SELECT * FROM mr WHERE code=?";
		$stmt=$this->connection->prepare($query);
		$stmt->bind_param('s',$code);
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->fetch();
		return $numberofrows = $stmt->num_rows;
	}

	public function signup()
	{	
		extract($_POST);
		$query="INSERT INTO mr (name,code,reporting,manager,state,region) VALUES(?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssssss",$name,$code,$reporting,$manager,$state,$region);
		return $stmt->execute();
		
	}

	public function signin()
	{	
		extract($_POST);
		$query="SELECT id,name,code,reporting,manager,state,region FROM mr WHERE code=? and code=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ss",$code,$password);
		$stmt->execute();
		$stmt->bind_result($id,$name,$code,$reporting,$manager,$state,$region);
		$json = array();
		if($stmt->fetch()) {
			$json = array('id'=>$id, 'name'=>$name,'code'=>$code,'reporting'=>$reporting,'manager'=>$manager,'state'=>$state,'region'=>$region);
		}else{
			$json = array('error'=>'no record found');
		}
		/* close statement */
		$stmt->close();
		return $json;
	}



}