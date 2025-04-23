<title>CRM | Manage RFQ Document</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage RFQ Document</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage RFQ</li>
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
                        <h4 class="mb-3">RFQ Document List</h4>
                        <div class="row" style="padding: 15px;">
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
                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input RFQ No." onkeyup="filterData()"></input>
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
                                <table id="tblRFQ" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Customer Type</th>
                                            <th class="text-center">Document No.</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Item Info.</th>
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

<!-- Modal for View RFQ Group Part No-->
<div class="modal fade" id="mdlPartNo" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header d-flex flex-wrap gap-3">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNo" name="ir_doc_no" value="" placeholder="RFQ Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRef" name="ir_doc_no_ref" value="" placeholder="Ref RFQ Document No." disabled>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="mb-4" id="myLargeModalLabel">Item Information</h5>
                <table class="dataTable table table-bordered text-wrap align-middle" style="width: 100%;" id="tblPartNo">
                    <thead class="fw-semibold">
                        <tr>
                            <th>No.</th>
                            <th>Part No.</th>
                            <th>Part Name</th>
                            <th>Model</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody id="bodyPartNo">

                    </tbody>
                </table>
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

<!-- Modal for Edit RFQ -->
<div class="modal fade" id="mdlEdit" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex flex-wrap gap-3 mt-3">
                <div class="d-flex align-items-center flex-grow-1 me-2">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoEdit" name="idc_running_no_edit" value="" placeholder="RFQ Document No." disabled>
                </div>
                <div class="d-flex align-items-center flex-grow-1">
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">Refer RFQ Document No.</label>
                    <input type="text" class="form-control flex-grow-1 shadow-sm" id="inpDocNoRefEdit" name="idc_refer_doc_edit" value="" placeholder="Ref RFQ Document No." disabled>
                </div>
            </div>
            <div class="modal-body">
                <div class="datatables">
                    <!-- basic table -->
                    <form id="edit_form" name="edit_form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <!------------------------------------------------------ Section 1  -------------------------------------------------------->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7">
                                                <h4 class="fs-5 fw-semibold">Section 1 : General Information</h4>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <!-------------------------- Attn. ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center" name="attn_group">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Attn. :</h4>
                                                </div>
                                                <input type="hidden" class="form-control me-2" name="idc_id" id="inpIdcIdEdit">
                                                <?php
                                                $option_topic = $this->ManageBackend->list_option("option/list_attn");
                                                foreach ($option_topic as $topic) {
                                                    echo '<div class="col-md-2">';
                                                    echo '<input type="checkbox" class="form-check-input me-2" name="ir_attn[]" id="' . $topic['mda_id'] . '" required>';
                                                    echo '<label class="form-check-label fw-semibold" for="inpAttn' . $topic['mda_id'] . '">' . $topic['mda_name'] . ' Dept</label>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                            <span class="invalid-feedback"></span>

                                            <!-------------------------- Customer ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
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

                                            <!-------------------------- Subject ---------------------------->
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

                                            <!-------------------------- Enclosures ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Enclosures :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <div class="col">
                                                        <select name="mde_id" id="inpEnclosuresEdit" onchange="changeEnclosures()" class="select2 form-select"></select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="idc_enclosures_note" id="inpOtherEnclosuresEdit" class="form-control" placeholder="Other Enclosures ..." disabled>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-------------------------- Note ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="idc_note1" class="form-control" rows="4" id="inpNoteEdit" maxlength="200"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Comment / Additional  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="idc_note2" class="form-control" rows="4" id="inpCommentEdit" maxlength="200"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Closeing Date  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-3 gap-5">
                                                    <input type="date" class="form-control" id="inpDuedateEdit" name="idc_closing_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Phase :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-5 gap-5">
                                                    <select class="form-select" id="inpPlantCd" name="idc_plant_cd">
                                                        <option value="51">Phase 10 (HO)</option>
                                                        <option value="52">Phase 8 (Branch No. 1)</option>
                                                    </select>
                                                    <span class="col-auto invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!------------------------------------------------------ Section 2  -------------------------------------------------------->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 2 : Item Information</h4>
                                                <span>( Max 10 Items )</span>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <!----------- Table Part No.  ------------>
                                            <div class="table-responsive mb-5">
                                                <table class="table table-hover text-wrap mb-0 align-middle table-b text-center bg-info-subtle border rounded shadow-sm" id="tblPartNoEdit">
                                                    <thead class="text-dark fs-4">
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
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Action</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border-top text-wrap bg-white" id="tblEditBodyPartNo">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                            <div class="row" style="padding: 15px;">
                                                <div class="col-md-7">
                                                    <h4 class="fs-5 fw-semibold">Section 3 : Volume Information</h4>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 15px;">

                                                <!-------------------------- Project Life ---------------------------->
                                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                    <div class="d-flex col-md-4 align-items-center">
                                                        <label for="" class="col-md-auto form-label fw-semibold me-3">Project Life :</label>
                                                        <div class="col-md-6 me-3">
                                                            <input type="number" min="1" max="10" class="form-control" id="inpProjectLifeEdit" name="idc_project_life" onchange="changeProLife()" placeholder="Enter Number ..." value="1">
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <label for="" class="col form-label fw-semibold">Years</label>
                                                    </div>

                                                    <div class="d-flex col-md-4 align-items-center">
                                                        <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                                        <div class="col">
                                                            <select class="select2 form-select" name="idc_project_start" id="inpProTim" onchange="changeProLife()">
                                                                <?php
                                                                echo '<option value="">Choose Year ...</option>';
                                                                $year_cur = (int)date('Y');
                                                                $year_end = $year_cur + 20;
                                                                for ($i = $year_cur; $i <= $year_end; $i++) {
                                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <!----------- Table Project Life  ------------>
                                                    <div class="table-responsive border rounded mb-3 shadow-sm" style="overflow-x: auto;">
                                                        <table class="table table-bordered text-wrap mb-0 align-middle text-center" id="tblProjectLifeEdit">
                                                            <thead class="text-dark fs-4">
                                                                <tr>
                                                                    <th class="border-bottom-0 align-middle" rowspan="2">
                                                                        <h6 class="fw-semibold mb-0">No.</h6>
                                                                    </th>
                                                                    <th class="border-bottom-0 align-middle" rowspan="2">
                                                                        <h6 class="fw-semibold mb-0">Part No.</h6>
                                                                    </th>
                                                                    <th class="border-bottom-0 align-middle" id="tlbHeadProjectLifeEdit">
                                                                        <h6 class="fw-semibold mb-0">Year/Volume</h6>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="border-top text-wrap" id="tblBodyProjectLifeEdit">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                        <button type="button" class="btn bg-success-subtle text-success card-hover" id="btnSaveChange"><i class="ti ti-download me-2" style="font-size: 20px;"></i>Save Change</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Zero Configuration -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-warning-subtle text-warning waves-effect text-start" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="view_pdf_file">
    <div class="modal-dialog modal-xl mt-3 mb-0">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <span class="exit float-right"><i class="fa fa-times"></i></span>
                <div id="view_pdf_content"></div>
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
    var groupPartData = [];
    let dataTable;
    let isProcessing = false;

    document.addEventListener('DOMContentLoaded', function() {
        initializeDateInputs('startDate', 'endDate');
    });

    function checkPartNo(event) {
        event.preventDefault();
        const input = event.target;
        const row = input.closest('tr');
        const tbody = row.parentElement;
        const rowIndex = Array.from(tbody.querySelectorAll('tr')).indexOf(row);

        const targetRow = document.querySelectorAll('#tblBodyProjectLifeEdit tr')[rowIndex];
        if (targetRow) {
            const partNoTd = targetRow.querySelector('td[name="part_no"]');
            if (partNoTd) {
                partNoTd.innerText = input.value;
            }
        }
        if (rowIndex >= 0 && rowIndex < groupPartData.length) {
            groupPartData[rowIndex].idi_item_no = input.value;
        }
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
        const checkboxesAttn = document.querySelectorAll('input[name="ir_attn[]"]');
        checkboxesAttn.forEach(checkbox => {
            checkbox.checked = false;
        });
        data.idat_item.forEach(id => {
            checkboxesAttn.forEach(checkbox => {
                if (checkbox.id === id) {
                    checkbox.checked = true;
                }
            });
        });

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

        const isOtherSelected = $('#selRequirementEdit option:selected').text() === 'Other';
        $('#inpOtherSubjectEdit').prop('disabled', !isOtherSelected);
        $('#inpOtherSubjectEdit').val(isOtherSelected ? data.idc_subject_note : '');

        const selectEnclosures = document.querySelectorAll('select[name="mde_id"]');
        selectEnclosures.forEach(select => {
            select.value = data.mde_id;
        });
        const isOtherEnclosures = $('#inpEnclosuresEdit option:selected').text() === 'Other';
        $('#inpOtherEnclosuresEdit').prop('disabled', !isOtherEnclosures);
        $('#inpOtherEnclosuresEdit').val(isOtherEnclosures ? data.idc_enclosures_note : '');

        $('#inpNoteEdit').val(data.idc_note1);
        $('#inpCommentEdit').val(data.idc_note2);
        $('#inpDuedateEdit').val(data.idc_closing_date);

        const selectPlant = document.querySelectorAll('select[name="idc_plant_cd"]');
        selectPlant.forEach(select => {
            select.value = data.idc_plant_cd;
        });

        await listTablePartNo(data.ir_group_part, 'edit');

        $('#inpProjectLifeEdit').val(data.idc_project_life);
        const selectProgramStart = document.querySelectorAll('select[name="idc_project_start"]');
        selectProgramStart.forEach(select => {
            select.value = data.idc_project_start;
        });

        $('#tblProjectLifeEdit thead tr:not(:first-child)').remove();
        $('#tlbHeadProjectLifeEdit').attr('colspan', 0);
        document.querySelector('#tblBodyProjectLifeEdit').innerHTML = '';

        if (!is_empty(document.getElementById('inpProjectLifeEdit').value) && !is_empty(document.getElementById('inpProTim').value)) {
            $('#tlbHeadProjectLifeEdit').attr('colspan', document.getElementById('inpProjectLifeEdit').value + 1);
            let html = '<tr>';
            let year = parseInt(document.getElementById('inpProTim').value, 10);
            for (let i = 0; i <= document.getElementById('inpProjectLifeEdit').value; i++) {
                html += `<th class="border-bottom-0 align-middle">
                    <h6 class="fw-semibold mb-0">${year + i}</h6>
                </th>`;
            }
            html += '</tr>';
            document.querySelector('#tblProjectLifeEdit thead').insertAdjacentHTML('beforeend', html);
            let htmlBody = '';
            for (let i = 0; i < groupPartData.length; i++) {
                htmlBody += `<tr>`;
                htmlBody += `<td>${i+1}</td>`
                htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`
                for (let q = 0; q < groupPartData[i].ir_group_volume.length; q++) {
                    htmlBody += `<td>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                        min="0" max="999999" data-id="${groupPartData[i].ir_group_volume[q].idv_id}"
                                        data-year="${groupPartData[i].ir_group_volume[q].idv_year}" 
                                        placeholder="Please input volume ${groupPartData[i].ir_group_volume[q].idv_year}"
                                        value="${groupPartData[i].ir_group_volume[q].idv_qty}">
                                    <span class="invalid-feedback"></span>
                                </td>`;
                }
                htmlBody += `</tr>`
            }
            document.querySelector('#tblBodyProjectLifeEdit').innerHTML = htmlBody;
        }
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
    async function checkGroupAttn() {
        const checkboxContainers = document.querySelectorAll('[name="attn_group"] input[type="checkbox"]');
        const labelContainers = document.querySelectorAll('[name="attn_group"] label, [name="attn_group"]  h4');
        let isChecked = false;

        labelContainers.forEach(label => label.classList.remove('text-danger'));
        checkboxContainers.forEach(checkbox => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            labelContainers.forEach(label => label.classList.add('text-danger'));
            if (checkboxContainers.length > 0) {
                checkboxContainers[0].focus();
            }
            return false;
        }
        return true;
    }
    async function saveChange(groupPart, groupVolume, mdt_id) {
        if (isProcessing) return;
        isProcessing = true;

        let chkAttn = await checkGroupAttn();
        if (!chkAttn) {
            isProcessing = false;
            return;
        }

        let chk = await Rfq_valid("edit");
        if (!chk) {
            isProcessing = false;
            return;
        }

        form_okValid(document.edit_form.idc_note1);
        form_okValid(document.edit_form.idc_note2);

        if (document.edit_form.idc_project_life.value < 1 || document.edit_form.idc_project_life.value > 10) {
            form_errValid(document.edit_form.idc_project_life, '*Please Enter Number 1-10');
            isProcessing = false;
            return;
        } else {
            form_okValid(document.edit_form.idc_project_life);
        }

        if (is_empty(document.edit_form.idc_project_start.value)) {
            form_errValid(document.edit_form.idc_project_start, '*Please Select Program Timing Info');
            isProcessing = false;
            return;
        } else {
            form_okValid(document.edit_form.idc_project_start);
        }
        isProcessing = false;

        let groupPartData = [];
        let groupVolumeData = [];
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

        if (document.edit_form.idc_project_life.value < 1 || document.edit_form.idc_project_life.value > 10) {
            form_errValid(document.edit_form.idc_project_life, '*Please Enter Project Life 1-10');
            return;
        } else {
            form_okValid(document.edit_form.idc_project_life);
        }

        if (is_empty(document.edit_form.idc_project_start.value)) {
            form_errValid(document.edit_form.idc_project_start, '*Please Select Program Timing Info');
            return;
        } else {
            form_okValid(document.edit_form.idc_project_start);
        }

        let isValid = true;
        $('#tblBodyProjectLifeEdit input[type="number"]').each(function() {
            if ($(this).val().trim() === "" || $(this).val().trim() < 1 || $(this).val().trim() > 999999) {
                form_errValid(this, "*Please Enter Volume 1-999999");
                isValid = false;
                return false;
            } else {
                form_okValid(this);
            }
        });
        if (!isValid) return;

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Edit RFQ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit it.!'
        }).then((result) => {
            if (result.isConfirmed) {
                var edit_form = {};
                let groupCheckBoxAttn = [];
                $('#edit_form').serializeArray().forEach(function(item) {
                    if ($('input[name="' + item.name + '"]').attr('type') === 'checkbox') {
                        return;
                    }
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

                const checkboxesAttn = document.querySelectorAll('input[name="ir_attn[]"]:checked');
                const checkedIdsAttn = Array.from(checkboxesAttn).map(checkbox => checkbox.id);

                groupPartData.forEach(item => {
                    document.querySelectorAll('#tblBodyProjectLifeEdit td[name="part_no"]').forEach(td => {
                        if (td.innerText.trim() === item.idi_item_no) {
                            let tr = td.closest('tr');
                            let inputValues = Array.from(tr.querySelectorAll('input[type="number"]'))
                                .map(input => ({
                                    idv_id: parseInt(input.getAttribute('data-id'), 10),
                                    idv_year: input.getAttribute('data-year'),
                                    idv_qty: input.value.trim()
                                }));
                            item.ir_group_volume = inputValues;
                        }
                    });
                });

                edit_form["idc_updated_date"] = getTimeNow();
                edit_form["idc_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                edit_form["idc_result_confirm"] = 0;
                edit_form["idc_status"] = 1;
                edit_form["idc_issue_year"] = "<?php echo date('Y') ?>";
                edit_form["idc_issue_month"] = "<?php echo date('m') ?>";
                edit_form["idc_issue_seq_no"] = "0";
                edit_form["mdt_id"] = mdt_id;

                edit_form["idc_issue_date"] = '';
                edit_form["idc_reply_date"] = '';
                edit_form["idc_file_path"] = '';
                edit_form["idc_physical_path"] = '';
                edit_form["idc_cancel_reason"] = '';

                edit_form["ir_group_part"] = groupPartData;
                edit_form["idat_item"] = checkedIdsAttn;
                edit_form["idc_running_no"] = '';
                edit_form["idc_id"] = chk;

                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'rfq/edit',
                    data: JSON.stringify(edit_form),
                    success: function(data) {
                        if (data.Error != "null" || data.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Updated RFQ success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            const formElements = document.edit_form.querySelectorAll('input, select, textarea');
                            formElements.forEach(element => {
                                form_defaultValid(element);
                            });
                            $('#edit_form .select2').select2();
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Updated RFQ!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            // $('#mdlEdit').modal('hide');
                        }
                    }
                });
            } else {
                console.log('Cancel');
            }
        });

        isProcessing = false;
    }
    async function changeProLife() {
        let proLife = document.getElementById('inpProjectLifeEdit');
        let proTim = document.getElementById('inpProTim');

        $('#tblProjectLifeEdit thead tr:not(:first-child)').remove();
        $('#tlbHeadProjectLifeEdit').attr('colspan', 0);
        document.querySelector('#tblBodyProjectLifeEdit').innerHTML = '';
        if (groupPartData.length == 0) {
            Swal.fire({
                html: "<h3>Please Insert Item Information</h3>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            form_errValid(document.add_form.idi_item_no, '*Plase Enter Part No.');
            form_errValid(document.add_form.idi_item_name, '*Plase Enter Part Name');
            form_errValid(document.add_form.idi_model, '*Plase Enter Model');
            return;
        }

        if (proLife.value <= 0 || proLife.value > 10) {
            form_errValid(document.getElementById('inpProjectLifeEdit'), "*Please Enter Number 1-10");
            return;
        } else {
            form_okValid(document.getElementById('inpProjectLifeEdit'));
        }

        if (proLife.value > 4) {
            $('#tblProjectLifeEdit').css('min-width', '1800px');
        } else {
            $('#tblProjectLifeEdit').css('min-width', 'auto');
        }

        if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
            $('#tlbHeadProjectLifeEdit').attr('colspan', proLife.value + 1);
            let groupVolume = [];
            let html = '<tr>';
            let year = parseInt(proTim.value, 10);
            for (let i = 0; i <= proLife.value; i++) {
                groupVolume.push({
                    year: year + i
                });
                html += `<th class="border-bottom-0 align-middle">
                    <h6 class="fw-semibold mb-0">${year + i}</h6>
                </th>`;
            }
            html += '</tr>';
            document.querySelector('#tblProjectLifeEdit thead').insertAdjacentHTML('beforeend', html);
            let htmlBody = '';
            for (let i = 0; i < groupPartData.length; i++) {
                htmlBody += `<tr>`;
                htmlBody += `<td>${i+1}</td>`
                htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`
                for (let q = 0; q < groupVolume.length; q++) {
                    htmlBody += `<td>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                        min="0" max="999999" data-id="0" 
                                        data-year="${groupVolume[q % groupVolume.length].year}" 
                                        placeholder="Please input volume ${groupVolume[q % groupVolume.length].year}">
                                    <span class="invalid-feedback"></span>
                                </td>`;
                }
                htmlBody += `</tr>`
            }
            document.querySelector('#tblBodyProjectLifeEdit').innerHTML = htmlBody;
        }
    }
    async function changeRequirement() {
        let data = $('#selRequirementEdit option:selected').text();
        if (data == 'Other') {
            $('#inpOtherSubjectEdit').prop('disabled', false);
            $('#inpOtherSubjectEdit').focus();
        } else {
            $('#inpOtherSubjectEdit').prop('disabled', true);
        }
    }
    async function changeEnclosures() {
        let data = $('#inpEnclosuresEdit option:selected').text();

        if (data == 'Other') {
            $('#inpOtherEnclosuresEdit').prop('disabled', false);
            $('#inpOtherEnclosuresEdit').focus();
        } else {
            $('#inpOtherEnclosuresEdit').prop('disabled', true);
        }
    }
    async function btnTable(type) {
        document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
            const popover = bootstrap.Popover.getInstance(el);
            if (popover) popover.dispose();
        });
        dataTable
            .columns(5)
            .search(type)
            .draw();
    }
    async function ViewAll() {
        document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
            const popover = bootstrap.Popover.getInstance(el);
            if (popover) popover.dispose();
        });
        $('#inpImportFrom').prop('selectedIndex', 0);
        $('#inpCustomer').val($('#inpCustomer option:first').val()).trigger('change');
        $('#inpSearchDocNo').val('');
        dataTable
            .search('')
            .columns().search('')
            .draw();
    }
    async function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Costomer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="Other">Other</option>';
                $('#inpCustomer').html(option_text);
                $('#inpEditCustomer').html(option_text);
            }
        })
    }
    async function listImportfromView(id, type) {
        const url = `${API_URL}option/list_import`;
        const response = await fetch(url);
        const result = await response.json();

        let optionText = '<option value="">Choose Customer Type</option>';
        result.forEach((value) => {
            const selected = value.mif_id === id ? 'selected' : '';
            optionText += `<option value="${value.mif_id}" ${selected}>${value.mif_name}</option>`;
        });

        if (type === 'edit') {
            const formElem = document.querySelector('form[name="edit_form"]');
            if (formElem && formElem.ir_import_tran) {
                formElem.ir_import_tran.innerHTML = optionText;
            }
        } else {
            const formElem = document.querySelector('form[name="view_edit_form"]');
            if (formElem && formElem.ir_import_tran) {
                formElem.ir_import_tran.innerHTML = optionText;
            }
        }
    }
    async function listCustomerView(name, type) {
        const url = 'http://192.168.161.106/etax_invoice_system/api/customers';
        const response = await fetch(url);
        const result = await response.json();

        let optionText = '<option value="">Choose Customer Name</option>';
        let found = false;

        result.forEach((value) => {
            const sel = value.MC_CUST_ANAME === name ? 'selected' : '';
            optionText += `<option value="${value.MC_CUST_ANAME}" ${sel}>${value.MC_CUST_ANAME} &nbsp;( ${value.MC_CUST_CD} )</option>`;

            if (value.MC_CUST_ANAME === name) {
                found = true;
            }
        });

        if (!found && name) {
            optionText += `<option value="${name}" selected>${name}</option>;`
        }

        optionText += '<option value="Other">Other</option>';

        const formElem = type === 'edit' ? document.querySelector('form[name="edit_form"]') : document.querySelector('form[name="view_edit_form"]');
        formElem.ir_customer.innerHTML = optionText;
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
            .columns(3)
            .search(customerName)
            .columns(2)
            .search(docNo)
            .draw();
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
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_no" onchange="checkPartNo(event)" maxlength="50" value="' + data[i].idi_item_no + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_name" maxlength="100" value="' + data[i].idi_item_name + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_model" maxlength="50" value="' + data[i].idi_model + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_remark" maxlength="100" value="' + data[i].idi_remark + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div><button type="button" onclick="deleteRow(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnDeletePartNo" name="btnDeletePartNo" data-id="' + data[i].idi_id + '"><i class="ti ti-trash-x fs-6"></i></button></td>';
                html += '</tr>';
                groupPartData.push({
                    idi_item_no: data[i].idi_item_no,
                    idi_item_name: data[i].idi_item_name,
                    idi_model: data[i].idi_model,
                    idi_remark: data[i].idi_remark,
                    ir_group_volume: data[i].ir_group_volume
                });
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

    function addPartNoByItem(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const partNo = currentRow.querySelector('input[id="inpPartNo"]');
        const partName = currentRow.querySelector('input[id="inpPartName"]');
        const model = currentRow.querySelector('input[id="inpModel"]');
        const remark = currentRow.querySelector('input[id="inpRemark"]');

        let proLife = document.getElementById('inpProjectLifeEdit');
        let proTim = document.getElementById('inpProTim');

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
        const rowIndex = Array.from(tbody.querySelectorAll('tr')).length;

        newRow.innerHTML = `
        <td><div class="col"><input class="form-control text-center" type="hidden" name="idi_id" value="0"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_no" maxlength="50" value="${partNo.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_name" maxlength="100" value="${partName.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_model" maxlength="50" value="${model.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_remark" maxlength="100" value="${remark.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td>
            <button type="button" onclick="deleteRow(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm">
                <i class="ti ti-trash-x fs-6"></i>
            </button>
        </td>`;
        tbody.insertBefore(newRow, currentRow);

        if (tbody.appendChild(currentRow)) {
            let html = ``;
            html += `<tr>`;
            html += `<td>${rowIndex}</td>`;
            html += `<td name="part_no">${partNo.value.trim()}</td>`;
            for (let q = 0; q <= parseInt(proLife.value); q++) {
                html += `<td>
                            <input type="number" class="form-control form-control-sm text-center" min="0" max="999999" data-id="0" data-year="${(parseInt(proTim.value) + q)}" placeholder="Please input volume ${(parseInt(proTim.value) + q)}">
                            <span class="invalid-feedback"></span>
                        </td>`;
            }
            html += `</tr>`;
            document.querySelector('#tblBodyProjectLifeEdit').insertAdjacentHTML('beforeend', html);
        }

        groupPartData.push({
            idi_item_no: partNo.value.trim(),
            idi_item_name: partName.value.trim(),
            idi_model: model.value.trim(),
            idi_remark: remark.value.trim()
        });

        currentRow.querySelector('input[placeholder="Part No"]').value = '';
        currentRow.querySelector('input[placeholder="Part Name"]').value = '';
        currentRow.querySelector('input[placeholder="Model"]').value = '';
        currentRow.querySelector('input[placeholder="Remark"]').value = '';

    }

    function deleteRow(event) {
        const table = document.getElementById('tblPartNoEdit').querySelector('tbody');
        const row = event.target.closest('tr');
        const rowIndex = Array.from(table.rows).indexOf(row);

        if (rowIndex !== -1) {
            table.deleteRow(rowIndex);
            if (rowIndex < groupPartData.length) {
                groupPartData.splice(rowIndex, 1);
                document.querySelector('#tblBodyProjectLifeEdit').innerHTML = '';
                let htmlBody = '';
                for (let i = 0; i < groupPartData.length; i++) {
                    htmlBody += `<tr>`;
                    htmlBody += `<td>${i + 1}</td>`;
                    htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`;
                    for (let q = 0; q < groupPartData[i].ir_group_volume.length; q++) {
                        htmlBody += `<td>
                                        <input type="number" class="form-control form-control-sm text-center" 
                                            min="0" max="999999"
                                            data-id="${groupPartData[i].ir_group_volume[q].idv_id}"
                                            data-year="${groupPartData[i].ir_group_volume[q].idv_year}" 
                                            placeholder="Please input volume ${groupPartData[i].ir_group_volume[q].idv_year}"
                                            value="${groupPartData[i].ir_group_volume[q].idv_qty}">
                                        <span class="invalid-feedback"></span>
                                    </td>`;
                    }
                    htmlBody += `</tr>`;
                }
                document.querySelector('#tblBodyProjectLifeEdit').innerHTML = htmlBody;
            } else {
                console.error('Row index out of bounds for groupPartData');
            }
        } else {
            console.error('Invalid row index');
        }
    }
    async function listSubjectView(name, type) {
        const url = `${API_URL}option/list_mrt`;
        const response = await fetch(url);
        const result = await response.json();

        let optionText = '<option value="">Select Subject</option>';
        let found = false;

        result.forEach((value) => {
            const isSelected = value.mrt_name === name;
            optionText += `<option value="${value.mrt_id}" ${isSelected ? 'selected' : ''}>${value.mrt_name}</option>`;
            if (isSelected) found = true;
        });

        const formElem = document.querySelector(type == 'edit' ? 'form[name="edit_form"]' : 'form[name="view_edit_form"]');
        if (!formElem) return;

        if (type !== 'edit') {
            if (!found && name) {
                optionText += '<option value="Other" selected>Other</option>';
                formElem.ir_mrt.innerHTML = optionText;
                formElem.ir_other_mrt.value = name;
                formElem.ir_other_mrt.disabled = false;
            } else {
                optionText += '<option value="Other">Other</option>';
                formElem.ir_mrt.innerHTML = optionText;
                formElem.ir_other_mrt.value = '';
                formElem.ir_other_mrt.disabled = true;
            }
        } else {
            if (!found && name) {
                optionText += '<option value="Other" selected>Other</option>';
                formElem.ir_mrt.innerHTML = optionText;
                formElem.ir_other_mrt.value = name;
                formElem.ir_other_mrt.disabled = false;
            } else {
                optionText += '<option value="Other">Other</option>';
                formElem.ir_mrt.innerHTML = optionText;
                formElem.ir_other_mrt.value = '';
                formElem.ir_other_mrt.disabled = true;
            }
        }
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

    async function listEnclosuresView(name, type) {
        const formElem = document.querySelector(type == 'edit' ? 'form[name="edit_form"]' : 'form[name="view_edit_form"]');
        const element = formElem.ir_enclosures;
        let found = false;

        for (const option of element.options) {
            if (option.value === name) {
                option.selected = true;
                found = true;
                break;
            }
        }

        if (!found) {
            for (const option of element.options) {
                if (option.value === "0") {
                    option.selected = true;
                    formElem.ir_other_enclosures.value = name;
                    formElem.ir_other_enclosures.disabled = false;
                    break;
                }
            }
        } else {
            formElem.ir_other_enclosures.value = '';
            formElem.ir_other_enclosures.disabled = true;
        }
    }

    function editModal(id) {
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
                                        resolve(data);
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        });
                    })
                    .then((data) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        $('#btnSaveChange')
                            .off('click')
                            .on('click', function() {
                                saveChange(data.ir_group_part, data.ir_group_volume, data.mdt_id);
                            });
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
            groupPartData = [];
            const formElements = document.edit_form.querySelectorAll('input, select, textarea');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
        });
    }

    function viewEditModal(id) {
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
                                        referRFQ(data, '( View Only )');
                                        setTimeout(() => {
                                            document.querySelectorAll('#edit_form input, #edit_form select, #edit_form textarea, #edit_form button')
                                                .forEach(element => element.disabled = true);
                                            $('#btnSaveChange').hide();
                                            $('#edit_form *').css('cursor', 'not-allowed');
                                        }, 500);
                                        resolve(data);
                                    } else {
                                        reject(data.Error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    reject('Failed to fetch data.');
                                }
                            });
                        });
                    })
                    .then((data) => {
                        modal.find('select.select2').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        $('#btnSaveChange')
                            .off('click')
                            .on('click', function() {
                                saveChange(data.ir_group_part, data.ir_group_volume, data.mdt_id);
                            });
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
            groupPartData = [];
            const formElements = document.edit_form.querySelectorAll('input, select, textarea');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
            document.querySelectorAll('#edit_form input, #edit_form select,  #edit_form textarea, #edit_form button').forEach(element => element.disabled = false);
            $('#btnSaveChange').show();
            $('#edit_form *').css('cursor', 'pointer');
        });
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

    async function btnFormRfq(sat_name) {
        var btnText = ``;
        if (sat_name == 'Issue') {
            btnText += `<button type="button" class="btn bg-warning-subtle text-warning waves-effect" onclick="return false;">Issue</button>`
        } else if (sat_name == 'Checked') {
            btnText += `<button type="button" class="btn bg-info-subtle text-info waves-effect" onclick="return false;">Check</button>`
        } else if (sat_name == 'Approve') {
            btnText += `<button type="button" class="btn bg-danger-subtle text-danger waves-effect" onclick="return false;">Approve</button>`
        } else if (sat_name == 'Authorize') {
            btnText += ` <button type="button" class="btn bg-success-subtle text-success waves-effect" onclick="return false;">Authorize</button>`
        } else {
            btnText += ``;
        }
        return btnText;
    }

    function modalPartno(id, ir_doc_no, idc_refer_doc) {
        event.preventDefault();
        $('#inpDocNo').val(ir_doc_no);
        $.ajax({
            url: API_URL + 'rfq/refer_doc/' + idc_refer_doc,
            method: 'GET',
            success: function(response) {
                $('#inpDocNoRef').val(response.Running_no);
            }
        });
        if ($.fn.DataTable.isDataTable('#tblPartNo')) {
            $('#tblPartNo').DataTable().destroy();
        }
        let dataTablePartno = $('#tblPartNo').DataTable({
            ajax: {
                url: API_URL + 'view/partno/' + id,
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
                width: "10px",
            }, ],
            bSort: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    className: 'text-center col-1',
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    className: 'text-center',
                    data: 'idi_item_no',
                },
                {
                    className: 'text-center',
                    data: 'idi_item_name',
                },
                {
                    className: 'text-center',
                    data: 'idi_model',
                },
                {
                    className: 'text-center',
                    data: 'idi_remark',
                }
            ]
        });
        dataTablePartno.on('order.dt search.dt', function() {
            let i = 1;
            dataTablePartno.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
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

    async function viewPDF(ir_id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'rfq/' + ir_id,
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
            }
        });
    }

    function rfqCancel(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel RFQ?",
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
                    url: API_URL + 'rfq/cancel/' + id + '/' + cancelReason + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Cancel RFQ Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Cancel RFQ!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
            }
        })
    }

    function genNBC(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Genarate NBC?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const cancelReason = result.value;
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'rfq/nbc/' + id + '/' + userID,
                    success: function(data) {
                        console.log(data);

                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Genarate NBC Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Genarate NBC!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
            }
        })
    }

    function rfqReverse(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to reverse RFQ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reverse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'rfq/reverse/' + id + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Reverse RFQ Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Reverse RFQ!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
            }
        })
    }

    function rfqSubmit(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Do you want to generate another document?',
            html: `
                    <div class="row border-top p-3">
                        <div class="col-md-4 align-items-center border-end" style="border-width: 2px !important; border-color:rgb(186, 203, 250) !important">
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input me-2" id="nbcCheck">
                                <span class="invalid-feedback"></span>
                                <label class="form-check-label fw-semibold text-primary" for="nbcCheck">NBC</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input me-2" id="feasibilityCheck">
                                <span class="invalid-feedback"></span>
                                <label class="form-check-label fw-semibold text-primary" for="feasibilityCheck">Feasibility</label>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="align-items-center">
                                <label class="col-auto me-2 fs-3 fw-semibold d-flex justtify-content-start mb-1 px-1" for="intReplydate">NBC Reply Date:</label>
                                <div class="col-10">
                                    <input type="date" id="intReplydate" name="idc_reply_date" class="form-control form-control-sm" min="<?php echo date('Y-m-d'); ?>">
                                    <span class="invalid-feedback fs-2"></span>
                                </div>
                            </div>
                        </div>
                        <label class="mt-3 fw-semibold fs-4">If you're sure, please click submit for get approval. </lab>
                    </div>
                `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            didOpen: () => {
                setTimeout(() => {
                    const content = document.querySelector('.swal2-html-container');
                    if (content) {
                        content.style.overflowX = 'hidden';
                    }
                }, 100);
            },
            preConfirm: () => {
                const nbcCheck = document.getElementById('nbcCheck').checked;
                const feasibilityCheck = document.getElementById('feasibilityCheck').checked;
                const intReplydate = document.getElementById('intReplydate').value;
                if (nbcCheck && is_empty(intReplydate)) {
                    let inpReply = document.getElementById('intReplydate');
                    form_errValid(inpReply, '*Please select NBC Reply Date.');
                    return false;
                }
                if (!nbcCheck && intReplydate) {
                    let inpReply = document.getElementById('intReplydate');
                    form_errValid(inpReply, '*Please check NBC box.');
                    return false;
                }
                return {
                    nbcCheck,
                    feasibilityCheck,
                    intReplydate
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const nbcCheck = result.value.nbcCheck;
                const feasibilityCheck = result.value.feasibilityCheck;
                const intReplydate = result.value.intReplydate;
                const createDate = dayjs().format("YYYY-MM-DD HH:mm:ss");
                const userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
                var data = {
                    nbcCheck: nbcCheck,
                    feasibilityCheck: feasibilityCheck,
                    intReplydate: intReplydate,
                    createDate: createDate,
                    createBy: userID
                }
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we submit the data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                // console.log(data);
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'rfq/submit/' + id,
                    data: JSON.stringify(data),
                    dataType: 'json',
                    success: function(data) {
                        Swal.close();
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Submit RFQ Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Submit RFQ!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblRFQ').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
            }
        })
    }

    function showStatus(status, id) {
        if (status == 1) {
            return '<span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>';
        } else if (status == 2) {
            return '<span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>Wait Approve</span>';
        } else if (status == 6) {
            return `<span class="badge text-perple fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #ffafbb !important; color: #C7253E !important" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="${id}">
                        <i class="ti ti-repeat-off fs-4"></i>
                        Rejected
                    </span>`;
        } else if (status == 9) {
            return '<span class="badge bg-success-subtle text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-check fs-4"></i>Approved</span>';
        } else if (status == 5) {
            return '<span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>';
        } else {
            return '';
        }
    }

    function showbtnAction(status, id, btnNbc) {
        if (status == 1 || status == 6) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                    <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="rfqSubmit(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                    <i class="ti ti-check" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="rfqCancel(${id})" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                    <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 2) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 9) {
            const display = btnNbc === "true" ? 'd-none' : '';
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="genNBC(${id})" class="${display} btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate NBC">
                    <i class="ti ti-checklist" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="rfqReverse(${id})" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                    <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else {
            return '';
        }
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

    function searchDate() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblRFQ')) {
            document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
                const popover = bootstrap.Popover.getInstance(el);
                if (popover) popover.dispose();
            });
            $('#tblRFQ').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblRFQ').DataTable({
            ajax: {
                url: API_URL + 'rfq/table/RFQ/' + stratDate + '/' + endDate,
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
                    className: 'text-center',
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'idc_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            let disp = '<div class="d-flex justify-content-around gap-1">' +
                                '<button type="button" onclick="modalPartno(\'' + row.idc_id + '\' , \'' + row.idc_running_no + '\', \'' + row.idc_refer_doc + '\')" class="btn bg-secondary-subtle text-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#mdlPartNo"> <i class="ti ti-augmented-reality" style="font-size: 1.5rem !important;"></i></button>' +
                                '</div>';
                            return disp;
                        }
                        return '';
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        const msg_reject = row.reject_message?.trim() ? row.reject_message : "No reason was given for rejection of this document.";
                        return showStatus(row.idc_status, msg_reject);
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
                    data: 'idc_updated_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.idc_updated_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" onerror="this.onerror=null; this.src="assets/images/logo/user-2.png" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.idc_updated_by + '">' + row.idc_updated_by + '</span>' +
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
                        return showbtnAction(row.idc_status, row.idc_id, row.btn_nbc);
                    }
                }
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
            document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
                new bootstrap.Popover(el);
            });
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

        if ($.fn.DataTable.isDataTable('#tblRFQ')) {
            $('#tblRFQ').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblRFQ').DataTable({
            ajax: {
                url: API_URL + 'rfq/table/RFQ/' + stratDate + '/' + endDate,
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
                    className: 'text-center',
                    data: 'idc_running_no',
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'idc_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            let disp = '<div class="d-flex justify-content-around gap-1">' +
                                '<button type="button" onclick="modalPartno(\'' + row.idc_id + '\' , \'' + row.idc_running_no + '\', \'' + row.idc_refer_doc + '\')" class="btn bg-secondary-subtle text-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#mdlPartNo"> <i class="ti ti-augmented-reality" style="font-size: 1.5rem !important;"></i></button>' +
                                '</div>';
                            return disp;
                        }
                        return '';
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_status',
                    "render": function(data, type, row) {
                        const msg_reject = row.reject_message?.trim() ? row.reject_message : "No reason was given for rejection of this document.";
                        return showStatus(row.idc_status, msg_reject);
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
                    data: 'idc_updated_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.idc_updated_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                let img_error = '<?php echo base_url() ?>' + 'assets/images/logos/user-3.png';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" onerror="this.onerror=null; this.src=\'' + img_error + '\'" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.idc_updated_by + '">' + row.idc_updated_by + '</span>' +
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
                        return showbtnAction(row.idc_status, row.idc_id, row.btn_nbc);
                    }
                }
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
            document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
                new bootstrap.Popover(el);
            });
        });
        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 600000);
    });
</script>