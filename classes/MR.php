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

	public function add()
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

	public function list()
	{	
		$query="SELECT id,name,code,reporting,manager,state,region FROM mr ORDER BY id DESC";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=array($row['id'],$row['name'],$row['code'],$row['reporting'],$row['manager'],$row['state'],$row['region'],$row['id']);
        }
		return $rows;
	}

	public function delete($id){
		$query = "DELETE FROM mr WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		return $stmt->execute();
	}

	public function edit($id){
		$query = "SELECT id,name,code,reporting,manager,state,region FROM mr WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
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

	public function update()
	{	
		extract($_POST);
		$query="UPDATE mr SET name=?,code=?,reporting=?,manager=?,state=?,region=? WHERE id = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssssssd",$name,$code,$reporting,$manager,$state,$region,$id);
		return $stmt->execute();
	}

	public function exportData(){
		$query="SELECT id,name,reporting FROM mr ORDER BY id DESC";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $mrArray=array();
        while ($row = $result->fetch_assoc()) {
			$newRow=array($row['name'],$row['reporting']);

			// query doctor count
			$queryDoctor = "SELECT count(id) as countDoctor FROM camps where mr_id=? AND MONTH(created_at) = MONTH(CURRENT_DATE())
			AND YEAR(created_at) = YEAR(CURRENT_DATE())";
			$stmtDoctor = $this->connection->prepare($queryDoctor);
			$stmtDoctor->bind_param('s',$row['id']);
			$stmtDoctor->execute();
			$stmtDoctor->bind_result($countDoctor);
			$stmtDoctor->fetch();
			$newRow['doctors'] = $countDoctor;
			$stmtDoctor->close();

			// query patient count
			$queryPatient = "SELECT count(id) as countPatient FROM patients where mr_id=? AND MONTH(created_at) = MONTH(CURRENT_DATE())
			AND YEAR(created_at) = YEAR(CURRENT_DATE())";
			$stmtPatient = $this->connection->prepare($queryPatient);
			$stmtPatient->bind_param('s',$row['id']);
			$stmtPatient->execute();
			$stmtPatient->bind_result($countPatient);
			$stmtPatient->fetch();
			$newRow['patients'] = $countPatient;

            $mrArray[]=$newRow;
        }
		return $mrArray;
	}



}