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
		$date=isset($_REQUEST['export'])?$_REQUEST['export']:date('m,Y');
		$dates=explode(',',$date);
		 $month = $dates[0];
		 $year = $dates[1];
        while ($row = $result->fetch_assoc()) {
			$newRow=array(date('F', mktime(0, 0, 0, $month, 10)),$row['name'],$row['reporting']);

			// query doctor count
			$queryDoctor = "SELECT count(id) as camp_conducted,date,GROUP_CONCAT(doctor) as doctors,GROUP_CONCAT(speciality) as speciality FROM camps where mr_id=? AND MONTH(created_at) = ?
			AND YEAR(created_at) = ? group by date";
			$stmtDoctor = $this->connection->prepare($queryDoctor);
			$stmtDoctor->bind_param('sdd',$row['id'],$month,$year);
			$stmtDoctor->execute();
			$stmtDoctor->bind_result($camp_conducted,$date,$doctors,$speciality);
			$stmtDoctor->fetch();
			$newRow['camp_conducted'] = $camp_conducted;
			$newRow['date'] = $date;
			$newRow['doctor'] = $doctors;
			$newRow['speciality'] = $speciality;
			$stmtDoctor->close();

			// query patient count
			$queryPatient = "SELECT count(id) as countPatient FROM patients where mr_id=? AND MONTH(created_at) = ?
			AND YEAR(created_at) = ?";
			$stmtPatient = $this->connection->prepare($queryPatient);
			$stmtPatient->bind_param('sdd',$row['id'],$month,$year);
			$stmtPatient->execute();
			$stmtPatient->bind_result($countPatient);
			$stmtPatient->fetch();
			$newRow['total_patients'] = $countPatient;
			$stmtPatient->close();

			//Hypertension patients
			$queryPatient1 = "SELECT count(id) as hypertension FROM patients where mr_id=? AND MONTH(created_at) = ?
			AND YEAR(created_at) = ? AND disease=?";
			$stmtPatient1 = $this->connection->prepare($queryPatient1);
			$disease = 'Hypertension';
			$stmtPatient1->bind_param('sdds',$row['id'],$month,$year,$disease);
			$stmtPatient1->execute();
			$stmtPatient1->bind_result($hypertension);
			$stmtPatient1->fetch();
			$newRow['hypertension_patients'] = $hypertension;
			$stmtPatient1->close();

			//Diabetes patients
			$queryPatient2 = "SELECT count(id) as diabetes FROM patients where mr_id=? AND MONTH(created_at) = ?
			AND YEAR(created_at) = ? and disease=?";
			$stmtPatient2 = $this->connection->prepare($queryPatient2);
			$disease = 'Diabetes';
			$stmtPatient2->bind_param('sdds',$row['id'],$month,$year,$disease);
			$stmtPatient2->execute();
			$stmtPatient2->bind_result($diabetes);
			$stmtPatient2->fetch();
			$newRow['diabetes_patients'] = $diabetes;
			$stmtPatient2->close();

			//Other patients
			$queryPatient3 = "SELECT count(id) as other FROM patients where mr_id=? AND MONTH(created_at) = ?
			AND YEAR(created_at) = ? and disease=?";
			$stmtPatient3 = $this->connection->prepare($queryPatient3);
			$disease = 'Other';
			$stmtPatient3->bind_param('sdds',$row['id'],$month,$year,$disease);
			$stmtPatient3->execute();
			$stmtPatient3->bind_result($other);
			$stmtPatient3->fetch();
			$newRow['other_patients'] = $other;
			$stmtPatient3->close();

            $mrArray[]=$newRow;
        }
		return $mrArray;
	}



}