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
		$query="INSERT INTO questions (patient,question,answer,score) VALUES(?,?,?,?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssss",$patient,$question,$answer,$score);
		$stmt->execute();
		return $stmt->insert_id;
	}

    public function calculateScore($patientId){
        $query = "SELECT sum(score) as totalScore FROM questions WHERE patient=? group by patient";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param('d', $patientId);
		$stmt->execute();
		$stmt->bind_result($totalScore);
		$total=0;
		if($stmt->fetch()) {
            $total = $totalScore;
		}
		/* close statement */
		$stmt->close();
		return $total;
    }
}