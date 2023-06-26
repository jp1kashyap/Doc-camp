<?php include '../includes/header-main.php'; 
include '../classes/Patient.php';
include '../classes/Camp.php';
include '../validation/DataValidator.php';
$patient=new Patient();
$camp=new Camp();
$validate = new Data_Validator();
$camp_id = isset($_REQUEST['doctor']) ? $_REQUEST['doctor'] : null;
if(!$camp_id){
    echo("<script>location.href = '".BASE_URL."doctor/list.php';</script>");
}
$list=$patient->doctorPatients($camp_id);
$doctor = $camp->edit($camp_id);
?>
<style>
    #toPrint #label{
        position: absolute;
        margin: 43px 10px;
        background-color: #f6f8fa;
        padding: 10px 12px;
    }
    .dataTable-wrapper{padding: 30px 11px;}
    
</style>
<script src="<?=BASE_URL?>assets/js/simple-datatables.js"></script>
<div >
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="<?=BASE_URL?>doctor/list.php" class="text-primary hover:underline">Doctors</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Patient</span>
        </li>
    </ul>

    <div x-data="exportTable">
    <div class="panel">
    <div class="md:absolute md:top-5 ltr:md:left-5 rtl:md:right-5">
            <div class="flex items-center flex-wrap mb-5">
                <button type="button" class="btn btn-primary btn-sm m-1" @click="printTable">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                        <path d="M6 17.9827C4.44655 17.9359 3.51998 17.7626 2.87868 17.1213C2 16.2426 2 14.8284 2 12C2 9.17157 2 7.75736 2.87868 6.87868C3.75736 6 5.17157 6 8 6H16C18.8284 6 20.2426 6 21.1213 6.87868C22 7.75736 22 9.17157 22 12C22 14.8284 22 16.2426 21.1213 17.1213C20.48 17.7626 19.5535 17.9359 18 17.9827" stroke="currentColor" stroke-width="1.5" />
                        <path opacity="0.5" d="M9 10H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M19 14L5 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M18 14V16C18 18.8284 18 20.2426 17.1213 21.1213C16.2426 22 14.8284 22 12 22C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path opacity="0.5" d="M17.9827 6C17.9359 4.44655 17.7626 3.51998 17.1213 2.87868C16.2427 2 14.8284 2 12 2C9.17158 2 7.75737 2 6.87869 2.87868C6.23739 3.51998 6.06414 4.44655 6.01733 6" stroke="currentColor" stroke-width="1.5" />
                        <circle opacity="0.5" cx="17" cy="10" r="1" fill="currentColor" />
                        <path opacity="0.5" d="M15 16.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path opacity="0.5" d="M13 19H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    PRINT
                </button>
            </div>
        </div>
        <div id="toPrint">
        <div>
            <label id="label">Doctor Name: <strong><?=isset($doctor) && $doctor['doctor']?$doctor['doctor']:"" ?></strong> Doctor Code: <strong><?=isset($doctor) && $doctor['doctor_code']?$doctor['doctor_code']:"" ?></strong> </label>
        </div>
        <table id="myTable" cellspacing="0" rules="all" border="1" class="whitespace-nowrap table-hover"></table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("exportTable", () => ({
            datatable: null,
            init() {
                this.datatable = new simpleDatatables.DataTable('#myTable', {
                    data: {
                        headings: ['Patient Name','Hospital','Age','Sex','Date','PSQi Score','PSQi Result'],
                        data: <?=json_encode($list)?>
                    },
                    perPage: 10,
                    perPageSelect: [10, 20, 30, 50, 100],
                    columns: [{
                            select: 0,
                            sort: 'asc',
                        },
                        {
                            select: 4,
                            render: (data, cell, row) => {
                                return this.formatDate(data);
                            },
                        }
                    ],
                    firstLast: true,
                    firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    labels: {
                        perPage: "{select}"
                    },
                    layout: {
                        top: "{search}",
                        bottom: "{info}{select}{pager}",
                    },
                });
            },

            exportTable(eType) {
                var data = {
                    type: eType,
                    filename: "table",
                    download: true,
                };

                if (data.type === "csv") {
                    data.lineDelimiter = "\n";
                    data.columnDelimiter = ";";
                }
                this.datatable.export(data);
            },

            printTable() {
                //this.datatable.print();
                var printWindow = window.open('');
                printWindow.document.write('<html><head><title>Table Contents</title>');
        
                //Print the Table CSS.
                printWindow.document.write('<style type = "text/css">');
                printWindow.document.write(`body
                    {
                        font-family: Arial;
                        font-size: 10pt;
                    }
                    table
                    {
                        border: 1px solid #ccc;
                        border-collapse: collapse;
                    }
                    table th
                    {
                        background-color: #F7F7F7;
                        color: #333;
                        font-weight: bold;
                    }
                    table th, table td
                    {
                        padding: 5px;
                        border: 1px solid #ccc;
                    }
                    label, .dataTable-wrapper{padding: 10px;}
                    .dataTable-top, .dataTable-bottom{display:none;}
                    `);
                printWindow.document.write('</style>');
                printWindow.document.write('</head>');
        
                //Print the DIV contents i.e. the HTML Table.
                printWindow.document.write('<body>');
                var divContents = document.getElementById("toPrint").outerHTML;
                printWindow.document.write(divContents);
                printWindow.document.write('</body>');
                printWindow.document.write('</html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            },

            formatDate(date) {
                if (date) {
                    const dt = new Date(date);
                    const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
                    const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                    return day + '/' + month + '/' + dt.getFullYear();
                }
                return '';
            },
        }));
    });
</script>
</div>
<?php include '../includes/footer-main.php'; ?>
