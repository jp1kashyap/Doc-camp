<?php
include_once 'DbConfig.php';

class Questions extends DbConfig
{
    public function __construct()
	{
		parent::__construct();
	}

    public function add()
	{	
		extract($_POST);
		$query="INSERT INTO questions (patient,question_id,question,answer,score) VALUES(?,?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sssss",$patient,$question_id,$question,$answer,$score);
		$stmt->execute();
		return $stmt->insert_id;
	}

	public function edit($patient,$question_id){
		$query = "SELECT answer,score FROM questions WHERE patient=? and question_id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('ss', $patient,$question_id);
		$stmt->execute();
		$stmt->bind_result($answer,$score);
		$json = array();
		if($stmt->fetch()) {
			$json = array('answer'=>$answer, 'score'=>$score);
		}else{
			$json = array('error'=>'no record found');
		}
		/* close statement */
		$stmt->close();
		return $json;
	}

	public function update(){
		extract($_POST);
		$query="UPDATE questions SET answer=?,score=? WHERE patient = ? and question_id=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssss",$answer,$score,$patient,$question_id);
		return $stmt->execute();
	}

    public function calculateScore($patientId){
        $query = "SELECT patient,question,answer,score FROM questions WHERE patient=?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $patientId);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=$row;
        }
		/* close statement */
		$stmt->close();
		return $rows;
    }
}