<title>CRM | Manage Users</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Users</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Users</li>
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
                            <div class="col-md-7">
                                <div class="hstack pb-1">
                                    <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-list-details text-primary fs-6"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fs-4 fw-semibold">Users List</h4>
                                        <p class="fs-3 mb-0">Table for show</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <button type="button" class="btn bg-primary-subtle text-primary" data-bs-toggle="modal" data-bs-target="#mdlRegister">
                                    <i class="ti ti-user-plus me-2"></i> Register Account
                                </button>
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblUsers" class="dataTable table  table-bordered text-nowrap align-middle">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Detail</th>
                                            <th>Permission Group</th>
                                            <th>E-mail</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
<!-- Modal for register user -->
<div class="modal fade" id="mdlRegister" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Register Account
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form" name="add_form">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="inpEmployeeCode" class="form-label fw-semibold col-sm-3 col-form-label">Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inpEmployeeCode" name="su_username" placeholder="Employee code">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inpFirstName" class="form-label fw-semibold col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inpFirstName" name="su_firstname" placeholder="First name">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inpLastName" class="form-label fw-semibold col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inpLastName" name="su_lastname" placeholder="Last name">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inpEmail" class="form-label fw-semibold col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="inpEmail" name="su_email" placeholder="exaple_email@tbkt.co.th">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="selDepartment" class="form-label fw-semibold col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select name="sd_id" id="selDepartment" class="form-control">
                                    <option value="" disabled selected>Choose department</option>
                                    <?php
                                    $option_department = $this->ManageBackend->list_option("option/list_department");
                                    foreach ($option_department as $department) {
                                        echo '<option value="' . $department['sd_id'] . '">' . $department['sd_dept_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="selPermissionGroup" class="form-label fw-semibold col-sm-3 col-form-label">Permission</label>
                            <div class="col-sm-9">
                                <select name="spg_id" id="selPermissionGroup" class="form-control">
                                    <option value="" disabled selected>Choose permission group</option>
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
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="btnSubmitRegister" type="submit" onclick="addUser()">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for edit user -->
<div class="modal fade" id="mdlEdits" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Account
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" name="edit_form">
                    <div class="container-fluid">
                        <div class="mb-3 row align-items-center">
                            <label for="edtEmployeeCode" class="form-label fw-semibold col-sm-3 col-form-label">Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtEmployeeCode" name="su_username" placeholder="Employee code">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtFirstName" class="form-label fw-semibold col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtFirstName" name="su_firstname" placeholder="First name">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtLastName" class="form-label fw-semibold col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtLastName" name="su_lastname" placeholder="Last name">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtEmail" class="form-label fw-semibold col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtEmail" name="su_email" placeholder="John Deo">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="editDepartment" class="form-label fw-semibold col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select name="sd_id" id="editDepartment" class="form-control"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPlants" class="form-label fw-semibold col-sm-3 col-form-label">Plant</label>
                            <div class="col-sm-9">
                                <select name="" id="edtPlants" class="form-control" disabled></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPermissionGroup" class="form-label fw-semibold col-sm-3 col-form-label">Permission</label>
                            <div class="col-sm-9">
                                <select name="spg_id" id="edtPermissionGroup" class="form-control"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="su_id" name="su_id">
                        <!-- <div class="my-2 row align-items-center">
                            <a href="javascript:void(0)" class="text-primary fw-bold" style="text-align: right;" onclick="re_password()">Reset Password</a>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" onclick="editUser()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    async function addUser() {
        event.preventDefault();
        let chk = await user_validate("add");
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
                    var add_form = {};
                    $('#add_form').serializeArray().forEach(function(item) {
                        if (item.name == 'spg_id' || item.name == 'spc_id' || item.name == 'sd_id') {
                            item.value = parseInt(item.value)
                        }
                        add_form[item.name] = item.value;
                    })
                    add_form["su_created_date"] = getTimeNow();
                    add_form["su_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    // console.log(add_form);
                    // return;
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'user/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add user success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                }).then((result) => {
                                    $('#mdlRegister').modal('hide');
                                    var dataTable = $('#tblUsers').DataTable();
                                    dataTable.ajax.reload(null, false);
                                })
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add user!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                }).then((result) => {
                                    $('#mdlRegister').modal('hide');
                                    var dataTable = $('#tblUsers').DataTable();
                                    dataTable.ajax.reload(null, false);
                                })
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
    async function editUser() {
        event.preventDefault();
        let chk = await user_validate("edit");
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
                    $('#edit_form').serializeArray().forEach(function(item) {
                        if (item.name == 'spg_id' || item.name == 'spc_id' || item.name == 'su_id' || item.name == 'sd_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["su_updated_date"] = getTimeNow();
                    edit_form["su_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    // console.log(edit_form);
                    // return;
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'user/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit user success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                }).then((result) => {
                                    $('#mdlEdits').modal('hide');
                                    var dataTable = $('#tblUsers').DataTable();
                                    dataTable.ajax.reload(null, false);
                                })
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit user!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                }).then((result) => {
                                    $('#mdlEdits').modal('hide');
                                    var dataTable = $('#tblUsers').DataTable();
                                    dataTable.ajax.reload(null, false);
                                })
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

    function change_status(id, status) {
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
                status_form["su_id"] = id;
                status_form["su_status"] = status;
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'user/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status user success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status user!</p>",
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
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }
    async function re_password() {
        event.preventDefault();
        var su_id = $('#su_id').val();
        var getUser = await getUserCode(su_id);
        Swal.fire({
            title: 'Are you sure, you want to reset password?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var repswData = {};
                repswData["su_id"] = parseInt(su_id);
                repswData["su_password"] = getUser.su_emp_code;
                repswData["update_date"] = getTimeNow();
                repswData["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'setting/password',
                    data: JSON.stringify(repswData),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update user password success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update user password!</p>",
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
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }
    async function getUserCode(suid) {
        try {
            var result = await $.ajax({
                type: 'GET',
                url: API_URL + 'user/' + suid
            });
            return result;
        } catch (err) {
            console.log(err);
            throw err;
        }
    }
    // modal --------------------------------------
    function editModal(id) {
        event.preventDefault();
        $('#su_id').val(id);
        $.ajax({
            type: 'get',
            url: API_URL + 'user/' + id,
            success: function(result) {
                $('#edtEmployeeCode').val(result.su_username);
                $('#edtFirstName').val(result.su_firstname);
                $('#edtLastName').val(result.su_lastname);
                $('#edtEmail').val(result.su_email);
                editDept(result.sd_id);
                editPlant(result.su_username.substring(0, 2));
                editPerg(result.spg_id);
            }
        })
    }

    function editDept(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_department',
            success: function(result) {
                if (id == 0 || id == null) {
                    var option_text = '<option value="" selected disabled>No Department</option>';
                }
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.sd_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.sd_id + '" ' + sel + '>' + value.sd_dept_name + '</option>';
                })
                $('#editDepartment').html(option_text);
            }
        })
    }

    function editPlant(plant) {
        var option_text = '<option value="" disabled selected>Choose plant</option>';
        if (plant == 51) {
            option_text += '<option value="51" selected disabled>Phase 10</option>';
        } else if (plant == 52) {
            option_text += '<option value="52" disabled>Phase 10</option>';
        } else {
            option_text += '<option value="0" disabled>Please check username...</option>';
        }
        $('#edtPlants').html(option_text);
    }

    function editPerg(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_spg',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose permission group</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.spg_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.spg_id + '" ' + sel + '>' + value.spg_name + '</option>';
                })
                $('#edtPermissionGroup').html(option_text);
            }
        })
    }
    $(document).ready(function() {
        var sessUsrId = "<?php echo $this->session->userdata('sessUsrId'); ?>";
        if ($.fn.DataTable.isDataTable('#tblUsers')) {
            $('#tblUsers').DataTable().destroy();
        }
        var dataTable = $('#tblUsers').DataTable({
            ajax: {
                url: API_URL + 'user/table/' + sessUsrId
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
                    data: 'su_id'
                },
                {
                    className: 'text-center',
                    data: 'su_id',
                    "render": function(data, type, row) {
                        let emp_code = row.su_username.substring(2, 7);
                        let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                        disp = '<div class="d-flex align-items-center justify-content-center">' +
                            '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                            '<div class="ms-3">' +
                            '<div class="user-meta-info">' +
                            '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + ' ' + row.su_lastname + '</h6>' +
                            '<span class="user-work fs-3" data-occupation="' + row.su_username + '">' + row.su_username + '</span>' +
                            '</div></div></div>';
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'spg_name',
                },
                {
                    className: 'text-center',
                    data: 'su_email'
                },
                {
                    className: 'text-center',
                    data: 'su_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.su_status) {
                                disp = '<a onclick="change_status(' + row.su_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_status(' + row.su_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'su_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editModal(\'' + row.su_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits">' +
                                '<i class="ti ti-pencil me-1"></i> Edit </button>';
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
        }, 300000);
    });
</script>