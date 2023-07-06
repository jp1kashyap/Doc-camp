<?php 
include '../classes/MR.php';
$mr=new MR();
if (isset($_REQUEST['export']) && $_REQUEST['export']) {
    $report = $mr->exportData();
    $reportname=str_replace(',','-',$_REQUEST['export']);
    $filename = "report-" .$reportname;
    $file_ending = "xls";
    $dates=explode(',',$_REQUEST['export']);
    //define separator (defines columns in excel & tabs in word)
    $sep = "\t"; //tabbed character
    // month Heading
    $monthName = date('F', mktime(0, 0, 0, $dates[0], 10));
    $monthHeading = [
        'Month',
        $monthName
    ];
    header("Content-Type: text/csv");
    header("Content-Disposition: attach; filename=".$filename.".csv");
    $h = fopen("php://output", "w");

    
//start of printing column names as names of MySQL fields
    $columns = [
        'Month',
        'Name of BE',
        'HQ Name',
        'Camp Conducted',
        'Date of Camp',
        'Names of Drs',
        'Speciality',
        'Total No of Patients',
        'Hypertension & Insomnia',
        'Diabetes & Insomnia',
        'Others with Insomnia'
    ];
    fputcsv($h, $columns);
    foreach ($report as $row) {
        fputcsv($h, $row);
    }
    fclose($h);
}else{
    return false;
}

?>