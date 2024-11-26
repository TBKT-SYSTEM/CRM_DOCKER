<title>CRM | RFQ Form</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">RFQ Form</h4>
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
                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input RFQ No." onchange="filterData()"></input>
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
            <div class="modal-header modal-colored-header bg-info text-white" style="background-color: rgb(243 188 130) !important;">
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="datatables">
                    <!-- basic table -->
                    <form id="add_form" name="add_form" method="post">
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
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pu_dept" id="inpPuDept">
                                                    <label class="form-check-label fw-semibold" for="inpPuDept">PU Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_pe_dept" id="inpPeDept">
                                                    <label class="form-check-label fw-semibold" for="inpPeDept">PE Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_scm_dept" id="inpScmDept">
                                                    <label class="form-check-label fw-semibold" for="inpScmDept">SCM Dept.</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_ce_dept" id="inpCeDept">
                                                    <label class="form-check-label fw-semibold" for="inpCeDept">CE Dept.</label>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_gdc_dept" id="inpGdcDept">
                                                    <label class="form-check-label fw-semibold" for="inpGdcDept">GDC Dept.</label>
                                                </div>
                                            </div>

                                            <!-------------------------- Customer ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <div class="col">
                                                        <select name="ir_import_tran" id="inpImportFrom" class="form-select"></select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <select name="ir_customer" id="inpCustomer" class=" form-select" onchange="changeCustomer()"></select>
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
                                                        <select name="ir_mrt" id="selRequirement" class="form-select" onchange="changeRequirement()"> </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_mrt" id="inpOtherSubject" class="form-control" placeholder="Other Subject ..." disabled>
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
                                                        <select name="ir_enclosures" id="inpEnclosures" onchange="changeEnclosures()" class="form-select">
                                                            <option value="">Select Enclosures</option>
                                                            <option value="Drawing">Drawing</option>
                                                            <option value="0">Other</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" name="ir_other_enclosures" id="inpOtherEnclosures" class="form-control" placeholder="Other Enclosures ..." disabled>
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
                                                    <input type="checkbox" class="form-check-input me-2" name="ir_raw_puc" id="inpRawMaterial">
                                                    <label class="form-check-label fw-semibold" for="inpRawMaterial">Raw material</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMold" name="ir_mold_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMold">Mold/Die</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMenuFac" name="ir_menufac_puc">
                                                    <label class="form-check-label fw-semibold" for="inpMenuFac">Manufacturing</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpTransport" name="ir_transport_puc">
                                                    <label class="form-check-label fw-semibold" for="inpTransport">Transportation</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Process Cost ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Process Cost :</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpCast" name="ir_cast_poc">
                                                    <label class="form-check-label fw-semibold" for="inpCast">Casting</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpMachin" name="ir_machin_poc">
                                                    <label class="form-check-label fw-semibold" for="inpMachin">Machining</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpAssembly" name="ir_assembly_poc">
                                                    <label class="form-check-label fw-semibold" for="inpAssembly">Assembly</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="checkbox" class="form-check-input me-2" id="inpPack" name="ir_pack_poc">
                                                    <label class="form-check-label fw-semibold col" for="inpPack">Packaging and Delivery</label>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Note ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_note" class="form-control" rows="4" id="inpNote"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Comment / Additional  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                                </div>
                                                <div class="d-flex col-md-10 me-3 gap-5">
                                                    <textarea name="ir_comment" class="form-control" rows="4" id="inpComment"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <!-------------------------- Closeing Date  ---------------------------->
                                            <div class="d-flex col-md-12 mb-3">
                                                <div class="col-md-2">
                                                    <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                                </div>
                                                <div class="d-flex col-md-3 me-3 gap-5">
                                                    <input type="date" class="form-control" id="inpDuedate" name="ir_duedate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
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
                                            <!-------------------------- Group Part NO ---------------------------->
                                            <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                <div class="d-flex col-md-5 align-items-center">
                                                    <label for="" class="col-md-2 form-label fw-semibold me-3">Part No. :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inpPartNo" name="ir_part_no" placeholder="Enter Part No ...">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex col-md-6 align-items-center">
                                                    <label for="" class="col-md-2 form-label fw-semibold me-3">Part Name :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control col-md-6" id="inpPartName" name="ir_part_name" placeholder="Enter Part Name ...">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                <div class="d-flex col-md-5 align-items-center">
                                                    <label for="" class="col-md-2 form-label fw-semibold me-3">Model :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inpModel" name="ir_model" placeholder="Enter Model ...">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex col-md-6 align-items-center">
                                                    <label for="" class="col-md-2 form-label fw-semibold me-3">Remark :</label>
                                                    <div class="col me-3">
                                                        <input type="text" class="form-control col-md-6" id="inpRemark" name="ir_remark" placeholder="Enter Remark ...">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <button type="button" onclick="addPart()" class="btn bg-primary-subtle text-primary">Add</button>
                                                </div>
                                            </div>

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
                                                    <tbody class="border-top text-wrap bg-white">
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
                                                            <input type="number" min="1" max="10" class="form-control" id="inpProjectLife" name="ir_pro_life" onchange="changeProLife()" placeholder="Enter Number ..." value="1">
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                        <label for="" class="col form-label fw-semibold">Years</label>
                                                    </div>

                                                    <div class="d-flex col-md-4 align-items-center">
                                                        <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                                        <div class="col">
                                                            <input type="month" class="form-control" id="inpProTim" name="ir_pro_tim" onchange="changeProLife()">
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <!----------- Table Project Life  ------------>
                                                    <div class="table-responsive border rounded mb-5 shadow-sm">
                                                        <table class="table text-wrap mb-0 align-middle text-center" id="tblProjectLife">
                                                            <thead class="text-dark fs-4">
                                                                <tr>
                                                                    <th class="border-bottom-0">
                                                                        <h6 class="fw-semibold mb-0">Year</h6>
                                                                    </th>
                                                                    <th class="border-bottom-0">
                                                                        <h6 class="fw-semibold mb-0">Volume</h6>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="border-top text-wrap" id="tlbBodyProjectLife">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                        <a href="javascript:void(0);" onclick="clearForm()" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                                        <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="addRfq()"><i class="ti ti-download me-2" style="font-size: 20px;"></i></i>Issue RFQ</button>
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
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
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

