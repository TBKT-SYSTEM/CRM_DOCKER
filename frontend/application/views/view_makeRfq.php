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
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>RfqForm">RFQ Form</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Make RFQ</li>
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
                            <div class="hstack">
                                <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-list-details text-primary fs-6"></i>
                                </div>
                                <div>
                                    <h3 class="mb-1 fw-semibold">Form RFQ</h2>
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
                                    <form id="add_form" name="add_form" type="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 d-flex justify-content-center gap-3">
                                                    <div class="col">
                                                        <label for="inpDocType" class="form-label">Document Type</label>
                                                        <input type="text" name="doc_type" value="RFQ" class="form-control" id="inpDocType" placeholder="xxxxx" disabled>
                                                        <input type="hidden" id="inpDocNo" name="ir_doc_no">
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="inpDate" class="form-label">Issue Date</label>
                                                        <input type="text" class="form-control" id="inpDate" name="create_date" placeholder="Date" value="<?php echo date('Y/m/d'); ?>" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="col">
                                                        <label for="if_ref_fm" class="form-label fw-semibold">Ref. Feasibility</label>
                                                        <input type="text" name="if_ref_fm" id="inpIrRefFm" value="" class="form-control" placeholder="" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="ir_ref_nbc" class="form-label fw-semibold">Ref. NBC.</label>
                                                        <input type="text" name="ir_ref_nbc" id="inpIrRefNbc" value="" class="form-control" placeholder="" disabled>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="col">
                                                        <label for="inpImportFrom" class="form-label fw-semibold">Import From</label>
                                                        <select name="ir_import_tran" id="inpImportFrom " class="form-control">
                                                            <option value="1">Oversea</option>
                                                            <option value="2">Domestic</option>
                                                        </select>
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="selRequirement" class="form-label fw-semibold">Requirement</label>
                                                        <select name="mrt_id" id="selRequirement" class="form-control">
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
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="col">
                                                        <label for="inpProjectLife" class="form-label fw-semibold">Project Life</label>
                                                        <input type="number" min="1" max="10" class="form-control" id="inpProjectLife" name="ir_pro_life" placeholder="Project Life" value="1">
                                                        <span class="form_error"></span>
                                                    </div>
                                                    <div class="col">
                                                        <label for="inpSop" class="form-label fw-semibold">Program Timing Info. (SOP)</label>
                                                        <input type="month" class="form-control" id="inpSop" name="ir_sop" placeholder="">
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="col">
                                                        <label for="inpFile" class="form-label fw-semibold">Attached Files</label>
                                                        <input type="file" class="form-control" id="inpFile" name="ir_file[]" placeholder="Attached Files" multiple>
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
                                                                        <select name="ir_customer" id="inpCustomer" class="form-control"></select>
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
                                                                        <input type="text" name="ir_customer_new" id="selNewCustomer" class="form-control" placeholder="Enter Customer Name">
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
                                                        <input type="number" class="form-control" onchange="changePartNo()" id="inpQtyPartNo" name="ir_qty_part_no" max="20" min="1" placeholder="Enter Quentity of Part"></input>
                                                        <span class="form_error"></span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div id="form_part_no" name="form_part_no" style="height: 490px; overflow: auto;">
                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                    <a href="<?php echo base_url() ?>RfqForm" class="btn bg-danger-subtle text-danger">Back</a>
                                                    <button type="button" class="btn btn-primary" id="btnSubmitRegister" onclick="addRfq()">Submit</button>
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
    async function addRfq() {
        event.preventDefault();
        let chk = await Rfq_validate("add");
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
                        if (item.name == 'ir_ref_fm' || item.name == 'ir_ref_nbc' || item.name == 'ir_import_tran' || item.name == 'mrt_id') {
                            item.value = parseInt(item.value)
                        }
                        add_form[item.name] = item.value;
                    })
                    add_form["ir_created_date"] = getTimeNow();
                    add_form["ir_duedate"] = addDaysToDate(getTimeNow(), 7).substring(0, 10) + " 11:59:59";
                    add_form["ir_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    add_form["ir_status"] = 1;
                    add_form["ir_group_part"] = chk.partInsert;

                    if (add_form['ir_customer_new'] !== '') {
                        add_form['ir_customer'] = add_form['ir_customer_new'];
                    } else {
                        add_form['ir_customer'] = add_form['ir_customer'];
                    }
                    
                    var files = document.getElementById('inpFile').files;
                    var formFile = new FormData();
                    if (files.length > 0) {
                        for (var i = 0; i < files.length; i++) {
                            formFile.append('ir_file[]', files[i]);
                        }
                        formFile.append('doc_no', add_form['ir_doc_no']);
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo base_url(); ?>FileControl/uploadFile",
                            data: formFile,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data.success == true) {
                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        contentType: 'application/json',
                                        url: API_URL + 'rfq/insert',
                                        data: JSON.stringify(add_form),
                                        success: function(data) {
                                            if (data.Error != "null" || data.Error != "") {
                                                Swal.fire({
                                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add RFQ success!</p>",
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
                                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add RFQ!</p>",
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
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message,
                                    });
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    } else {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            contentType: 'application/json',
                            url: API_URL + 'rfq/insert',
                            data: JSON.stringify(add_form),
                            success: function(data) {
                                if (data.Error != "null" || data.Error != "") {
                                    Swal.fire({
                                        html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add RFQ success!</p>",
                                        icon: 'success',
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                                    })
                                    $('#add_form')[0].reset();
                                } else {
                                    Swal.fire({
                                        html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add RFQ!</p>",
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
                    }
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

    function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Costomer</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                $('#inpCustomer').html(option_text);
            }
        })
    }

    async function changePartNo() {
        event.preventDefault();
        var maxPartNo = parseInt(inpQtyPartNo.getAttribute('max'), 10);
        var inpQtyPart = $('#inpQtyPartNo');

        if (inpQtyPartNo.value > maxPartNo || inpQtyPartNo.value < 1) {
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
            html +=
                '<div class="px-2">' +
                '<div class="d-flex justify-content-center col-12 gap-3">' +
                '<div class="mb-3 col align-items-center">' +
                '<label abel for="inpPartNo' + i + '" class="form-label fw-semibold">Part No (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpPartNo' + i + '" name="ir_part_no[]" placeholder="Part No ...">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '<div class="mb-3 col align-items-center">' +
                '<label for="inpPartName' + i + '" class="form-label fw-semibold">Part Name (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpPartName' + i + '" name="ir_part_name[]" placeholder="Part Name ...">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="d-flex justify-content-center col-12 gap-3">' +
                '<div class="mb-3 col align-items-center">' +
                '<label for="inpModel' + i + '" class="form-label fw-semibold">Model (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpModel' + i + '" name="ir_model[]" placeholder="Model ...">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '<div class="mb-3 col align-items-center">' +
                '<label for="inpRemark' + i + '" class="form-label fw-semibold">Remark (' + i_plus_1 + ')</label>' +
                '<div class="col">' +
                '<input type="text" class="form-control" id="inpRemark' + i + '" name="ir_remark[]" placeholder="Remark ...">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>';
        }
        $('#form_part_no').html(html);
    }

    $(document).ready(function() {
        listCustomer();
    });
</script>