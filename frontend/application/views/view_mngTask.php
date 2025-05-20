<title>CRM | Task Control</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Task</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Task Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="datatables">
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <!-- start Zero Configuration -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Task Information</h4>
                        <div class="row border" style="padding: 15px;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Document Type :</label>
                                        <select class="form-select form-select-sm shadow-sm" name="mdt_id" id="inpDocType" onchange="filterData()">
                                            <?php
                                            $option_topic = $this->ManageBackend->list_option("option/list_mdt");
                                            echo '<option value="">Choose document type ...</option>';
                                            foreach ($option_topic as $topic) {
                                                echo '<option value="' . $topic['mdt_position1'] . '">' . $topic['mdt_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Issue Date :</label>
                                        <div class="input-group me-2">
                                            <input type="date" class="form-control form-control-sm text-center" id="startDate">
                                            <span class="input-group-text bg-info text-white fs-1 px-3" style="padding-top: 0rem !important; padding-bottom: 0rem !important;">TO</span>
                                            <input type="date" class="form-control form-control-sm text-center" id="endDate">
                                        </div>
                                        <button class="btn btn-sm bg-info text-white card-hover shadow-sm" onclick="searchDate()">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;" for="inpImportFrom">Customer Type :</label>
                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpImportFrom" name="ir_import_tran" onchange="filterData()">
                                            <option value="">All</option>
                                            <option value="1">Domestic</option>
                                            <option value="2">Overseas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;" for="inpCustomer">Customer Name :</label>
                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpCustomer" name="irq_customer" onchange="filterData()"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="text-dark fw-semibold fs-3 me-3">Status :</label>
                                        <button class="btn btn-sm bg-secondary text-white card-hover me-2 shadow-sm" onclick="btnTable('open')">Open</button>
                                        <button class="btn btn-sm bg-warning text-white card-hover me-2 shadow-sm" onclick="btnTable('wait approve')">Wait Approve</button>
                                        <button class="btn btn-sm bg-danger text-white card-hover shadow-sm me-2" style="background-color: #C7253E !important;" onclick="btnTable('Rejected')">Rejected</button>
                                        <button class="btn btn-sm bg-success text-white card-hover shadow-sm me-2" onclick="btnTable('Approved')">Approved</button>
                                        <button class="btn btn-sm bg-danger text-white card-hover shadow-sm" onclick="btnTable('cancel')">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center flex-nowrap justify-content-end">
                                        <button class="btn btn-outline-secondary btn-sm px-3 py-2 shadow-sm" onclick="ViewAll()">View All</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblMngTask" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-center">Customer Type</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Document No.</th>
                                            <th class="text-center">Refer Doc No.</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Issued Date</th>
                                            <th class="text-center">Issued By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal for View RFQ No-->
<div class="modal fade" id="mdlReferRfq" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header d-flex flex-wrap gap-3">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNo" name="ir_doc_no" value="" placeholder="Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRef" name="ir_doc_no_ref" value="" placeholder="RFQ Document No." disabled>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="mb-4" id="">Item Information</h5>
                <div class="p-5 border shadow-sm" style="height: 80vh;">
                    <iframe class="w-100 h-100" src="" id="filePreview" frameborder="0"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let dataTable;

    function searchDate() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblMngTask')) {
            $('#tblMngTask').DataTable().destroy();
        }
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblMngTask').DataTable({
            ajax: {
                url: API_URL + 'manageTask/searchDate' + '/' + startDate + '/' + endDate,
                dataSrc: function(json) {
                    return json.data ? json.data : [];
                },
            },
            columnDefs: [{
                searchable: true,
                orderable: true,
                targets: 0,
            }, ],
            scrollX: true,
            bSort: true,
            order: [
                [6, 'asc']
            ],
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Overseas';
                        } else if (row.idc_customer_type == 2) {
                            return 'Domestic';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'refer_doc',
                    "render": function(data, type, row) {
                        let result = row.refer_doc.substr(0, 3);
                        if (row.refer_doc == "null" || row.refer_doc == "" || result != 'RFQ') {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.refer_doc}', 'RFQ')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.refer_doc}</span>`;
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.idc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_date',
                    "render": function(data, type, row) {
                        return row.idc_created_date.substring(0, 10);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.idc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null; this.src=\'http://192.168.161.219/ticketMaintenance/assets/img/avatars/no-avatar.png\'">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.idc_created_by + '">' + row.idc_created_by + '</span>' +
                                    '</div></div></div>';
                            } else {
                                disp = "";
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'idc_id',
                    "render": function(data, type, row) {
                        return `
                                <div class="d-flex justify-content-evenly gap-1">
                                    <button type="button" onclick="viewRfqPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlReferRfq" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                    <button id="btnPDF" onclick="viewPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                </div>`;
                    }
                },
            ]
        });

        dataTable.on('draw', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        
    }
    async function ViewAll() {
        if ($.fn.DataTable.isDataTable('#tblMngTask')) {
            $('#tblMngTask').DataTable().destroy();
        }
        const currentYear = new Date().getFullYear();
        const firstDayOfYear = `${currentYear}-01-01`;
        const lastDayOfYear = `${currentYear}-12-31`;
        dataTable = $('#tblMngTask').DataTable({
            ajax: {
                url: API_URL + 'manageTask/viewAll/' + firstDayOfYear + '/' + lastDayOfYear,
            },
            columnDefs: [{
                searchable: true,
                orderable: true,
                targets: 0,
            }, ],
            scrollX: true,
            bSort: true,
            order: [
                [6, 'asc']
            ],
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Overseas';
                        } else if (row.idc_customer_type == 2) {
                            return 'Domestic';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'refer_doc',
                    "render": function(data, type, row) {
                        let result = row.refer_doc.substr(0, 3);
                        if (row.refer_doc == "null" || row.refer_doc == "" || result != 'RFQ') {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.refer_doc}', 'RFQ')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.refer_doc}</span>`;
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.idc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_date',
                    "render": function(data, type, row) {
                        return row.idc_created_date.substring(0, 10);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.idc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null; this.src=\'http://192.168.161.219/ticketMaintenance/assets/img/avatars/no-avatar.png\'">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.idc_created_by + '">' + row.idc_created_by + '</span>' +
                                    '</div></div></div>';
                            } else {
                                disp = "";
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'idc_id',
                    "render": function(data, type, row) {
                        return `
                                <div class="d-flex justify-content-evenly gap-1">
                                    <button type="button" onclick="viewRfqPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlReferRfq" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                    <button id="btnPDF" onclick="viewPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                </div>`;
                    }
                },
            ]
        });

        dataTable.on('draw', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        $('#inpImportFrom').val($('#inpCustomer option:first').val()).trigger('change');
        $('#inpCustomer').val($('#inpCustomer option:first').val()).trigger('change');
        $('#inpDocType').val($('#inpCustomer option:first').val()).trigger('change');
        dataTable
            .search('')
            .columns().search('')
            .draw();
    }
    async function btnTable(type) {
        dataTable
            .columns(5)
            .search(type)
            .draw();
    }
    async function filterData() {
        const elementId = event.target.id
        var customerType = $('#inpImportFrom').val();
        var customerName = $('#inpCustomer').val();
        var documentType = $('#inpDocType').val();
        if (customerName == 'Other') {
            const {
                value: text
            } = await Swal.fire({
                title: "Input Customer Name",
                input: "text",
                inputPlaceholder: "Enter your customer name"
            });

            if (text) {
                let optionExists = false;
                $('select#inpCustomer option').each(function() {
                    if ($(this).val() == text) {
                        optionExists = true;
                    }
                });

                if (!optionExists) {
                    $('select#inpCustomer').append(new Option(text, text));
                }
                $('select#inpCustomer').val(text);
            }

            customerName = text;
        }

        if (is_empty(customerType)) {
            customerType = '';
        } else {
            customerType = $('#inpImportFrom option:selected').text();
        }
        if (is_empty(customerName)) {
            customerName = '';
        }

        dataTable
            .columns(0)
            .search(customerType)
            .columns(1)
            .search(documentType)
            .columns(4)
            .search(customerName)
            .draw();
    }

    function showStatus(status) {
        if (status == 1) {
            return '<span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>';
        } else if (status == 2) {
            return '<span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>Wait Approve</span>';
        } else if (status == 6) {
            return '<span class="badge text-perple fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #ffafbb !important; color: #C7253E !important"><i class="ti ti-repeat-off fs-4"></i>Rejected</span>';
        } else if (status == 9) {
            return '<span class="badge bg-success-subtle text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-check fs-4"></i>Approved</span>';
        } else if (status == 5) {
            return '<span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>';
        } else {
            return '';
        }
    }
    async function viewPDF(doc_no, doc_type) {
        var run_no = doc_no;
        if (doc_type == 'RFQ') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {

                    let param = {
                        ...result
                    };

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>RfqForm/createPDF?' + $.param(param);
                    window.open(pdfUrl, '_blank');
                    return;
                }
            });
        } else if (doc_type == 'NBC') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {
                    let param = {
                        ...result
                    };

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>ManageNbc/createNbcPDF?' + $.param(param);
                    window.open(pdfUrl, '_blank');
                    return;
                }
            });
        } else if (doc_type == 'FS') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {
                    console.log(result);

                    let param = {
                        ...result
                    };

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>ManageFeasibility/createFeasibilityPDF?' + $.param(param);
                    window.open(pdfUrl, '_blank');
                    return;
                }
            });
        } else {
            swal.fire('Error', 'Document type not found.', 'error');
        }
    }

    function formatDate(inputDate) {
        let dateParts = inputDate.split('-');
        let year = dateParts[0];
        let month = dateParts[1];
        let day = dateParts[2];

        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let monthName = months[parseInt(month) - 1];

        return `${day}-${monthName}-${year.substring(2)}`;
    }
    async function viewRfqPDF(run_no, doc_type) {
        $('#mdlReferRfq').modal('hide')
        if ($('#mdlReferRfq').hasClass('show')) {
            $('#mdlReferRfq').modal('hide');
        }

        if (doc_type == 'RFQ') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {
                    let param = {
                        ...result
                    };

                    $.ajax({
                        url: API_URL + 'rfq/refer_doc/' + result.idc_refer_doc,
                        method: 'GET',
                        success: function(response) {
                            $('#inpDocNo').val(run_no);
                            $('#inpDocNoRef').val(response.Running_no);
                        }
                    });

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>RfqForm/createPDF?' + $.param(param);
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we load the data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    let iframe = document.getElementById('filePreview');

                    iframe.onload = function() {
                        Swal.close();
                    };

                    iframe.src = pdfUrl;
                }
            });
        } else if (doc_type == 'NBC') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {
                    let param = {
                        ...result
                    };

                    $.ajax({
                        url: API_URL + 'rfq/refer_doc/' + result.idc_refer_doc,
                        method: 'GET',
                        success: function(response) {
                            $('#inpDocNo').val(run_no);
                            $('#inpDocNoRef').val(response.Running_no);
                        }
                    });

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>ManageNbc/createNbcPDF?' + $.param(param);
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we load the data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    let iframe = document.getElementById('filePreview');

                    iframe.onload = function() {
                        Swal.close();
                    };

                    iframe.src = pdfUrl;
                }
            });
        } else if (doc_type == 'FS') {
            $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no,
                success: async function(result) {
                    console.log(result);

                    let param = {
                        ...result
                    };

                    $.ajax({
                        url: API_URL + 'rfq/refer_doc/' + result.idc_refer_doc,
                        method: 'GET',
                        success: function(response) {
                            $('#inpDocNo').val(run_no);
                            $('#inpDocNoRef').val(response.Running_no);
                        }
                    });

                    let IssueDate = param.idc_created_date.split(" ")[0];
                    param.idc_created_date = formatDate(IssueDate);

                    let Duedate = param.idc_closing_date.split(" ")[0];
                    param.idc_closing_date = formatDate(Duedate);

                    let pdfUrl = '<?php echo base_url(); ?>ManageFeasibility/createFeasibilityPDF?' + $.param(param);
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we load the data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    let iframe = document.getElementById('filePreview');

                    iframe.onload = function() {
                        Swal.close();
                    };

                    iframe.src = pdfUrl;
                }
            });
        }

        $('#mdlReferRfq').on('hidden.bs.modal', function() {
            $('#filePreview').attr('src', '');
        });
    }
    async function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Customer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="Other">Other</option>';
                $('#inpCustomer').html(option_text);
            }
        })
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeDateInputs('startDate', 'endDate');
    });

    function initializeDateInputs(startDateId, endDateId) {
        const startDateInput = document.getElementById(startDateId);
        const endDateInput = document.getElementById(endDateId);

        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const firstDayOfMonth = `${year}-${(month + 1).toString().padStart(2, '0')}-01`;
        const lastDayOfMonth = `${year}-${(month + 1).toString().padStart(2, '0')}-${daysInMonth}`;

        startDateInput.value = firstDayOfMonth;
        endDateInput.value = lastDayOfMonth;

        startDateInput.addEventListener('change', validateDateRange);
        endDateInput.addEventListener('change', validateDateRange);

        function validateDateRange() {
            if (new Date(endDateInput.value) < new Date(startDateInput.value)) {
                endDateInput.value = startDateInput.value;
            }
        }
    }

    $(document).ready(function() {
        $('#inpDocType, #inpImportFrom, #inpCustomer').select2();

        $('.select2-container--default .select2-selection--single, .select2-container--default .select2-selection__rendered').css({
            'height': '30px',
            'line-height': '30px',
            'font-size': '12px',
        });
        $('.select2-container--default .select2-selection__arrow').css({
            'height': '35px',
            'line-height': '35px',
        });
        listCustomer()
        if ($.fn.DataTable.isDataTable('#tblMngTask')) {
            $('#tblMngTask').DataTable().destroy();
        }
        dataTable = $('#tblMngTask').DataTable({
            ajax: {
                url: API_URL + 'manageTask/table',
                dataSrc: function(json) {
                    return json.data ? json.data : [];
                },
            },
            columnDefs: [{
                searchable: true,
                orderable: true,
                targets: 0,
            }, ],
            scrollX: true,
            bSort: true,
            order: [
                [6, 'asc']
            ],
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Overseas';
                        } else if (row.idc_customer_type == 2) {
                            return 'Domestic';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'refer_doc',
                    "render": function(data, type, row) {
                        let result = row.refer_doc.substr(0, 3);
                        if (row.refer_doc == "null" || row.refer_doc == "" || result != 'RFQ') {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.refer_doc}', 'RFQ')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.refer_doc}</span>`;
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.idc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_date',
                    "render": function(data, type, row) {
                        return row.idc_created_date.substring(0, 10);
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.idc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null; this.src=\'http://192.168.161.219/ticketMaintenance/assets/img/avatars/no-avatar.png\'">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.idc_created_by + '">' + row.idc_created_by + '</span>' +
                                    '</div></div></div>';
                            } else {
                                disp = "";
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'idc_id',
                    "render": function(data, type, row) {
                        return `
                                <div class="d-flex justify-content-evenly gap-1">
                                    <button type="button" onclick="viewRfqPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlReferRfq" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                    <button id="btnPDF" onclick="viewPDF('${row.idc_running_no}', '${row.mdt_position1}')" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                </div>`;
                    }
                },
            ]
        });

        dataTable.on('draw', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 600000);
    });
</script>