<title>CRM | Manage Document Info</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Document Info</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Document Info</li>
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
                                    <span>Document Control No.</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Document Type</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div class="row text-end mb-3">
                                        <label for="selDoctype" class="form-label fw-semibold col-sm col-form-label">Document Type</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="selDoctype">
                                                <option value="" selected disabled>Choose document type</option>
                                                <?php
                                                $option_mm = $this->ManageBackend->list_option("option/list_mdt");
                                                foreach ($option_mm as $op_mm) {
                                                    echo '<option value="' . $op_mm['mdt_id'] . '">' . $op_mm['mdt_name'] . '</option>';
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Document Control No.</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpMenuController" class="form-label fw-semibold col-sm-2 col-form-label">Position 1</label>
                                                    <div class="col-sm-6">
                                                        <select name="" id="inpDocNoPo1" class="form-control" disabled>
                                                            <option value="">Choose Years</option>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start">
                                                <button type="button" class="btn btn btn-primary" id="btnRegisterDocControlNo" onclick="addDocConNo()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Document Control No List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table id="tblDocControl" class="dataTable table  table-bordered text-nowrap align-middle ">
                                                        <thead>
                                                            <!-- start row -->
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>DOC. Type Name</th>
                                                                <th>DOC. Control Position 1</th>
                                                                <th>DOC. Control Position 2</th>
                                                                <th>Updated Date</th>
                                                                <th>Updated By</th>
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Register Document Type</h4>
                                                    <p class="fs-3 mb-0">Input for register</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3 row align-items-center">
                                                    <div class="col-lg-5">
                                                        <div class=" row align-items-center">
                                                            <label for="inpDocName" class="form-label fw-semibold col-sm-3 col-form-label">Document Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="inpDocName" id="inpDocName" placeholder="Enter Document Type Name">
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class=" row align-items-center">
                                                            <label for="inpDocPo1" class="form-label fw-semibold col-sm-3 col-form-label">Position 1</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="inpDocPo1" id="inpDocPo1" placeholder="Enter Text Position 1">
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row align-items-center">
                                                    <div class="col-lg-5">
                                                        <div class=" row align-items-center">
                                                            <label for="inpDocPo2" class="form-label fw-semibold col-sm-3 col-form-label">Position 2</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="inpDocPo2" id="inpDocPo2" placeholder="Enter Text Position 2">
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class=" row align-items-center">
                                                            <label for="inpDocPo3" class="form-label fw-semibold col-sm-3 col-form-label">Approve Pattern</label>
                                                            <div class="col-sm-8">
                                                                <select type="text" class="form-select" name="inpDocPo3" id="inpDocPo3">
                                                                    <option value="" selected disabled>Choose approve pattern</option>
                                                                    <?php
                                                                    $option_mm = $this->ManageBackend->list_option("option/list_map");
                                                                    foreach ($option_mm as $op_mm) {
                                                                        echo '<option value="' . $op_mm['map_id'] . '">' . $op_mm['map_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg">
                                                        <button type="button" class="btn btn btn-primary" id="btnRegisterDocType" onclick="addDocumentType()">
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
                                                    <h4 class="mb-1 fs-4 fw-semibold">Document Type List</h4>
                                                    <p class="fs-3 mb-0">Table for show</p>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table id="tblDocYpe" class="dataTable table  table-bordered text-nowrap align-middle " style="width: 100%;">
                                                        <thead>
                                                            <!-- start row -->
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Document Type Name</th>
                                                                <th>Position 1</th>
                                                                <th>Position 2</th>
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

<!-- Modal for docuemt control -->
<div class="modal fade modal-lg" id="mdlEditDocControl" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Document Control
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditDocControl" name="frmEditDocControl">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtSelDoctype" class="form-label fw-semibold col-sm-3 col-form-label">Document Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="edtSelDoctype" name="mdt_id" disabled></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPostion1" class="form-label fw-semibold col-sm-3 col-form-label">Position 1</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="edtPostion1" name="mdcn_position1"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="edtDocConId" name="mdcn_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateSubMenu" onclick="editDocConNo()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for edit document type -->
<div class="modal fade modal-lg" id="mdlEditDocType" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Document Type
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditDocType" name="frmEditDocType">
                    <div class="p-4">
                        <div class="mb-3 row align-items-center">
                            <label for="edtDocName" class="form-label fw-semibold col-sm-3 col-form-label">Document Type Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtDocName" name="mdt_name" placeholder="Enter Document Type Name ...">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPo1" class="form-label fw-semibold col-sm-3 col-form-label">Position 1</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtPo1" name="mdt_position1" placeholder="Text Position 1 ...">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPo2" class="form-label fw-semibold col-sm-3 col-form-label">Position 2</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edtPo2" name="mdt_position2" placeholder="Text Position 2 ...">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="edtPo3" class="form-label fw-semibold col-sm-3 col-form-label">Approver pattern</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="edtPo3" name="map_id"></select>
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="mdt_id" id="edtDocId">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" id="btnUpdateMainMenu" onclick="editDocType()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editMdt(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mdt',
            success: function(result) {
                var option_text = '<option value="" selected>Choose document type</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.mdt_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.mdt_id + '" ' + sel + '>' + value.mdt_name + '</option>';
                })
                $('#edtSelDoctype').html(option_text);
            }
        })
    }

    function generateYearOptions(selectId) {
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 5;
        const endYear = currentYear + 5;
        const selectElement = document.getElementById(selectId);

        if (!selectElement) return;

        selectElement.innerHTML = '';
        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }

            selectElement.appendChild(option);
        }
    }

    function generateYearOptionsEdit(selectId, val) {
        const currentYear = parseInt(val);
        const startYear = currentYear - 5;
        const endYear = currentYear + 5;
        const selectElement = document.getElementById(selectId);

        if (!selectElement) return;

        selectElement.innerHTML = '';
        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }

            selectElement.appendChild(option);
        }
    }

    async function addDocumentType() {
        event.preventDefault();
        let chk = await mdt_validate("add");
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
                        "mdt_name": $('#inpDocName').val(),
                        "mdt_position1": $('#inpDocPo1').val(),
                        "mdt_position2": $('#inpDocPo2').val(),
                        "map_id": +$('#inpDocPo3').val(),
                        "mdt_status": 1,
                        "mdt_created_date": getTimeNow(),
                        "mdt_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'document_type/insert',
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
                                $('#inpDocName').val('');
                                $('#inpDocPo1').val('');
                                $('#inpDocPo2').val('');
                                $('#inpDocPo3').val('');
                                var table = $('#tblDocYpe').DataTable();
                                table.ajax.reload(null, false);
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
                                $('#inpDocName').val('');
                                $('#inpDocPo1').val('');
                                $('#inpDocPo2').val('');
                                $('#inpDocPo3').val('');
                                var table = $('#tblDocYpe').DataTable();
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

    async function editDocType() {
        event.preventDefault();
        let chk = await mdt_validate("edit");
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
                    $('#frmEditDocType').serializeArray().forEach(function(item) {
                        if (item.name == 'mdt_id' || item.name == 'map_id') {
                            edit_form[item.name] = parseInt(item.value);
                            return;
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["mdt_updated_date"] = getTimeNow();
                    edit_form["mdt_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'document_type/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit document type success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditDocType').modal('hide');
                                var table = $('#tblDocYpe').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit main menu!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#mdlEditDocType').modal('hide');
                                var table = $('#tblDocYpe').DataTable();
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

    function change_mdt_status(id, status) {
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
                status_form["mdt_id"] = id;
                status_form["mdt_status"] = status;
                status_form["mdt_updated_date"] = getTimeNow();
                status_form["mdt_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'document_type/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status document type success!</p>",
                                icon: 'success',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblDocYpe').DataTable();
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status document type!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            var table = $('#tblDocYpe').DataTable();
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
    async function addDocConNo() {
        event.preventDefault();
        let chk = await mdcn_validate("add");
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
                        "mdt_id": parseInt($('#selDoctype').val()),
                        "mdcn_position1": $('#inpDocNoPo1').val(),
                        "mdcn_position2": "0",
                        "mdcn_created_date": getTimeNow(),
                        "mdcn_created_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'document_control_no/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            // console.log(data);
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Document control success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblDocControl').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Document control!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                })
                                var table = $('#tblDocControl').DataTable();
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
    async function editDocConNo() {
        event.preventDefault();
        let chk = await mdcn_validate("edit");
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
                    $('#edtSelDoctype').prop('disabled', false);
                    var edit_form = {};
                    $('#frmEditDocControl').serializeArray().forEach(function(item) {
                        if (item.name == 'mdt_id' || item.name == 'mdcn_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["mdcn_updated_date"] = getTimeNow();
                    edit_form["mdcn_updated_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'document_control_no/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit document control success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#edtSelDoctype').prop('disabled', true);
                                $('#mdlEditDocControl').modal('hide');
                                var table = $('#tblDocControl').DataTable();
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit document control!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                                $('#edtSelDoctype').prop('disabled', true);
                                $('#mdlEditDocControl').modal('hide');
                                var table = $('#tblDocControl').DataTable();
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

    // modal --------------------------------------
    function editModal(name, po1, po2, map_id, id) {
        event.preventDefault();
        // alert('name:' + name +
        //     '\npo1:' + po1 +
        //     '\npo2:' + po2 +
        //     '\npo3:' + po3 +
        //     '\nid:' + id);
        $('#edtDocName').val(name);
        $('#edtPo1').val(po1);
        $('#edtPo2').val(po2);
        $('#edtDocId').val(id);
        $.ajax({
            url: API_URL + 'option/list_map',
            type: 'GET',
            success: function(response) {
                $('#edtPo3').html('<option value="" disabled>Choose approve pattern</option>');
                for (let i = 0; i < response.length; i++) {
                    let optionHtml = '';
                    if (response[i].map_id == map_id) {
                        optionHtml = '<option value="' + response[i].map_id + '" selected>' + response[i].map_name + '</option>';
                    } else {
                        optionHtml = '<option value="' + response[i].map_id + '">' + response[i].map_name + '</option>';
                    }
                    $('#edtPo3').append(optionHtml);
                }
            }
        })
    }

    function editDetailModal(position1, mdt_id, mdcn_id) {
        $('#edtDocConId').val(mdcn_id);
        editMdt(mdt_id);
        generateYearOptionsEdit('edtPostion1', position1);
    }

    $('#selDoctype').on('change', function() {
        form_ok(document.getElementById("selDoctype"));
        if (this.value) {
            $('#tab-1 select').prop('disabled', false);
            $('#tab-1 #btnRegisterDocControlNo').prop('disabled', false);
        } else {
            $('#tab-1 select').prop('disabled', true);
            $('#tab-1 #btnRegisterDocControlNo').prop('disabled', true);
        }
        generateYearOptions('inpDocNoPo1');
        // alert( this.value );
        if ($.fn.DataTable.isDataTable('#tblDocControl')) {
            $('#tblDocControl').DataTable().destroy();
            $('#tblDocControl').empty();
        }
        var detailTable = $('#tblDocControl').DataTable({
            ajax: {
                url: API_URL + 'doc_control_detail/table/' + this.value
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
                    data: 'mdcn_id'
                },
                {
                    title: 'DOC. Type Name',
                    className: 'text-center',
                    data: 'mdt_name'
                },
                {
                    title: 'DOC. Control Position 1',
                    className: 'text-center',
                    data: 'mdcn_position1'
                },
                {
                    title: 'DOC. Control Position 2',
                    className: 'text-center',
                    data: 'mdcn_position2'
                },
                {
                    title: 'Updated Date',
                    className: 'text-center',
                    data: 'mdcn_updated_date'
                },
                {
                    title: 'Updated By',
                    className: 'text-center',
                    data: 'mdcn_updated_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.update_by != "") {
                                let emp_code = row.mdcn_updated_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + ' ' + row.su_lastname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.mdcn_updated_by + '">' + row.mdcn_updated_by + '</span>' +
                                    '</div></div></div>';
                            } else {
                                disp = "";
                            }
                        }
                        return disp;
                    },
                },
                {
                    title: 'Action',
                    className: 'text-center',
                    data: 'mdcn_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editDetailModal(\'' + row.mdcn_position1 + '\',\'' + row.mdt_id + '\',\'' + row.mdcn_id + '\')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditDocControl">' +
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
        if ($.fn.DataTable.isDataTable('#tblDocYpe')) {
            $('#tblDocYpe').DataTable().destroy();
        }
        var dataTable = $('#tblDocYpe').DataTable({
            ajax: {
                url: API_URL + 'document_type/table'
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
                    data: 'mdt_id'
                },
                {
                    className: 'text-center',
                    data: 'mdt_name'
                },
                {
                    className: 'text-center',
                    data: 'mdt_position1',
                },
                {
                    className: 'text-center',
                    data: 'mdt_position2'
                },
                {
                    className: 'text-center',
                    data: 'map_id'
                },
                {
                    className: 'text-center',
                    data: 'mdt_updated_date'
                },
                {
                    className: 'text-center',
                    data: 'mdt_updated_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.mdt_updated_by != "") {
                                let emp_code = row.mdt_updated_by.substring(2, 7);
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center justify-content-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35" onerror="this.onerror=null;this.src=\'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png\';">' +
                                    '<div class="ms-3">' +
                                    '<div class="user-meta-info">' +
                                    '<h6 class="user-name mb-0" data-name="' + row.su_firstname + ' ' + row.su_lastname + '">' + row.su_firstname + ' ' + row.su_lastname + '</h6>' +
                                    '<span class="user-work fs-3" data-occupation="' + row.mdt_updated_by + '">' + row.mdt_updated_by + '</span>' +
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
                    data: 'mdt_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.mdt_status) {
                                disp = '<a onclick="change_mdt_status(' + row.mdt_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
                            } else {
                                disp = '<a onclick="change_mdt_status(' + row.mdt_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
                            }
                        }
                        return disp;
                    },
                },
                {
                    className: 'text-center',
                    data: 'mdt_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editModal(\'' + row.mdt_name + '\',\'' + row.mdt_position1 + '\',\'' + row.mdt_position2 + '\',\'' + row.map_id + '\',\'' + row.mdt_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEditDocType">' +
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