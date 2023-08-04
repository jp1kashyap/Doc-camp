<?php
include_once 'DbConfig.php';
class Patient extends DbConfig
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
		$query="INSERT INTO patients (name,age,sex,address,disease,other_disease,camp_id,mr_id) VALUES(?,?,?,?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sdssssds",$name,$age,$sex,$address,$disease,$other_disease,$camp_id,$mr_id);
		$stmt->execute();
		return $stmt->insert_id;
	}

    public function list()
	{
		if(isset($_REQUEST['disease']) && $_REQUEST['disease']=='Diabetes'){
			return $this->diabetesList();
		}else if(isset($_REQUEST['disease']) && $_REQUEST['disease']=='Hypertension'){
			return $this->hyperTensionList();
		} else {
			try {
				if ($this->isAdmin) {
					$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id ORDER BY id DESC";
					$stmt = $this->connection->prepare($query);
				} else {
					$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.mr_id=? ORDER BY id DESC";
					$stmt = $this->connection->prepare($query);
					$mr_id = $_SESSION['id'];
					$stmt->bind_param('s', $mr_id);
				}
				$stmt->execute();
				$result = $stmt->get_result();
				$rows = array();
				while ($row = $result->fetch_assoc()) {
					$rows[] = array($row['id'], $row['hospital'], $row['name'], $row['age'], $row['sex'], $row['address'], $row['disease'], $row['other_disease'], $row['id']);
				}
				return $rows;
			} catch (Exception $e) {
				print_r($e);
				return [];
			}
		}
	}

	public function doctorPatients($camp_id)
	{	
		$query="SELECT p.name as name,c.hospital as hospital,p.age as age,p.sex as sex,p.created_at as date,p.disease as disease,p.other_disease as other_disease,p.psqi_score as psqi_score,p.psqi_result as psqi_result FROM patients as p join camps as c on p.camp_id=c.id where p.camp_id=? ORDER BY p.id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('s', $camp_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()) {
			$disease = $row['disease'] == 'Other' ? $row['other_disease'] : $row['disease'];
            $rows[]=array($row['name'],$row['hospital'],$row['age'],$row['sex'],$row['date'],$disease,$row['psqi_score'],$row['psqi_result']);
        }
		return $rows;
	}

	public function listForDashboard()
	{
		try {
			if ($this->isAdmin) {
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id ORDER BY id DESC LIMIT 10";
				$stmt = $this->connection->prepare($query);
			}else{
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.mr_id=? ORDER BY id DESC LIMIT 10";
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

	public function updateScore($id,$score,$result){
		$query="UPDATE patients SET psqi_score=?,psqi_result=? WHERE id = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssd",$score,$result,$id);
		return $stmt->execute();
	}

	public function hyperTensionList(){
		try {
			if ($this->isAdmin) {
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.disease='Hypertension' ORDER BY p.id DESC";
				$stmt = $this->connection->prepare($query);
			}else{
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.disease='Hypertension' and p.mr_id=? ORDER BY p.id DESC";
				$stmt = $this->connection->prepare($query);
				$mr_id = $_SESSION['id'];
				$stmt->bind_param('s', $mr_id);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = array($row['id'], $row['hospital'], $row['name'], $row['age'], $row['sex'], $row['address'], $row['disease'], $row['other_disease'], $row['id']);
			}
			return $rows;
		}catch(Exception $e){
			print_r($e);
			return [];
		}
	}

	public function diabetesList(){
		try {
			if ($this->isAdmin) {
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.disease='Diabetes' ORDER BY p.id DESC";
				$stmt = $this->connection->prepare($query);
			}else{
				$query = "SELECT p.id as id,p.name as name,p.age as age,p.sex as sex,p.address as address,p.disease as disease,p.other_disease as other_disease,c.hospital as hospital FROM patients as p join camps as c on p.camp_id=c.id where p.disease='Diabetes' and p.mr_id=? ORDER BY p.id DESC";
				$stmt = $this->connection->prepare($query);
				$mr_id = $_SESSION['id'];
				$stmt->bind_param('s', $mr_id);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = array($row['id'], $row['hospital'], $row['name'], $row['age'], $row['sex'], $row['address'], $row['disease'], $row['other_disease'], $row['id']);
			}
			return $rows;
		}catch(Exception $e){
			print_r($e);
			return [];
		}
	}
}