<script>
    let dataTable;

    async function btnTable(type) {
        dataTable
            .columns(5)
            .search(type)
            .draw();
    }

    async function ViewAll() {
        dataTable
            .search('')
            .columns().search('')
            .draw();
        $('#inpImportFrom').val('');
        $('#inpCustomer').val('');
        $('#inpIssueDate').val('');
        $('#inpSearchDocNo').val('');
    }

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

    function editModal(id) {
        event.preventDefault();

        $('#ir_id').val(id);
        $.ajax({
            type: 'get',
            url: API_URL + 'rfq/' + id,
            success: function(result) {
                // console.log(result);
                // return;
                $('#editRef').val(result.ir_id);
                $('#editDate').val(result.create_date.substring(0, 10));
                // $('#editDuedate').val(result.ir_duedate.substring(0, 10));
                $('#editCustomer').val(result.ir_customer);
                $('#ir_duedate').text(result.ir_duedate.substring(0, 10));
                // let importText = '<option value="" disabled selected>Import From</option>' +
                //     '<option value="1" ' + ((result.if_import_tran == 1) ? 'selected' : '') + '>Oversea</option>' +
                //     '<option value="2" ' + ((result.if_import_tran == 2) ? 'selected' : '') + '>Domestic</option>';
                // $('#editImportFrom').html(importText);
                // $('#editPartNo').val(result.if_part_no);
                // $('#editPartName').val(result.if_part_name);
                // listRequirement(result.mrt_id);
                // viewFeasibility(id);
            }
        })

        $.ajax({
            type: 'get',
            url: API_URL + 'rfq/getBtnRfq/' + '<?php echo $this->session->userdata('sessUsr') ?>',
            success: async function(result) {
                var html = `<button type="button" onclick="previewPDF()" class="btn bg-secondary-subtle text-secondary waves-effect text-start">PDF</button>`;
                var data = result.data;
                if (data != null) {
                    for (let i = 0; i < data.length; i++) {
                        html += await btnFormRfq(data[i].sat_name)
                    }
                    $('#btnFooter').html(html);
                } else {
                    $('#btnFooter').html(html);
                }
            }
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

    function modalPartno(id, ir_doc_no) {
        event.preventDefault();
        $('#inpDocNo').val(ir_doc_no);
        $('#inpDocNoRef').val('-');
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
                    data: 'irpn_part_no',
                },
                {
                    className: 'text-center',
                    data: 'irpn_part_name',
                },
                {
                    className: 'text-center',
                    data: 'irpn_model',
                },
                {
                    className: 'text-center',
                    data: 'irpn_remark',
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

                let IssueDate = param.ir_created_date.split(" ")[0];
                param.ir_created_date = formatDate(IssueDate);

                let Duedate = param.ir_duedate.split(" ")[0];
                param.ir_duedate = formatDate(Duedate);

                param.ir_sop_tim = param.ir_sop_tim.substring(0, 4);

                if (param.ir_ref_nbc == 0) {
                    param.ir_ref_nbc = '';
                }

                console.log(param);
                let pdfUrl = '<?php echo base_url(); ?>RfqForm/createPDF?' + $.param(param);
                window.open(pdfUrl, '_blank');
            }
        });
    }

    function rfqCancel(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel RFQ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'rfq/cancel/' + id,
                    success: function(data) {
                        console.log(data);
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
                <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit" data-bs-target="#mdlEdit" data-bs-toggle="modal">
                    <i class="ti ti-pencil-minus" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                    <i class="ti ti-check" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="rfqCancel(${id})" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                    <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" style="font-size: 1.5rem !important;"></i>
                </button>
                <button id="btnPDF" onclick="viewPDF(${id})" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                    <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 9) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" style="font-size: 1.5rem !important;"></i>
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
                <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                    <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        }
    }

    $(document).ready(function() {
        listImportfrom();
        listCustomer();

        if ($.fn.DataTable.isDataTable('#tblRFQ')) {
            $('#tblRFQ').DataTable().destroy();
        }
        dataTable = $('#tblRFQ').DataTable({
            ajax: {
                url: API_URL + 'rfq/table'
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
                    data: 'ir_id'
                },
                {
                    className: 'text-center col-1',
                    data: 'ir_import_tran',
                    render: function(data, type, row) {
                        if (row.ir_import_tran == 1) {
                            return 'Overseas';
                        } else if (row.ir_import_tran == 2) {
                            return 'Domestic';
                        }
                    }
                },
                {
                    className: 'text-center',
                    data: 'ir_doc_no',
                },
                {
                    className: 'text-center',
                    data: 'ir_customer',
                },
                {
                    className: 'text-center',
                    data: 'ir_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<div class="d-flex justify-content-around gap-1">' +
                                '<button type="button" onclick="modalPartno(\'' + row.ir_id + '\' , \'' + row.ir_doc_no + '\')" class="btn bg-secondary-subtle text-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#mdlPartNo"> <i class="ti ti-augmented-reality" style="font-size: 1.5rem !important;"></i></button>' +
                                '</div>';
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'ir_status',
                    "render": function(data, type, row) {
                        return showStatus(row.ir_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'ir_created_date',
                    "render": function(data, type, row) {
                        return row.ir_created_date.substring(0, 10);
                    }
                },
                {
                    className: 'text-center',
                    data: 'ir_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.ir_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.ir_created_by + '">' + row.ir_created_by + '</span>' +
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
                    data: 'ir_id',
                    "render": function(data, type, row) {
                        return showbtnAction(row.ir_status, row.ir_id);
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
        });
        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 600000);
    });
</script>