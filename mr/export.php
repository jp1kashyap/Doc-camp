<?php 
include '../classes/MR.php';
$mr=new MR();
if (isset($_REQUEST['export']) && $_REQUEST['export']) {
    $report = $mr->exportData();
    $filename = "report-" . date('m-Y');
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
    echo implode($sep, array_values($monthHeading)) . "\r\n";
    // year heading

    $yearHeading = [
        'Year', $dates[1]
    ];
    echo implode($sep, array_values($yearHeading)) . "\r\n\r\n\r\n";
    //header info for browser
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    
//start of printing column names as names of MySQL fields
    $columns = [
        'BE Name',
        'HQ',
        'No of Drs Participated',
        'No of Patients Screened'
    ];
    echo implode($sep, array_values($columns)) . "\r\n";
    foreach ($report as $row) {
        echo implode($sep, array_values($row)) . "\r\n";
    }
}else{
    return false;
}

?>