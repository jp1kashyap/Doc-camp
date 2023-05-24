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
            $rows[]=array($row['id'],$row['hospital'],$row['location'],$row['doctor'],$row['doctor_code'],$row['speciality'],$row['date']);
        }
		return $rows;
	}
}