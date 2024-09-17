<title>CRM | Manage Consideration Info</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Consideration Info</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Consideration Info</li>
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
                                    <span>Incharge</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Consideration</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div id="tab-1" style="display: block;">
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-file-text text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Incharge</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selTitle" class="form-label fw-semibold col-sm-3 col-form-label">Title</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selTitle">
                                                            <option value="" selected disabled>Choose title</option>
                                                            <?php
                                                                $option_consider = $this->ManageBackend->list_option("option/list_mc");
                                                                foreach($option_consider as $consider){
                                                                    echo '<option value="'.$consider['mc_id'].'">'.$consider['mc_title'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selDept" class="form-label fw-semibold col-sm-3 col-form-label">Department</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selDept">
                                                            <option value="" selected disabled>Choose department</option>
                                                            <?php
                                                                $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                                foreach($option_dept as $dept){
                                                                    echo '<option value="'.$dept['sd_id'].'">'.$dept['sd_name'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn btn-primary" id="btnRegisterConsiderationDetail" onclick="addIncharge()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Consideration Incharge List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblIncharge" class="dataTable table  table-bordered text-nowrap align-middle ">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Consideration</th>
                                                            <th>Incharge</th>
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Consideration</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpTitle" class="form-label fw-semibold col-sm-3 col-form-label">Title</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" id="inpTitle" class="form-control" placeholder="Enter Title">
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpWeight" class="form-label fw-semibold col-sm-1 col-form-label">Weight</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" id="inpWeight" class="form-control" placeholder="Enter Weight">
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn btn-primary" onclick="addConsider()">
                                                            <i class="ti ti-plus me-1"></i> Register
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-list-details text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Consideration List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblConsideration" class="dataTable table  table-bordered text-nowrap align-middle " style="width: 100%;">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Title</th>
                                                            <th>Weight</th>
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


<!-- Modal for edit Incharge -->
<div class="modal fade" id="mdlEditIncharge" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Incharge
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditConsideration" name="frmEditConsideration">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="edtmc" class="form-label fw-semibold col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtmc" name="mc_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtDept" class="form-label fw-semibold col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtDept" name="sd_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="Incharge_id" name="mci_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateConsideration" onclick="editIncharge()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit Consideration -->
<div class="modal fade" id="mdlEditConsideration" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Consideration
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_formConsider" name="edit_formConsider">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="edtTitle" class="form-label fw-semibold col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtTitle" name="mc_title" placeholder="Enter Title">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtWeight" class="form-label fw-semibold col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtWeight" name="mc_weight" placeholder="Enter Weight">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="mc_id" id="edtConsiderationId">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateConsideration" onclick="editConsider()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    async function addConsider(){
		event.preventDefault();
        let chk = await mc_validate("add");
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
                        "mc_title": $('#inpTitle').val(),
                        "mc_weight": parseFloat($('#inpWeight').val()),
                        "create_date": getTimeNow(),
                        "create_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'consideration/insert',
                        data: JSON.stringify(add_form),
                        success: function(data){
                            // console.log(data);
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Consideration  success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                $('#inpTitle').val("")
                                $('#inpWeight').val("")
                                $('#inpTotal').val("")
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Consideration !</p>",
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
    async function editConsider(){
		event.preventDefault();
        let chk = await mc_validate("edit");
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
                    $('#edit_formConsider').serializeArray().forEach(function(item) {
                        if(item.name == 'mc_id'){
                            item.value = parseInt(item.value)
                        }else if(item.name == 'mc_weight'){
                            item.value = parseFloat(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["update_date"] = getTimeNow();
                    edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'consideration/update',
                        data: JSON.stringify(edit_form),
                        success: function(data){
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Consideration  success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Consideration !</p>",
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
    function change_mc_status(id,status){
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
                status_form["mc_id"] = id;
                status_form["mc_status"] = status;
                $.ajax({
                    type: 'PUT',
					dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL+'consideration/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data){
                        // console.log(data);
                        if(data!=false){
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Consideration  success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Consideration !</p>",
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
    async function addIncharge(){
		event.preventDefault();
        let chk = await incharge_validate("add");
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
                        "mc_id": parseInt($('#selTitle').val()),
                        "sd_id": parseInt($('#selDept').val()),
                        "create_date": getTimeNow(),
                        "create_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL+'incharge/insert',
                        data: JSON.stringify(add_form),
                        success: function(data){
                            // console.log(data);
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Incharge success!</p>",
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
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Incharge!</p>",
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
    async function editIncharge(){
		event.preventDefault();
        let chk = await incharge_validate("edit");
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
                    $('#frmEditConsideration').serializeArray().forEach(function(item) {
                        if(item.name == 'mc_id' || item.name == 'sd_id' || item.name == 'mci_id'){
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
                        url: API_URL+'incharge/update',
                        data: JSON.stringify(edit_form),
                        success: function(data){
                            if(data!=false){
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Incharge success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            }else{
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Incharge!</p>",
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
    function change_mci_status(id,status){
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
                status_form["mci_id"] = id;
                status_form["mci_status"] = status;
                $.ajax({
                    type: 'PUT',
					dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL+'incharge/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data){
                        // console.log(data);
                        if(data!=false){
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Incharge success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Incharge!</p>",
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
	function editModal(title,weight,id){
		event.preventDefault();
		$('#edtTitle').val(title);
		$('#edtWeight').val(weight);
		$('#edtConsiderationId').val(id);
	}
    function editDetailModal(mc_id,sd_id,id){
		event.preventDefault();
		$('#Incharge_id').val(id);
        editConsiderationOption(mc_id);
        editDepartmentOption(sd_id);
	}
    function editConsiderationOption(id){
        $.ajax({
            type: 'get',
            url: API_URL+'option/list_mc',
            success: function (result){
                var option_text = '<option value="" selected disabled>Choose consideration</option>';
                $.each(result, function (key, value){
                    let sel = "";
                    if(value.mc_id == id){sel = "selected";}
                    option_text += '<option value="'+value.mc_id+'" '+sel+'>'+value.mc_title+'</option>';
                })
                $('#edtmc').html(option_text);
            }
        })
    }
    function editDepartmentOption(id){
        $.ajax({
            type: 'get',
            url: API_URL+'option/list_department',
            success: function (result){
                var option_text = '<option value="" selected disabled>Choose department</option>';
                $.each(result, function (key, value){
                    let sel = "";
                    if(value.sd_id == id){sel = "selected";}
                    option_text += '<option value="'+value.sd_id+'" '+sel+'>'+value.sd_name+'</option>';
                })
                $('#edtDept').html(option_text);
            }
        })
    }
    $(document).ready(function (){
        if ( $.fn.DataTable.isDataTable('#tblIncharge') ) {
            $('#tblIncharge').DataTable().destroy();
        }
		var inchargeTable = $('#tblIncharge').DataTable({
			ajax: {
				url: API_URL+'incharge/table'
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
                    data:'mci_id'
                },
                {
                    className: 'text-center',
                    data:'mc_title',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            disp = '<div class="text-warp">'+data+'</div>';
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data:'sd_name'
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
                    data:'mci_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.mci_status){
                                disp = '<a onclick="change_mci_status('+row.mci_id+',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            }else{
                                disp = '<a onclick="change_mci_status('+row.mci_id+',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data:'mci_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            disp = '<button type="button" onclick="editDetailModal(\''+row.mc_id+'\',\''+row.sd_id+'\',\''+row.mci_id+'\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditIncharge">'+
                                '<i class="ti ti-pencil me-1"></i>Edit</button>';
                        }
                        return disp;
                    }
            }]
		});
        inchargeTable.on('order.dt search.dt', function () {
            let i = 1;
            inchargeTable.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();

        if ( $.fn.DataTable.isDataTable('#tblConsideration') ) {
            $('#tblConsideration').DataTable().destroy();
        }
		var dataTable = $('#tblConsideration').DataTable({
			ajax: {
				url: API_URL+'consideration/table'
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
                    data:'mc_id'
                },
                {
                    className: 'text-center',
                    data:'mc_title',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            disp = '<div class="text-warp">'+data+'</div>';
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data:'mc_weight'
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
                    data:'mc_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            if(row.mc_status){
                                disp = '<a onclick="change_mc_status('+row.mc_id+',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            }else{
                                disp = '<a onclick="change_mc_status('+row.mc_id+',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data:'mc_id',
                    "render": function (data, type, row){
                        if (type === 'display'){
                            disp = '<button type="button" onclick="editModal(\''+row.mc_title+'\',\''+row.mc_weight+'\',\''+row.mc_id+'\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditConsideration">'+
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
			inchargeTable.ajax.reload( null, false );
		}, 600000 );
	});
</script>