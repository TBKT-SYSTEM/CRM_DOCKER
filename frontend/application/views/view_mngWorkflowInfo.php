<title>CRM | Manage Workflow Info</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Workflow Info</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Workflow Info</li>
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
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true">
                                    <span>Workflow Detail</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Workflow Group</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div class="row text-end mb-3">
                                        <label for="selWorkflowGroup" class="form-label fw-semibold col-sm col-form-label">Workflow Group</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="selWorkflowGroup">
                                                <option value="" selected disabled>Choose Workflow group</option>
                                                <?php
                                                    $option_swg = $this->ManageBackend->list_option("option/list_swg");
                                                    foreach($option_swg as $op_swg){
                                                        echo '<option value="'.$op_swg['swg_id'].'">'.$op_swg['swg_name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <span class="form_error"></span>
                                        </div>
                                    </div>
                                    <div id="tab-1" style="display: block;">
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-file-text text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Workflow Detail</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selAppLv" class="form-label fw-semibold col-sm-3 col-form-label">Approve Level</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selAppLv">
                                                            <option value="" selected disabled>Choose approve level</option>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selUser" class="form-label fw-semibold col-sm-3 col-form-label">User</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selUser">
                                                            <option value="" selected disabled>Choose user</option>
                                                            <?php
                                                                $option_user = $this->ManageBackend->list_option("option/list_user");
                                                                foreach($option_user as $op_user){
                                                                    echo '<option value="'.$op_user['su_id'].'">'.$op_user['su_fname'].' '.$op_user['su_lname'].' ('.$op_user['sd_name'].')</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selApproveType" class="form-label fw-semibold col-sm-3 col-form-label">Approve Type</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selApproveType">
                                                            <option value="" selected disabled>Choose approve type</option>
                                                            <?php
                                                                $option_user = $this->ManageBackend->list_option("option/list_approve_type");
                                                                foreach($option_user as $op_user){
                                                                    echo '<option value="'.$op_user['sat_id'].'">'.$op_user['sat_name'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn btn-primary" id="btnRegisterWorkflowDetail" onclick="addWorkflowDetail()">
                                                    <i class="ti ti-plus me-1"></i> Register
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-list-details text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Workflow Detail List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblWorkflowDetail" class="dataTable table  table-bordered text-nowrap align-middle ">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Approve Level</th>
                                                            <th>Approve By</th>
                                                            <th>Approve Type</th>
                                                            <th>Updated Date</th>
                                                            <th>Updated By</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <!-- end row -->
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                                    <div id="tab-2" style="display: block;">
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-file-text text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Workflow Group</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-lg">
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="inpWorkflowGroup" class="form-label fw-semibold col-sm-3 col-form-label">Workflow Group</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="inpWorkflowGroup" class="form-control" placeholder="Enter Workflow Group">
                                                            <span class="form_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="inpMaxLv" class="form-label fw-semibold col-sm-3 col-form-label">Max Level</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="inpMaxLv">
                                                                <option value="" selected disabled>Choose Max Level of approval</option>
                                                                <?php
                                                                    for($i=1;$i<=10;$i++){
                                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                            <span class="form_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button type="button" class="btn btn btn-primary" onclick="addWorkflowGroup()">
                                                        <i class="ti ti-plus me-1"></i> Register
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-list-details text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Workflow Group List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblWorkflowGroup" class="dataTable table  table-bordered text-nowrap align-middle " style="width: 100%;">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Workflow Group</th>
                                                            <th>Max Level</th>
                                                            <th>Updated Date</th>
                                                            <th>Updated By</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <!-- end row -->
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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


<!-- Modal for edit Workflow detail -->
<div class="modal fade" id="mdlEditWorkflowDetail" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Workflow Detail
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditWorkflow" name="frmEditWorkflow">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="editAppLv" class="form-label fw-semibold col-sm-3 col-form-label">Approve Level</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editAppLv" name="swd_app_lv"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="editUser" class="form-label fw-semibold col-sm-3 col-form-label">User</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editUser" name="su_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="editApproveType" class="form-label fw-semibold col-sm-3 col-form-label">Approve Type</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editApproveType" name="sat_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="WorkflowDetail_id" name="swd_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateWorkflow" onclick="editWorkflowDetail()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit Workflow group -->
<div class="modal fade" id="mdlEditWorkflowGroup" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Workflow Group
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_formWorkflowGroup" name="edit_formWorkflowGroup">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="edtWorkflowGroup" class="form-label fw-semibold col-sm-3 col-form-label">Workflow Group</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtWorkflowGroup" name="swg_name" placeholder="Enter Workflow group">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtMaxLv" class="form-label fw-semibold col-sm-3 col-form-label">Max Level</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtMaxLv" name="swg_max_lv"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="swg_id" id="edtWorkflowGroupId">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateWorkflowGroup" onclick="editWorkflowGroup()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    async function addWorkflowGroup(){
		event.preventDefault();
        let chk = await swg_validate("add");
        // console.log(chk);
        if(chk){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var add_form = {
                        "swg_name": $('#inpWorkflowGroup').val(),
                        "swg_max_lv": parseInt($('#inpMaxLv').val()),
                        "create_date": getTimeNow(),
                        "create_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'workflow_group/insert',
                        data: JSON.stringify(add_form),
                        success: function(data){
                            // console.log(data);
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Workflow group success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Workflow group!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }
                        },
                        error: function(err){console.log(err);}
                    })
                }
            })

        }
	}
    async function editWorkflowGroup(){
		event.preventDefault();
        let chk = await swg_validate("edit");
        if(chk){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var edit_form = {};
                    $('#edit_formWorkflowGroup').serializeArray().forEach(function(item) {
                        if(item.name == 'swg_id' || item.name == 'swg_max_lv'){
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["update_date"] = getTimeNow();
                    edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
    
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'workflow_group/update',
                        data: JSON.stringify(edit_form),
                        success: function(data){
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Workflow group success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Workflow group!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }
                        },
                        error: function(err){console.log(err)}
                    })
                }
            })
        }
	}
    function change_swg_status(id,status){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var status_form = {};
                status_form["swg_id"] = id;
                status_form["swg_status"] = status;
                $.ajax({
                    type: 'PUT',
					dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL+'workflow_group/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data){
                        // console.log(data);
                        if(data!=false){
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Workflow group success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }else{
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Workflow group!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                    },
                    error: function(err){console.log(err);}
                })
            }
        })
    }
    async function addWorkflowDetail(){
		event.preventDefault();
        let chk = await swd_validate("add");
        if(chk){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var add_form = {
                        "swd_app_lv": parseInt($('#selAppLv').val()),
                        "su_id": parseInt($('#selUser').val()),
                        "swg_id": parseInt($('#selWorkflowGroup').val()),
                        "sat_id": parseInt($('#selApproveType').val()),
                        "create_date": getTimeNow(),
                        "create_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'workflow_detail/insert',
                        data: JSON.stringify(add_form),
                        success: function(data){
                            // console.log(data);
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Workflow detail success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Workflow detail!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                            }
                        },
                        error: function(err){console.log(err);}
                    })
                }
            })

        }
	}
    async function editWorkflowDetail(){
		event.preventDefault();
        let chk = await swd_validate("edit");
        if(chk){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var edit_form = {};
                    $('#frmEditWorkflow').serializeArray().forEach(function(item) {
                        if(item.name == 'swd_id' || item.name == 'swd_app_lv' || item.name == 'su_id' || item.name == 'sat_id'){
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["swg_id"] = parseInt($("#selWorkflowGroup").val());
                    edit_form["update_date"] = getTimeNow();
                    edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
    
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'workflow_detail/update',
                        data: JSON.stringify(edit_form),
                        success: function(data){
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Workflow detail success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Workflow detail!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }
                        },
                        error: function(err){console.log(err)}
                    })
                }
            })
        }
	}
    function change_swd_status(id,status){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var status_form = {};
                status_form["swd_id"] = id;
                status_form["swd_status"] = status;
                $.ajax({
                    type: 'PUT',
					dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL+'workflow_detail/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data){
                        // console.log(data);
                        if(data!=false){
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Workflow detail success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }else{
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Workflow detail!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                    },
                    error: function(err){console.log(err);}
                })
            }
        })
    }
