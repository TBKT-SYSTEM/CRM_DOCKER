<title>CRM | Manage Department</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Department</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Department</li>
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
                                        <h4 class="mb-1 fs-4 fw-semibold">Department List</h4>
                                        <p class="fs-3 mb-0">Table for show</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <button type="button" class="btn bg-primary-subtle text-primary" data-bs-toggle="modal" data-bs-target="#mdlRegister">
                                    <i class="ti ti-user-plus me-2"></i> Register Department
                                </button>
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblDepartment" class="dataTable table  table-bordered text-nowrap align-middle">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>No.</th>
                                            <th>Department Name</th>
                                            <th>Department Short Name</th>
                                            <th>Department Code</th>
                                            <th>Updated Date</th>
                                            <th>Updated By</th>
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
<!-- Modal for register department -->
<div class="modal modal-lg fade" id="mdlRegister" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Register Department
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form" name="add_form">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="inpDepartment" class="form-label fw-semibold col-sm-4 col-form-label">Department Name</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="inpDepartment" name="sd_dept_name" placeholder="Department Name">
                                <span class="form_error"></span>
                            </div>
                            <label for="inpDepartmentShort" class="form-label fw-semibold col-sm-4 col-form-label">Department Short Name</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="inpDepartmentShort" name="sd_dept_aname" placeholder="Department Short Name">
                                <span class="form_error"></span>
                            </div>
                            <label for="inpDepartmentCd" class="form-label fw-semibold col-sm-4 col-form-label">Department Code</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="inpDepartmentCd" name="sd_dept_cd" placeholder="Department Code">
                                <span class="form_error"></span>
                            </div>
                            <label for="inpPlant" class="form-label fw-semibold col-sm-4 col-form-label">Plant</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-select" id="inpPlant" name="sd_plant_cd">
                                    <option value="51" selected>Phase 10</option>
                                    <option value="52">Phase 8</option>
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
                <button type="button" class="btn btn-primary" id="btnSubmitRegister" type="submit" onclick="adddepartment()">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for edit department -->
<div class="modal modal-lg fade" id="mdlEdits" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Department
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" name="edit_form">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtDepartment" class="form-label fw-semibold col-sm-4 col-form-label mb-3">Department Name</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="edtDepartment" name="sd_dept_name" placeholder="Department Name">
                                <span class="form_error"></span>
                            </div>
                            <label for="edtDepartmentShort" class="form-label fw-semibold col-sm-4 col-form-label mb-3">Department Short Name</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="edtDepartmentShort" name="sd_dept_aname" placeholder="Department Short Name">
                                <span class="form_error"></span>
                            </div>
                            <label for="edtDepartmentCd" class="form-label fw-semibold col-sm-4 col-form-label mb-3">Department Code</label>
                            <div class="col-sm-8 mb-3">
                                <input type="text" class="form-control" id="edtDepartmentCd" name="sd_dept_cd" placeholder="Department Code">
                                <span class="form_error"></span>
                            </div>
                            <label for="edtPlantCd" class="form-label fw-semibold col-sm-4 col-form-label">Plant</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-select" id="edtPlantCd" name="sd_plant_cd">
                                </select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="sd_id" name="sd_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" onclick="editdepartment()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    async function adddepartment() {
        event.preventDefault();
        let chk = await department_validate("add");
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
                        if (item.name == 'sd_plant_cd') {
                            add_form[item.name] = parseInt(item.value); // แปลงเป็นตัวเลข
                        } else {
                            add_form[item.name] = item.value;
                        }
                    })
                    add_form["sd_created_date"] = getTimeNow();
                    add_form["sd_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'department/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add department success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                $("#inpDepartment").val('');
                                $("#inpDepartmentShort").val('');
                                $("#inpDepartmentCd").val('');
                                $("#inpPlant").prop('selectedIndex', 0);
                                var dataTable = $('#tblDepartment').DataTable();
                                dataTable.ajax.reload(null, false);
                                $('#mdlRegister').modal('hide');
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add department!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                $("#inpDepartment").val('');
                                $("#inpDepartmentShort").val('');
                                $("#inpDepartmentCd").val('');
                                $("#inpPlant").prop('selectedIndex', 0);
                                var dataTable = $('#tblDepartment').DataTable();
                                dataTable.ajax.reload(null, false);
                                $('#mdlRegister').modal('hide');
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
    async function editdepartment() {
        event.preventDefault();
        let chk = await department_validate("edit");
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
                        if (item.name == 'sd_id' || item.name == 'sd_plant_cd') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["sd_updated_date"] = getTimeNow();
                    edit_form["sd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'department/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit department success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#edit_form')[0].reset();
                                var dataTable = $('#tblDepartment').DataTable();
                                dataTable.ajax.reload(null, false);
                                $('#mdlEdits').modal('hide');
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit department!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#edit_form')[0].reset();
                                var dataTable = $('#tblDepartment').DataTable();
                                dataTable.ajax.reload(null, false);
                                $('#mdlEdits').modal('hide');
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
                status_form["sd_id"] = id;
                status_form["sd_status"] = status;
                status_form["sd_updated_date"] = getTimeNow();
                status_form["sd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'department/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status department success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblDepartment').DataTable();
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status department!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var dataTable = $('#tblDepartment').DataTable();
                            dataTable.ajax.reload(null, false);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }

    function editModal(name, cd, id, plant, aname) {
        event.preventDefault();
        $('#edtDepartment').val(name);
        $('#edtDepartmentShort').val(aname);
        $('#edtDepartmentCd').val(cd);
        $('#sd_id').val(id);
        const phases = [{
                value: 51,
                label: 'Phase 10'
            },
            {
                value: 52,
                label: 'Phase 8'
            }
        ];
        const plantNum = parseInt(plant, 10);
        const options = phases.map((phase) => {
            const selected = plantNum === phase.value ? 'selected' : '';
            return `<option value="${phase.value}" ${selected}>${phase.label}</option>`;
        });

        $('#edtPlantCd').html(options.join(''));
    }

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tblDepartment')) {
            $('#tblDepartment').DataTable().destroy();
        }
        var dataTable = $('#tblDepartment').DataTable({
            ajax: {
                url: API_URL + 'department/table'
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
                    data: 'sd_id'
                },
                {
                    className: 'text-center',
                    data: 'sd_dept_name',
                },
                {
                    className: 'text-center',
                    data: 'sd_dept_aname',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.sd_dept_aname == "") {
                                disp = "-";
                            } else {
                                disp = row.sd_dept_aname;
                            }
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'sd_dept_cd',
                },
                {
                    className: 'text-center',
                    data: 'sd_updated_date'
                },
                {
                    className: 'text-center',
                    data: 'sd_updated_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.sd_updated_by != "") {
                                let emp_code = row.sd_updated_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_fname + ' ' + row.su_lname + '">' + row.su_fname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.sd_updated_by + '">' + row.sd_updated_by + '</span>' +
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
                    data: 'sd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.sd_status) {
                                disp = '<a onclick="change_status(' + row.sd_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_status(' + row.sd_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    }
                },
                {
                    className: 'text-center',
                    data: 'sd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editModal(\'' + row.sd_dept_name + '\',\'' + row.sd_dept_cd + '\',\'' + row.sd_id + '\',\'' + row.sd_plant_cd + '\',\'' + row.sd_dept_aname + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits">' +
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