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
                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpImportFrom" name="ir_import_tran" onchange="filterData()"></select>
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
                                        <input type="date" class="form-control form-control-sm shadow-sm" id="inpIssueDate" onchange="filterData()"></input>
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
                                        <button class="btn btn-sm bg-warning text-white card-hover me-2 shadow-sm" onclick="btnTable('In Progress')">In Progress</button>
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
                                <table id="tblNBC" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-center">No.</th>
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
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                FM-SM-2024-001
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-001</span>
                                            </td>
                                            <td class="text-center">ISUZU Co., Ltd.</td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>
                                            </td>
                                            <td class="text-center">30/11/2024</td>
                                            <td class="text-center">Kyoko</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                                                        <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-center">
                                                FM-SM-2024-002
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-002</span>
                                            </td>
                                            <td class="text-center">MAHLE Co., Ltd..</td>
                                            <td class="text-center">
                                                <span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>
                                            </td>
                                            <td class="text-center">18/12/2024</td>
                                            <td class="text-center">Kantamanee</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                                                        <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                                                        <i class="ti ti-check" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                                                        <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-center">
                                                FM-SM-2024-003
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-003</span>
                                            </td>
                                            <td class="text-center">Kubota Co., Ltd.</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>Wait Approve</span>
                                            </td>
                                            <td class="text-center">20/11/2024</td>
                                            <td class="text-center">Kantamanee</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
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

