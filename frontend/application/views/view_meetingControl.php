<title>CRM | Meeting Control</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Meeting Control</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Meeting Control</li>
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
                        <ul class="nav nav-pills nav-fill gap-2" role="tablist">
                            <li class="nav-item bg-primary-subtle rounded text-primary fw-semibold shadow-sm" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true">
                                    <span>Manage Meeting</span>
                                </a>
                            </li>
                            <li class="nav-item bg-primary-subtle rounded text-primary fw-semibold shadow-sm" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Register Meeting</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div id="tab-1" style="display: block;">
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
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Meeting Date :</label>
                                                        <div class="input-group me-3">
                                                            <input type="date" class="form-control form-control-sm text-center" value="<?php echo date('Y-m-d'); ?>" id="startDate">
                                                        </div>
                                                        <button class="btn btn-sm bg-info text-white card-hover shadow-sm" onclick="searchDate()">Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Meeting Topic :</label>
                                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpTopic" name="ir_topic" onchange="filterData()">
                                                            <?php
                                                            $option_topic = $this->ManageBackend->list_option("option/list_mdt");
                                                            echo '<option value="">Choose meeting topic ...</option>';
                                                            foreach ($option_topic as $topic) {
                                                                echo '<option value="' . $topic['mdt_id'] . '" data-aname="' . $topic['mdt_position1'] . '">' . $topic['mdt_name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="text-dark fw-semibold fs-3 me-3">Status :</label>
                                                        <button class="btn btn-sm bg-secondary text-white card-hover me-2 shadow-sm" onclick="btnTable('open')">Open</button>
                                                        <button class="btn btn-sm bg-success text-white card-hover me-2 shadow-sm" onclick="btnTable('Close')">Close</button>
                                                        <button class="btn btn-sm bg-danger text-white card-hover shadow-sm" onclick="btnTable('cancel')">Cancel</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Document No :</label>
                                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input Document No." onkeyup="filterData()"></input>
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
                                                <table id="tblMeeting" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th class="text-center">No.</th>
                                                            <th class="text-center">Customer Type</th>
                                                            <th class="text-center">Topic</th>
                                                            <th class="text-center">Document No.</th>
                                                            <th class="text-center">Customer</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Meeting Date</th>
                                                            <th class="text-center">Reported By</th>
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

                                <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                                    <form id="add_form" name="add_form" method="post">
                                        <div id="tab-2" style="display: block;">
                                            <div class="row" style="padding: 15px;">
                                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                    <div class="d-flex col-md-5 align-items-center">
                                                        <label for="" class="col-auto fs-3 text-dark fw-semibold me-3">Meeting Topic :</label>
                                                        <div class="col">
                                                            <select type="text" class="form-select form-select-sm shadow-sm" id="inpAddTopic" name="mdt_id" onchange="filterData()">
                                                                <?php
                                                                $option_topic = $this->ManageBackend->list_option("option/list_mdt");
                                                                echo '<option value="">Choose meeting topic ...</option>';
                                                                foreach ($option_topic as $topic) {
                                                                    echo '<option value="' . $topic['mdt_id'] . '">' . $topic['mdt_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex col-md-6 align-items-center">
                                                        <label for="" class="col-auto fs-3 text-dark fw-semibold me-3">Refer Document No. :</label>
                                                        <div class="col">
                                                            <select name="idc_id" id="inpRefDoc" class="select2 form-select">
                                                                <?php
                                                                $option_topic = $this->ManageBackend->list_option("option/list_doc");
                                                                echo '<option value="">Input for search Document No ...</option>';
                                                                foreach ($option_topic as $topic) {
                                                                    echo '<option value="' . $topic['idc_id'] . '">' . $topic['idc_running_no'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex col-md-12 align-items-center gap-5">
                                                    <div class="d-flex col-md-5 align-items-center">
                                                        <label for="inpMeetingDate" class="col-auto fs-3 text-dark fw-semibold me-3">Meeting Date :</label>
                                                        <div class="col">
                                                            <input type="date" class="form-control form-control-sm text-center" id="inpMeetingDate" name="imc_date" value="<?php echo date('Y-m-d'); ?>">
                                                            <span class="invalid-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex col-md-12 mt-3 mb-3">
                                                    <div class="d-flex col-auto">
                                                        <label for="selDept" class="col-auto fs-3 text-dark fw-semibold me-3">Member :</label>
                                                    </div>
                                                    <table class="table table-sm text-wrap mb-0 align-middle table-b text-center" id="tblPerson">
                                                        <tbody class="text-wrap bg-white">
                                                            <tr>
                                                                <td style="border: none;">
                                                                    <div class="col">
                                                                        <select type="text" class="form-select form-select-sm shadow-sm" id="selDept" name="sd_id" onchange="changeMember(this)">
                                                                            <option value="" selected>Choose Department</option>
                                                                            <?php
                                                                            $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                                            foreach ($option_dept as $dept) {
                                                                                echo '<option value="' . $dept['sd_id'] . '">' . '( ' . $dept['sd_dept_aname'] . ' ) ' . $dept['sd_dept_name'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td style="border: none;">
                                                                    <div class="col">
                                                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpAddPerson" name="su_id" disabled>
                                                                            <option value="">Choose Person or Fill Name</option>
                                                                        </select>
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td class="col-2" style="border: none;">
                                                                    <div class="d-flex col align-items-center">
                                                                        <button type="button" onclick="addPerson(event)" class="col-auto px-5 btn btn-sm rounded-pill bg-primary-subtle text-primary shadow-sm me-2">
                                                                            <i class="ti ti-user-plus fs-6"></i>
                                                                        </button>
                                                                        <label for="" class="col-md-auto fw-semibold fs-1">( Max 20 Items )</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="d-flex col mb-3 gap-5">
                                                    <label for="" class="col-auto form-label fw-semibold me-3">Design Concern Point :</label>
                                                    <div class="w-100">
                                                        <textarea class="form-control" rows="3" id="inpDesignConcern" name="imc_detail"></textarea>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" style="padding: 15px;">
                                                <!----------- Table Part No.  ------------>
                                                <label for="" class="col-auto fs-3 text-dark fw-semibold me-3 mb-1">Next Action Need :</label>
                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblNextAction">
                                                        <thead class="text-dark fs-4">
                                                            <tr>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">No.</h6>
                                                                </th>
                                                                <th class="">
                                                                    <h6 class="fw-semibold mb-0">Topic</h6>
                                                                </th>
                                                                <th class="col-3">
                                                                    <h6 class="fw-semibold mb-0">P.I.C. Dept.</h6>
                                                                </th>
                                                                <th class="col-2">
                                                                    <h6 class="fw-semibold mb-0">Action Plan & Duedate</h6>
                                                                </th>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white">
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm text-center shadow-sm" name="next_topic" id="inpNextTopic" value="" placeholder="Input your topic ...">
                                                                    <span class="invalid-feedback"></span>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select form-select-sm shadow-sm" name="next_dept" id="inpNextDept">
                                                                        <option value="" selected>Choose Department</option>
                                                                        <?php
                                                                        $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                                        foreach ($option_dept as $dept) {
                                                                            echo '<option value="' . $dept['sd_id'] . '">' . '( ' . $dept['sd_dept_aname'] . ' ) ' . $dept['sd_dept_name'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="invalid-feedback"></span>
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control form-control-sm text-center shadow-sm" name="next_date" id="inpNextDate" value="<?php echo date('Y-m-d'); ?>">
                                                                    <span class="invalid-feedback"></span>
                                                                </td>
                                                                <td>
                                                                    <button type="button" onclick="addNextAction(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddNext" name="btn_add_next" data-id="">
                                                                        <i class="ti ti-pin fs-6"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                        <a href="javascript:void(0);" onclick="clearForm()" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                                        <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="addMeeting()"><i class="ti ti-download me-2" style="font-size: 20px;"></i>Save</button>
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
                <!-- end Zero Configuration -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for View No-->
<div class="modal fade" id="mdlReferDoc" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
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

<div class="modal fade" id="mdlEdit" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
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
                                            <form id="edit_form" name="edit_form" method="post">
                                                <div id="tab-2" style="display: block;">
                                                    <div class="row" style="padding: 15px;">
                                                        <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                            <input type="hidden" name="imc_id" id="inpEditId">
                                                            <input type="hidden" name="mdt_id" id="inpEditTopic">
                                                            <div class="d-flex col-md-5 align-items-center">
                                                                <label for="inpMeetingDate" class="col-auto fs-3 text-dark fw-semibold me-3">Meeting Date :</label>
                                                                <div class="col">
                                                                    <input type="date" class="form-control form-control-sm text-center" id="inpMeetingDate" name="imc_date" value="<?php echo date('Y-m-d'); ?>">
                                                                    <span class="invalid-feedback"></span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex col-md-6 align-items-center">
                                                                <label for="" class="col-auto fs-3 text-dark fw-semibold me-3">Refer Document No. :</label>
                                                                <div class="col">
                                                                    <select name="idc_id" id="inpEditRefDoc" class="select2 form-select">
                                                                        <?php
                                                                        $option_topic = $this->ManageBackend->list_option("option/list_doc");
                                                                        echo '<option value="">Input for search Document No ...</option>';
                                                                        foreach ($option_topic as $topic) {
                                                                            echo '<option value="' . $topic['idc_id'] . '">' . $topic['idc_running_no'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="invalid-feedback"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex col-md-12 mb-3">
                                                            <div class="d-flex col-auto">
                                                                <label for="selDept" class="col-auto fs-3 text-dark fw-semibold me-3 mt-2">Member :</label>
                                                            </div>
                                                            <table class="table table-sm text-wrap mb-0 align-middle table-b text-center" id="tblEditPerson">
                                                                <tbody class="text-wrap bg-white">
                                                                    <tr>
                                                                        <td style="border: none;">
                                                                            <div class="col">
                                                                                <select type="text" class="form-select form-select-sm shadow-sm text-center" id="selEditDept" name="sd_id" onchange="changeEditMember(this)">
                                                                                    <option value="" selected>Choose Department</option>
                                                                                    <?php
                                                                                    $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                                                    foreach ($option_dept as $dept) {
                                                                                        echo '<option value="' . $dept['sd_id'] . '">' . '( ' . $dept['sd_dept_aname'] . ' ) ' . $dept['sd_dept_name'] . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <span class="invalid-feedback"></span>
                                                                            </div>
                                                                        </td>
                                                                        <td style="border: none;">
                                                                            <div class="col">
                                                                                <select type="text" class="form-select form-select-sm shadow-sm text-center" id="inpEditAddPerson" name="su_id" disabled>
                                                                                    <option value="">Choose Person or Fill Name</option>
                                                                                </select>
                                                                                <span class="invalid-feedback"></span>
                                                                            </div>
                                                                        </td>
                                                                        <td class="col-2" style="border: none;">
                                                                            <div class="d-flex col align-items-center">
                                                                                <button type="button" onclick="addEditPerson(event)" class="col-auto px-5 btn btn-sm rounded-pill bg-primary-subtle text-primary shadow-sm me-2">
                                                                                    <i class="ti ti-user-plus fs-6"></i>
                                                                                </button>
                                                                                <label for="" class="col-md-auto fw-semibold fs-1">( Max 20 Items )</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="d-flex col mb-3 gap-5">
                                                            <label for="" class="col-auto form-label fw-semibold me-3">Design Concern Point :</label>
                                                            <div class="w-100">
                                                                <textarea class="form-control" rows="3" id="inpDesignConcern" name="imc_detail"></textarea>
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row" style="padding: 15px;">
                                                        <!----------- Table Part No.  ------------>
                                                        <label for="" class="col-auto fs-3 text-dark fw-semibold me-3 mb-1">Next Action Need :</label>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblEditNextAction">
                                                                <thead class="text-dark fs-4">
                                                                    <tr>
                                                                        <th class="col-1">
                                                                            <h6 class="fw-semibold mb-0">No.</h6>
                                                                        </th>
                                                                        <th class="">
                                                                            <h6 class="fw-semibold mb-0">Topic</h6>
                                                                        </th>
                                                                        <th class="col-3">
                                                                            <h6 class="fw-semibold mb-0">P.I.C. Dept.</h6>
                                                                        </th>
                                                                        <th class="col-2">
                                                                            <h6 class="fw-semibold mb-0">Action Plan & Duedate</h6>
                                                                        </th>
                                                                        <th class="col-1">
                                                                            <h6 class="fw-semibold mb-0">Action</h6>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="border-top text-wrap bg-white">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm text-center shadow-sm" name="next_topic" id="inpEditNextTopic" value="" placeholder="Input your topic ...">
                                                                            <span class="invalid-feedback"></span>
                                                                        </td>
                                                                        <td>
                                                                            <select class="form-select form-select-sm shadow-sm text-center" name="next_dept" id="inpEditNextDept">
                                                                                <option value="" selected>Choose Department</option>
                                                                                <?php
                                                                                $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                                                foreach ($option_dept as $dept) {
                                                                                    echo '<option value="' . $dept['sd_id'] . '">' . '( ' . $dept['sd_dept_aname'] . ' ) ' . $dept['sd_dept_name'] . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="invalid-feedback"></span>
                                                                        </td>
                                                                        <td>
                                                                            <input type="date" class="form-control form-control-sm text-center shadow-sm" name="next_date" id="inpEditNextDate" value="<?php echo date('Y-m-d'); ?>">
                                                                            <span class="invalid-feedback"></span>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" onclick="addEditNextAction(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddNext" name="btn_add_next" data-id="">
                                                                                <i class="ti ti-pin fs-6"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-between gap-3 mt-2">
                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                        <button type="button" class="btn bg-danger-subtle text-danger card-hover" data-bs-dismiss="modal"><i class="ti ti-x me-2" style="font-size: 20px;"></i>Close</button>
                        <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="saveMeeting()"><i class="ti ti-download me-2" style="font-size: 20px;"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let dataTable;
    let isProcessing = false;

    async function addMeeting() {
        if (isProcessing) return;
        isProcessing = true;

        let groupMember = [];
        let groupNextAction = [];
        let hasError = false;

        let chk = await Meeting_valid("add");
        if (!chk) {
            isProcessing = false;
            return;
        }



        $('#tblPerson tbody tr:not(:first)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;

            $(this).find('td').each(function() {
                const input = $(this).find('input');

                if (input.length > 0) {
                    const inputName = input.attr('name');
                    let inputValue = input.val().trim();

                    if (inputName === 'imm_name') {
                        inputValue = inputValue.replace(/\s*\(\s*\w+\s*\)$/, '');
                    }

                    if (inputName === 'sd_id') {
                        inputValue = input.data('id-dept');
                    }
                    rowData[inputName] = inputValue;
                }
            });

            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupMember.push(rowData);
            }
        });

        if (hasError) {
            isProcessing = false;
            return;
        }

        $('#tblNextAction tbody tr:not(:first)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;

            $(this).find('td').each(function() {
                const input = $(this).find('input');
                const span = $(this).find('span[name="imnc_topic_no"]');

                if (input.length > 0) {
                    const inputName = input.attr('name');
                    let inputValue = input.val().trim();

                    if (inputName === 'sd_id') {
                        inputValue = input.data('id-dept');
                    }
                    rowData[inputName] = inputValue;
                }

                if (span.length > 0) {
                    let spanValue = parseInt(span.text().trim(), 10) || 0;
                    rowData['imnc_topic_no'] = spanValue;
                }
            });

            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupNextAction.push(rowData);
            }
        });

        if (hasError) {
            isProcessing = false;
            return;
        }

        if (groupMember.length == 0) {
            form_errValid(document.getElementById('selDept'), '*Please Add Group Member');
            form_errValid(document.getElementById('inpAddPerson'), '*Please Add Group Member');
            isProcessing = false;
            return;
        }

        if (groupNextAction.length == 0) {
            form_errValid(document.getElementById('inpNextTopic'), '*Please Add Group Next Action Need');
            form_errValid(document.getElementById('inpNextDept'), '*Please Add Group Next Action Need');
            isProcessing = false;
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to register meeting?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, register it.!'
        }).then((result) => {
            if (result.isConfirmed) {
                var add_form = {};
                $('#add_form').serializeArray().forEach(function(item) {
                    if (item.name == 'sd_id' || item.name == 'imm_name' || item.name == 'su_id' || item.name == 'next_dept' || item.name == 'next_topic' || item.name == 'next_date' || item.name == 'imnc_topic_detail') {
                        return;
                    }
                    if (item.name == 'idc_id' || item.name == 'mdt_id') {
                        item.value = parseInt(item.value)
                    }
                    add_form[item.name] = item.value;
                });

                add_form["imc_created_date"] = getTimeNow();
                add_form["imc_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                add_form["imc_group_member"] = groupMember;
                add_form["imc_group_action"] = groupNextAction;

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'meeting/insert',
                    data: JSON.stringify(add_form),
                    success: function(data) {
                        if (data.Error != "null" || data.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Register meeting success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblMeeting').DataTable();
                            dataTable.ajax.reload(null, false);
                            clearForm();
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error register Meeting!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
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
    async function saveMeeting() {
        if (isProcessing) return;
        isProcessing = true;

        let groupMember = [];
        let groupNextAction = [];
        let hasError = false;

        let chk = await Meeting_valid("edit");
        if (!chk) {
            isProcessing = false;
            return;
        }

        $('#tblEditPerson tbody tr:not(:first)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;

            $(this).find('td').each(function() {
                const input = $(this).find('input');

                if (input.length > 0) {
                    const inputName = input.attr('name');

                    let inputID = input.data('imm-id');

                    let inputValue = input.val().trim();

                    if (inputName === 'imm_name') {
                        inputValue = inputValue.replace(/\s*\(\s*\w+\s*\)$/, '');
                    }

                    if (inputName === 'sd_id') {
                        inputValue = input.data('id-dept');
                        if (inputID != 0) {
                            rowData['imm_id'] = parseInt(inputID);
                        } else {
                            rowData['imm_id'] = 0;
                        }
                    }

                    rowData[inputName] = inputValue;
                }
            });

            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupMember.push(rowData);
            }
        });

        if (hasError) {
            isProcessing = false;
            return;
        }

        $('#tblEditNextAction tbody tr:not(:first)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;

            $(this).find('td').each(function() {
                const input = $(this).find('input');
                const span = $(this).find('span[name="imnc_topic_no"]');

                if (input.length > 0) {
                    const inputName = input.attr('name');
                    let inputValue = input.val().trim();
                    let inputID = input.data('imnc-id');

                    if (inputName === 'sd_id') {
                        inputValue = input.data('id-dept');
                        if (inputID != 0) {
                            rowData['imnc_id'] = parseInt(inputID);
                        } else {
                            rowData['imnc_id'] = 0;
                        }
                    }
                    rowData[inputName] = inputValue;
                }

                if (span.length > 0) {
                    let spanValue = parseInt(span.text().trim(), 10) || 0;
                    rowData['imnc_topic_no'] = spanValue;
                }
            });

            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupNextAction.push(rowData);
            }
        });

        if (hasError) {
            isProcessing = false;
            return;
        }

        if (groupMember.length == 0) {
            form_errValid(document.getElementById('selEditDept'), '*Please Add Group Member');
            form_errValid(document.getElementById('inpEditAddPerson'), '*Please Add Group Member');
            isProcessing = false;
            return;
        }

        if (groupNextAction.length == 0) {
            form_errValid(document.getElementById('inpEditNextTopic'), '*Please Add Group Next Action Need');
            form_errValid(document.getElementById('inpEditNextDept'), '*Please Add Group Next Action Need');
            isProcessing = false;
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save meeting?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it.!'
        }).then((result) => {
            if (result.isConfirmed) {
                var add_form = {};
                $('#edit_form').serializeArray().forEach(function(item) {
                    if (item.name == 'sd_id' || item.name == 'imm_name' || item.name == 'su_id' || item.name == 'next_dept' || item.name == 'next_topic' || item.name == 'next_date' || item.name == 'imnc_topic_detail') {
                        return;
                    }
                    if (item.name == 'idc_id' || item.name == 'mdt_id' || item.name == 'imc_id') {
                        item.value = parseInt(item.value)
                    }
                    add_form[item.name] = item.value;
                });

                add_form["imc_updated_date"] = getTimeNow();
                add_form["imc_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                add_form["imc_group_member"] = groupMember;
                add_form["imc_group_action"] = groupNextAction;

                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'meeting/edit',
                    data: JSON.stringify(add_form),
                    success: function(data) {
                        if (data.Error != "null" || data.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update meeting success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblMeeting').DataTable();
                            dataTable.ajax.reload(null, false);
                            $('#mdlEdit').modal('hide');
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error update Meeting!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
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

    function searchDate() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblMeeting')) {
            $('#tblMeeting').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        dataTable = $('#tblMeeting').DataTable({
            ajax: {
                url: API_URL + 'meeting/searchDate/' + stratDate,
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
                    data: 'imc_id'
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Domestic';
                        } else if (row.idc_customer_type == 2) {
                            return 'Overseas';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center',
                    data: 'idc_running_no',
                    "render": function(data, type, row) {
                        return `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewDocPDF('${row.idc_running_no}', '${row.mdt_position1}', '${row.idc_id}')" data-bs-toggle="modal" data-bs-target="#mdlReferDoc">${row.idc_running_no}</span>`;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'imc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.imc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'imc_date',
                },
                {
                    className: 'text-center',
                    data: 'imc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.imc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.imc_created_by + '">' + row.imc_created_by + '</span>' +
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
                    data: 'imc_id',
                    "render": function(data, type, row) {
                        return showbtnAction(row.imc_status, row.imc_id);
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
    async function clearForm() {
        const form = document.querySelector('#add_form');
        const topic = document.querySelector('#inpNextTopic');
        const refDoc = form.querySelector('#inpRefDoc');
        const dept = form.querySelector('#selDept');
        const person = form.querySelector('#inpAddPerson');
        const nextDept = form.querySelector('#inpNextDept');

        form.reset();
        $('#tblPerson tbody tr:not(:first-child)').remove();
        $('#tblNextAction tbody tr:not(:first-child)').remove();

        form.querySelectorAll('input, select, textarea').forEach(element => form_defaultValid(element));

        [refDoc, dept, person, nextDept, topic].forEach(element => {
            element.selectedIndex = 0;
            $(element).trigger('change');
        });
    }
    async function addNextAction(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const topic = currentRow.querySelector('#inpNextTopic');
        const dept = currentRow.querySelector('#inpNextDept');
        const date = currentRow.querySelector('#inpNextDate');

        if (topic.value == "") {
            form_errValid(topic, "*Please input topic details. !!");
            return;
        } else {
            form_okValid(topic);
            if (dept.value == "") {
                form_errValid(dept, "*Please Choose Person Department !!");
                return;
            } else {
                form_okValid(dept);
                if (date.value == "") {
                    form_errValid(date, "*Please Choose Date !!");
                    return;
                } else {
                    form_okValid(date);
                }
            }
        }

        if ($('#tblNextAction tbody tr').length > 10) {
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
            topic.value = "";
            dept.selectedIndex = 0;
            $(dept).trigger('change');
            date.value = "<?php echo date('Y-m-d') ?>";
            form_defaultValid(topic);
            form_defaultValid(dept);
            form_defaultValid(date);
            return;
        }

        const tbody = document.querySelector('#tblNextAction tbody');
        const newRow = document.createElement('tr');
        const existingDept = tbody.querySelectorAll(`input[data-id-dept]`);
        const deptExists = Array.from(existingDept).some(input => input.dataset.idDept === dept.value.trim());
        if (deptExists) {
            form_errValid(dept, "*This department is already on the list. !!");
            return;
        }
        newRow.innerHTML = `<td>
                                <div class="col-auto">
                                    <span class="" name="imnc_topic_no">${$('#tblNextAction tbody tr').length}</span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imnc_topic_detail" value="${topic.value}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="sd_id" data-id-dept="${dept.value.trim()}" value="${dept.options[dept.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="date" name="imnc_date" value="${date.value}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <button type="button" onclick="deleteNextAction(event)" class="btn btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm">
                                    <i class="ti ti-pinned-off fs-6"></i>
                                </button>
                            </td>`;
        tbody.appendChild(newRow);

        topic.value = "";
        dept.selectedIndex = 0;
        $(dept).trigger('change');
        date.value = "<?php echo date('Y-m-d') ?>";
        form_defaultValid(topic);
        form_defaultValid(dept);
        form_defaultValid(date);;
    }
    async function addPerson(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const dept = currentRow.querySelector('#selDept');
        const person = currentRow.querySelector('#inpAddPerson');

        if (dept.value == "") {
            form_errValid(dept, "*Please Choose Department !!");
            return;
        } else {
            form_okValid(dept);
            if (person.value == "") {
                form_errValid(person, "*Please Choose Person !!");
                return;
            } else {
                form_okValid(person);
            }
        }

        if ($('#tblPerson tbody tr').length > 21) {
            Swal.fire({
                html: "<h4>Cannot add more than 20 items.</h4>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            dept.selectedIndex = 0;
            person.selectedIndex = 0;
            $(dept).trigger('change');
            $(person).trigger('change');
            return;
        }

        const tbody = document.querySelector('#tblPerson tbody');
        const newRow = document.createElement('tr');
        const existingPerson = tbody.querySelectorAll(`input[data-id-person]`);
        const personExists = Array.from(existingPerson).some(input => input.dataset.idPerson === person.value.trim());

        if (personExists) {
            form_errValid(person, "*This user is already on the list. !!");
            return;
        }
        newRow.innerHTML = `<td style="border: none;">
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="sd_id" data-id-dept="${dept.value.trim()}" value="${dept.options[dept.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td style="border: none;">
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imm_name" data-id-person="${person.value.trim()}" value="${person.options[person.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td class="text-start" style="border: none;">
                                <button type="button" onclick="deletePerson(event)" class="col-auto px-4 btn btn-sm rounded-pill bg-danger-subtle text-danger shadow-sm">
                                    <i class="ti ti-trash-x fs-6"></i>
                                </button>
                            </td>`;
        tbody.appendChild(newRow);

        dept.selectedIndex = 0;
        person.selectedIndex = 0;
        $(dept).trigger('change');
        $(person).trigger('change');
    }

    function deleteNextAction(event) {
        const button = event.target.closest('button');
        const row = button.closest('tr');
        row.remove();
        reorderNumbers();
    }

    function reorderNumbers() {
        const rows = document.querySelectorAll('tbody tr');
        let count = 1;

        rows.forEach(row => {
            const numberCell = row.querySelector('span[name="imnc_topic_no"]');
            if (numberCell) {
                numberCell.textContent = count++;
            }
        });
    }

    function deletePerson(event) {
        const button = event.target.closest('button');
        const row = button.closest('tr');
        row.remove();
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
        var docNo = $('#inpSearchDocNo').val();
        var docTopic = $('#inpTopic option:selected').data('aname');

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
            .columns(2)
            .search(docTopic)
            .columns(4)
            .search(customerName)
            .columns(3)
            .search(docNo)
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
    async function ViewAll() {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblMeeting')) {
            $('#tblMeeting').DataTable().destroy();
        }
        let stratDate = $('#startDate').val();
        dataTable = $('#tblMeeting').DataTable({
            ajax: {
                url: API_URL + 'meeting/viewAll',
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
                    data: 'imc_id'
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Domestic';
                        } else if (row.idc_customer_type == 2) {
                            return 'Overseas';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center',
                    data: 'idc_running_no',
                    "render": function(data, type, row) {
                        return `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewDocPDF('${row.idc_running_no}', '${row.mdt_position1}', '${row.idc_id}')" data-bs-toggle="modal" data-bs-target="#mdlReferDoc">${row.idc_running_no}</span>`;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'imc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.imc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'imc_date',
                },
                {
                    className: 'text-center',
                    data: 'imc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.imc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.imc_created_by + '">' + row.imc_created_by + '</span>' +
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
                    data: 'imc_id',
                    "render": function(data, type, row) {
                        return showbtnAction(row.imc_status, row.imc_id);
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
        $('#inpImportFrom').prop('selectedIndex', 0);
        $('#inpCustomer').val($('#inpCustomer option:first').val()).trigger('change');
        $('#inpTopic').prop('selectedIndex', 0);
        $('#inpSearchDocNo').val('');
        dataTable
            .search('')
            .columns().search('')
            .draw();
    }
    async function listUserByDept(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_user_by_dept/' + id,
            success: function(result) {
                var option_text = '<option value="">Choose Person or Fill Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.su_id + '">' + value.su_firstname + ' ' + value.su_lastname + '&nbsp( ' + value.su_username + ' )' + '</option>';
                })
                $('#inpAddPerson').html(option_text);
            }
        })
    }
    async function listEditUserByDept(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_user_by_dept/' + id,
            success: function(result) {
                var option_text = '<option value="">Choose Person or Fill Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.su_id + '">' + value.su_firstname + ' ' + value.su_lastname + '&nbsp( ' + value.su_username + ' )' + '</option>';
                })
                $('#inpEditAddPerson').html(option_text);
            }
        })
    }
    async function changeMember(selectElement) {
        if (selectElement.value == '') {
            $('#inpAddPerson').prop('disabled', true);
            $('#inpAddPerson').empty().append('<option value="">Choose Person or Fill Name</option>');
            form_defaultValid(document.getElementById('selDept'));
            form_defaultValid(document.getElementById('inpAddPerson'));
            return;
        } else {
            $('#inpAddPerson').prop('disabled', false);
        }
        listUserByDept(selectElement.value);
    }
    async function changeEditMember(selectElement) {
        if (selectElement.value == '') {
            $('#inpEditAddPerson').prop('disabled', true);
            $('#inpEditAddPerson').empty().append('<option value="">Choose Person or Fill Name</option>');
            form_defaultValid(document.getElementById('selEditDept'));
            form_defaultValid(document.getElementById('inpEditAddPerson'));
            return;
        } else {
            $('#inpEditAddPerson').prop('disabled', false);
        }
        listEditUserByDept(selectElement.value);
    }

    function showStatus(status, id) {
        if (status == 1) {
            return '<span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>';
        } else if (status == 9) {
            return '<span class="badge bg-success-subtle text-success fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-check fs-4"></i>Close</span>';
        } else if (status == 5) {
            return '<span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>';
        } else {
            return '';
        }
    }

    function showbtnAction(status, id) {
        if (status == 1 || status == 6) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                    <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docClose(${id})" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Close">
                    <i class="ti ti-check" data-bs-target="#mdlClose" data-bs-toggle="modal"  style="font-size: 1.5rem !important;"></i>
                </button>
                <button type="button" onclick="docCancel(${id})" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                    <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 9) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editViewModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                    <i class="ti ti-zoom-exclamation" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                </button>
            </div>`;
        } else if (status == 5) {
            return `
            <div class="d-flex justify-content-evenly gap-1">
                <button type="button" onclick="editViewModal(${id})" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
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

    function docClose(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to close meeting record?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, close it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'meeting/close/' + id + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Close Meeting Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblMeeting').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Close Meeting!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblMeeting').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
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
            text: "Do you want to reverse meeting record?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reverse it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'meeting/reverse/' + id + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Reverse Meeting Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblMeeting').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Reverse Meeting!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                var dataTable = $('#tblMeeting').DataTable();
                                dataTable.ajax.reload(null, false);
                            })
                        }
                    }
                })
            }
        })
    }

    function docCancel(id) {
        event.preventDefault();
        let userID = '<?php echo $this->session->userdata('sessUsr'); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel the meeting record?",
            icon: 'warning',
            input: "text",
            inputPlaceholder: "Please fill reason for cancellation.",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!',
            preConfirm: (cancelReason) => {
                if (!cancelReason) {
                    Swal.showValidationMessage('Please enter a reason for cancellation.');
                }
                return cancelReason;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const cancelReason = result.value;
                $.ajax({
                    method: 'PUT',
                    url: API_URL + 'meeting/cancel/' + id + '/' + cancelReason + '/' + userID,
                    success: function(data) {
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Cancel Meeting Success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblMeeting').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Cancel Meeting!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblMeeting').DataTable();
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
    async function viewDocPDF(run_no, topic, idc_id) {
        let path, controller;

        switch (topic) {
            case 'FS':
                path = `nbc/${idc_id}`;
                controller = 'ManageFeasibility/createFeasibilityPDF';
                break;
            case 'RFQ':
                path = `rfq/${idc_id}`;
                controller = 'RfqForm/createPDF';
                break;
            case 'NBC':
                path = `nbc/${idc_id}`;
                controller = 'ManageNbc/createNbcPDF';
                break;
            default:
                Swal.fire({
                    title: 'Error',
                    text: 'Invalid document type',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
        }

        $.ajax({
            type: 'get',
            url: API_URL + path,
            success: async function(result) {
                let param;
                if (topic == 'FS' || topic == 'NBC') {
                    param = {
                        ...result.data[0]
                    };
                    $.ajax({
                        url: API_URL + 'rfq/refer_doc/' + result.data[0].idc_refer_doc,
                        method: 'GET',
                        success: function(response) {
                            $('#inpDocNo').val(run_no);
                            $('#inpDocNoRef').val(response.Running_no);
                        }
                    });
                } else {
                    param = {
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
                }

                let IssueDate = param.idc_created_date.split(" ")[0];
                param.idc_created_date = formatDate(IssueDate);

                let Duedate = param.idc_closing_date.split(" ")[0];
                param.idc_closing_date = formatDate(Duedate);

                let pdfUrl = '<?php echo base_url(); ?>' + controller + '?' + $.param(param);

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

        $('#mdlReferDoc').on('hidden.bs.modal', function() {
            $('#filePreview').attr('src', '');
        });
    }
    async function listTableMember(data, type) {
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
                html = '';
                html += '<tr>';
                html += `<td style="border: none;">
                            <div class="col-auto">
                                <input class="form-control form-control-sm text-center shadow-sm" type="text" name="sd_id" data-imm-id="${data[i].imm_id}" data-id-dept="${data[i].sd_id}" value="${data[i].sd_dept_name}" readonly>
                                <span class="invalid-feedback"></span>
                            </div>
                        </td>`;
                html += `<td style="border: none;">
                            <div class="col-auto">
                                <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imm_name" data-id-person="0" value="${data[i].imm_name}" readonly>
                                <span class="invalid-feedback"></span>
                            </div>
                        </td>`;
                html += `<td class="text-start" style="border: none;">
                            <button type="button" onclick="deletePerson(event)" class="col-auto px-4 btn btn-sm rounded-pill bg-danger-subtle text-danger shadow-sm">
                                <i class="ti ti-trash-x fs-6"></i>
                            </button>
                        </td>`;
                html += '</tr>';
                $('#tblEditPerson tbody').append(html);
            }
        }
    }
    async function listTableAction(data, type) {
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
            document.getElementById('tblEditNextAction').innerHTML = html;
        } else {
            for (let i = 0; i < data.length; i++) {
                html = '';
                html += '<tr>';
                html += `<td>
                            <div class="col-auto">
                                <span class="" name="imnc_topic_no" data-imnc-id="${data[i].imnc_id}" >${data[i].imnc_topic_no}</span>
                            </div>
                        </td>`;
                html += `<td>
                            <div class="col-auto">
                                <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imnc_topic_detail" value="${data[i].imnc_topic_detail}" readonly="">
                                <span class="invalid-feedback"></span>
                            </div>
                        </td>`;
                html += `<td>
                            <div class="col-auto">
                                <input class="form-control form-control-sm text-center shadow-sm" type="text" data-imnc-id="${data[i].imnc_id}" name="sd_id" data-id-dept="${data[i].sd_id}" value="${data[i].sd_dept_name}" readonly="">
                                <span class="invalid-feedback"></span>
                            </div>
                        </td>`;
                html += `<td>
                            <div class="col-auto">
                                <input class="form-control form-control-sm text-center shadow-sm" type="date" name="imnc_date" value="${data[i].imnc_date}" readonly="">
                                <span class="invalid-feedback"></span>
                            </div>
                        </td>`;
                html += `<td>
                             <button type="button" onclick="deleteNextAction(event)" class="btn btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm">
                                    <i class="ti ti-pinned-off fs-6"></i>
                                </button>
                        </td>`;
                html += '</tr>';
                $('#tblEditNextAction tbody').append(html);
            }
        }
    }
    async function addEditNextAction(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const topic = currentRow.querySelector('#inpEditNextTopic');
        const dept = currentRow.querySelector('#inpEditNextDept');
        const date = currentRow.querySelector('#inpEditNextDate');

        if (topic.value == "") {
            form_errValid(topic, "*Please input topic details. !!");
            return;
        } else {
            form_okValid(topic);
            if (dept.value == "") {
                form_errValid(dept, "*Please Choose Person Department !!");
                return;
            } else {
                form_okValid(dept);
                if (date.value == "") {
                    form_errValid(date, "*Please Choose Date !!");
                    return;
                } else {
                    form_okValid(date);
                }
            }
        }

        if ($('#tblEditNextAction tbody tr').length > 10) {
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
            topic.value = "";
            dept.selectedIndex = 0;
            $(dept).trigger('change');
            date.value = "<?php echo date('Y-m-d') ?>";
            form_defaultValid(topic);
            form_defaultValid(dept);
            form_defaultValid(date);
            return;
        }

        const tbody = document.querySelector('#tblEditNextAction tbody');
        const newRow = document.createElement('tr');
        const existingDept = tbody.querySelectorAll(`input[data-id-dept]`);
        const deptExists = Array.from(existingDept).some(input => input.dataset.idDept === dept.value.trim());
        if (deptExists) {
            form_errValid(dept, "*This department is already on the list. !!");
            return;
        }
        newRow.innerHTML = `<td>
                                <div class="col-auto">
                                    <span class="" name="imnc_topic_no">${$('#tblEditNextAction tbody tr').length}</span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imnc_topic_detail" value="${topic.value}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" data-imnc-id="0" name="sd_id" data-id-dept="${dept.value.trim()}" value="${dept.options[dept.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="date" name="imnc_date" value="${date.value}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td>
                                <button type="button" onclick="deleteNextAction(event)" class="btn btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm">
                                    <i class="ti ti-pinned-off fs-6"></i>
                                </button>
                            </td>`;
        tbody.appendChild(newRow);

        topic.value = "";
        dept.selectedIndex = 0;
        $(dept).trigger('change');
        date.value = "<?php echo date('Y-m-d') ?>";
        form_defaultValid(topic);
        form_defaultValid(dept);
        form_defaultValid(date);;
    }
    async function addEditPerson(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const dept = currentRow.querySelector('#selEditDept');
        const person = currentRow.querySelector('#inpEditAddPerson');

        if (dept.value == "") {
            form_errValid(dept, "*Please Choose Department !!");
            return;
        } else {
            form_okValid(dept);
            if (person.value == "") {
                form_errValid(person, "*Please Choose Person !!");
                return;
            } else {
                form_okValid(person);
            }
        }

        if ($('#tblEditPerson tbody tr').length > 21) {
            Swal.fire({
                html: "<h4>Cannot add more than 20 items.</h4>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            dept.selectedIndex = 0;
            person.selectedIndex = 0;
            $(dept).trigger('change');
            $(person).trigger('change');
            return;
        }

        const tbody = document.querySelector('#tblEditPerson tbody');
        const newRow = document.createElement('tr');

        const personName = person.options[person.selectedIndex].text.replace(/\s*\(\s*\d+\s*\)/, "").trim();
        const existingPersons = document.querySelectorAll('#tblEditPerson tbody input[name="imm_name"]');
        const personExists = Array.from(existingPersons).some(input =>
            input.value.trim() === personName
        );
        if (personExists) {
            form_errValid(person, "*This user is already on the list. !!");
            return;
        }

        newRow.innerHTML = `<td style="border: none;">
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="sd_id" data-imm-id="0" data-id-dept="${dept.value.trim()}" value="${dept.options[dept.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td style="border: none;">
                                <div class="col-auto">
                                    <input class="form-control form-control-sm text-center shadow-sm" type="text" name="imm_name" data-id-person="${person.value.trim()}" value="${person.options[person.selectedIndex].text}" readonly>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </td>
                            <td class="text-start" style="border: none;">
                                <button type="button" onclick="deletePerson(event)" class="col-auto px-4 btn btn-sm rounded-pill bg-danger-subtle text-danger shadow-sm">
                                    <i class="ti ti-trash-x fs-6"></i>
                                </button>
                            </td>`;
        tbody.appendChild(newRow);

        dept.selectedIndex = 0;
        person.selectedIndex = 0;
        $(dept).trigger('change');
        $(person).trigger('change');
    }

    function editViewModal(id) {
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
                                url: API_URL + 'meeting/' + id,
                                success: function(data) {
                                    if (!data.Error) {
                                        data = data[0];
                                        document.edit_form.imc_id.value = data.imc_id;
                                        document.edit_form.mdt_id.value = data.mdt_id;
                                        document.edit_form.imc_date.value = data.imc_date;
                                        $('[name="idc_id"]').val(data.idc_id).trigger('change');
                                        document.edit_form.imc_detail.value = data.imc_detail;
                                        listTableMember(data.imc_group_member, 'edit');
                                        listTableAction(data.imc_group_action, 'edit');
                                        const formElements = document.edit_form.querySelectorAll('input, select, button');
                                        formElements.forEach(element => {
                                            form_defaultValid(element);
                                        });
                                        document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button:not([data-keep-enabled]), #edit_form textarea').forEach(element => element.disabled = true);
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
                                $('#mdlEdit').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                        $('.select2-container').find('.select2-selection--single, .select2-selection__rendered').css({
                            'height': '30px',
                            'line-height': '30px',
                            'font-size': '12px',
                        });
                        $('.select2-container').find('.select2-selection__arrow').css({
                            'height': '35px',
                            'line-height': '35px',
                        });
                    });
            });

        $('#mdlEdit').modal('show');
        $('#mdlEdit').on('hidden.bs.modal', function() {
            $('#tblEditPerson tbody tr:not(:first-child)').remove();
            $('#tblEditNextAction tbody tr:not(:first-child)').remove();
        });
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
                        modal.find('#inpEditRefDoc, #selEditDept, #inpEditAddPerson, #inpEditAddTopic, #inpEditNextDept').select2({
                            dropdownParent: modal,
                            width: '100%'
                        });
                        setTimeout(() => resolve(), 100);
                    })
                    .then(() => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                method: 'GET',
                                url: API_URL + 'meeting/' + id,
                                success: function(data) {
                                    if (!data.Error) {
                                        data = data[0];
                                        document.edit_form.imc_id.value = data.imc_id;
                                        document.edit_form.mdt_id.value = data.mdt_id;
                                        document.edit_form.imc_date.value = data.imc_date;
                                        $('[name="idc_id"]').val(data.idc_id).trigger('change');
                                        document.edit_form.imc_detail.value = data.imc_detail;
                                        listTableMember(data.imc_group_member, 'edit');
                                        listTableAction(data.imc_group_action, 'edit');
                                        const formElements = document.edit_form.querySelectorAll('input, select, button');
                                        formElements.forEach(element => {
                                            form_defaultValid(element);
                                        });
                                        document.querySelectorAll('#edit_form input, #edit_form select, #edit_form button:not([data-keep-enabled]), #edit_form textarea').forEach(element => element.disabled = false);
                                        document.querySelector('#inpEditAddPerson').disabled = true;
                                        modal.find('#inpEditRefDoc, #selEditDept, #inpEditAddPerson, #inpEditAddTopic, #inpEditNextDept').trigger('change');
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
                                $('#mdlEdit').modal('hide');
                            }
                        });
                    })
                    .finally(() => {
                        Swal.close();
                        $('.select2-container').find('.select2-selection--single, .select2-selection__rendered').css({
                            'height': '30px',
                            'line-height': '30px',
                            'font-size': '12px',
                        });
                        $('.select2-container').find('.select2-selection__arrow').css({
                            'height': '35px',
                            'line-height': '35px',
                        });
                    });
            });

        $('#mdlEdit').modal('show');
        $('#mdlEdit').on('hidden.bs.modal', function() {
            $('#tblEditPerson tbody tr:not(:first-child)').remove();
            $('#tblEditNextAction tbody tr:not(:first-child)').remove();
        });
    }

    $(document).ready(function() {
        $('#inpCustomer, #inpRefDoc, #selDept, #inpAddPerson, #inpTopic, #inpAddTopic, #inpNextDept, #inpImportFrom').select2();

        $('.select2-container--default .select2-selection--single, .select2-container--default .select2-selection__rendered').css({
            'height': '30px',
            'line-height': '30px',
            'font-size': '12px',
        });
        $('.select2-container--default .select2-selection__arrow').css({
            'height': '35px',
            'line-height': '35px',
        });
        listCustomer();
        if ($.fn.DataTable.isDataTable('#tblMeeting')) {
            $('#tblMeeting').DataTable().destroy();
        }
        dataTable = $('#tblMeeting').DataTable({
            ajax: {
                url: API_URL + 'meeting/table',
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
                    data: 'imc_id'
                },
                {
                    className: 'text-center col-1',
                    data: 'idc_customer_type',
                    render: function(data, type, row) {
                        if (row.idc_customer_type == 1) {
                            return 'Domestic';
                        } else if (row.idc_customer_type == 2) {
                            return 'Overseas';
                        }
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center',
                    data: 'idc_running_no',
                    "render": function(data, type, row) {
                        return `<span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;" onclick="viewDocPDF('${row.idc_running_no}', '${row.mdt_position1}', '${row.idc_id}')" data-bs-toggle="modal" data-bs-target="#mdlReferDoc">${row.idc_running_no}</span>`;
                    }
                },
                {
                    className: 'text-center',
                    data: 'idc_customer_name',
                },
                {
                    className: 'text-center',
                    data: 'imc_status',
                    "render": function(data, type, row) {
                        return showStatus(row.imc_status);
                    }
                },
                {
                    className: 'text-center',
                    data: 'imc_date',
                },
                {
                    className: 'text-center',
                    data: 'imc_created_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.create_by != "") {
                                let emp_code = row.imc_created_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.imc_created_by + '">' + row.imc_created_by + '</span>' +
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
                    data: 'imc_id',
                    "render": function(data, type, row) {
                        return showbtnAction(row.imc_status, row.imc_id);
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