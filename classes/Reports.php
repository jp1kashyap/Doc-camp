<?php
include_once 'DbConfig.php';
class Reports extends DbConfig
{
    private $isAdmin = false;
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $this->isAdmin = true;
        }
    }

    public function list(){
        try{
            $month = date('m');
            $year = date('Y');
            // check current month report
            $checkQuery = "SELECT count(id) as count FROM reports WHERE month=? and year=?";
            $checkStmt = $this->connection->prepare($checkQuery);
            $checkStmt->bind_param('dd', $month, $year);
            $checkStmt->execute();
			$checkStmt->bind_result($count);
			$checkStmt->fetch();
            $countAll = $count;
            $checkStmt->close();
			if($countAll<=0){
                $queryInsert="INSERT INTO reports (month,year) VALUES(?,?)";
                $stmtInsert = $this->connection->prepare($queryInsert);
                $stmtInsert->bind_param("dd",$month,$year);
                 $stmtInsert->execute();
                 $stmtInsert->close();
            }

            if ($this->isAdmin) {
				$query = "SELECT id,month,year FROM reports ORDER BY id DESC";
				$stmt = $this->connection->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = array($row['id'], date('F', mktime(0, 0, 0, $row['month'], 10)), $row['year'],$row['month'].','.$row['year']);
                }
                return $rows;
			}else{
				return [];
			}
        }catch(Exception $e){
            print_r($e);
            return [];
        }
    }
}