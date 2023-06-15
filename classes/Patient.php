<?php
include_once 'DbConfig.php';

class Patient extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}
    public function add()
	{	
		extract($_POST);
		$query="INSERT INTO patients (name,age,sex,address,disease,other_disease) VALUES(?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sdssss",$name,$age,$sex,$address,$disease,$other_disease);
		$stmt->execute();
		return $stmt->insert_id;
	}

    public function list()
	{	
		$query="SELECT id,name,age,sex,address,disease,other_disease FROM patients ORDER BY id DESC";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=array($row['id'],$row['name'],$row['age'],$row['sex'],$row['address'],$row['disease'],$row['other_disease'],$row['id']);
        }
		return $rows;
	}

	public function delete($id){
		$query = "DELETE FROM patients WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		return $stmt->execute();
	}

	public function edit($id){
		$query = "SELECT id,name,age,sex,address,disease,other_disease FROM patients WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		$stmt->execute();
		$stmt->bind_result($id,$name,$age,$sex,$address,$disease,$other_disease);
		$json = array();
		if($stmt->fetch()) {
			$json = array('id'=>$id, 'name'=>$name,'age'=>$age,'sex'=>$sex,'address'=>$address,'disease'=>$disease,'other_disease'=>$other_disease);
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
		$query="UPDATE patients SET name=?,age=?,sex=?,address=?,disease=?,other_disease=? WHERE id = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sdssssd",$name,$age,$sex,$address,$disease,$other_disease,$id);
		return $stmt->execute();
	}
}