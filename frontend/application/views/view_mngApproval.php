<title>CRM | Task Control</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Task Control</h4>
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
                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input RFQ No." onkeyup="filterData()"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Issue Date :</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-control-sm text-center" id="startDate">
                                            <span class="input-group-text bg-info text-white fs-1 px-3" style="padding-top: 0rem !important; padding-bottom: 0rem !important;">TO</span>
                                            <input type="date" class="form-control form-control-sm text-center" id="endDate">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        <label class="text-dark fw-semibold fs-3 me-3">Status :</label>
                                        <button class="btn btn-sm bg-warning text-white card-hover me-2 shadow-sm" onclick="btnTable('wait approve')">Wait Approve</button>
                                        <button class="btn btn-sm bg-danger text-white card-hover shadow-sm me-2" style="background-color: #C7253E !important;" onclick="btnTable('Rejected')">Rejected</button>
                                        <button class="btn btn-sm bg-success text-white card-hover shadow-sm me-2" onclick="btnTable('Approved')">Approved</button>
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
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">RFQ</td>
                                            <td class="text-center">
                                                NBC-SM-2024-001
                                            </td>
                                            <td class="text-center">
                                                <span>-</span>
                                            </td>
                                            <td class="text-center">ISUZU Co., Ltd.</td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>
                                            </td>
                                            <td class="text-center">30/11/2024</td>
                                            <td class="text-center">Kyoko</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-center">NBC</td>
                                            <td class="text-center">
                                                NBC-SM-2024-002
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
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-center">Feasibility</td>
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
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
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
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

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
    });
</script>