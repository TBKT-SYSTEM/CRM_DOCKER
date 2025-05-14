<title>CRM | Manage Permission Info</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Permission Info</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Permission Info</li>
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
                                    <span>Permission Detail</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Permission Group</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div class="row text-end mb-3">
                                        <label for="exampleInputText1" class="form-label fw-semibold col-sm col-form-label">Permission Group</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="selPermissionGroup">
                                                <option value="" selected disabled>Choose permission group</option>
                                                <?php
                                                $option_spg = $this->ManageBackend->list_option("option/list_spg");
                                                foreach ($option_spg as $op_spg) {
                                                    echo '<option value="' . $op_spg['spg_id'] . '">' . $op_spg['spg_name'] . '</option>';
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Permission Detail</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selMainMenu" class="form-label fw-semibold col-sm-3 col-form-label">Main Menu</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selMainMenu" disabled>
                                                            <option value="" selected disabled>Choose main menu</option>
                                                            <?php
                                                            $option_menug = $this->ManageBackend->list_option("option/list_smg");
                                                            foreach ($option_menug as $menug) {
                                                                echo '<option value="' . $menug['smg_id'] . '">' . $menug['smg_name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="selSubMenu" class="form-label fw-semibold col-sm-3 col-form-label">Sub Menu</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selSubMenu" disabled>
                                                            <option value="" selected disabled>Choose sub menu</option>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn btn-primary" id="btnRegisterPermissionDetail" onclick="addPerDetail()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Permission Detail List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblPermissionDetail" class="dataTable table  table-bordered text-nowrap align-middle ">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Main Menu</th>
                                                            <th>Sub Menu</th>
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Permission Group</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="exampleInputText1" class="form-label fw-semibold col-sm-3 col-form-label">Permission Group</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="inpPermissionGroup" class="form-control" placeholder="Enter Permission Group">
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn btn-primary" onclick="addPerg()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Permission Group List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="tblPermissionGroup" class="dataTable table  table-bordered text-nowrap align-middle " style="width: 100%;">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Permission Group</th>
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


<!-- Modal for edit permission detail -->
<div class="modal fade modal-lg" id="mdlEditPermissionDetail" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Permission Detail
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditPermission" name="frmEditPermission">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtMainMenu" class="form-label fw-semibold col-sm-3 col-form-label">Main Menu</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtMainMenu" name="smg_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtSubMenu" class="form-label fw-semibold col-sm-3 col-form-label">Sub Menu</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtSubMenu" name="smd_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="perDetail_id" name="spd_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdatePermission" onclick="editPerDetail()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit permission group -->
<div class="modal fade modal-lg" id="mdlEditPermissionGroup" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Permission Group
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_formPerg" name="edit_formPerg">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtPermissionGroup" class="form-label fw-semibold col-sm-3 col-form-label">Permission Group</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtPermissionGroup" name="spg_name" placeholder="Enter permission group">
                                <span class="form_error"></span>
                            </div>
                            <input type="hidden" name="spg_id" id="edtPermissionGroupId">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdatePermissionGroup" onclick="editPerg()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    async function addPerg() {
        event.preventDefault();
        let chk = await spg_validate("add");
        // console.log(chk);
        if (chk) {
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
                        "spg_name": $('#inpPermissionGroup').val(),
                        "spg_created_date": getTimeNow(),
                        "spg_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'spg_table/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add permission group success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                $('#inpPermissionGroup').val('')
                                var tableSPG = $('#tblPermissionGroup').DataTable();
                                tableSPG.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add permission group!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                $('#inpPermissionGroup').val('')
                                var tableSPG = $('#tblPermissionGroup').DataTable();
                                tableSPG.ajax.reload(null, false);
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    })
                }
            })

        }
    }
    async function editPerg() {
        event.preventDefault();
        let chk = await spg_validate("edit");
        if (chk) {
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
                    $('#edit_formPerg').serializeArray().forEach(function(item) {
                        if (item.name == 'spg_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["spg_updated_date"] = getTimeNow();
                    edit_form["spg_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'spg_table/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit permission group success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditPermissionGroup').modal('hide');
                                var tableSPG = $('#tblPermissionGroup').DataTable();
                                tableSPG.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit permission group!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditPermissionGroup').modal('hide');
                                var tableSPG = $('#tblPermissionGroup').DataTable();
                                tableSPG.ajax.reload(null, false);
                            }
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
        }
    }

    function change_spg_status(id, status) {
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
                status_form["spg_id"] = id;
                status_form["spg_status"] = status;
                status_form["spg_updated_date"] = getTimeNow();
                status_form["spg_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'spg_table/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status permission group success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var tableSPG = $('#tblPermissionGroup').DataTable();
                            tableSPG.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status permission group!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var tableSPG = $('#tblPermissionGroup').DataTable();
                            tableSPG.ajax.reload(null, false);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }
    async function addPerDetail() {
        event.preventDefault();
        let chk = await spd_validate("add");
        if (chk) {
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
                        "spg_id": parseInt($('#selPermissionGroup').val()),
                        "smd_id": parseInt($('#selSubMenu').val()),
                        "spd_created_date": getTimeNow(),
                        "spd_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'spd_table/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add permission detail success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var tableSPG = $('#tblPermissionDetail').DataTable();
                                tableSPG.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add permission detail!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var tableSPG = $('#tblPermissionDetail').DataTable();
                                tableSPG.ajax.reload(null, false);
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    })
                }
            })

        }
    }
    async function editPerDetail() {
        event.preventDefault();
        let chk = await spd_validate("edit");
        if (chk) {
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
                    $('#frmEditPermission').serializeArray().forEach(function(item) {
                        if (item.name == 'spd_id' || item.name == 'smg_id' || item.name == 'smd_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["spd_updated_date"] = getTimeNow();
                    edit_form["spd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'spd_table/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit permission detail success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditPermissionDetail').modal('hide');
                                var tableSPG = $('#tblPermissionDetail').DataTable();
                                tableSPG.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit permission detail!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditPermissionDetail').modal('hide');
                                var tableSPG = $('#tblPermissionDetail').DataTable();
                                tableSPG.ajax.reload(null, false);
                            }
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
        }
    }

    function change_spd_status(id, status) {
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
                status_form["spd_id"] = id;
                status_form["spd_status"] = status;
                status_form["spd_updated_date"] = getTimeNow();
                status_form["spd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'spd_table/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status permission detail success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var tableSPG = $('#tblPermissionDetail').DataTable();
                            tableSPG.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status permission detail!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var tableSPG = $('#tblPermissionDetail').DataTable();
                            tableSPG.ajax.reload(null, false);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }
    // modal --------------------------------------
    function editModal(name, id) {
        event.preventDefault();
        $('#edtPermissionGroup').val(name);
        $('#edtPermissionGroupId').val(id);
    }

    function editDetailModal(smg_id, smd_id, id) {
        event.preventDefault();
        $('#perDetail_id').val(id);
        editMenuGroup(smg_id);
        editMenuDetail(smd_id);
    }

    function editMenuGroup(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_smg',
            success: function(result) {
                var option_text = '<option value="" selected disabled>Choose main menu</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.smg_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.smg_id + '" ' + sel + '>' + value.smg_name + '</option>';
                })
                $('#edtMainMenu').html(option_text);
            }
        })
    }

    function editMenuDetail(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_smd',
            success: function(result) {
                var option_text = '<option value="" selected disabled>Choose sub menu</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.smd_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.smd_id + '" ' + sel + '>' + value.smd_name + '</option>';
                })
                $('#edtSubMenu').html(option_text);
            }
        })
    }
    $('#selPermissionGroup').on('change', function() {
        $('#tab-1 select').prop('disabled', false);
        // alert( this.value );
        if ($.fn.DataTable.isDataTable('#tblPermissionDetail')) {
            $('#tblPermissionDetail').DataTable().destroy();
            $('#tblPermissionDetail').empty();
        }
        var detailTable = $('#tblPermissionDetail').DataTable({
            ajax: {
                url: API_URL + 'spd_table/' + this.value
            },
            columnDefs: [{
                searchable: true,
                orderable: false,
                targets: 0,
            }, ],
            bSort: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    title: 'No.',
                    className: 'text-center',
                    data: 'spd_id'
                },
                {
                    title: 'Main Menu',
                    className: 'text-center',
                    data: 'smg_name'
                },
                {
                    title: 'Sub Menu',
                    className: 'text-center',
                    data: 'smd_name'
                },
                {
                    title: 'Updated Date',
                    className: 'text-center',
                    data: 'update_date'
                },
                {
                    title: 'Updated By',
                    className: 'text-center',
                    data: 'update_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.update_by != "") {
                                let emp_code = row.update_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_fname + ' ' + row.su_lname + '">' + row.su_fname + ' ' + row.su_lname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.update_by + '">' + row.update_by + '</span>' +
                                    '</div></div></div>';
                            } else {
                                disp = "";
                            }
                        }
                        return disp;
                    },
                },
                {
                    title: 'Status',
                    className: 'text-center',
                    data: 'spd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.spd_status) {
                                disp = '<a onclick="change_spd_status(' + row.spd_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_spd_status(' + row.spd_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    title: 'Action',
                    className: 'text-center',
                    data: 'spd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editDetailModal(\'' + row.smg_id + '\',\'' + row.smd_id + '\',\'' + row.spd_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditPermissionDetail">' +
                                '<i class="ti ti-pencil me-1"></i>Edit</button>';
                        }
                        return disp;
                    }
                }
            ]
        });
        detailTable.on('order.dt search.dt', function() {
            let i = 1;
            detailTable.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
        setInterval(function() {
            detailTable.ajax.reload(null, false);
        }, 300000);
    });
    $('#selMainMenu').on('change', function() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_smd/' + this.value,
            success: function(result) {
                var option_text = '<option value="" selected disabled>Choose sub menu</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.smd_id + '">' + value.smd_name + '</option>';
                })
                $('#selSubMenu').html(option_text);
            }
        })
    });
    $('#edtMainMenu').on('change', function() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_smd/' + this.value,
            success: function(result) {
                var option_text = '<option value="" selected disabled>Choose sub menu</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.smd_id + '">' + value.smd_name + '</option>';
                })
                $('#edtSubMenu').html(option_text);
            }
        })
    });
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tblPermissionGroup')) {
            $('#tblPermissionGroup').DataTable().destroy();
        }
        var dataTable = $('#tblPermissionGroup').DataTable({
            ajax: {
                url: API_URL + 'spg_table'
            },
            columnDefs: [{
                searchable: true,
                orderable: false,
                targets: 0,
            }, ],
            bSort: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    className: 'text-center',
                    data: 'spg_id'
                },
                {
                    className: 'text-center',
                    data: 'spg_name'
                },
                {
                    className: 'text-center',
                    data: 'update_date'
                },
                {
                    className: 'text-center',
                    data: 'update_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.update_by != "") {
                                let emp_code = row.update_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_fname + ' ' + row.su_lname + '">' + row.su_fname + ' ' + row.su_lname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.update_by + '">' + row.update_by + '</span>' +
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
                    data: 'spg_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.spg_status) {
                                disp = '<a onclick="change_spg_status(' + row.spg_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_spg_status(' + row.spg_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'spg_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editModal(\'' + row.spg_name + '\',\'' + row.spg_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditPermissionGroup">' +
                                '<i class="ti ti-pencil me-1"></i>Edit</button>';
                        }
                        return disp;
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

        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 600000);
    });
</script>