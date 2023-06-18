<?php
include_once 'DbConfig.php';

class Camp extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}
    public function add()
	{	
		extract($_POST);
		$query="INSERT INTO camps (hospital,location,doctor,doctor_code,speciality,date) VALUES(?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssssss",$hospital,$location,$doctor,$doctor_code,$speciality,$date);
		return $stmt->execute();
	}

    public function list()
	{	
		$query="SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps ORDER BY id DESC";
		$stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=array($row['id'],$row['hospital'],$row['location'],$row['doctor'],$row['doctor_code'],$row['speciality'],$row['date'],$row['id']);
        }
		return $rows;
	}
	public function listForDashboard()
	{	
		$query="SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps ORDER BY id DESC LIMIT 10";
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
		$query = "DELETE FROM camps WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		return $stmt->execute();
	}

	public function edit($id){
		$query = "SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps WHERE id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $id);
		$stmt->execute();
		$stmt->bind_result($id,$hospital,$location,$doctor,$doctor_code,$speciality,$date);
		$json = array();
		if($stmt->fetch()) {
			$json = array('id'=>$id, 'hospital'=>$hospital,'location'=>$location,'doctor'=>$doctor,'doctor_code'=>$doctor_code,'speciality'=>$speciality,'date'=>$date);
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
		$query="UPDATE camps SET hospital=?,location=?,doctor=?,doctor_code=?,speciality=?,date=? WHERE id = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssssssd",$hospital,$location,$doctor,$doctor_code,$speciality,$date,$id);
		return $stmt->execute();
	}
}