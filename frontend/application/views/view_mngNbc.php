<title>CRM | Manage NBC Document</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage NBC Document</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage NBC</li>
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
                        <h4 class="mb-3">NBC Document List</h4>
                        <div class="row border" style="padding: 15px;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;" for="inpImportFrom">Customer Type :</label>
                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpImportFrom" name="ir_import_tran" onchange="filterData()">
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
                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input NBC No." onkeyup="filterData()"></input>
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
                                <table id="tblNBC" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
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
                            <th>Part Remark</th>
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
                    <label class="col-auto fs-5 text-dark fw-semibold me-2" id="myLargeModalLabel">NBC Document No.</label>
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
                                            <!-------------------------- Attn. ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none" name="attn_group">
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
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none">
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

                                            <!-------------------------- Purchase Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none" name="mdpu_group">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Purchase Cost :</h4>
                                                </div>
                                                <?php
                                                $option_topic = $this->ManageBackend->list_option("option/list_mdpu");
                                                foreach ($option_topic as $topic) {
                                                    echo '<div class="col-md-2">';
                                                    echo '<input type="checkbox" class="form-check-input me-2" name="ir_mdpu[]" id="' . $topic['mdpu_id'] . '">';
                                                    echo '<label class="form-check-label fw-semibold" for="inpAttn' . $topic['mdpu_id'] . '">' . $topic['mdpu_name'] . '</label>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                            <span class="invalid-feedback"></span>
                                            <!-------------------------- Process Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none" name="mdpc_group">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Process Cost :</h4>
                                                </div>
                                                <?php
                                                $option_topic = $this->ManageBackend->list_option("option/list_mdpc");
                                                foreach ($option_topic as $topic) {
                                                    if (strlen($topic['mdpc_name']) > 14) {
                                                        echo '<div class="col-md-3">';
                                                        echo '<input type="checkbox" class="form-check-input me-2" name="ir_mdpc[]" id="' . $topic['mdpc_id'] . '">';
                                                        echo '<label class="form-check-label fw-semibold col-auto" for="inpAttn' . $topic['mdpc_id'] . '">' . $topic['mdpc_name'] . '</label>';
                                                        echo '</div>';
                                                    } else {
                                                        echo '<div class="col-md-2">';
                                                        echo '<input type="checkbox" class="form-check-input me-2" name="ir_mdpc[]" id="' . $topic['mdpc_id'] . '">';
                                                        echo '<label class="form-check-label fw-semibold col-auto" for="inpAttn' . $topic['mdpc_id'] . '">' . $topic['mdpc_name'] . '</label>';
                                                        echo '</div>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <span class="invalid-feedback"></span>
                                            <!-------------------------- Note ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 d-none">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="idc_note1" class="form-control" rows="4" id="inpNoteEdit"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Comment / Additional  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 d-none">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                                </div>

                                            </div>

                                            <!-------------------------- Closeing Date  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-3 gap-5">
                                                    <input type="date" class="form-control" id="inpDuedateEdit" name="idc_closing_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="d-flex col-md-12 mb-3 align-items-center d-none">
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

                                            <h4 class="fs-5 fw-semibold me-2">Item Information</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-nowrap align-middle shadow-sm" id="tblPartNo">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
                                                            <th class="border-bottom-0 text-center">
                                                                <h6 class="fw-semibold mb-0">Part No.</h6>
                                                            </th>
                                                            <th class="border-bottom-0 text-center">
                                                                <h6 class="fw-semibold mb-0">Part Name</h6>
                                                            </th>
                                                            <th class="border-bottom-0 text-center">
                                                                <h6 class="fw-semibold mb-0">Model</h6>
                                                            </th>
                                                            <th class="border-bottom-0 text-center">
                                                                <h6 class="fw-semibold mb-0">Remark</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border-top text-wrap bg-white" id="tblEditBodyPartNo">
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row d-flex">
                                                <!-- Volume Information -->
                                                <div class="col-md-6">
                                                    <h4 class="fs-5 fw-semibold me-2">Volume Information</h4>
                                                    <div class="table-responsive border rounded mb-5 shadow-sm">
                                                        <table class="table text-wrap mb-0 align-middle text-center" id="tblProjectLifeEdit">
                                                            <thead class="text-dark fs-4">
                                                                <tr>
                                                                    <th class="border-bottom-0 border-end">
                                                                        <h6 class="fw-semibold mb-0">Year</h6>
                                                                    </th>
                                                                    <th class="border-bottom-0">
                                                                        <h6 class="fw-semibold mb-0">Volume</h6>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="border-top text-wrap" id="tblBodyProjectLifeEdit">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- R&D Note/Comment -->
                                                <div class="col-md-6">
                                                    <h4 class="fs-5 fw-semibold me-2">R&D Note/Comment :</h4>
                                                    <div class="d-flex col-md-12 gap-3 mb-3">
                                                        <textarea name="idc_note2" class="form-control shadow-sm" rows="4" id="inpCommentEdit"></textarea>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <h4 class="fs-5 fw-semibold me-2">R&D Attach File :</h4>
                                                    <div class="container card-hover" style="margin-top: 0.75rem !important;" id="boxFile">
                                                        <input type="file" class="filepond" name="inaf_file" id="file_nbc" />
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="reset" class="btn bg-warning-subtle text-warning waves-effect text-start" data-bs-dismiss="modal" style="cursor: pointer;">Close</button>
                                                    <button type="button" onclick="saveNbc()" id="btnSaveNbc" class="btn bg-success-subtle text-success waves-effect text-start" style="cursor: pointer;">Save NBC</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!------------------------------------------------------ Section 2  -------------------------------------------------------->
                                    <div class="card d-none">
                                        <div class="card-body">
                                            <div class="row" style="padding: 15px;">
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

    function nbcSubmit(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit NBC for get approval?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
        }).then((result) => {
            if (result.isConfirmed) {
                const idc_created_date = '<?php echo date('Y-m-d H:i:s'); ?>';
                const idc_created_by = '<?php echo $this->session->userdata('sessUsr'); ?>';
                var data = {
                    idc_created_date: idc_created_date,
                    idc_created_by: idc_created_by
                }
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'nbc/submit/' + id,
                    data: JSON.stringify(data),
                    dataType: 'json',
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Submit NBC Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblNBC').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Submit NBC!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblNBC').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    }
                })
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

                if (!document.querySelector('#file_nbc')) {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.classList.add('filepond');
                    fileInput.name = 'inaf_file';
                    fileInput.id = 'file_nbc';

                    document.querySelector('#boxFile').appendChild(fileInput);
                }

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
                                        document.querySelectorAll('#edit_form input, #edit_form select, #edit_form textarea').forEach(element => {
                                            element.disabled = true;
                                        });
                                        idc_id_edit = $('#inpIdcIdEdit').val();
                                        $('#edit_form *').css('cursor', 'not-allowed');
                                        $('#btnSaveNbc').hide();
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
                    .then((data) => {
                        const filepond = FilePond.create(document.querySelector('#file_nbc'), {
                            server: {
                                url: '/ManageNbc/UploadFile?idc_id=' + idc_id_edit,
                                process: {
                                    url: '/process',
                                    method: 'POST',
                                    onload: (response) => {
                                        const jsonResponse = JSON.parse(response);
                                        console.log('Upload success');
                                        filePath = jsonResponse.file_path;
                                        physicalPath = jsonResponse.inaf_physical_path;
                                        inaf_id = jsonResponse.insert_id;
                                    },
                                    onerror: (response) => {
                                        console.error('Upload failed:', response);
                                    },
                                },
                                revert: null,
                            },
                            allowRevert: true,
                            instantUpload: false,
                            allowProcess: true,
                            onremovefile: (error, file) => {
                                if (is_empty(filePath)) {
                                    return;
                                } else {
                                    $.ajax({
                                        method: 'POST',
                                        url: '<?php echo base_url(); ?>ManageNbc/RemoveFile',
                                        data: {
                                            filePath: filePath,
                                            inaf_id: inaf_id,
                                            idc_id: idc_id_edit,
                                        },
                                        success: function(data) {
                                            filePath = '';
                                            physicalPath = '';
                                            console.log('Removed success');
                                        }
                                    });
                                }
                            },
                        });

                        if (filepond) {
                            document.querySelector('.filepond--drop-label').classList.add('bg-info-subtle', 'rounded', 'shadow-sm', 'text-info');
                            document.querySelectorAll('.filepond--panel.filepond--panel-root div').forEach(function(div) {
                                div.classList.add('bg-info-subtle', 'rounded', 'shadow-sm', 'text-info');
                            });
                        }
                        if (!is_empty(data.idc_file_path)) {
                            filePath = data.idc_file_path;
                            physicalPath = data.idc_physical_path;
                            filepond.addFile(data.idc_file_path);
                        }
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
            document.querySelector('#boxFile').innerHTML = '';
            // const filepond = FilePond.create();
            // filepond.removeFiles();
            const formElements = document.edit_form.querySelectorAll('input, select, textarea');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
            document.querySelectorAll('#edit_form input, #edit_form select,  #edit_form textarea, #edit_form button').forEach(element => element.disabled = false);
        });
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
            url: 'http://192.168.161.106/etax_invoice_system_debug/api/customers',
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

        if (elementId === "inpCustomer") {
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

    function showbtnAction(status, id, ) {
        if (status == 1 || status == 6) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                    <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="nbcSubmit(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                    <i class="ti ti-check" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docCancel(${id})" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
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
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docReverse(${id})" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
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
                    url: API_URL + 'nbc/cancel/' + id + '/' + cancelReason + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Cancel NBC Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblNBC').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Cancel NBC!</p>",
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

    function docReverse(id) {
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
                    url: API_URL + 'nbc/reverse/' + id + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Reverse NBC Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblNBC').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Reverse NBC!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblNBC').DataTable();
                            dataTable.ajax.reload(null, false);
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
                // console.log(result);

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

                let pdfUrl = '<?php echo base_url(); ?>ManageNbc/createNbcPDF?' + $.param(param);
                window.open(pdfUrl, '_blank');
            }
        });
    }

    function searchDate() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblNBC')) {
            $('#tblNBC').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblNBC').DataTable({
            ajax: {
                url: API_URL + 'nbc/table/NBC/' + stratDate + '/' + endDate,
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
                            disp = '';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.run_no}')">${row.run_no}</span>`;
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
        idc_id_edit = data.idc_id;
        filePath = data.idc_file_path;
        physicalPath = data.idc_physical_path;
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

        const checkboxesIdpu = document.querySelectorAll('input[name="ir_mdpu[]"]');
        checkboxesIdpu.forEach(checkbox => {
            checkbox.checked = false;
        });
        data.idpu_item.forEach(id => {
            checkboxesIdpu.forEach(checkbox => {
                if (checkbox.id === id) {
                    checkbox.checked = true;
                }
            });
        });

        const checkboxesIdpc = document.querySelectorAll('input[name="ir_mdpc[]"]');
        checkboxesIdpc.forEach(checkbox => {
            checkbox.checked = false;
        });
        data.idpc_item.forEach(id => {
            checkboxesIdpc.forEach(checkbox => {
                if (checkbox.id === id) {
                    checkbox.checked = true;
                }
            });
        });

        $('#inpNoteEdit').val(data.idc_note1);
        $('#inpCommentEdit').val(data.idc_note2);
        $('#inpDuedateEdit').val(data.idc_closing_date);

        const selectPlant = document.querySelectorAll('select[name="idc_plant_cd"]');
        selectPlant.forEach(select => {
            select.value = data.idc_plant_cd;
        });

        $('#inpProjectLifeEdit').val(data.idc_project_life);

        const selectProgramStart = document.querySelectorAll('select[name="idc_project_start"]');
        selectProgramStart.forEach(select => {
            select.value = data.idc_project_start;
        });

        const tableProLife = document.getElementById('tblProjectLifeEdit').querySelector('tbody');
        let htmlProLife = '';
        for (i = 0; i < data.ir_group_volume.length; i++) {
            htmlProLife += '<tr>';
            htmlProLife += '<td class="text-center col-6 border-end">' + data.ir_group_volume[i].idv_year + '</td>';
            htmlProLife += '<td class="text-center col-6">' + data.ir_group_volume[i].idv_qty + '</td>';
            htmlProLife += '</tr>';
        }
        tableProLife.innerHTML = htmlProLife;
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
                html += '<td class="text-center">' + data[i].idi_item_no + '</td>';
                html += '<td class="text-center">' + data[i].idi_item_name + '</td>';
                html += '<td class="text-center">' + data[i].idi_model + '</td>';
                html += '<td class="text-center">' + data[i].idi_remark + '</td>';
                html += '</tr>';
            }
            document.getElementById('tblEditBodyPartNo').innerHTML = html;
        }
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

                if (!document.querySelector('#file_nbc')) {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.classList.add('filepond');
                    fileInput.name = 'inaf_file';
                    fileInput.id = 'file_nbc';

                    document.querySelector('#boxFile').appendChild(fileInput);
                }

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
                                        document.querySelectorAll('#edit_form input, #edit_form select, #edit_form textarea').forEach(element => {
                                            if (element.name == 'inaf_file' || element.name == 'idc_note2') {
                                                element.disabled = false;
                                            } else {
                                                element.disabled = true;
                                            }
                                        });
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
                    .then((data) => {
                        const filepond = FilePond.create(document.querySelector('#file_nbc'), {
                            server: {
                                url: '/ManageNbc/UploadFile?idc_id=' + idc_id_edit,
                                process: {
                                    url: '/process',
                                    method: 'POST',
                                    onload: (response) => {
                                        const jsonResponse = JSON.parse(response);
                                        console.log('Upload success');
                                        filePath = jsonResponse.file_path;
                                        physicalPath = jsonResponse.inaf_physical_path;
                                        inaf_id = jsonResponse.insert_id;
                                    },
                                    onerror: (response) => {
                                        console.error('Upload failed:', response);
                                    },
                                },
                                revert: null,
                            },
                            allowRevert: true,
                            instantUpload: false,
                            allowProcess: true,
                            onremovefile: (error, file) => {
                                if (is_empty(filePath)) {
                                    return;
                                } else {
                                    $.ajax({
                                        method: 'POST',
                                        url: '<?php echo base_url(); ?>ManageNbc/RemoveFile',
                                        data: {
                                            filePath: filePath,
                                            inaf_id: inaf_id,
                                            idc_id: idc_id_edit,
                                        },
                                        success: function(data) {
                                            filePath = '';
                                            physicalPath = '';
                                            console.log('Removed success');
                                        }
                                    });
                                }
                            },
                        });

                        if (filepond) {
                            document.querySelector('.filepond--drop-label').classList.add('bg-info-subtle', 'rounded', 'shadow-sm', 'text-info');
                            document.querySelectorAll('.filepond--panel.filepond--panel-root div').forEach(function(div) {
                                div.classList.add('bg-info-subtle', 'rounded', 'shadow-sm', 'text-info');
                            });
                        }
                        if (!is_empty(data.idc_file_path)) {
                            filePath = data.idc_file_path;
                            physicalPath = data.idc_physical_path;
                            filepond.addFile(data.idc_file_path);
                        }
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
            document.querySelector('#boxFile').innerHTML = '';
            // const filepond = FilePond.create();
            // filepond.removeFiles();
            const formElements = document.edit_form.querySelectorAll('input, select, textarea');
            formElements.forEach(element => {
                form_defaultValid(element);
            });
            document.querySelectorAll('#edit_form input, #edit_form select,  #edit_form textarea, #edit_form button').forEach(element => element.disabled = false);
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


        if ($.fn.DataTable.isDataTable('#tblNBC')) {
            $('#tblNBC').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        dataTable = $('#tblNBC').DataTable({
            ajax: {
                url: API_URL + 'nbc/table/NBC/' + stratDate + '/' + endDate,
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
                            disp = '';
                        } else {
                            disp = `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewRfqPDF('${row.run_no}')">${row.run_no}</span>`;
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
        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 600000);
    });
</script>