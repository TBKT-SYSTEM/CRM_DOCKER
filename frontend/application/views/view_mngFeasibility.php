<title>CRM | Manage Feasibility Document</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Feasibility Document</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Feasibility</li>
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
                        <h4 class="mb-3">Feasibility Document List</h4>
                        <div class="row border" style="padding: 15px;">
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
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Issue Date :</label>
                                        <div class="input-group me-3">
                                            <input type="date" class="form-control form-control-sm text-center" id="startDate">
                                            <span class="input-group-text bg-info text-white fs-1 px-3" style="padding-top: 0rem !important; padding-bottom: 0rem !important;">TO</span>
                                            <input type="date" class="form-control form-control-sm text-center" id="endDate">
                                        </div>
                                        <button class="btn btn-sm bg-info text-white card-hover shadow-sm" onclick="searchDate()">Search</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Document No :</label>
                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input Feasibility No." onkeyup="filterData()"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="text-dark fw-semibold fs-3 me-3">Status :</label>
                                        <button class="btn btn-sm bg-secondary text-white card-hover me-2 shadow-sm" onclick="btnTable('open')">Open</button>
                                        <button class="btn btn-sm bg-warning text-white card-hover me-2 shadow-sm" onclick="btnTable('In progress')">In progress</button>
                                        <button class="btn btn-sm bg-success text-white card-hover shadow-sm me-2" onclick="btnTable('Completed')">Completed</button>
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
                                <table id="tblFS" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Customer Type</th>
                                            <th class="text-center">Document No.</th>
                                            <th class="text-center">Refer RFQ No.</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created Date</th>
                                            <th class="text-center">Created By</th>
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
                <!-- end Zero Configuration -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for View No-->
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

<!-- Modal for Edit -->
<div class="modal fade" id="mdlEdit" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex flex-wrap gap-3 mt-3">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">FS Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoEdit" name="idc_running_no_edit" value="" placeholder="RFQ Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRefEdit" name="idc_refer_doc_edit" value="" placeholder="Ref RFQ Document No." disabled>
                </div>
            </div>
            <div class="modal-body" style="background-color: #edededad !important;">
                <div class="datatables">
                    <!-- basic table -->
                    <form id="edit_form" name="edit_form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <!------------------------------------------------------ Section 1  -------------------------------------------------------->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="padding: 15px;">
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <input type="hidden" name="idc_id" id="inpEditIdcId" class="form-control">
                                                    <div class="col">
                                                        <select name="idc_customer_type" id="inpEditImportFrom" class="select2 form-select">
                                                            <option value="1">Domestic</option>
                                                            <option value="2">Overseas</option>
                                                        </select>

                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <select name="idc_customer_name" id="inpEditCustomer" class="select2 form-select" onchange="changeEditCustomer()"></select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Subject :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <div class="col">
                                                        <select name="mds_id" id="selRequirementEdit" class="select2 form-select" onchange="changeRequirement()"> </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="idc_subject_note" id="inpOtherSubjectEdit" class="form-control" placeholder="Other Subject ..." disabled>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Item Information</h4>
                                                <label class="fs-3 fw-semibold">( Max 10 Items )</label>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblPartNo">
                                                        <thead class="text-dark fs-4 shadow-sm">
                                                            <tr>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0"></h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Part No.</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Part Name</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Model</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Remark</h6>
                                                                </th>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white" id="tblEditBodyPartNo">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between gap-3 mt-2">
                                                <div class="col-auto">
                                                    <label class="fw-semibold fs-2 text-info text-start">If apply data from RFQ then show data in all topic. All topic cannot change data.</label>
                                                </div>
                                                <button type="button" onclick="saveFS()" id="btnSaveFS" class="btn bg-info-subtle text-info waves-effect text-start rounded-pill" style="cursor: pointer;">Save Feasibility</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Score -->
