<?php 
include '../classes/MR.php';
$mr=new MR();
$report=$mr->exportData();
$filename = "report-".date('m-Y');
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");

//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
$columns = [
'BE Name',
'HQ',
'No of Drs Participated',
'No of Patients Screened'
];
echo implode($sep, array_values($columns)) . "\r\n";
foreach($report as $row){
    echo implode($sep, array_values($row)) . "\r\n";
}

?>