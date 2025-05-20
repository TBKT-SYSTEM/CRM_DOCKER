<title>CRM | Remaining Task</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Remaining Task</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Task Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Remaining Task</li>
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
                        <h4 class="mb-3">Document Information</h4>
                        <div id="box_alert"></div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblRemainTask" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Document No.</th>
                                            <th class="text-center">Refer Doc No.</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Workflow Detail</th>
                                            <th class="text-center">Issued Date</th>
                                            <th class="text-center">Issued By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Zero Configuration -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for View RFQ No-->
<div class="modal fade" id="mdlReferRfq" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
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

<!-- Modal for Approve No-->
<div class="modal fade" id="mdlApprove" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header d-flex flex-wrap gap-3">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoApprove" name="ir_doc_no" value="" placeholder="Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRefApprove" name="ir_doc_no_ref" value="" placeholder="RFQ Document No." disabled>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="mb-4">Item Information</h5>
                <div class="p-5 border shadow-sm" style="height: 80vh;">
                    <iframe class="w-100 h-100" src="" id="filePreviewApprove" frameborder="0"></iframe>
                    <div class="d-flex text-center align-items-center d-none" id="chkNBC">
                        <input type="hidden" name="idc_id" id="inpIdc">
                        <input type="hidden" name="ida_id" id="inpIda">
                        <label class="col-auto fs-5 text-dark fw-semibold me-2">R&D Dept. confirm project's possibility result:</label>
                        <div class="d-flex flex-wrap gap-6">
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                            <label class="btn btn-outline-success " for="option1">OK</label>

                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" disabled>
                            <label class="btn btn-outline-danger " for="option2">NG</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="approve()" class="btn bg-primary-subtle waves-effect text-start text-primary">Yes, approve it.!</button>
                <button type="button" onclick="reject()" class="btn bg-danger-subtle waves-effect text-start text-danger">No, reject it.!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var mdt;
    async function approve() {
        let idc_id = $('#inpIdc').val();
        let ida_id = $('#inpIda').val();

        await new Promise(resolve => setTimeout(resolve, 300));

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it.!',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we load the data.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                let url_api = API_URL + 'email/approve_email/' + idc_id + '/' + ida_id + '/website';
                let idc_result_confirm = 0;
                if (mdt == 'NBC') {
                    const checkedOption = document.querySelector('input[name="options"]:checked');
                    if (checkedOption.id == 'option1') {
                        idc_result_confirm = 9;
                    } else {
                        idc_result_confirm = 1;
                    }
                }
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ "idc_result_confirm": idc_result_confirm }),
                    url: url_api,
                    success: function(result) {
                        Swal.close();
                        if (typeof result == "string") {
                            Swal.fire({
                                html: '<h5>' + result + '</h5>\n <p>It cannot be re-approved.</p>',
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                }
                            }).then(() => {
                                var dataTable = $('#tblRemainTask').DataTable();
                                dataTable.ajax.reload(null, false);
                                $('#mdlApprove').modal('hide');
                            });
                        } else {
                            Swal.fire({
                                html: '<p>Approve submitted successfully</p>',
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                showConfirmButton: true,
                            }).then(() => {
                                var dataTable = $('#tblRemainTask').DataTable();
                                dataTable.ajax.reload(null, false)
                                $('#mdlApprove').modal('hide');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            html: `<p>เกิดข้อผิดพลาด: ${error}</p>`,
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            }
                        });
                    }
                })
            }
        })
    }
    async function reject() {
        let idc_id = $('#inpIdc').val();
        let ida_id = $('#inpIda').val();
        $('#mdlApprove').modal('hide');

        await new Promise(resolve => setTimeout(resolve, 300));

        const {
            value: userInput
        } = await Swal.fire({
            title: 'Enter reject message',
            input: 'text',
            inputPlaceholder: 'Enter your reject reason here...',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter reject message!';
                }
                if (value.length > 100) {
                    return 'Reject message must not exceed 100 characters!';
                }
                return null;
            }
        });

        if (userInput) {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we load the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            let url_api = API_URL + 'email/reject_email/' + idc_id + '/' + ida_id + '/' + userInput + '/website';
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                contentType: 'application/json',
                url: url_api,
                success: function(result) {
                    Swal.close();
                    if (typeof result == "string") {
                        Swal.fire({
                            html: '<h5>' + result + '</h5>\n <p>It cannot be re-rejected.</p>',
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            }
                        }).then(() => {
                            var dataTable = $('#tblRemainTask').DataTable();
                            dataTable.ajax.reload(null, false);
                            $('#mdlApprove').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            html: '<p>Reject submitted successfully</p>',
                            icon: 'success',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            showConfirmButton: true,
                        }).then(() => {
                            var dataTable = $('#tblRemainTask').DataTable();
                            dataTable.ajax.reload(null, false)
                            $('#mdlApprove').modal('hide');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        html: `<p>เกิดข้อผิดพลาด: ${error}</p>`,
                        icon: 'error',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    });
                }
            });
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
    async function viewRfqPDF(run_no) {
        $.ajax({
            type: 'get',
            url: API_URL + 'doc/runno/' + run_no,
            success: async function(result) {

                $.ajax({
                    url: API_URL + 'rfq/refer_doc/' + result.idc_refer_doc,
                    method: 'GET',
                    success: function(response) {
                        $('#inpDocNo').val(run_no);
                        $('#inpDocNoRef').val(response.Running_no);
                    }
                });

                let param = {
                    ...result
                };

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

        $('#mdlReferRfq').on('hidden.bs.modal', function() {
            $('#filePreview').attr('src', '');
        });
    }
    async function viewApproveModal(doc_no, doc_type, ida_id, idc_id) {
        if ($('#mdlApprove').hasClass('show')) {
            $('#mdlApprove').modal('hide').on('hidden.bs.modal', function() {
                $('#filePreviewApprove').attr('src', '');
            });
        }

        var url_pdf;
        var run_no = doc_no;
        if (doc_type == 'RFQ') {
            mdt = 'RFQ';
            url_pdf = 'RfqForm/createPDF?';
            $('#chkNBC').addClass('d-none').find('input').prop('disabled', true);
        } else if (doc_type == 'NBC') {
            mdt = 'NBC';
            url_pdf = 'ManageNbc/createNbcPDF?';
            $('#chkNBC').removeClass('d-none').find('input').prop('disabled', false);
        } else if (doc_type == 'FS') {
            mdt = 'FS';
            url_pdf = 'ManageFeasibility/createFeasibilityPDF?';
            $('#chkNBC').addClass('d-none').find('input').prop('disabled', true);
        } else {
            Swal.fire('Error', 'Document type not found.', 'error');
            return;
        }

        try {
            let result = await $.ajax({
                type: 'get',
                url: API_URL + 'doc/runno/' + run_no
            });
            if (result) {
                $.ajax({
                    url: API_URL + 'rfq/refer_doc/' + result.idc_refer_doc,
                    method: 'GET',
                    success: function(response) {
                        $('#inpDocNoApprove').val(run_no);
                        $('#inpDocNoRefApprove').val(response.Running_no);
                    }
                });
            }

            let param = {
                ...result
            };

            let IssueDate = param.idc_created_date ? param.idc_created_date.split(" ")[0] : null;
            param.idc_created_date = IssueDate ? formatDate(IssueDate) : '';

            let Duedate = param.idc_closing_date ? param.idc_closing_date.split(" ")[0] : null;
            param.idc_closing_date = Duedate ? formatDate(Duedate) : '';

            let pdfUrl = '<?php echo base_url(); ?>' + url_pdf + $.param(param);

            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we load the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            let iframe = document.getElementById('filePreviewApprove');
            iframe.onload = function() {
                Swal.close();
                $('#mdlApprove').modal('show');
                $('#inpIdc').val(idc_id);
                $('#inpIda').val(ida_id);
            };

            iframe.src = pdfUrl;
        } catch (error) {
            Swal.fire('Error', 'Failed to load document.', 'error');
        }
    }

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tblRemainTask')) {
            $('#tblRemainTask').DataTable().destroy();
        }
        dataTable = $('#tblRemainTask').DataTable({
            ajax: {
                url: API_URL + 'remainTask/table/' + '<?php echo $this->session->userdata('sessUsrId'); ?>',
                dataSrc: function(json) {
                    const data = (json.data || []).filter(item =>
                        item.doc_type === "FS" ||
                        item.ida_prev_action === 1 ||
                        (item.doc_type === "RFQ" && item.ida_seq_no === 1 && item.ida_prev_action === 0) ||
                        (item.doc_type === "NBC" && item.ida_seq_no === 1 && item.ida_prev_action === 0)
                    );
                    let html = '';
                    if (json.data == null || json.data.length == 0) {
                        html += `<div class="alert alert-light-success bg-success-subtle text-success" role="alert">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-mood-wink text-success me-2" style="font-size: 3rem !important;"></i>
                                        <label class="alert-heading fw-semibold" style="font-size: 1.5rem !important;">Great job!</label>
                                    </div>
                                    <hr>
                                    <p>You have no tasks left waiting to be approved.</p>
                                </div>`;
                    } else {
                        html += `<div class="alert alert-light-danger bg-danger-subtle text-danger" role="alert">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-alert-triangle text-danger me-2" style="font-size: 3rem !important;"></i>
                                        <label class="alert-heading fw-semibold" style="font-size: 1.5rem !important;"> Alert!</label>
                                    </div>
                                    <hr>
                                    <p>You have ${data.length} tasks left waiting to be approved.</p>
                                </div>`;
                    }
                    $('#box_alert').html(html);
                    return data || [];
                }
            },
            columnDefs: [{
                searchable: true,
                orderable: false,
                targets: 0,
            }, ],
            scrollX: true,
            bSort: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    className: 'text-center',
                    data: 'ida_id'
                },
                {
                    className: 'text-center col-1',
                    data: 'doc_type',
                },
                {
                    className: 'text-center col-1',
                    data: 'doc_no',
                },
                {
                    className: 'text-center',
                    data: 'refer_doc',
                    "render": function(data, type, row) {
                        let result = row.refer_doc.substr(0, 3);
                        if (row.refer_doc == "null" || row.refer_doc == "" || result != 'RFQ') {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.refer_doc}')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.refer_doc}</span>`;
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer',
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        if (row.doc_type == "FS") {
                            return '-';
                        } else {
                            let work_flow = row.work_flow;
                            let steps = work_flow.split(',');
                            let result = steps.join('<i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>');
                            return `<div class="d-flex justify-content-evenly gap-1">${result}</div>`;

                        }
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
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
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
                                    <button type="button" onclick="viewApproveModal('${row.doc_no}', '${row.doc_type}', '${row.ida_id}', '${row.idc_id}')" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlApprove" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                    <button id="btnPDF" onclick="viewPDF('${row.doc_no}', '${row.doc_type}')" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                    </button>
                                </div>`;
                    }
                },
            ]
        });

        dataTable.on('order.dt search.dt', function() {
            let i = 1;
            dataTable.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
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