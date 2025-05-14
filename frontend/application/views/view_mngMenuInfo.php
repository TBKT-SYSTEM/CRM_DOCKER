<title>CRM | Manage Permission Info</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Menu Info</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Menu Info</li>
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
                                    <span>Sub menu</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Main Menu</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div class="row text-end mb-3">
                                        <label for="selMainMenu" class="form-label fw-semibold col-sm col-form-label">Main Menu</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="selMainMenu">
                                                <option value="" selected disabled>Choose main menu</option>
                                                <?php
                                                $option_mm = $this->ManageBackend->list_option("option/list_smg");
                                                foreach ($option_mm as $op_mm) {
                                                    echo '<option value="' . $op_mm['smg_id'] . '">' . $op_mm['smg_name'] . '</option>';
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Sub Menu</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpSubMenu" class="form-label fw-semibold col-sm-3 col-form-label">Sub Menu</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inpSubMenu" placeholder="Enter sub menu" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpMenuController" class="form-label fw-semibold col-sm-3 col-form-label">Controller</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="inpMenuController" placeholder="Enter menu controller" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn btn-primary" id="btnRegisterSubMenu" onclick="addSubMenu()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Sub Menu List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table id="tblSubMenu" class="dataTable table  table-bordered text-nowrap align-middle ">
                                                        <thead>
                                                            <!-- start row -->
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Sub Menu</th>
                                                                <th>Menu Controller</th>
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

                                <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                                    <div id="tab-2" style="display: block;">
                                        <div class="row border" style="padding: 15px;">
                                            <div class="hstack mb-3 pb-1">
                                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-file-text text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Main Menu</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3 row align-items-center">
                                                    <div class="col-lg">
                                                        <div class=" row align-items-center">
                                                            <label for="inpMainMenu" class="form-label fw-semibold col-sm-3 col-form-label">Main Menu</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="inpMainMenu" id="inpMainMenu" placeholder="Enter main menu">
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg">
                                                        <div class=" row align-items-center">
                                                            <label for="inpMenuIcon" class="form-label fw-semibold col-sm-3 col-form-label">Menu Icon</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="inpMenuIcon" id="inpMenuIcon" placeholder="Click for select icon" readonly onclick="openIconModal()">
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <button type="button" class="btn btn btn-primary" id="btnRegisterMainMenu" onclick="addMainMenu()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Main Menu List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table id="tblMainMenu" class="dataTable table  table-bordered text-nowrap align-middle " style="width: 100%;">
                                                        <thead>
                                                            <!-- start row -->
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Main Menu</th>
                                                                <th>Menu Icon</th>
                                                                <th>Order No.</th>
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
                </div>
                <!-- end Zero Configuration -->
            </div>
        </div>

    </div>
</div>

<!-- Modal for edit sub menu -->
<div class="modal fade modal-lg" id="mdlEditSubMenu" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Sub Menu
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditSubMenu" name="frmEditSubMenu">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtSubMenu" class="form-label fw-semibold col-sm-3 col-form-label">Sub Menu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtSubMenu" name="smd_name" placeholder="Sub menu">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtMenuController" class="form-label fw-semibold col-sm-3 col-form-label">Menu Controller</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtMenuController" name="smd_link" placeholder="Menu controller">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="subMenu_id" name="smd_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateSubMenu" onclick="editSubMenu()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit main menu -->
<div class="modal fade modal-lg" id="mdlEditMainMenu" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Main Menu
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditMainMenu" name="frmEditMainMenu">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtMainMenu" class="form-label fw-semibold col-sm-3 col-form-label">Main Menu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtMainMenu" name="smg_name" placeholder="Main menu">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtMenuIcon" class="form-label fw-semibold col-sm-3 col-form-label">Menu Icon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtMenuIcon" name="smg_icon" placeholder="Menu icon">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtMenuOrder" class="form-label fw-semibold col-sm-3 col-form-label">Menu Order No.</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtMenuOrder" name="smg_order_no" placeholder="Menu order no.">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="smg_id" id="edtMenuId">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateMainMenu" onclick="editMainMenu()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconModalLabel">Select Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="iconList">
                    <!-- Icons will be dynamically inserted here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="clearIcon()" >Reset</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openIconModal() {
        const modal = new bootstrap.Modal(document.getElementById('iconModal'));
        modal.show();
    }

    async function populateIcons() {
        const iconList = document.getElementById('iconList');
        const response = await fetch('assets/json/icons.json');
        const icons = await response.json();

        icons.forEach(icon => {
            const col = document.createElement('div');
            col.className = 'col-1 text-center mb-3';

            const iconElement = document.createElement('i');
            iconElement.className = `ti ${icon} fs-5 btn btn-secondary-subtle text-secondary shadow-sm card-hover`;
            iconElement.style.cursor = 'pointer';
            iconElement.onclick = () => selectIcon(icon);

            col.appendChild(iconElement);
            iconList.appendChild(col);
        });
    }

    function selectIcon(icon) {
        const inpMenuIcon = document.getElementById('inpMenuIcon');
        inpMenuIcon.value = `ti ${icon}`;

        const modal = bootstrap.Modal.getInstance(document.getElementById('iconModal'));
        modal.hide();
    }

    function clearIcon() {
        const inpMenuIcon = document.getElementById('inpMenuIcon');
        inpMenuIcon.value = ``;

        const modal = bootstrap.Modal.getInstance(document.getElementById('iconModal'));
        modal.hide();
    }

    document.addEventListener('DOMContentLoaded', populateIcons);

    async function addMainMenu() {
        event.preventDefault();
        let chk = await smg_validate("add");
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
                        "smg_name": $('#inpMainMenu').val(),
                        "smg_icon": $('#inpMenuIcon').val(),
                        "smg_created_date": getTimeNow(),
                        "smg_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'menu_group/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add main menu success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblMainMenu').DataTable();
                                table.ajax.reload(null, false);
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add main menu!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblMainMenu').DataTable();
                                table.ajax.reload(null, false);
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
    async function editMainMenu() {
        event.preventDefault();
        let chk = await smg_validate("edit");
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
                    $('#frmEditMainMenu').serializeArray().forEach(function(item) {
                        if (item.name == 'smg_id' || item.name == 'smg_order_no') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["smg_updated_date"] = getTimeNow();
                    edit_form["smg_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'menu_group/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit main menu success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditMainMenu').modal('hide');
                                var table = $('#tblMainMenu').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit main menu!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditMainMenu').modal('hide');
                                var table = $('#tblMainMenu').DataTable();
                                table.ajax.reload(null, false);
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

    function change_smg_status(id, status) {
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
                status_form["smg_id"] = id;
                status_form["smg_status"] = status;
                status_form["smg_updated_date"] = getTimeNow();
                status_form["smg_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'menu_group/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status main menu success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblMainMenu').DataTable();
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status main menu!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblMainMenu').DataTable();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })
    }
    async function addSubMenu() {
        event.preventDefault();
        let chk = await smd_validate("add");
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
                        "smd_name": $('#inpSubMenu').val(),
                        "smg_id": parseInt($('#selMainMenu').val()),
                        "smd_link": $('#inpMenuController').val(),
                        "smd_created_date": getTimeNow(),
                        "smd_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'menu_detail/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add sub menu success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblSubMenu').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add sub menu!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblSubMenu').DataTable();
                                table.ajax.reload(null, false);
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
    async function editSubMenu() {
        event.preventDefault();
        let chk = await smd_validate("edit");
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
                    $('#frmEditSubMenu').serializeArray().forEach(function(item) {
                        if (item.name == 'smd_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["smd_updated_date"] = getTimeNow();
                    edit_form["smd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'menu_detail/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit sub menu success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditSubMenu').modal('hide');
                                var table = $('#tblSubMenu').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit sub menu!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditSubMenu').modal('hide');
                                var table = $('#tblSubMenu').DataTable();
                                table.ajax.reload(null, false);
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

    function change_smd_status(id, status) {
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
                status_form["smd_id"] = id;
                status_form["smd_status"] = status;
                status_form["smd_updated_date"] = getTimeNow();
                status_form["smd_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'menu_detail/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status sub menu success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblSubMenu').DataTable();
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status sub menu!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblSubMenu').DataTable();
                            table.ajax.reload(null, false);
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
    function editModal(name, icon, order, id) {
        event.preventDefault();
        $('#edtMainMenu').val(name);
        $('#edtMenuIcon').val(icon);
        $('#edtMenuOrder').val(order);
        $('#edtMenuId').val(id);
    }

    function editDetailModal(name, link, id) {
        event.preventDefault();
        $('#subMenu_id').val(id);
        $('#edtSubMenu').val(name);
        $('#edtMenuController').val(link);
    }
    $('#selMainMenu').on('change', function() {
        $('#tab-1 input').prop('disabled', false);
        // alert( this.value );
        if ($.fn.DataTable.isDataTable('#tblSubMenu')) {
            $('#tblSubMenu').DataTable().destroy();
            $('#tblSubMenu').empty();
        }
        var detailTable = $('#tblSubMenu').DataTable({
            ajax: {
                url: API_URL + 'menu_detail/table/' + this.value
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
                    data: 'smd_id'
                },
                {
                    title: 'Sub Menu',
                    className: 'text-center',
                    data: 'smd_name'
                },
                {
                    title: 'Menu Controller',
                    className: 'text-center',
                    data: 'smd_link'
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
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + ' ' + row.su_lastname + '</h6>' +
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
                    data: 'smd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.smd_status) {
                                disp = '<a onclick="change_smd_status(' + row.smd_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_smd_status(' + row.smd_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    title: 'Action',
                    className: 'text-center',
                    data: 'smd_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editDetailModal(\'' + row.smd_name + '\',\'' + row.smd_link + '\',\'' + row.smd_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditSubMenu">' +
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
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tblMainMenu')) {
            $('#tblMainMenu').DataTable().destroy();
        }
        var dataTable = $('#tblMainMenu').DataTable({
            ajax: {
                url: API_URL + 'menu_group/table'
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
                    data: 'smg_id'
                },
                {
                    className: 'text-center',
                    data: 'smg_name'
                },
                {
                    className: 'text-center',
                    data: 'smg_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<i class="' + row.smg_icon + '"></i>';
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'smg_order'
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
                    data: 'smg_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.smg_status) {
                                disp = '<a onclick="change_smg_status(' + row.smg_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_smg_status(' + row.smg_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'smg_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editModal(\'' + row.smg_name + '\',\'' + row.smg_icon + '\',\'' + row.smg_order + '\',\'' + row.smg_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditMainMenu">' +
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
        }, 300000);
    });
</script>