// modal --------------------------------------
	function editModal(name,id,swg_max_lv){
		event.preventDefault();
		$('#edtWorkflowGroup').val(name);
		$('#edtWorkflowGroupId').val(id);
        let maxText = '<option value="" selected disabled>Choose Max Level of approval</option>';
        for(let i=1;i<=10;i++){
            let sel = "";
            if(sel == swg_max_lv){sel = "selected";}
            maxText += '<option value="'+i+'" '+sel+'>'+i+'</option>';
        }
		$('#edtMaxLv').html(maxText);
	}
    function editDetailModal(app_lv,su_id,sat_id,id){
		event.preventDefault();
		$('#WorkflowDetail_id').val(id);
        editMaxLevel(app_lv);
        editUserOption(su_id);
        editAppTypeOption(sat_id);
	}
    function editUserOption(id){
        $.ajax({
            type: 'get',
            url: API_URL+'option/list_user',
            success: function (result){
                var option_text = '<option value="" selected disabled>Choose user</option>';
                $.each(result, function (key, value){
                    let sel = "";
                    if(value.su_id == id){sel = "selected";}
                    option_text += '<option value="'+value.su_id+'" '+sel+'>'+value.su_fname+' '+value.su_lname+'</option>';
                })
                $('#editUser').html(option_text);
            }
        })
    }
    function editAppTypeOption(id){
        $.ajax({
            type: 'get',
            url: API_URL+'option/list_approve_type',
            success: function (result){
                var option_text = '<option value="" selected disabled>Choose Approve Type</option>';
                $.each(result, function (key, value){
                    let sel = "";
                    if(value.sat_id == id){sel = "selected";}
                    option_text += '<option value="'+value.sat_id+'" '+sel+'>'+value.sat_name+'</option>';
                })
                $('#editApproveType').html(option_text);
            }
        })
    }
    function editMaxLevel(app_lv){
        var swg_id = document.getElementById("selWorkflowGroup").value;
        $.ajax({
            type: 'get',
            url: API_URL+'workflow_group/'+swg_id,
            success: function (result){
                console.log(swg_id)
                var option_text = '<option value="" selected disabled>Choose approve level</option>';
                for(let i = 1;i<=result.swg_max_lv;i++){
                    let sel = "";
                    if(app_lv == i){sel = "selected";}
                    option_text += '<option value="'+i+'" '+sel+'>Approve Lv.'+i+'</option>';
                }
                $('#editAppLv').html(option_text);
            }
        })
    }
    function getMaxLevel(swg_id){
        $.ajax({
            type: 'get',
            url: API_URL+'workflow_group/'+swg_id,
            success: function (result){
                var option_text = '<option value="" selected disabled>Choose approve level</option>';
                for(let i = 1;i<=result.swg_max_lv;i++){
                    option_text += '<option value="'+i+'">Approve Lv.'+i+'</option>';
                }
                $('#selAppLv').html(option_text);
            }
        })
    }
    $('#selWorkflowGroup').on('change', function() {
        // alert( this.value );
        getMaxLevel(this.value);
        if ( $.fn.DataTable.isDataTable('#tblWorkflowDetail') ) {
            $('#tblWorkflowDetail').DataTable().destroy();
            $('#tblWorkflowDetail').empty();
        }
		var detailTable = $('#tblWorkflowDetail').DataTable({
			ajax: {
				url: API_URL+'workflow_detail/table/'+this.value
			},
            columnDefs: [{
					searchable: true,
					orderable: false,
					targets: 0,
				},
			],
            bSort: false,
			order: [[1, 'asc']],
			columns: [{
                    title:'No.',
                    className: 'text-center',
                    data:'swd_id'
                },
                {
                    title:'Approve Level',
                    className: 'text-center',
                    data:'swd_app_lv'
                },
                {
                    title:'Approve By',
                    className: 'text-center',
                    data:'fullname'
                },
                {
                    title:'Approve Type',
                    className: 'text-center',
                    data:'sat_name'
                },
                {
                    title:'Updated Date',
                    className: 'text-center',
                    data:'update_date'
                },
                {
                    title:'Updated By',
                    className: 'text-center',
                    data:'update_by',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.update_by!=""){
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/'+row.update_by+'.jpg';
                                if(!is_cached(img_ok)){img_ok = 'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';}
                                disp = '<div class="d-flex align-items-center">'+
                                    '<img src="'+img_ok+'" alt="avatar" class="rounded-circle avatar" width="35">'+
                                    '<div class="ms-3">'+
                                        '<div class="user-meta-info">'+
                                            '<h6 class="user-name mb-0" data-name="'+row.su_fname+' '+row.su_lname+'">'+row.su_fname+'</h6>'+
                                            '<span class="user-work fs-3" data-occupation="'+row.update_by+'">'+row.update_by+'</span>'+
                                '</div></div></div>';
                            }else{disp="";}
                        }
                        return disp;
                    },
                },
                {
                    title:'Status',
                    className: 'text-center',
                    data:'swd_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.swd_status){
                                disp = '<a onclick="change_swd_status('+row.swd_id+',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            }else{
                                disp = '<a onclick="change_swd_status('+row.swd_id+',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    title:'Action',
                    className: 'text-center',
                    data:'swd_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            disp = '<button type="button" onclick="editDetailModal(\''+row.swd_app_lv+'\',\''+row.su_id+'\',\''+row.sat_id+'\',\''+row.swd_id+'\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditWorkflowDetail">'+
                                '<i class="ti ti-pencil me-1"></i>Edit</button>';
                        }
                        return disp;
                    }
            }]
		});
        detailTable.on('order.dt search.dt', function () {
            let i = 1;
            detailTable.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
        setInterval(function (){
            detailTable.ajax.reload( null, false );
        }, 1000 );
    });
    $(document).ready(function (){
        if ( $.fn.DataTable.isDataTable('#tblWorkflowGroup') ) {
            $('#tblWorkflowGroup').DataTable().destroy();
        }
		var dataTable = $('#tblWorkflowGroup').DataTable({
			ajax: {
				url: API_URL+'workflow_group/table'
			},
            columnDefs: [{
					searchable: true,
					orderable: false,
					targets: 0,
				},
			],
            bSort: false,
			order: [[1, 'asc']],
			columns: [{
                    className: 'text-center',
                    data:'swg_id'
                },
                {
                    className: 'text-center',
                    data:'swg_name'
                },
                {
                    className: 'text-center',
                    data:'swg_max_lv'
                },
                {
                    className: 'text-center',
                    data:'update_date'
                },
                {
                    className: 'text-center',
                    data:'update_by',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.update_by!=""){
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/'+row.update_by+'.jpg';
                                if(!is_cached(img_ok)){img_ok = 'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';}
                                disp = '<div class="d-flex align-items-center">'+
                                    '<img src="'+img_ok+'" alt="avatar" class="rounded-circle avatar" width="35">'+
                                    '<div class="ms-3">'+
                                        '<div class="user-meta-info">'+
                                            '<h6 class="user-name mb-0" data-name="'+row.su_fname+' '+row.su_lname+'">'+row.su_fname+'</h6>'+
                                            '<span class="user-work fs-3" data-occupation="'+row.update_by+'">'+row.update_by+'</span>'+
                                '</div></div></div>';
                            }else{disp="";}
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data:'swg_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.swg_status){
                                disp = '<a onclick="change_swg_status('+row.swg_id+',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            }else{
                                disp = '<a onclick="change_swg_status('+row.swg_id+',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data:'swg_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            disp = '<button type="button" onclick="editModal(\''+row.swg_name+'\',\''+row.swg_id+'\',\''+row.swg_max_lv+'\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditWorkflowGroup">'+
                                '<i class="ti ti-pencil me-1"></i>Edit</button>';
                        }
                        return disp;
                    }
            }]
		});
        dataTable.on('order.dt search.dt', function () {
            let i = 1;
            dataTable.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();

		setInterval(function (){
			dataTable.ajax.reload( null, false );
		}, 1000 );
	});
</script>