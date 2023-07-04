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
    fputcsv($h, $monthHeading);
    // year heading
    $yearHeading = [
        'Year', $dates[1]
    ];
    fputcsv($h, $yearHeading);
    fputcsv($h, []);
    fputcsv($h, []);
    //header info for browser
   

    
//start of printing column names as names of MySQL fields
    $columns = [
        'BE Name',
        'HQ',
        'No of Drs Participated',
        'No of Patients Screened'
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