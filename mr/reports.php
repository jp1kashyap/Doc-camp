<?php include '../includes/header-main.php'; 
include '../includes/admin-head.php'; 
include '../classes/Reports.php';
include '../validation/DataValidator.php';
$reports=new Reports();
$validate = new Data_Validator();
$list=$reports->list();
?>
<script src="<?=BASE_URL?>assets/js/simple-datatables.js"></script>
<div >
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Reports</a>
        </li>
    </ul>

    <div x-data="exportTable">
    <div class="panel">
        <table id="myTable" class="whitespace-nowrap table-hover"></table>
    </div>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("exportTable", () => ({
            datatable: null,
            init() {
                this.datatable = new simpleDatatables.DataTable('#myTable', {
                    data: {
                        headings: ['ID','Month','Year','Action'],
                        data: <?=json_encode($list)?>
                    },
                    perPage: 10,
                    perPageSelect: [10, 20, 30, 50, 100],
                    columns: [{
                            select: 0,
                            sort: 'asc',
                        },
                        {
                            select: 3,
                            sortable:false,
                            render: (data, cell, row) => {
                                return `<div class="flex items-center">
                                            <a href="<?=BASE_URL?>mr/export.php?export=${data}" class="ltr:mr-2 rtl:ml-2 btn btn-success">
                                                Export Report
                                            </a>
                                        </div>`;
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
                this.datatable.print();
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