<div class="modal fade" id="mdlScore" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex flex-wrap gap-3 mt-3 px-5">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">FS Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoEditScore" name="idc_running_no_edit" value="" placeholder="RFQ Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRefEditScore" name="idc_refer_doc_edit" value="" placeholder="Ref RFQ Document No." disabled>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #edededad !important;">
                <div class="datatables">
                    <!-- basic table -->
                    <form id="score_form" name="score_form" method="post">
                        <input type="hidden" name="idc_id" id="inpIdcId">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Score Information :</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblScore">
                                                        <thead class="text-dark fs-4 shadow-sm">
                                                            <tr>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Weight</h6>
                                                                </th>
                                                                <th class="border-bottom-0 col-1">
                                                                    <h6 class="fw-semibold mb-0">Score</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Total</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Consideration</h6>
                                                                </th>
                                                                <th class="border-bottom-0 col-3">
                                                                    <h6 class="fw-semibold mb-0">Comment</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">P.I.C.</h6>
                                                                </th>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white" id="tblBodyScore"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 15px;">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="mb-0 align-middle text-center col-12" id="">
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td class="fs-2 fw-semibold text-dark text-start" width="9%">Conclusion :</td>
                                                                <td colspan="6"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fs-5 fw-semibold text-dark col-1" rowspan="2">Total</td>
                                                                <td class="border border-dark border-2 fs-5 fw-semibold text-dark col-1 bg-secondary-subtle" rowspan="2" id="total_score"></td>
                                                                <td width="3%"></td>
                                                                <td class="border border-dark border-1 fs-3 fw-semibold text-dark text-center" style="background-color: #13de2c !important;" width="9%">Green</td>
                                                                <td class="border border-dark border-1" width="3%" id="green_score"></td>
                                                                <td width="3%"></td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-center col-1">Green</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start col-1" style="padding-left: 8px;">Score: 90 - 100</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start" width="10%" style="padding-left: 8px;">Feasible & No Risk</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start" style="padding-left: 8px;">Product can be produced as specified with no revisions</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td class="border border-dark border-1 fs-3 fw-semibold text-dark text-center" style="background-color: #fbfd40 !important;" width="9%">Yellow</td>
                                                                <td class="border border-dark border-1" id="yellow_score"></td>
                                                                <td></td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-center">Yellow</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start col-1" style="padding-left: 8px;">Score: 70 - 89</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start" style="padding-left: 8px;">Feasible & No Risk</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start" style="padding-left: 8px;">Risk Need recommended or Other requirment (See attached).</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="border border-dark border-1 fs-3 fw-semibold text-dark text-center" style="background-color: #f3481a!important;" width="9%">Red</td>
                                                                <td class="border border-dark border-1" id="red_score"></td>
                                                                <td></td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-center">Red</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start col-1" style="padding-left: 8px;">Score: < 69</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start" style="padding-left: 8px;">Feasible & No Risk</td>
                                                                <td class="border border-dark border-1 fs-2 fw-semibold text-dark text-start text-wrap" style="padding-left: 8px;">Design revision required to produce product within the specified requirements and have risk to produce product.</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 15px;">
                                                <div class="col-md-12 d-flex align-items-center">
                                                    <label class="fs-4 fw-semibold me-2 text-dark">Scoring Meaning :</label>
                                                    <span>5 = High potential , 4 = Potential , 3 = Potential with condition , 2 = Need study for scenarior , 1 = Can't meet requirement.</span>
                                                </div>
                                            </div>
                                            <hr class="mt-3">
                                            <div class="d-flex justify-content-end mt-2">
                                                <button type="button" onclick="fsSubmit()" id="btnSubmitScore" class="btn bg-info-subtle text-info waves-effect text-start rounded-pill d-none" style="cursor: pointer;">Submit Feasibility</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Bootstrap Modal -->
