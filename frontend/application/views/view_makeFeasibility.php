<title>CRM | Make Feasibility</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Make Feasibility</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Requirement Form</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>FeasibilityForm">Feasibility Form</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Make Feasibility</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <!-- start Zero Configuration -->
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="row" style="padding: 15px;">
                        <div class="col-md-7">
                            <div class="hstack pb-1">
                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-list-details text-primary fs-6"></i>
                                </div>
                                <div>
                                    <h3 class="mb-1 fw-semibold">Form Feasibility</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class=" w-100 position-relative overflow-hidden mb-0">
                                <div class="card-body p-4">
                                    <form id="add_form" name="add_form">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 d-flex justify-content-center gap-3">
                                                    <div class="col">
                                                        <label for="inpDocType" class="form-label">Document Type</label>
                                                        <input type="text" name="doc_type" value="Feasibility" class="form-control" id="inpDocType" placeholder="xxxxx" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="inpDate" class="form-label">Issue Date</label>
                                                        <input type="text" class="form-control" id="inpDate" name="create_date" placeholder="Date" value="<?php echo date('Y/m/d'); ?>" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="if_ref" class="form-label fw-semibold">Document Reference</label>
                                                        <input type="text" name="if_ref" id="inpIrRef" value="" class="form-control" placeholder="" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="col">
                                                        <label for="inpImportFrom" class="form-label fw-semibold">Import From</label>
                                                        <select name="if_import_tran" id="selImport" class="form-control">
                                                            <option value="" disabled selected>Import From</option>
                                                            <option value="1">Oversea</option>
                                                            <option value="2">Domestic</option>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="selRequirement" class="form-label fw-semibold">Requirement</label>
                                                        <select name="mrt_id" id="selRequirement" class="form-control">
                                                            <option value="" disabled selected>Choose Requirement</option>
                                                            <?php
                                                            $option_mrt = $this->ManageBackend->list_option("option/list_mrt");
                                                            foreach ($option_mrt as $op_mrt) {
                                                                echo '<option value="' . $op_mrt['mrt_id'] . '">' . $op_mrt['mrt_name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <ul class="nav nav-pills nav-fill gap-3" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true">
                                                                    <span>Current Customer</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                                                    <span>New Customer</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-content mt-2">
                                                        <div class="tab-pane active show" id="navpill-111" role="tabpanel">
                                                            <div class="mb-3 row align-items-center">
                                                                <div class="col">
                                                                    <label for="inpCustomer" class="form-label fw-semibold">Select Customer</label>
                                                                    <div class="col-lg-6">
                                                                        <select name="if_customer" id="inpCustomer" class="form-control">
                                                                            <option value="" selected>Choose Customer</option>
                                                                            <?php
                                                                            $option_mct = $this->ManageBackend->list_option("option/list_cus");
                                                                            foreach ($option_mct as $op_mct) {
                                                                                echo '<option value="' . $op_mct['mct_id'] . '">' . $op_mct['mct_name'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="form_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="navpill-222" role="tabpanel">
                                                            <div id="tab-2" style="display: block;">
                                                                <div class="mb-3 row align-items-center">
                                                                    <label for="inpNewCustomer" class="form-label fw-semibold">Customer Name</label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" name="if_customer_new" id="selNewCustomer" class="form-control" placeholder="Enter Customer Name">
                                                                        <span class="form_error"></span>
                                                                    </div>
                                                                </div>
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3 row align-items-center">
                                                    <label for="inpQtyPartNo" class="form-label fw-semibold">Part No.</label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" onchange="changePartNo()" id="inpQtyPartNo" name="if_qty_part_no" max="20" min="1" placeholder="Enter Quentity of Part"></input>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div id="form_part_no" name="form_part_no" style="height: 250px; overflow: auto;">

                                                </div>
                                            </div>

                                            <input type="hidden" id="doc_no" name="if_doc_no">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                    <a href="<?php echo base_url() ?>FeasibilityForm" class="btn bg-danger-subtle text-danger">Back</a>
                                                    <button type="button" class="btn btn-primary" id="btnSubmitRegister" onclick="addFeasibility()">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

<script>
    async function addFeasibility() {
        event.preventDefault();
        let chk = await Feasibility_validate("add");
        // console.log('check =>',chk);
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

                        if (item.name == 'if_import_tran' || item.name == 'mrt_id') {
                            item.value = parseInt(item.value)
                        }

                        if (item.name == 'if_part_no[]' || item.name == 'if_part_name[]') {
                            return;
                        }

                        add_form[item.name] = item.value;
                    })
                    add_form["create_date"] = getTimeNow();
                    add_form["if_duedate"] = addDaysToDate(getTimeNow(), 7).substring(0, 10) + " 11:59:59";
                    add_form["create_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    add_form["update_date"] = getTimeNow();
                    add_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    add_form["if_group_part"] = chk;
                    add_form["su_id"] = '<?php echo $this->session->userdata('sessUsrId') ?>';
                    add_form["doc_type"] = 2;
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'feasibility/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
                            if (data.Error != null || data.Error != "") {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Feasibility success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutUp'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?= base_url() ?>FeasibilityForm";
                                    }
                                });
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Feasibility!</p>",
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
    }

    function listRequirement(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mrt',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Requirement</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.mrt_id == id) {
                        sel = "selected";
                    }
                    option_text += '<option value="' + value.mrt_id + '" ' + sel + '>' + value.mrt_name + '</option>';
                })
                $('#editRequirement').html(option_text);
            }
        })
    }

    function changePartNo() {
        var maxPartNo = parseInt(inpQtyPartNo.getAttribute('max'), 10);
        var inpQtyPart = $('#inpQtyPartNo');

        if (inpQtyPartNo.value > maxPartNo) {
            inpQtyPartNo.value = 0;
            let err = document.getElementById('inpQtyPartNo');
            form_err(err, "*Please Enter Quentity 1-20");
            return false;
        }

        if (inpQtyPart.length && inpQtyPart.val() !== "") {
            inpQtyPart[0].style.border = "1px solid #d1d3e2";
            inpQtyPart[0].nextElementSibling.style.display = "none";
        }
        var html = '';
        for (var i = 0; i < inpQtyPart.val(); i++) {
            var i_plus_1 = i + 1;
            html += '<div class="d-flex justify-content-center gap-3">' +
                '<div class="mb-3 col align-items-center">' +
                '<label for="inpPartNo' + i + '" class="form-label fw-semibold">Part No (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpPartNo' + i + '" name="if_part_no[]" placeholder="Part No.">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '<div class="mb-3 col align-items-center">' +
                '<label for="inpPartName' + i + '" class="form-label fw-semibold">Part Name (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpPartName' + i + '" name="if_part_name[]" placeholder="Part Name">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>';
        }
        $('#form_part_no').html(html);
    }
</script>