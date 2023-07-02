<?php
include_once 'DbConfig.php';
class Camp extends DbConfig
{
	private $isAdmin = false;
	public function __construct()
	{
		parent::__construct();
		if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
			$this->isAdmin = true;
		}
	}
    public function add()
	{	
		extract($_POST);
		$mr_id=$this->isAdmin?null:$_SESSION['id'];
		$query="INSERT INTO camps (hospital,location,doctor,doctor_code,speciality,date,mr_id) VALUES(?,?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sssssss",$hospital,$location,$doctor,$doctor_code,$speciality,$date,$mr_id);
		return $stmt->execute();
	}

    public function list()
	{
		try {
			if ($this->isAdmin) {
				$query = "SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps ORDER BY id DESC";
				$stmt = $this->connection->prepare($query);
			}else{
				$query = "SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps where mr_id=? ORDER BY id DESC";
				$stmt = $this->connection->prepare($query);
				$mr_id = $_SESSION['id'];
				$stmt->bind_param('s', $mr_id);
			}
			
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = array($row['id'], $row['hospital'], $row['location'], $row['doctor'], $row['doctor_code'], $row['speciality'], $row['date'], $row['id']);
			}
			return $rows;
		}catch(Exception $e){
			print_r($e);
			return [];
		}
	}
	public function listForDashboard()
	{
		try {
			if ($this->isAdmin) {
				$query = "SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps ORDER BY id DESC LIMIT 10";
				$stmt = $this->connection->prepare($query);
			} else {
				$query = "SELECT id,hospital,location,doctor,doctor_code,speciality,date FROM camps where mr_id=? ORDER BY id DESC LIMIT 10";
				$stmt = $this->connection->prepare($query);
				$mr_id = $_SESSION['id'];
				$stmt->bind_param('s', $mr_id);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}catch(Exception $e){
			print_r($e);
			return [];
		}
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

	public function doctorList(){
		try {
			if ($this->isAdmin) {
				$query = "SELECT c.id,c.doctor,c.doctor_code,c.hospital,c.location,c.date,count(p.id) as totalPatient  FROM camps as c left join patients as p on p.camp_id=c.id group by c.id ORDER BY c.id DESC";
				$stmt = $this->connection->prepare($query);
			} else {
				$query = "SELECT c.id,c.doctor,c.doctor_code,c.hospital,c.location,c.date,count(p.id) as totalPatient  FROM camps as c left join patients as p on p.camp_id=c.id where c.mr_id=? group by c.id  ORDER BY c.id DESC";
				$stmt = $this->connection->prepare($query);
				$mr_id = $_SESSION['id'];
				$stmt->bind_param('s', $mr_id);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = array($row['id'], $row['doctor'], $row['doctor_code'], $row['hospital'], $row['location'], $row['date'], $row['totalPatient']);
			}
			return $rows;
		}catch(Exception $e){
			print_r($e);
			return [];
		}
	}
}