<div class="modal fade" id="customCustomerModal" style="backdrop-filter: blur(2px);" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Other Customer Name</h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="newCustomerName" class="form-control" placeholder="Enter your customer name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCustomerName">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    let dataTable;
    let isProcessing = false;
    var filePath = '';
    var physicalPath = '';

    document.addEventListener('DOMContentLoaded', function() {
        initializeDateInputs('startDate', 'endDate');
    });

    async function changeRequirement() {
        let data = $('#selRequirementEdit option:selected').text();
        if (data == 'Other') {
            $('#inpOtherSubjectEdit').prop('disabled', false);
            $('#inpOtherSubjectEdit').focus();
        } else {
            $('#inpOtherSubjectEdit').prop('disabled', true);
        }
    }

    async function changeEditCustomer() {
        const customerInput = $('#inpEditCustomer').val();

        if (customerInput === 'Other') {
            $('#customCustomerModal').modal('show');
            $('#newCustomerName').focus();
            $('#saveCustomerName').off('click').on('click', function() {
                const text = $('#newCustomerName').val();

                if (text) {
                    const select = $('select#inpEditCustomer');
                    if (!select.find(`option[value="${text}"]`).length) {
                        select.append(new Option(text, text));
                    }
                    select.val(text);
                }
                $('#newCustomerName').val('')
                $('#customCustomerModal').modal('hide');
            });
        }
        $('#customCustomerModal').on('hidden.bs.modal', function() {
            $('#newCustomerName').val('');
        })
    }

    function fsSubmit() {
        event.preventDefault();
        let id = $('#inpIdcId').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit Feasibility for get approval?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
        }).then((result) => {
            if (result.isConfirmed) {
                const idc_created_date = dayjs().format("YYYY-MM-DD HH:mm:ss");
                const idc_created_by = '<?php echo $this->session->userdata('sessUsr'); ?>';
                var data = {
                    idc_created_date: idc_created_date,
                    idc_created_by: idc_created_by,
                    sd_id: <?php echo $this->session->userdata('sessDeptId') ?>
                }
                Swal.fire({
                    title: 'Loading...',
                    html: 'Please wait while we submit the data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'feasibility/submit/' + id,
                    data: JSON.stringify(data),
                    dataType: 'json',
                    success: function(data) {
                        Swal.close();
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Submit Feasibility Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Submit Feasibility!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                        var dataTable = $('#tblFS').DataTable();
                        dataTable.ajax.reload(null, false);
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire({
                            html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Submit Feasibility!</p>",
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                    }
                })
                $('#mdlScore').modal('hide');
            }
        })
    }

    function viewEditModal(id) {
        var idc_id_edit = '';
        var inaf_id = '';
        if ($('#mdlEdit').hasClass('show')) {
            $('#mdlEdit').modal('hide');
        }

        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we load the data and initialize the form.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $('#mdlEdit')
            .off('shown.bs.modal')
            .on('shown.bs.modal', function() {
                const modal = $(this);

                new Promise((resolve) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        setTimeout(() => resolve(), 100);
                    })
                    .then(() => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'GET',
                                url: API_URL + 'rfq/' + id,
                                success: function(data) {
                                    if (!data.Error) {
                                        referRFQ(data, '( Edit Form )');
                                        listTablePartNo(data.ir_group_part, 'edit');
                                        resolve(data);
                                        document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button').forEach(element => {
                                            if (element.id == 'btnSaveFS') {
                                                element.disabled = false;
                                            } else {
                                                element.disabled = true;
                                            }
                                        });
                                        $('#edit_form *').css('cursor', 'not-allowed');
                                        $('#btnSaveFS').hide();
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        })
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#mdlEdit').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                    });
            });

        $('#mdlEdit').modal('show');
        $('#mdlEdit').on('hidden.bs.modal', function() {
            filePath = '';
            physicalPath = '';
            const formElements = document.edit_form.querySelectorAll('input, select, button');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
            document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button').forEach(element => element.disabled = false);
            $('#edit_form *').css('cursor', 'pointer');
        });
    }

    async function saveFS(mdt_id) {
        if (isProcessing) return;
        isProcessing = true;

        let chk = await Fs_valid("edit");
        if (!chk) {
            isProcessing = false;
            return;
        }

        let groupPartData = [];
        let hasError = false;

        $('#tblEditBodyPartNo tr:not(:last)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;
            $(this).find('td').each(function() {
                const input = $(this).find('input');
                if (input.length > 0) {
                    if (input.attr('name') !== 'idi_remark') {
                        if (is_empty(input.val())) {
                            form_errValid(input[0], "*Please Enter Value");
                            hasError = true;
                            return false;
                        } else {
                            form_okValid(input[0]);
                        }
                    } else {
                        form_okValid(input[0]);
                    }

                    const inputName = input.attr('name');
                    rowData[inputName] = input.val().trim();
                }
            });
            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupPartData.push(rowData);
            }
        });

        const partNo = document.querySelector('input[id="inpPartNo"]');
        const partName = document.querySelector('input[id="inpPartName"]');
        const model = document.querySelector('input[id="inpModel"]');

        const fields = [{
                element: partNo,
                message: '*Please Enter Part No.'
            },
            {
                element: partName,
                message: '*Please Enter Part Name'
            },
            {
                element: model,
                message: '*Please Enter Model'
            }
        ];

        const allEmpty = fields.every(field => is_empty(field.element.value.trim()));

        if (!allEmpty) {
            fields.forEach(field => {
                if (is_empty(field.element.value.trim())) {
                    form_errValid(field.element, field.message);
                    hasError = true;
                } else {
                    form_okValid(field.element);
                }
            });
        } else {
            fields.forEach(field => {
                form_defaultValid(field.element);
            });
        }

        if (hasError) {
            isProcessing = false;
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Save Feasibility?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it.!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we submit the data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                var edit_form = {};
                let groupCheckBoxAttn = [];
                document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button').forEach(element => element.disabled = false);
                $('#edit_form').serializeArray().forEach(function(item) {
                    if (item.name == 'idi_item_name' || item.name == 'idi_item_no' || item.name == 'idi_model' || item.name == 'idi_remark') {
                        return;
                    }
                    if (item.name == 'idc_customer_type' || item.name == 'mds_id' || item.name == 'mde_id' || item.name == 'idc_project_life' || item.name == 'idc_refer_doc' || item.name == 'idc_plant_cd') {
                        item.value = parseInt(item.value)
                    }
                    edit_form[item.name] = item.value;
                });

                groupPartData.forEach(item => {
                    if (item.hasOwnProperty('idi_id')) {
                        item.idi_id = parseInt(item.idi_id, 10);
                    }
                });

                if (is_empty(edit_form['idc_subject_note'])) {
                    edit_form['idc_subject_note'] = '';
                }

                if (is_empty(edit_form['idc_enclosures_note'])) {
                    edit_form['idc_enclosures_note'] = '';
                }

                edit_form["idc_updated_date"] = getTimeNow();
                edit_form["idc_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                edit_form["idc_result_confirm"] = 0;
                edit_form["idc_status"] = 1;
                edit_form["idc_issue_year"] = "<?php echo date('Y') ?>";
                edit_form["idc_issue_month"] = "<?php echo date('m') ?>";
                edit_form["idc_issue_seq_no"] = "0";

                edit_form["idc_issue_date"] = '';
                edit_form["idc_reply_date"] = '';
                edit_form["idc_file_path"] = '';
                edit_form["idc_physical_path"] = '';
                edit_form["idc_cancel_reason"] = '';

                edit_form["ir_group_part"] = groupPartData;
                edit_form["idc_running_no"] = '';
                edit_form["idc_id"] = chk;

                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'feasibility/update',
                    data: JSON.stringify(edit_form),
                    success: function(data) {
                        Swal.close();
                        if (data.Error != "null" || data.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Updated Feasibility success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                $('#mdlEdit').modal('hide');
                            })

                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Updated Feasibility!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                $('#mdlEdit').modal('hide');
                            })
                        }
                    }
                });
            } else {
                console.log('Cancel');
            }
        });

        isProcessing = false;
    }

    async function saveNbc() {
        event.preventDefault();
        let idc_id = document.edit_form.idc_id.value;
        let note2 = document.edit_form.idc_note2.value;
        var edit_form = {
            idc_id: parseInt(idc_id),
            idc_note2: note2,
            idc_file_path: filePath,
            idc_physical_path: physicalPath,
            idc_updated_date: getTimeNow(),
            idc_updated_by: "<?php echo $this->session->userdata('sessUsr') ?>"
        };
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Edit NBC?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit it.!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: API_URL + 'nbc/edit',
                    dataType: 'json',
                    contentType: 'application/json',
                    type: 'PUT',
                    data: JSON.stringify(edit_form),
                    success: function(response) {
                        if (response.Error != "null" || response.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Updated NBC success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#mdlEdit').modal('hide');
                                }
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Updated NBC!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#mdlEdit').modal('hide');
                                }
                            })
                        }
                    }
                });
            }
        })
    }

    async function btnTable(type) {
        dataTable
            .columns(5)
            .search(type)
            .draw();
    }

    async function ViewAll() {
        $('#inpImportFrom').prop('selectedIndex', 0);
        $('#inpCustomer').val($('#inpCustomer option:first').val()).trigger('change');
        $('#inpSearchDocNo').val('');
        dataTable
            .search('')
            .columns().search('')
            .draw();
    }

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
                $('#inpEditCustomer').html(option_text);
            }
        })
    }

    function listSubject() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mds',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Select Subject</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.mds_id + '">' + value.mds_name + '</option>';
                })
                $('#selRequirementEdit').html(option_text);
            }
        })
    }

    function listEnclosures() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mde',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Select Enclosures</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.mde_id + '">' + value.mde_name + '</option>';
                })
                $('#inpEnclosuresEdit').html(option_text);
            }
        })
    }

    async function filterData() {
        const elementId = event.target.id
        var customerType = $('#inpImportFrom').val();
        var customerName = $('#inpCustomer').val();
        var docNo = $('#inpSearchDocNo').val();

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
            .columns(1)
            .search(customerType)
            .columns(4)
            .search(customerName)
            .columns(2)
            .search(docNo)
            .draw();
    }

    function showStatus(status, id) {
        if (status == 1) {
            return '<span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>';
        } else if (status == 2) {
            return '<span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>In progress</span>';
        } else if (status == 6) {
            return '<span class="badge text-perple fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #ffafbb !important; color: #C7253E !important"><i class="ti ti-repeat-off fs-4"></i>Rejected</span>';
        } else if (status == 9) {
            return '<span class="badge bg-success-subtle text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-check fs-4"></i>Completed</span>';
        } else if (status == 5) {
            return '<span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>';
        } else {
            return '';
        }
    }

    function showbtnAction(status, id) {
        let btnEdit, btnPreview, btnScore, btnCancle, btnReverse;
        let dept = <?php echo $this->session->userdata('sessDeptId') ?>;
        if (dept == 22) {
            btnEdit = '';
            btnPreview = '';
            btnScore = '';
            btnCancle = '';
            btnReverse = '';
        } else if (dept == 19 || dept == 31 || dept == 41 || dept == 47 || dept == 16 || dept == 20 || dept == 15) {
            btnEdit = 'd-none';
            btnPreview = '';
            btnScore = '';
            btnCancle = 'd-none';
            btnReverse = 'd-none';
        } else {
            btnEdit = 'd-none';
            btnPreview = 'd-none';
            btnScore = 'd-none';
            btnCancle = 'd-none';
            btnReverse = '';
        }

        if (status == 1 || status == 6) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnEdit}" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                    <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnPreview}" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="editScore(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnScore}" data-bs-toggle="tooltip" data-bs-placement="top" title="Score">
                    <i class="ti ti-thumb-up" data-bs-target="#mdlScore" data-bs-toggle="modal"  style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docCancel(${id})" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnCancle}" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                    <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 2) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnEdit}" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="editScore(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnScore}" data-bs-toggle="tooltip" data-bs-placement="top" title="Score">
                    <i class="ti ti-thumb-up" data-bs-target="#mdlScore" data-bs-toggle="modal"  style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnPreview}" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 9) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnEdit}" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="viewEditScore(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Score">
                    <i class="ti ti-numbers" data-bs-target="#mdlScore" data-bs-toggle="modal"  style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnPreview}" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnPreview}" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docReverse(${id})" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnReverse}" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                    <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else {
            return '';
        }
    }

    function docCancel(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel Feasibility?",
            icon: 'warning',
            input: "text",
            inputPlaceholder: "Please fill reason for cancellation.",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const cancelReason = result.value;
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'feasibility/cancel/' + id + '/' + cancelReason + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Cancel Feasibility Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblFS').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Cancel Feasibility!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblFS').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
            }
        })
    }

    function docReverse(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to reverse Feasibility?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reverse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'feasibility/reverse/' + id + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Reverse Feasibility Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblFS').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Reverse Feasibility!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblFS').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
                        }
                    }
                })
            }
        })
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

    async function viewPDF(ir_id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'nbc/' + ir_id,
            success: async function(result) {
                let param = {
                    ...result.data[0]
                };

                let IssueDate = param.idc_created_date.split(" ")[0];
                param.idc_created_date = formatDate(IssueDate);

                let Duedate = param.idc_closing_date.split(" ")[0];
                param.idc_closing_date = formatDate(Duedate);

                let pdfUrl = '<?php echo base_url(); ?>ManageFeasibility/createFeasibilityPDF?' + $.param(param);
                window.open(pdfUrl, '_blank');
            }
        });
    }

    function searchDate() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblFS')) {
            $('#tblFS').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblFS').DataTable({
            ajax: {
                url: API_URL + 'feasibility/table/feasibility/' + stratDate + '/' + endDate,
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
                    data: 'idc_id'
                },
                {
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
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'run_no',
                    "render": function(data, type, row) {
                        if (row.run_no == "null" || row.run_no == "") {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.run_no}')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.run_no}</span>`;
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
                        return showbtnAction(row.idc_status, row.idc_id);
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
    }

    async function referRFQ(data, type) {
        $('#mdlEdit #inpDocNoEdit').val(data.idc_running_no);
        $.ajax({
            url: API_URL + 'rfq/refer_doc/' + data.idc_refer_doc,
            method: 'GET',
            success: function(response) {
                $('#mdlEdit #inpDocNoRefEdit').val(response.Running_no);
            }
        });

        $('#inpIdcIdEdit').val(data.idc_id);

        const selectCus = document.querySelectorAll('select[name="idc_customer_type"]');
        selectCus.forEach(select => {
            select.value = data.idc_customer_type;
        });
        document.querySelector('#select2-inpEditImportFrom-container').textContent = $('#inpEditImportFrom option:selected').text();
        document.querySelector('#select2-inpEditImportFrom-container').setAttribute = ('title', $('#inpEditImportFrom option:selected').text());

        const selectCusName = document.querySelectorAll('select[name="idc_customer_name"]');
        let foundCusName = false;
        selectCusName.forEach(select => {
            select.value = data.idc_customer_name;
            if (select.value == data.idc_customer_name) {
                foundCusName = true;
            }
        });
        if (!foundCusName && data.idc_customer_name) {
            const newOption = document.createElement('option');
            newOption.value = data.idc_customer_name;
            newOption.textContent = data.idc_customer_name;
            selectCusName.forEach(select => {
                select.appendChild(newOption);
                select.value = data.idc_customer_name;
            });
        }
        document.querySelector('#select2-inpEditCustomer-container').textContent = $('#inpEditCustomer option:selected').text();
        document.querySelector('#select2-inpEditCustomer-container').setAttribute = ('title', $('#inpEditCustomer option:selected').text());

        const selectSubject = document.querySelectorAll('select[name="mds_id"]');
        selectSubject.forEach(select => {
            select.value = data.mds_id;
        });
        $('select[name="mds_id"]').val(data.mds_id).trigger('change');

        const isOtherSelected = $('#selRequirementEdit option:selected').text() === 'Other';
        $('#inpOtherSubjectEdit').prop('disabled', !isOtherSelected);
        $('#inpOtherSubjectEdit').val(isOtherSelected ? data.idc_subject_note : '');
    }

    async function listTablePartNo(data, type) {
        let html = '';
        if (type == 'view') {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td>' + data[i].idi_item_no + '</td>';
                html += '<td>' + data[i].idi_item_name + '</td>';
                html += '<td>' + data[i].idi_model + '</td>';
                html += '<td>' + data[i].idi_remark + '</td>';
                html += '</tr>';
            }
            document.getElementById('tblViewBodyPartNo').innerHTML = html;
        } else {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="hidden" name="idi_id" value="' + data[i].idi_id + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_no" maxlength="50" value="' + data[i].idi_item_no + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_name" maxlength="100" value="' + data[i].idi_item_name + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_model" maxlength="50" value="' + data[i].idi_model + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_remark" maxlength="100" value="' + data[i].idi_remark + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div><button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnDeletePartNo" name="btnDeletePartNo" data-id="' + data[i].idi_id + '"><i class="ti ti-trash-x fs-6"></i></button></td>';
                html += '</tr>';
            }
            html += '<tr>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="hidden" id="inpId" value="0"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartNo" maxlength="50" placeholder="Part No"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartName" maxlength="100" placeholder="Part Name"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpModel" maxlength="50" placeholder="Model"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpRemark" maxlength="100" placeholder="Remark"><span class="invalid-feedback"></span></div></td>';
            html += '<td><button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id=""><i class="ti ti-plus fs-6"></i></button></td>';
            html += '</tr>';
            document.getElementById('tblEditBodyPartNo').innerHTML = html;
        }
    }

    function deletePartNoByItem(event) {
        const button = event.target.closest('button');
        const row = button.closest('tr');
        row.remove();
    }

    function addPartNoByItem(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const partNo = currentRow.querySelector('input[id="inpPartNo"]');
        const partName = currentRow.querySelector('input[id="inpPartName"]');
        const model = currentRow.querySelector('input[id="inpModel"]');
        const remark = currentRow.querySelector('input[id="inpRemark"]');

        if ($('#tblEditBodyPartNo tr').length > 10) {
            Swal.fire({
                html: "<h4>Cannot add more than 10 items.</h4>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            partNo.value = "";
            partName.value = "";
            model.value = "";
            remark.value = "";
            return;
        }
        if (is_empty(partNo.value.trim())) {
            form_errValid(partNo, '*Plase Enter Part No.');
            return;
        } else {
            form_okValid(partNo);
            if (is_empty(partName.value.trim())) {
                form_errValid(partName, '*Plase Enter Part Name');
                return;
            } else {
                form_okValid(partName);
                if (is_empty(model.value.trim())) {
                    form_errValid(model, '*Plase Enter Model');
                    return;
                } else {
                    form_okValid(model);
                }
            }
        }

        form_defaultValid(partNo);
        form_defaultValid(partName);
        form_defaultValid(model);

        const tbody = document.getElementById('tblEditBodyPartNo');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td><div class="col"><input class="form-control text-center" type="hidden" name="idi_id" value="0"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_no" value="${partNo.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_name" value="${partName.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_model" value="${model.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_remark" value="${remark.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td>
            <button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm">
                <i class="ti ti-trash-x fs-6"></i>
            </button>
        </td>`;
        tbody.insertBefore(newRow, currentRow);

        currentRow.querySelector('input[placeholder="Part No"]').value = '';
        currentRow.querySelector('input[placeholder="Part Name"]').value = '';
        currentRow.querySelector('input[placeholder="Model"]').value = '';
        currentRow.querySelector('input[placeholder="Remark"]').value = '';

        tbody.appendChild(currentRow);
    }

    function editModal(id) {
        var idc_id_edit = '';
        var inaf_id = '';
        if ($('#mdlEdit').hasClass('show')) {
            $('#mdlEdit').modal('hide');
        }

        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we load the data and initialize the form.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $('#mdlEdit')
            .off('shown.bs.modal')
            .on('shown.bs.modal', function() {
                const modal = $(this);

                new Promise((resolve) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        setTimeout(() => resolve(), 100);
                    })
                    .then(() => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'GET',
                                url: API_URL + 'rfq/' + id,
                                success: function(data) {
                                    if (!data.Error) {
                                        document.getElementById('inpEditIdcId').value = data.idc_id;
                                        referRFQ(data, '( Edit Form )');
                                        listTablePartNo(data.ir_group_part, 'edit');
                                        resolve(data);
                                        if (data.idc_refer_doc == 0 || data.idc_refer_doc == null || data.idc_refer_doc == '') {
                                            document.getElementById('btnSaveFS').disabled = false;
                                        } else {
                                            document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button').forEach(element => {
                                                if (element.id == 'btnSaveFS') {
                                                    element.disabled = false;
                                                } else {
                                                    element.disabled = true;
                                                }
                                            });
                                        }
                                        idc_id_edit = $('#inpIdcIdEdit').val();
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        })
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#mdlEdit').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                    });
            });

        $('#mdlEdit').modal('show');
        $('#mdlEdit').on('hidden.bs.modal', function() {
            filePath = '';
            physicalPath = '';
            const formElements = document.edit_form.querySelectorAll('input, select, button');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
            document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button').forEach(element => element.disabled = false);
        });
    }

    function scoreChange(event) {
        const scoreInput = event.target;
        let score = parseFloat(scoreInput.value);

        if (isNaN(score)) {
            score = 0;
        }

        if (score < 0) {
            scoreInput.value = 0;
        } else if (score > 5) {
            scoreInput.value = 5;
        }

        scoreInput.classList.remove('bg-success-subtle', 'border-success-subtle', 'bg-warning-subtle', 'border-warning-subtle');
        if (score > 0) {
            scoreInput.classList.add('bg-success-subtle', 'border-success-subtle');
        } else {
            scoreInput.classList.add('bg-warning-subtle', 'border-warning-subtle');
        }
    }

    async function saveScore(ifs_id, idc_id) {
        const inpScore = document.querySelector(`#inpScore_${ifs_id}`).value;
        const inpComment = document.querySelector(`#inpComment_${ifs_id}`).value;
        const inpWeight = document.querySelector(`#inpWeight_${ifs_id}`).textContent;
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save score?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!',
        }).then((result) => {
            if (result.isConfirmed) {
                var data_score = {
                    "idc_id": idc_id,
                    "ifs_id": ifs_id,
                    "mcip_weight": inpWeight,
                    "ifs_score": inpScore,
                    "ifs_comment": inpComment,
                    "ifs_updated_date": getTimeNow(),
                    "ifs_updated_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                };
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'feasibility/saveScore',
                    data: JSON.stringify(data_score),
                    success: function(data) {
                        if (data != false) {
                            var dataTable = $('#tblFS').DataTable();
                            dataTable.ajax.reload(null, false);
                            $('#mdlScore').modal('hide');
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Save Score success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(() => {
                                editScore(idc_id);
                            });
                        } else {
                            var dataTable = $('#tblFS').DataTable();
                            dataTable.ajax.reload(null, false);
                            $('#mdlScore').modal('hide');
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Save Score!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(() => {
                                editScore(idc_id);
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        })
    }

    async function editScore(id) {
        let idc_id;
        if ($('#mdlScore').hasClass('show')) {
            $('#mdlScore').modal('hide');
        }

        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we load the data and initialize the form.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $('#mdlScore')
            .off('shown.bs.modal')
            .on('shown.bs.modal', function() {
                const modal = $(this);

                new Promise((resolve) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        setTimeout(() => resolve(), 100);
                    })
                    .then(() => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'GET',
                                url: API_URL + 'feasibility/' + id,
                                success: function(data) {
                                    $('#inpIdcId').val(data.idc_id);
                                    if (!data.Error) {
                                        $('#inpDocNoEditScore').val(data.idc_running_no);
                                        $('#inpDocNoRefEditScore').val(data.run_no === 'null' || data.run_no === '' ? '-' : data.run_no);
                                        $.ajax({
                                            method: 'GET',
                                            url: API_URL + 'feasibilityItem/' + data.idc_id,
                                            success: async function(response) {
                                                let html = '';
                                                let allStatusValid = true;
                                                let userDept = '<?php echo $this->session->userdata('sessDeptId') ?>';
                                                const scoreTotal = await $.ajax({
                                                    type: 'GET',
                                                    url: API_URL + 'feasibility/totalScore/' + data.idc_id,
                                                });
                                                if (userDept == 41 || userDept == 47 || userDept == 20) {
                                                    allStatusValid = false;
                                                }
                                                response.forEach(item => {
                                                    const isMyDept = item.sd_id === <?php echo $this->session->userdata('sessDeptId') ?>;

                                                    let bgTr = '';
                                                    let btnNone = 'd-none';
                                                    let disabled = 'disabled';

                                                    if (isMyDept) {
                                                        btnNone = '';
                                                        disabled = '';

                                                        if (item.ifs_status == 0) {
                                                            allStatusValid = false;
                                                        } else if (item.ifs_status == 2) {
                                                            btnNone = 'd-none';
                                                            bgTr = `style="background-color: #bfbfbf61;"`;
                                                            allStatusValid = false;
                                                        } else if (item.ifs_status == 9) {
                                                            btnNone = 'd-none';
                                                            bgTr = `style="background-color: #9aff713d;"`;
                                                        }else if (item.ifs_status == 6) {
                                                            bgTr = `style="background-color:rgba(255, 113, 113, 0.24);"`;
                                                        }
                                                    }
                                                    const scoreClass = parseInt(item.ifs_score) > 0 ? 'bg-success-subtle border-success-subtle' : 'bg-warning-subtle border-warning-subtle';
                                                    const weightedScore = item.mcip_weight * (item.ifs_score || 0);
                                                    html += `<tr ${bgTr}>
                                                                <td class="text-center" id="inpWeight_${item.ifs_id}">${item.mcip_weight}</td>
                                                                <td class="text-center">
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm ${scoreClass}" onchange="scoreChange(event)" type="number" value="${item.ifs_score || 0}" max="5" min="0" id="inpScore_${item.ifs_id}" ${disabled}>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">${weightedScore}</td>
                                                                <td class="text-center">${item.mci_name}</td>
                                                                <td class="text-center">
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" value="${item.ifs_comment || ''}" maxlength="60" id="inpComment_${item.ifs_id}" ${disabled}>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">${item.sd_dept_aname}</td>
                                                                <td class="text-center">
                                                                    <button type="button" onclick="saveScore(${item.ifs_id}, ${data.idc_id})" class="btn mb-1 btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm ${btnNone}" ${disabled}>
                                                                        <i class="ti ti-device-floppy fs-6"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>`;
                                                });

                                                $('#tblBodyScore').html(html);
                                                $('#total_score').text(scoreTotal);
                                                if (scoreTotal >= 90 && scoreTotal <= 100) {
                                                    $('#green_score').addClass('bg-dark');
                                                } else if (scoreTotal >= 70 && scoreTotal <= 89) {
                                                    $('#yellow_score').addClass('bg-dark');
                                                } else {
                                                    $('#red_score').addClass('bg-dark');
                                                }

                                                if (allStatusValid) {
                                                    $('#btnSubmitScore').removeClass('d-none');
                                                } else {
                                                    $('#btnSubmitScore').addClass('d-none');
                                                }
                                            }
                                        });
                                        resolve(data);
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        })
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#mdlScore').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                    });
            });

        $('#mdlScore').modal('show');
        $('#mdlScore').on('hidden.bs.modal', function() {
            $('#tblBodyScore').html('');
            $('#green_score').removeClass('bg-dark');
            $('#yellow_score').removeClass('bg-dark');
            $('#red_score').removeClass('bg-dark');
            $('#inpIdcId').val('');
        });
    }

    async function viewEditScore(id) {
        let idc_id;
        if ($('#mdlScore').hasClass('show')) {
            $('#mdlScore').modal('hide');
        }

        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we load the data and initialize the form.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $('#mdlScore')
            .off('shown.bs.modal')
            .on('shown.bs.modal', function() {
                const modal = $(this);

                new Promise((resolve) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        setTimeout(() => resolve(), 100);
                    })
                    .then(() => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'GET',
                                url: API_URL + 'feasibility/' + id,
                                success: function(data) {
                                    idc_id = data.idc_id;
                                    if (!data.Error) {
                                        $('#inpDocNoEditScore').val(data.idc_running_no);
                                        $('#inpDocNoRefEditScore').val(data.run_no === 'null' || data.run_no === '' ? '-' : data.run_no);
                                        $.ajax({
                                            method: 'GET',
                                            url: API_URL + 'feasibilityItem/' + data.idc_id,
                                            success: async function(response) {
                                                let html = '';
                                                let allStatusValid = true;
                                                const scoreTotal = await $.ajax({
                                                    type: 'GET',
                                                    url: API_URL + 'feasibility/totalScore/' + data.idc_id,
                                                });
                                                response.forEach(item => {
                                                    if (item.ifs_status != 1) {
                                                        allStatusValid = false;
                                                    }
                                                    const isEditable = item.sd_id === <?php echo $this->session->userdata('sessDeptId') ?>;
                                                    const disabled = isEditable ? '' : 'disabled';
                                                    const btnNone = isEditable ? '' : 'd-none';
                                                    const scoreClass = item.ifs_score ? 'bg-success-subtle border-success-subtle' : 'bg-warning-subtle border-warning-subtle';
                                                    const weightedScore = item.mcip_weight * (item.ifs_score || 0);
                                                    html += `<tr>
                                                                <td class="text-center" id="inpWeight_${item.ifs_id}">${item.mcip_weight}</td>
                                                                <td class="text-center">
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm ${scoreClass}" onchange="scoreChange(event)" type="number" value="${item.ifs_score || 0}" max="5" min="0" id="inpScore_${item.ifs_id}" readonly>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">${weightedScore}</td>
                                                                <td class="text-center">${item.mci_name}</td>
                                                                <td class="text-center">
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" value="${item.ifs_comment || ''}" maxlength="60" id="inpComment_${item.ifs_id}" readonly>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">${item.sd_dept_aname}</td>
                                                                <td class="text-center">
                                                                    <button type="button" onclick="saveScore(${item.ifs_id}, ${data.idc_id})" class="btn mb-1 btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm d-none">
                                                                        <i class="ti ti-device-floppy fs-6"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>`;
                                                });
                                                $('#tblBodyScore').html(html);
                                                $('#total_score').text(scoreTotal);
                                                if (scoreTotal >= 90 && scoreTotal <= 100) {
                                                    $('#green_score').addClass('bg-dark');
                                                } else if (scoreTotal >= 70 && scoreTotal <= 89) {
                                                    $('#yellow_score').addClass('bg-dark');
                                                } else {
                                                    $('#red_score').addClass('bg-dark');
                                                }
                                                $('#btnSubmitScore').addClass('d-none');
                                            }
                                        });
                                        resolve(data);
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        })
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#mdlScore').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                    });
            });

        $('#mdlScore').modal('show');
        $('#mdlScore').on('hidden.bs.modal', function() {
            $('#tblBodyScore').html('');
            $('#green_score').removeClass('bg-dark');
            $('#yellow_score').removeClass('bg-dark');
            $('#red_score').removeClass('bg-dark');
        });
    }

    $(document).ready(function() {
        listCustomer();
        listSubject();
        listEnclosures();
        $('#inpCustomer').select2();
        $('.select2-container--default .select2-selection--single, .select2-container--default .select2-selection__rendered').css({
            'height': '30px',
            'line-height': '30px',
            'font-size': '12px',
        });
        $('.select2-container--default .select2-selection__arrow').css({
            'height': '35px',
            'line-height': '35px',
        });

        $(document).on('click', function(e) {
            document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
                const popover = bootstrap.Popover.getInstance(el);
                if (popover && !el.contains(e.target) && !document.querySelector('.popover')?.contains(e.target)) {
                    popover.hide();
                }
            });
        });

        if ($.fn.DataTable.isDataTable('#tblFS')) {
            $('#tblFS').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblFS').DataTable({
            ajax: {
                url: API_URL + 'feasibility/table/feasibility/' + stratDate + '/' + endDate,
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
                    data: 'idc_id'
                },
                {
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
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'run_no',
                    "render": function(data, type, row) {
                        if (row.run_no == "null" || row.run_no == "") {
                            disp = '-';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.run_no}')" data-bs-toggle="modal" data-bs-target="#mdlReferRfq">${row.run_no}</span>`;
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
                                let img_error = '<?=base_url()?>'+'assets/images/logos/user-3.png';
                                let emp_code = row.idc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null; this.src=\'' + img_error + '\'">' +
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
                        return showbtnAction(row.idc_status, row.idc_id);
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