<!-- Modal for View Edit RFQ -->
<div class="modal fade" id="mdlViewEdit" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning text-white">
                <h4 class="modal-title text-white me-2" id="warning-header-modalLabel"></h4>
                <span class="fs-4">( Read Only )</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="datatables">
                    <!-- basic table -->
                    <form id="view_edit_form" name="view_edit_form">
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
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Attn. :</h4>
                                                </div>
                                                <!-- <input type="hidden" class="form-check-input me-2" name="ir_doc_no" id="inpDocNo"> -->
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pu_dept" id="inpPuDeptView">
                                                    <label class="form-check-label fw-semibold" for="inpPuDeptView">PU Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pe_dept" id="inpPeDeptView">
                                                    <label class="form-check-label fw-semibold" for="inpPeDeptView">PE Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_scm_dept" id="inpScmDeptView">
                                                    <label class="form-check-label fw-semibold" for="inpScmDeptView">SCM Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_ce_dept" id="inpCeDeptView">
                                                    <label class="form-check-label fw-semibold" for="inpCeDeptView">CE Dept.</label>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_gdc_dept" id="inpGdcDeptView">
                                                    <label class="form-check-label fw-semibold" for="inpGdcDeptView">GDC Dept.</label>
                                                </div>
                                            </div>

                                            <!-------------------------- Customer ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <div class="col">
                                                        <select name="ir_import_tran" id="inpImportFromView" class="form-select"></select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <select name="ir_customer" id="inpCustomerView" class=" form-select" onchange=""></select>
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
                                                        <select name="ir_mrt" id="selRequirementView" class="form-select" onchange=""> </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_mrt" id="inpOtherSubjectView" class="form-control" placeholder="Other Subject ..." disabled>
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
                                                        <select name="ir_enclosures" id="inpEnclosuresView" onchange="" class="form-select">
                                                            <option value="">Select Enclosures</option>
                                                            <option value="Drawing">Drawing</option>
                                                            <option value="0">Other</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_enclosures" id="inpOtherEnclosuresView" class="form-control" placeholder="Other Enclosures ..." disabled>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-------------------------- Purchase Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Purchase Cost :</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_raw_puc" id="inpRawMaterialView">
                                                    <label class="form-check-label fw-semibold" for="inpRawMaterialView">Raw material</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMoldView" name="ir_mold_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMoldView">Mold/Die</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMenuFacView" name="ir_menufac_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMenuFacView">Manufacturing</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpTransportView" name="ir_transport_puc">
                                                    <label class="form-check-label fw-semibold" for="inpTransportView">Transportation</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Process Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Process Cost :</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpCastView" name="ir_cast_poc">
                                                    <label class="form-check-label fw-semibold" for="inpCastView">Casting</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMachinView" name="ir_machin_poc">
                                                    <label class="form-check-label fw-semibold" for="inpMachinView">Machining</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpAssemblyView" name="ir_assembly_poc">
                                                    <label class="form-check-label fw-semibold" for="inpAssemblyView">Assembly</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpPackView" name="ir_pack_poc">
                                                    <label class="form-check-label fw-semibold col" for="inpPackView">Packaging and Delivery</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Note ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_note" class="form-control" rows="4" id="inpNoteView"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Comment / Additional  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_comment" class="form-control" rows="4" id="inpCommentView"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Closeing Date  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-3 gap-5">
                                                    <input type="date" class="form-control" id="inpDuedateView" name="ir_duedate" min="" value="">
                                                    <span class="invalid-feedback"></span>
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
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <!----------- Table Part No.  ------------>
                                            <div class="table-responsive mb-5">
                                                <table class="table table-hover text-wrap mb-0 align-middle table-b text-center bg-info-subtle border rounded shadow-sm" id="tblViewPartNo">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border-top text-wrap bg-white" id="tblViewBodyPartNo">
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
                                                            <input type="number" min="1" max="10" class="form-control" id="inpProjectLifeView" name="ir_pro_life" onchange="" placeholder="Enter Number ..." value="1">
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <label for="" class="col form-label fw-semibold">Years</label>
                                                    </div>

                                                    <div class="d-flex col-md-4 align-items-center">
                                                        <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                                        <div class="col">
                                                            <input type="month" class="form-control" id="inpProTimView" name="ir_pro_tim" onchange="">
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <!----------- Table Project Life  ------------>
                                                    <div class="table-responsive border rounded mb-5 shadow-sm">
                                                        <table class="table text-wrap mb-0 align-middle text-center" id="tblViewProjectLife">
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
                                                            <tbody class="border-top text-wrap" id="tblViewBodyProjectLife">
                                                            </tbody>
                                                        </table>
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
                <button type="reset" class="btn bg-warning-subtle text-warning waves-effect text-start" data-bs-dismiss="modal">
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
            <div class="modal-header modal-colored-header bg-warning text-white">
                <h4 class="modal-title text-white me-2" id="warning-header-modalLabel"></h4>
                <span class="fs-4">( Edit Form )</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Attn. :</h4>
                                                </div>
                                                <input type="hidden" class="form-control me-2" name="ir_id" id="inpIrIdEdit">
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pu_dept" id="inpPuDeptEdit">
                                                    <label class="form-check-label fw-semibold" for="inpPuDeptEdit">PU Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pe_dept" id="inpPeDeptEdit">
                                                    <label class="form-check-label fw-semibold" for="inpPeDept">PE Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_scm_dept" id="inpScmDeptEdit">
                                                    <label class="form-check-label fw-semibold" for="inpScmDeptEdit">SCM Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_ce_dept" id="inpCeDeptEdit">
                                                    <label class="form-check-label fw-semibold" for="inpCeDept">CE Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_gdc_dept" id="inpGdcDeptEdit">
                                                    <label class="form-check-label fw-semibold" for="inpGdcDeptEdit">GDC Dept.</label>
                                                </div>
                                            </div>

                                            <!-------------------------- Customer ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <div class="col">
                                                        <select name="ir_import_tran" id="inpEditImportFrom" class="form-select"></select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <select name="ir_customer" id="inpEditCustomer" class="form-select" onchange="changeEditCustomer()"></select>
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
                                                        <select name="ir_mrt" id="selRequirementEdit" class="form-select" onchange="changeRequirement()"> </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_mrt" id="inpOtherSubjectEdit" class="form-control" placeholder="Other Subject ..." disabled>
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
                                                        <select name="ir_enclosures" id="inpEnclosuresEdit" onchange="changeEnclosures()" class="form-select">
                                                            <option value="">Select Enclosures</option>
                                                            <option value="Drawing">Drawing</option>
                                                            <option value="0">Other</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_enclosures" id="inpOtherEnclosuresEdit" class="form-control" placeholder="Other Enclosures ..." disabled>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-------------------------- Purchase Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Purchase Cost :</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_raw_puc" id="inpRawMaterialEdit">
                                                    <label class="form-check-label fw-semibold" for="inpRawMaterialEdit">Raw material</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMoldEdit" name="ir_mold_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMoldEdit">Mold/Die</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMenuFacEdit" name="ir_menufac_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMenuFacEdit">Manufacturing</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpTransportEdit" name="ir_transport_puc">
                                                    <label class="form-check-label fw-semibold" for="inpTransportEdit">Transportation</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Process Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Process Cost :</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpCastEdit" name="ir_cast_poc">
                                                    <label class="form-check-label fw-semibold" for="inpCastEdit">Casting</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMachinEdit" name="ir_machin_poc">
                                                    <label class="form-check-label fw-semibold" for="inpMachinEdit">Machining</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpAssemblyEdit" name="ir_assembly_poc">
                                                    <label class="form-check-label fw-semibold" for="inpAssemblyEdit">Assembly</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpPackEdit" name="ir_pack_poc">
                                                    <label class="form-check-label fw-semibold" for="inpPackEdit">Packaging and Delivery</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Note ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_note" class="form-control" rows="4" id="inpNoteEdit"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Comment / Additional  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_comment" class="form-control" rows="4" id="inpCommentEdit"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Closeing Date  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-3 gap-5">
                                                    <input type="date" class="form-control" id="inpDuedateEdit" name="ir_duedate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                                                    <span class="invalid-feedback"></span>
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
                                                <span>( Max 20 Items )</span>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <!----------- Table Part No.  ------------>
                                            <div class="table-responsive mb-5">
                                                <table class="table table-hover text-wrap mb-0 align-middle table-b text-center bg-info-subtle border rounded shadow-sm" id="tblPartNo">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
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
                                                            <input type="number" min="1" max="10" class="form-control" id="inpProjectLifeEdit" name="ir_pro_life" onchange="changeProLife()" placeholder="Enter Number ..." value="1">
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <label for="" class="col form-label fw-semibold">Years</label>
                                                    </div>

                                                    <div class="d-flex col-md-4 align-items-center">
                                                        <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                                        <div class="col">
                                                            <input type="month" class="form-control" id="inpProTimEdit" name="ir_pro_tim" onchange="changeProLife()">
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <!----------- Table Project Life  ------------>
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
    let dataTable;
    let isProcessing = false;

    // async function saveChange(groupPart, groupVolume) {
    //     if (isProcessing) return;
    //     isProcessing = true;
    //     event.preventDefault();
    //     let chk = await Rfq_valid("edit");

    //     if (!chk) {
    //         isProcessing = false;
    //         return;
    //     }

    //     let groupPartData = [];
    //     let groupVolumeData = [];
    //     let hasError = false;
    //     const formElements = document.edit_form.querySelectorAll('textarea');
    //     formElements.forEach(element => {
    //         form_okValid(element);
    //     });

    //     $('#tblEditBodyPartNo tr:not(:last)').each(function() {
    //         if (hasError) return false;
    //         let rowData = {};
    //         let isValid = true;
    //         $(this).find('td').each(function() {
    //             const input = $(this).find('input');

    //             if (input.length > 0) {
    //                 if (input.attr('name') !== 'irpn_remark') {
    //                     if (is_empty(input.val())) {
    //                         form_errValid(input[0], "*Please Enter Value");
    //                         hasError = true;
    //                         return false;
    //                     } else {
    //                         form_okValid(input[0]);
    //                     }
    //                 } else {
    //                     form_okValid(input[0]);
    //                 }

    //                 const inputName = input.attr('name');
    //                 rowData[inputName] = input.val().trim();
    //             }
    //         });
    //         if (!isValid || hasError) {
    //             return false;
    //         }
    //         if (Object.keys(rowData).length > 0) {
    //             groupPartData.push(rowData);
    //         }
    //     });

    //     const partNo = document.querySelector('input[id="inpPartNo"]');
    //     const partName = document.querySelector('input[id="inpPartName"]');
    //     const model = document.querySelector('input[id="inpModel"]');

    //     const fields = [{
    //             element: partNo,
    //             message: '*Please Enter Part No.'
    //         },
    //         {
    //             element: partName,
    //             message: '*Please Enter Part Name'
    //         },
    //         {
    //             element: model,
    //             message: '*Please Enter Model'
    //         }
    //     ];

    //     const allEmpty = fields.every(field => is_empty(field.element.value.trim()));

    //     if (!allEmpty) {
    //         fields.forEach(field => {
    //             if (is_empty(field.element.value.trim())) {
    //                 form_errValid(field.element, field.message);
    //                 hasError = true;
    //             } else {
    //                 form_okValid(field.element);
    //             }
    //         });
    //     } else {
    //         fields.forEach(field => {
    //             form_defaultValid(field.element);
    //         });
    //     }

    //     if (hasError) {
    //         isProcessing = false;
    //         return;
    //     }
    //     // console.log(groupPartData);

    //     $('#tblBodyProjectLifeEdit tr').each(function() {
    //         if (hasError) return false;

    //         let rowData = {};
    //         const label = $(this).find('td:first-child label').text().trim();
    //         const inputElement = $(this).find('td:last-child input');
    //         const inputValue = inputElement.val().trim();

    //         if (is_empty(inputValue)) {
    //             form_errValid(inputElement[0], "*Please Enter Value");
    //             hasError = true;
    //             return false;
    //         } else {
    //             form_okValid(inputElement[0]);
    //             rowData['year'] = label;
    //             rowData['volume'] = inputValue;
    //         }

    //         if (Object.keys(rowData).length > 0) {
    //             groupVolumeData.push(rowData);
    //         }
    //     });
    //     if (hasError) {
    //         isProcessing = false;
    //         return;
    //     }
    //     // console.log(groupVolumeData);

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "Do you want to Edit RFQ?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, edit it.!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             var edit_form = {};
    //             let groupCheckBox = [{}];

    //             $('#edit_form').serializeArray().forEach(function(item) {
    //                 if ($('input[name="' + item.name + '"]').attr('type') === 'checkbox') {
    //                     return;
    //                 }
    //                 if (item.name == 'irpn_part_no' || item.name == 'irpn_part_name' || item.name == 'irpn_model' || item.name == 'irpn_remark') {
    //                     return;
    //                 }
    //                 if (item.name == 'ir_id' || item.name == 'ir_import_tran' || item.name == 'ir_mrt' || item.name == 'ir_enclosures' || item.name == 'ir_pro_life') {
    //                     item.value = parseInt(item.value)
    //                 }
    //                 edit_form[item.name] = item.value;
    //             });

    //             $('#edit_form input[type="checkbox"]').each(function() {
    //                 groupCheckBox[0][$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
    //             });

    //             if (edit_form["ir_mrt"] == 0) {
    //                 edit_form["ir_mrt"] = edit_form["ir_other_mrt"];
    //             } else {
    //                 edit_form["ir_mrt"] = document.edit_form.ir_mrt.options[document.edit_form.ir_mrt.selectedIndex].text;
    //             }

    //             if (edit_form["ir_enclosures"] == 0) {
    //                 edit_form["ir_enclosures"] = edit_form["ir_other_enclosures"];
    //             } else {
    //                 edit_form["ir_enclosures"] = document.edit_form.ir_enclosures.options[document.edit_form.ir_enclosures.selectedIndex].text;
    //             }

    //             edit_form["ir_ref_fm"] = null;
    //             edit_form["ir_ref_nbc"] = null;
    //             edit_form["ir_created_date"] = getTimeNow();
    //             edit_form["ir_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
    //             edit_form["ir_status"] = 1;

    //             edit_form["ir_doc_no"] = '';
    //             edit_form["ir_group_part"] = groupPartData;
    //             edit_form["ir_group_volume"] = groupVolumeData;
    //             edit_form["ir_group_checkbox"] = groupCheckBox;

    //             // console.log(edit_form);
    //             $.ajax({
    //                 type: 'PUT',
    //                 dataType: 'json',
    //                 contentType: 'application/json',
    //                 url: API_URL + 'rfq/edit',
    //                 data: JSON.stringify(edit_form),
    //                 success: function(data) {
    //                     if (data.Error != "null" || data.Error != "") {
    //                         Swal.fire({
    //                             html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Updated RFQ success!</p>",
    //                             icon: 'success',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         // $('#mdlEdit').modal('hide');
    //                     } else {
    //                         Swal.fire({
    //                             html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Updated RFQ!</p>",
    //                             icon: 'error',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         // $('#mdlEdit').modal('hide');
    //                     }
    //                 }
    //             });
    //         } else {
    //             console.log('Cancel');
    //         }
    //     });

    //     isProcessing = false;
    // }

    async function changeProLife() {
        let proLife = document.getElementById('inpProjectLifeEdit');
        let proTim = document.getElementById('inpProTimEdit');

        if (proLife.value <= 0 || proLife.value > 10) {
            form_errValid(document.getElementById('inpProjectLifeEdit'), "*Please Enter Number 1-10");
            return;
        } else {
            form_okValid(document.getElementById('inpProjectLifeEdit'));
        }

        if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
            let html = '';
            let count = 1;
            let year = proTim.value.substring(0, 4);
            for (let i = 0; i <= proLife.value; i++) {
                html += '<tr>' +
                    '<td class="text-center border-end"><label class="form-label">' + (parseInt(year) + i) + '</label></td>' +
                    '<td><div class="col"><input type="number" class="form-control text-center col-6" min="0" max="999999" id="inpVolume' + i + '"><span class="invalid-feedback"></span></div></td>' +
                    '</tr>';
            }
            document.getElementById('tblBodyProjectLifeEdit').innerHTML = html;
        }
    }

    async function changeRequirement() {
        let data = $('#selRequirementEdit').val();
        if (data == 'Other') {
            $('#inpOtherSubjectEdit').prop('disabled', false);
            $('#inpOtherSubjectEdit').focus();
        } else {
            $('#inpOtherSubjectEdit').prop('disabled', true);
        }
    }

    async function changeEnclosures() {
        let data = $('#inpEnclosuresEdit').val();
        if (data == '0') {
            $('#inpOtherEnclosuresEdit').prop('disabled', false);
            $('#inpOtherEnclosuresEdit').focus();
        } else {
            $('#inpOtherEnclosuresEdit').prop('disabled', true);
        }
    }

    // async function btnTable(type) {
    //     dataTable
    //         .columns(5)
    //         .search(type)
    //         .draw();
    // }

    // async function ViewAll() {
    //     dataTable
    //         .search('')
    //         .columns().search('')
    //         .draw();
    //     $('#inpImportFrom').val('');
    //     $('#inpCustomer').val('');
    //     $('#inpIssueDate').val('');
    //     $('#inpSearchDocNo').val('');
    // }

    async function listImportfrom(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_import',
            success: function(result) {
                var option_text = '<option value="">Choose Customer Type</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.mif_id == id) {
                        sel = "selected";
                        chkCus = true;
                    }
                    option_text += '<option value="' + value.mif_id + '" ' + sel + '>' + value.mif_name + '</option>';
                })
                $('#inpImportFrom').html(option_text);
            }
        })
    }

    async function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system_debug/api/customers',
            success: function(result) {
                var option_text = '<option value="">Choose Costomer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="Other">Other</option>';
                $('#inpCustomer').html(option_text);
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
        const url = 'http://192.168.161.106/etax_invoice_system_debug/api/customers';
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
        var issueDate = $('#inpIssueDate').val();
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
        if (is_empty(issueDate)) {
            issueDate = '';
        }

        dataTable
            .columns(1)
            .search(customerType)
            .columns(3)
            .search(customerName)
            .columns(6)
            .search(issueDate)
            .columns(2)
            .search(docNo)
            .draw();
    }

    async function listTablePartNo(data, type) {
        let html = '';
        if (type == 'view') {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td>' + data[i].irpn_part_no + '</td>';
                html += '<td>' + data[i].irpn_part_name + '</td>';
                html += '<td>' + data[i].irpn_model + '</td>';
                html += '<td>' + data[i].irpn_remark + '</td>';
                html += '</tr>';
            }
            document.getElementById('tblViewBodyPartNo').innerHTML = html;
        } else {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_part_no" value="' + data[i].irpn_part_no + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_part_name" value="' + data[i].irpn_part_name + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_model" value="' + data[i].irpn_model + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_remark" value="' + data[i].irpn_remark + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div><button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnDeletePartNo" name="btnDeletePartNo" data-id="' + data[i].irpn_id + '"><i class="ti ti-trash-x fs-6"></i></button></td>';
                html += '</tr>';
            }
            html += '<tr>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartNo" placeholder="Part No"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartName" placeholder="Part Name"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpModel" placeholder="Model"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpRemark" placeholder="Remark"><span class="invalid-feedback"></span></div></td>';
            html += '<td><button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id=""><i class="ti ti-plus fs-6"></i></button></td>';
            html += '</tr>';
            document.getElementById('tblEditBodyPartNo').innerHTML = html;
        }
    }

    // function addPartNoByItem(event) {
    //     const button = event.target.closest('button');
    //     const currentRow = button.closest('tr');

    //     const partNo = currentRow.querySelector('input[id="inpPartNo"]');
    //     const partName = currentRow.querySelector('input[id="inpPartName"]');
    //     const model = currentRow.querySelector('input[id="inpModel"]');
    //     const remark = currentRow.querySelector('input[id="inpRemark"]');

    //     if (is_empty(partNo.value.trim())) {
    //         form_errValid(partNo, '*Plase Enter Part No.');
    //         return;
    //     } else {
    //         form_okValid(partNo);
    //         if (is_empty(partName.value.trim())) {
    //             form_errValid(partName, '*Plase Enter Part Name');
    //             return;
    //         } else {
    //             form_okValid(partName);
    //             if (is_empty(model.value.trim())) {
    //                 form_errValid(model, '*Plase Enter Model');
    //                 return;
    //             } else {
    //                 form_okValid(model);
    //             }
    //         }
    //     }

    //     form_defaultValid(partNo);
    //     form_defaultValid(partName);
    //     form_defaultValid(model);

    //     const tbody = document.getElementById('tblEditBodyPartNo');
    //     const newRow = document.createElement('tr');
    //     newRow.innerHTML = `
    //     <td><div class="col"><input class="form-control text-center" type="text" name="irpn_part_no" value="${partNo.value.trim()}"><span class="invalid-feedback"></span></div></td>
    //     <td><div class="col"><input class="form-control text-center" type="text" name="irpn_part_name" value="${partName.value.trim()}"><span class="invalid-feedback"></span></div></td>
    //     <td><div class="col"><input class="form-control text-center" type="text" name="irpn_model" value="${model.value.trim()}"><span class="invalid-feedback"></span></div></td>
    //     <td><div class="col"><input class="form-control text-center" type="text" name="irpn_remark" value="${remark.value.trim()}"><span class="invalid-feedback"></span></div></td>
    //     <td>
    //         <button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm">
    //             <i class="ti ti-trash-x fs-6"></i>
    //         </button>
    //     </td>
    // `;
    //     tbody.insertBefore(newRow, currentRow);

    //     currentRow.querySelector('input[placeholder="Part No"]').value = '';
    //     currentRow.querySelector('input[placeholder="Part Name"]').value = '';
    //     currentRow.querySelector('input[placeholder="Model"]').value = '';
    //     currentRow.querySelector('input[placeholder="Remark"]').value = '';

    //     tbody.appendChild(currentRow);
    // }

    // function deletePartNoByItem(event) {
    //     const button = event.target.closest('button');
    //     const row = button.closest('tr');
    //     row.remove();
    // }

    // async function listTableProLife(data, type) {
    //     let html = '';
    //     if (type == 'view') {
    //         for (let i = 0; i < data.length; i++) {
    //             html += '<tr>';
    //             html += '<td class="border-end">' + data[i].year + '</td>';
    //             html += '<td>' + data[i].volume + '</td>';
    //             html += '</tr>';
    //         }
    //         document.getElementById('tblViewBodyProjectLife').innerHTML = html;
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             html += '<tr>';
    //             html += '<td class="border-end"><label class="form-label">' + data[i].year + '</label></td>';
    //             html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" value="' + data[i].volume + '"><span class="invalid-feedback"></span></div></td>';
    //             html += '</tr>';
    //         }
    //         document.getElementById('tblBodyProjectLifeEdit').innerHTML = html;
    //     }
    // }

    // async function listSubjectView(name, type) {
    //     const url = `${API_URL}option/list_mrt`;
    //     const response = await fetch(url);
    //     const result = await response.json();

    //     let optionText = '<option value="">Select Subject</option>';
    //     let found = false;

    //     result.forEach((value) => {
    //         const isSelected = value.mrt_name === name;
    //         optionText += `<option value="${value.mrt_id}" ${isSelected ? 'selected' : ''}>${value.mrt_name}</option>`;
    //         if (isSelected) found = true;
    //     });

    //     const formElem = document.querySelector(type == 'edit' ? 'form[name="edit_form"]' : 'form[name="view_edit_form"]');
    //     if (!formElem) return;

    //     if (type !== 'edit') {
    //         if (!found && name) {
    //             optionText += '<option value="Other" selected>Other</option>';
    //             formElem.ir_mrt.innerHTML = optionText;
    //             formElem.ir_other_mrt.value = name;
    //             formElem.ir_other_mrt.disabled = false;
    //         } else {
    //             optionText += '<option value="Other">Other</option>';
    //             formElem.ir_mrt.innerHTML = optionText;
    //             formElem.ir_other_mrt.value = '';
    //             formElem.ir_other_mrt.disabled = true;
    //         }
    //     } else {
    //         if (!found && name) {
    //             optionText += '<option value="Other" selected>Other</option>';
    //             formElem.ir_mrt.innerHTML = optionText;
    //             formElem.ir_other_mrt.value = name;
    //             formElem.ir_other_mrt.disabled = false;
    //         } else {
    //             optionText += '<option value="Other">Other</option>';
    //             formElem.ir_mrt.innerHTML = optionText;
    //             formElem.ir_other_mrt.value = '';
    //             formElem.ir_other_mrt.disabled = true;
    //         }
    //     }
    // }

    // async function listEnclosuresView(name, type) {
    //     const formElem = document.querySelector(type == 'edit' ? 'form[name="edit_form"]' : 'form[name="view_edit_form"]');
    //     const element = formElem.ir_enclosures;
    //     let found = false;

    //     for (const option of element.options) {
    //         if (option.value === name) {
    //             option.selected = true;
    //             found = true;
    //             break;
    //         }
    //     }

    //     if (!found) {
    //         for (const option of element.options) {
    //             if (option.value === "0") {
    //                 option.selected = true;
    //                 formElem.ir_other_enclosures.value = name;
    //                 formElem.ir_other_enclosures.disabled = false;
    //                 break;
    //             }
    //         }
    //     } else {
    //         formElem.ir_other_enclosures.value = '';
    //         formElem.ir_other_enclosures.disabled = true;
    //     }
    // }

    // function editModal(id) {
    //     event.preventDefault();
    //     if ($('#mdlEdit').hasClass('show')) {
    //         $('#mdlEdit').modal('hide');
    //     }
    //     $('#mdlEdit').modal('show');
    //     $.ajax({
    //         method: 'GET',
    //         url: API_URL + 'rfq/' + id,
    //         success: function(data) {
    //             if (!data.Error) {
    //                 console.log(data);
    //                 $('#mdlEdit .modal-header h4').text(data.ir_doc_no);

    //                 document.edit_form.ir_id.value = data.ir_id;
    //                 document.edit_form.ir_pu_dept.checked = data.ir_group_checkbox[0]['ir_pu_dept'] == 1;
    //                 document.edit_form.ir_pe_dept.checked = data.ir_group_checkbox[0]['ir_pe_dept'] == 1;
    //                 document.edit_form.ir_scm_dept.checked = data.ir_group_checkbox[0]['ir_scm_dept'] == 1;
    //                 document.edit_form.ir_ce_dept.checked = data.ir_group_checkbox[0]['ir_ce_dept'] == 1;
    //                 document.edit_form.ir_gdc_dept.checked = data.ir_group_checkbox[0]['ir_gdc_dept'] == 1;

    //                 document.edit_form.ir_raw_puc.checked = data.ir_group_checkbox[0]['ir_raw_puc'] == 1;
    //                 document.edit_form.ir_mold_puc.checked = data.ir_group_checkbox[0]['ir_mold_puc'] == 1;
    //                 document.edit_form.ir_menufac_puc.checked = data.ir_group_checkbox[0]['ir_menufac_puc'] == 1;
    //                 document.edit_form.ir_transport_puc.checked = data.ir_group_checkbox[0]['ir_transport_puc'] == 1;

    //                 document.edit_form.ir_cast_poc.checked = data.ir_group_checkbox[0]['ir_cast_poc'] == 1;
    //                 document.edit_form.ir_machin_poc.checked = data.ir_group_checkbox[0]['ir_machin_poc'] == 1;
    //                 document.edit_form.ir_assembly_poc.checked = data.ir_group_checkbox[0]['ir_assembly_poc'] == 1;
    //                 document.edit_form.ir_pack_poc.checked = data.ir_group_checkbox[0]['ir_pack_poc'] == 1;

    //                 document.edit_form.ir_note.value = data.ir_note;
    //                 document.edit_form.ir_comment.value = data.ir_comment;
    //                 document.edit_form.ir_duedate.value = data.ir_duedate.substring(0, 10);

    //                 listImportfromView(data.ir_import_tran, 'edit');
    //                 listCustomerView(data.ir_customer, 'edit');
    //                 listSubjectView(data.mrt_id, 'edit');
    //                 listEnclosuresView(data.ir_enclosures, 'edit');

    //                 listTablePartNo(data.ir_group_part, 'edit');
    //                 listTableProLife(data.ir_group_volume, 'edit');

    //                 document.edit_form.ir_pro_life.value = data.ir_pro_life;
    //                 document.edit_form.ir_pro_tim.value = data.ir_sop_tim;

    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: data.Error,
    //                     allowOutsideClick: false,
    //                     allowEscapeKey: false,
    //                 }).then((result) => {
    //                     if (result.isConfirmed) {
    //                         $('#mdlEdit').modal('hide');
    //                     }
    //                 });

    //             }

    //             $('#btnSaveChange').on('click', function() {
    //                 saveChange(data.ir_group_part, data.ir_group_volume);
    //             });

    //         }
    //     })

    //     $('#mdlEdit').on('hidden.bs.modal', function() {
    //         const formElements = document.edit_form.querySelectorAll('input, select, textarea');
    //         formElements.forEach(element => {
    //             form_defaultValid(element);
    //         });

    //     })

    // }

    // function viewEditModal(id) {
    //     event.preventDefault();
    //     $.ajax({
    //         method: 'GET',
    //         url: API_URL + 'rfq/' + id,
    //         success: function(data) {
    //             if (!data.Error) {
    //                 $('#mdlViewEdit .modal-header h4').text(data.ir_doc_no);
    //                 document.querySelectorAll('#view_edit_form input, #view_edit_form select,  #view_edit_form textarea').forEach(element => element.disabled = true);

    //                 document.view_edit_form.ir_pu_dept.checked = data.ir_group_checkbox[0]['ir_pu_dept'] == 1;
    //                 document.view_edit_form.ir_pe_dept.checked = data.ir_group_checkbox[0]['ir_pe_dept'] == 1;
    //                 document.view_edit_form.ir_scm_dept.checked = data.ir_group_checkbox[0]['ir_scm_dept'] == 1;
    //                 document.view_edit_form.ir_ce_dept.checked = data.ir_group_checkbox[0]['ir_ce_dept'] == 1;
    //                 document.view_edit_form.ir_gdc_dept.checked = data.ir_group_checkbox[0]['ir_gdc_dept'] == 1;

    //                 document.view_edit_form.ir_raw_puc.checked = data.ir_group_checkbox[0]['ir_raw_puc'] == 1;
    //                 document.view_edit_form.ir_mold_puc.checked = data.ir_group_checkbox[0]['ir_mold_puc'] == 1;
    //                 document.view_edit_form.ir_menufac_puc.checked = data.ir_group_checkbox[0]['ir_menufac_puc'] == 1;
    //                 document.view_edit_form.ir_transport_puc.checked = data.ir_group_checkbox[0]['ir_transport_puc'] == 1;

    //                 document.view_edit_form.ir_cast_poc.checked = data.ir_group_checkbox[0]['ir_cast_poc'] == 1;
    //                 document.view_edit_form.ir_machin_poc.checked = data.ir_group_checkbox[0]['ir_machin_poc'] == 1;
    //                 document.view_edit_form.ir_assembly_poc.checked = data.ir_group_checkbox[0]['ir_assembly_poc'] == 1;
    //                 document.view_edit_form.ir_pack_poc.checked = data.ir_group_checkbox[0]['ir_pack_poc'] == 1;

    //                 listSubjectView(data.mrt_id, 'view');
    //                 listEnclosuresView(data.ir_enclosures, 'view');

    //                 document.view_edit_form.ir_note.value = data.ir_note;
    //                 document.view_edit_form.ir_comment.value = data.ir_comment;
    //                 document.view_edit_form.ir_duedate.value = data.ir_duedate.substring(0, 10);

    //                 listImportfromView(data.ir_import_tran, 'view');
    //                 listCustomerView(data.ir_customer, 'view');
    //                 listTablePartNo(data.ir_group_part, 'view');
    //                 listTableProLife(data.ir_group_volume, 'view');

    //                 document.view_edit_form.ir_pro_life.value = data.ir_pro_life;
    //                 document.view_edit_form.ir_pro_tim.value = data.ir_sop_tim;

    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: data.Error,
    //                     allowOutsideClick: false,
    //                     allowEscapeKey: false,
    //                 }).then((result) => {
    //                     if (result.isConfirmed) {
    //                         $('#mdlViewEdit').modal('hide');
    //                     }
    //                 });

    //             }
    //         }
    //     })
    // }

    // async function changeEditCustomer() {
    //     const customerInput = document.edit_form.ir_customer.value;

    //     if (customerInput === 'Other') {
    //         $('#customCustomerModal').modal('show');
    //         $('#newCustomerName').focus();
    //         $('#saveCustomerName').off('click').on('click', function() {
    //             const text = $('#newCustomerName').val();

    //             if (text) {
    //                 const select = $('select#inpEditCustomer');
    //                 if (!select.find(`option[value="${text}"]`).length) {
    //                     select.append(new Option(text, text));
    //                 }
    //                 select.val(text);
    //             }
    //             $('#newCustomerName').val('')
    //             $('#customCustomerModal').modal('hide');
    //         });
    //     }
    //     $('#customCustomerModal').on('hidden.bs.modal', function() {
    //         $('#newCustomerName').val('');
    //     })
    // }

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

    // function modalPartno(id, ir_doc_no) {
    //     event.preventDefault();
    //     $('#inpDocNo').val(ir_doc_no);
    //     $('#inpDocNoRef').val('-');
    //     if ($.fn.DataTable.isDataTable('#tblPartNo')) {
    //         $('#tblPartNo').DataTable().destroy();
    //     }
    //     let dataTablePartno = $('#tblPartNo').DataTable({
    //         ajax: {
    //             url: API_URL + 'view/partno/' + id,
    //         },
    //         columnDefs: [{
    //             searchable: false,
    //             orderable: false,
    //             targets: 0,
    //             width: "10px",
    //         }, ],
    //         bSort: false,
    //         order: [
    //             [1, 'asc']
    //         ],
    //         columns: [{
    //                 className: 'text-center col-1',
    //                 data: null,
    //                 render: function(data, type, row, meta) {
    //                     return meta.row + 1;
    //                 },
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'irpn_part_no',
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'irpn_part_name',
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'irpn_model',
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'irpn_remark',
    //             }
    //         ]
    //     });
    //     dataTablePartno.on('order.dt search.dt', function() {
    //         let i = 1;
    //         dataTablePartno.cells(null, 0, {
    //             search: 'applied',
    //             order: 'applied'
    //         }).every(function(cell) {
    //             this.data(i++);
    //         });
    //     }).draw();
    // }

    function formatDate(inputDate) {
        let dateParts = inputDate.split('-');
        let year = dateParts[0];
        let month = dateParts[1];
        let day = dateParts[2];

        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let monthName = months[parseInt(month) - 1];

        return `${day}-${monthName}-${year.substring(2)}`;
    }

    // async function viewPDF(ir_id) {
    //     $.ajax({
    //         type: 'get',
    //         url: API_URL + 'rfq/' + ir_id,
    //         success: async function(result) {

    //             let param = {
    //                 ...result
    //             };

    //             let IssueDate = param.ir_created_date.split(" ")[0];
    //             param.ir_created_date = formatDate(IssueDate);

    //             let Duedate = param.ir_duedate.split(" ")[0];
    //             param.ir_duedate = formatDate(Duedate);

    //             param.ir_sop_tim = param.ir_sop_tim.substring(0, 4);

    //             if (param.ir_ref_nbc == 0) {
    //                 param.ir_ref_nbc = '';
    //             }

    //             // console.log(param);
    //             let pdfUrl = '<?php echo base_url(); ?>RfqForm/createPDF?' + $.param(param);
    //             window.open(pdfUrl, '_blank');
    //         }
    //     });
    // }

    // function rfqCancel(id) {
    //     event.preventDefault();
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "Do you want to cancel RFQ?",
    //         icon: 'warning',
    //         input: "text",
    //         inputPlaceholder: "Please fill reason for cancellation.",
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, Cancel it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             const cancelReason = result.value;
    //             $.ajax({
    //                 method: 'PUT',
    //                 url: API_URL + 'rfq/cancel/' + id + '/' + cancelReason,
    //                 success: function(data) {
    //                     if (data != false) {
    //                         Swal.fire({
    //                             html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Cancel RFQ Success!</p>",
    //                             icon: 'success',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     } else {
    //                         Swal.fire({
    //                             html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Cancel RFQ!</p>",
    //                             icon: 'error',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // }

    // function rfqReverse(id) {
    //     event.preventDefault();
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "Do you want to reverse RFQ?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, reverse it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 method: 'PUT',
    //                 url: API_URL + 'rfq/reverse/' + id,
    //                 success: function(data) {
    //                     if (data != false) {
    //                         Swal.fire({
    //                             html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Reverse RFQ Success!</p>",
    //                             icon: 'success',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     } else {
    //                         Swal.fire({
    //                             html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Reverse RFQ!</p>",
    //                             icon: 'error',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // }

    // function rfqSubmit(id) {
    //     event.preventDefault();
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "Do you want to submit RFQ?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, submit it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 method: 'PUT',
    //                 url: API_URL + 'rfq/submit/' + id,
    //                 success: function(data) {
    //                     if (data != false) {
    //                         Swal.fire({
    //                             html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Submit RFQ Success!</p>",
    //                             icon: 'success',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     } else {
    //                         Swal.fire({
    //                             html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Submit RFQ!</p>",
    //                             icon: 'error',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                         var dataTable = $('#tblNBC').DataTable();
    //                         dataTable.ajax.reload(null, false);
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // }

    function showStatus(status) {
        if (status == 1) {
            return '<span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>'
        } else if (status == 5) {
            return '<span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>Wait Approve</span>'
        } else if (status == 6) {
            return '<span class="badge text-perple fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #ffafbb !important; color: #C7253E !important"><i class="ti ti-repeat-off fs-4"></i>Rejected</span>'
        } else if (status == 9) {
            return '<span class="badge bg-success-subtle text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-check fs-4"></i>Approved</span>'
        } else {
            return '<span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>'
        }
    }

    function showbtnAction(status, id) {
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
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 9) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate NBC">
                    <i class="ti ti-checklist" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="viewEditModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="rfqReverse(${id})" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                    <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        }
    }

    $(document).ready(function() {
        listImportfrom();
        listCustomer();
        // if ($.fn.DataTable.isDataTable('#tblNBC')) {
        //     $('#tblNBC').DataTable().destroy();
        // }
        // dataTable = $('#tblNBC').DataTable({
        //     ajax: {
        //         url: API_URL + 'rfq/table'
        //     },
        //     columnDefs: [{
        //         searchable: true,
        //         orderable: false,
        //         targets: 0,
        //     }, ],
        //     scrollX: true,
        //     bSort: false,
        //     order: [
        //         [1, 'asc']
        //     ],
        //     columns: [{
        //             className: 'text-center',
        //             data: 'ir_id'
        //         },
        //         {
        //             className: 'text-center col-1',
        //             data: 'ir_import_tran',
        //             render: function(data, type, row) {
        //                 if (row.ir_import_tran == 1) {
        //                     return 'Overseas';
        //                 } else if (row.ir_import_tran == 2) {
        //                     return 'Domestic';
        //                 }
        //             }
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_doc_no',
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_customer',
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_id',
        //             "render": function(data, type, row) {
        //                 if (type === 'display') {
        //                     disp = '<div class="d-flex justify-content-around gap-1">' +
        //                         '<button type="button" onclick="modalPartno(\'' + row.ir_id + '\' , \'' + row.ir_doc_no + '\')" class="btn bg-secondary-subtle text-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#mdlPartNo"> <i class="ti ti-augmented-reality" style="font-size: 1.5rem !important;"></i></button>' +
        //                         '</div>';
        //                 }
        //                 return disp;
        //             }
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_status',
        //             "render": function(data, type, row) {
        //                 return showStatus(row.ir_status);
        //             }
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_created_date',
        //             "render": function(data, type, row) {
        //                 return row.ir_created_date.substring(0, 10);
        //             }
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_created_by',
        //             "render": function(data, type, row) {
        //                 if (type === 'display') {
        //                     if (row.create_by != "") {
        //                         let emp_code = row.ir_created_by.substring(2, 7);
        //                         let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
        //                         disp = '<div class="d-flex align-items-center justify-content-center">' +
        //                             '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
        //                             '<div class="ms-3">' +
        //                             '<div class="user-meta-info">' +
        //                             '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
        //                             '<span class="user-work fs-3" data-occupation="' + row.ir_created_by + '">' + row.ir_created_by + '</span>' +
        //                             '</div></div></div>';
        //                     } else {
        //                         disp = "";
        //                     }
        //                 }
        //                 return disp;
        //             },
        //         },
        //         {
        //             className: 'text-center',
        //             data: 'ir_id',
        //             "render": function(data, type, row) {
        //                 return showbtnAction(row.ir_status, row.ir_id);
        //             }
        //         }
        //     ]
        // });

        // dataTable.on('order.dt search.dt', function() {
        //     let i = 1;
        //     dataTable.cells(null, 0, {
        //         search: 'applied',
        //         order: 'applied'
        //     }).every(function(cell) {
        //         this.data(i++);
        //     });
        // }).draw();
        // dataTable.on('draw', function() {
        //     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        //     tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        //         new bootstrap.Tooltip(tooltipTriggerEl);
        //     });
        // });
        // setInterval(function() {
        //     dataTable.ajax.reload(null, false);
        // }, 600000);
    });
</script>