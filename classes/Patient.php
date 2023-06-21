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
		$query="INSERT INTO patients (name,age,sex,address,disease,other_disease,camp_id) VALUES(?,?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sdssssd",$name,$age,$sex,$address,$disease,$other_disease,$camp_id);
		$stmt->execute();
		return $stmt->insert_id;
	}

    public function list()
	{	
		$query="SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id ORDER BY id DESC";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=array($row['id'],$row['hospital'],$row['name'],$row['age'],$row['sex'],$row['address'],$row['disease'],$row['other_disease'],$row['id']);
        }
		return $rows;
	}

	public function doctorPatients($camp_id)
	{	
		$query="SELECT p.name as name,c.hospital as hospital,p.age as age,p.sex as sex,p.created_at as date FROM patients as p join camps as c on p.camp_id=c.id where p.camp_id=? ORDER BY p.id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('s', $camp_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=array($row['name'],$row['hospital'],$row['age'],$row['sex'],$row['date'],'','');
        }
		return $rows;
	}

	public function listForDashboard()
	{	
		$query="SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id ORDER BY id DESC LIMIT 10";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=$row;
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
		$query = "SELECT id,name,age,sex,address,disease,other_disease,camp_id FROM patients WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		$stmt->execute();
		$stmt->bind_result($id,$name,$age,$sex,$address,$disease,$other_disease,$camp_id);
		$json = array();
		if($stmt->fetch()) {
			$json = array('id'=>$id, 'name'=>$name,'age'=>$age,'sex'=>$sex,'address'=>$address,'disease'=>$disease,'other_disease'=>$other_disease,'camp_id'=>$camp_id);
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