<title>CRM | RFQ Form</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Issue RFQ Document</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Issue RFQ </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="datatables">
        <!-- basic table -->
        <form id="add_form" name="add_form" method="post">
            <div class="row">
                <div class="col-12">

                    <!------------------------------------------------------ Section 1  -------------------------------------------------------->
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="padding: 15px;">
                                <div class="col-md-7">
                                    <h4 class="fs-5 fw-semibold">Section 1 : General Information</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row" style="padding: 15px;">
                                <!-------------------------- Attn. ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Attn. :</h4>
                                    </div>
                                    <!-- <input type="hidden" class="form-check-input me-2" name="ir_doc_no" id="inpDocNo"> -->
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_pu_dept" id="inpPuDept">
                                        <label class="form-check-label fw-semibold" for="inpPuDept">PU Dept.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_pe_dept" id="inpPeDept">
                                        <label class="form-check-label fw-semibold" for="inpPeDept">PE Dept.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_scm_dept" id="inpScmDept">
                                        <label class="form-check-label fw-semibold" for="inpScmDept">SCM Dept.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_ce_dept" id="inpCeDept">
                                        <label class="form-check-label fw-semibold" for="inpCeDept">CE Dept.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_gdc_dept" id="inpGdcDept">
                                        <label class="form-check-label fw-semibold" for="inpGdcDept">GDC Dept.</label>
                                    </div>
                                </div>

                                <!-------------------------- Customer ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <div class="col">
                                            <select name="ir_import_tran" id="inpImportFrom" class="select2 form-select"></select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <select name="ir_customer" id="inpCustomer" class=" form-select" onchange="changeCustomer()"></select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-------------------------- Subject ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Subject :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <div class="col">
                                            <select name="ir_mrt" id="selRequirement" class="form-select" onchange="changeRequirement()"> </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="ir_other_mrt" id="inpOtherSubject" class="form-control" placeholder="Other Subject ..." disabled>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-------------------------- Enclosures ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Enclosures :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <div class="col">
                                            <select name="ir_enclosures" id="inpEnclosures" onchange="changeEnclosures()" class="form-select">
                                                <option value="">Select Enclosures</option>
                                                <option value="Drawing">Drawing</option>
                                                <option value="0">Other</option>
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="ir_other_enclosures" id="inpOtherEnclosures" class="form-control" placeholder="Other Enclosures ..." disabled>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-------------------------- Purchase Cost ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Purchase Cost :</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" name="ir_raw_puc" id="inpRawMaterial">
                                        <label class="form-check-label fw-semibold" for="inpRawMaterial">Raw material</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpMold" name="ir_mold_puc">
                                        <label class="form-check-label fw-semibold" for="inpMold">Mold/Die</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpMenuFac" name="ir_menufac_puc">
                                        <label class="form-check-label fw-semibold" for="inpMenuFac">Manufacturing</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpTransport" name="ir_transport_puc">
                                        <label class="form-check-label fw-semibold" for="inpTransport">Transportation</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <!-------------------------- Process Cost ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Process Cost :</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpCast" name="ir_cast_poc">
                                        <label class="form-check-label fw-semibold" for="inpCast">Casting</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpMachin" name="ir_machin_poc">
                                        <label class="form-check-label fw-semibold" for="inpMachin">Machining</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpAssembly" name="ir_assembly_poc">
                                        <label class="form-check-label fw-semibold" for="inpAssembly">Assembly</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" class="form-check-input me-2" id="inpPack" name="ir_pack_poc">
                                        <label class="form-check-label fw-semibold" for="inpPack">Packaging and Delivery</label>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <!-------------------------- Note ---------------------------->
                                <div class="d-flex col-md-12 mb-3">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <textarea name="ir_note" class="form-control" rows="4" id="inpNote"></textarea>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <!-------------------------- Comment / Additional  ---------------------------->
                                <div class="d-flex col-md-12 mb-3">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <textarea name="ir_comment" class="form-control" rows="4" id="inpComment"></textarea>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <!-------------------------- Closeing Date  ---------------------------->
                                <div class="d-flex col-md-12 mb-3">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                    </div>
                                    <div class="d-flex col-md-3 me-3 gap-5">
                                        <input type="date" class="form-control" id="inpDuedate" name="ir_duedate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------------------------------------ Section 2  -------------------------------------------------------->
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="padding: 15px;">
                                <div class="col-md-7 d-flex">
                                    <h4 class="fs-5 fw-semibold me-2">Section 2 : Item Information</h4>
                                    <span>( Max 20 Items )</span>
                                </div>
                                <hr>
                            </div>
                            <div class="row" style="padding: 15px;">
                                <!-------------------------- Group Part NO ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                    <div class="d-flex col-md-5 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Part No. :</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="inpPartNo" name="ir_part_no" placeholder="Enter Part No ...">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Part Name :</label>
                                        <div class="col">
                                            <input type="text" class="form-control col-md-6" id="inpPartName" name="ir_part_name" placeholder="Enter Part Name ...">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                    <div class="d-flex col-md-5 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Model :</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="inpModel" name="ir_model" placeholder="Enter Model ...">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Remark :</label>
                                        <div class="col me-3">
                                            <input type="text" class="form-control col-md-6" id="inpRemark" name="ir_remark" placeholder="Enter Remark ...">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <button type="button" onclick="addPart()" class="btn bg-primary-subtle text-primary">Add</button>
                                    </div>
                                </div>

                                <!----------- Table Part No.  ------------>
                                <div class="table-responsive mb-5">
                                    <table class="table table-hover text-wrap mb-0 align-middle table-b text-center bg-info-subtle border rounded shadow-sm" id="tblPartNo">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Part No.</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Part Name</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Model</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Remark</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-top text-wrap bg-white">
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-7">
                                        <h4 class="fs-5 fw-semibold">Section 3 : Volume Information</h4>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px;">

                                    <!-------------------------- Project Life ---------------------------->
                                    <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                        <div class="d-flex col-md-4 align-items-center">
                                            <label for="" class="col-md-auto form-label fw-semibold me-3">Project Life :</label>

                                            <div class="col-md-6 me-3">
                                                <input type="number" min="1" max="10" class="form-control" id="inpProjectLife" name="ir_pro_life" onchange="changeProLife()" placeholder="Enter Number ..." value="1">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <label for="" class="col form-label fw-semibold">Years</label>
                                        </div>

                                        <div class="d-flex col-md-4 align-items-center">
                                            <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                            <div class="col">
                                                <input type="month" class="form-control" id="inpProTim" name="ir_pro_tim" onchange="changeProLife()">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <!----------- Table Project Life  ------------>
                                        <div class="table-responsive border rounded mb-5 shadow-sm">
                                            <table class="table text-wrap mb-0 align-middle text-center" id="tblProjectLife">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Year</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Volume</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="border-top text-wrap" id="tlbBodyProjectLife">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                            <a href="javascript:void(0);" onclick="clearForm()" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                            <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="addRfq()"><i class="ti ti-download me-2" style="font-size: 20px;"></i></i>Issue RFQ</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Zero Configuration -->
            </div>
        </form>
    </div>
    

</div>



<script>
    var groupPartData = [];
    var groupVolumeInfo = [];

    async function addPart() {
        const partNo = document.add_form.ir_part_no.value;
        const partName = document.add_form.ir_part_name.value;
        const model = document.add_form.ir_model.value;
        const remark = document.add_form.ir_remark.value;

        if (groupPartData.length > 19) {
            Swal.fire({
                html: "<h3>Part No. Incorrect quantity !</h3>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            return;
        }

        let chkPart = await checkPartGroup(document.add_form.ir_part_no, document.add_form.ir_part_name, document.add_form.ir_model);
        if (chkPart) {
            const table = document.getElementById('tblPartNo').querySelector('tbody');
            const rowCount = table.rows.length;
            const newRow = table.insertRow();

            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);
            const cell5 = newRow.insertCell(4);

            cell1.innerHTML = partNo;
            cell2.innerHTML = partName;
            cell3.innerHTML = model;
            cell4.innerHTML = remark;

            groupPartData.push({
                irpn_part_no: partNo,
                irpn_part_name: partName,
                irpn_model: model,
                irpn_remark: remark
            });

            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'btn btn-danger btn-sm ti ti-trash fs-5 rounded-circle card-hover';

            deleteBtn.onclick = function() {
                table.deleteRow(newRow.rowIndex - 1);

                const indexToRemove = rowCount;
                if (indexToRemove >= 0 && indexToRemove < groupPartData.length) {
                    groupPartData.splice(indexToRemove, 1);
                }
            };
            cell5.appendChild(deleteBtn);

            document.add_form.ir_part_no.value = '';
            document.add_form.ir_part_name.value = '';
            document.add_form.ir_model.value = '';
            document.add_form.ir_remark.value = '';
            form_defaultValid(document.add_form.ir_part_no);
            form_defaultValid(document.add_form.ir_part_name);
            form_defaultValid(document.add_form.ir_model);
        } else {
            return false;
        }

    }

    async function changeProLife() {
        let proLife = document.getElementById('inpProjectLife');
        let proTim = document.getElementById('inpProTim');

        if (proLife.value <= 0 || proLife.value > 10) {
            form_errValid(document.getElementById('inpProjectLife'), "*Please Enter Number 1-10");
            return;
        } else {
            form_okValid(document.getElementById('inpProjectLife'));
        }

        if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
            let html = '';
            let count = 1;
            let year = proTim.value.substring(0, 4);
            for (let i = 0; i <= proLife.value; i++) {
                html += '<tr>' +
                    '<td class="text-center col-6">' + (parseInt(year) + i) + '</td>' +
                    '<td><div class="col"><input type="number" class="form-control text-center col-6" min="0" max="999999" id="inpVolume' + i + '"><span class="invalid-feedback"></span></div></td>' +
                    '</tr>';
            }
            document.getElementById('tlbBodyProjectLife').innerHTML = html;
        }
    }

    function listImportfrom(id) {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_import',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Customer Type</option>';
                $.each(result, function(key, value) {
                    let sel = "";
                    if (value.mif_id == id) {
                        sel = "selected";
                        chkCus = true;
                    }
                    option_text += '<option value="' + value.mif_id + '" ' + sel + '>' + value.mif_name + '</option>';
                })
                $('#inpImportFrom').html(option_text);
            }
        })
    }

    function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system_debug/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Costomer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="">Other</option>';
                $('#inpCustomer').html(option_text);
            }
        })
    }

    function listSubject() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mrt',
            success: function(result) {
                var option_text = '<option value="">Select Subject</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.ir_mrt + '">' + value.mrt_name + '</option>';
                })
                option_text += '<option value="0">Other</option>';
                $('#selRequirement').html(option_text);
            }
        })
    }

    async function changeCustomer() {
        let data = $('#inpCustomer').val();
        if (data == '') {
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


        }
    }

    async function changeRequirement() {
        let data = $('#selRequirement').val();
        if (data == 0) {
            $('#inpOtherSubject').prop('disabled', false);
        } else {
            $('#inpOtherSubject').prop('disabled', true);
        }
    }

    async function changeEnclosures() {
        let data = $('#inpEnclosures').val();
        if (data == 0) {
            $('#inpOtherEnclosures').prop('disabled', false);
        } else {
            $('#inpOtherEnclosures').prop('disabled', true);
        }
    }

    async function clearForm() {
        $('#add_form')[0].reset();
        $('#tblPartNo tbody').html('');
        $('#tlbBodyProjectLife').html('');
        const formElements = document.add_form.querySelectorAll('input, select, textarea');
        formElements.forEach(element => {
            form_defaultValid(element);
        });
    }

    async function addRfq() {
        event.preventDefault();
        let chk = await Rfq_valid("add");
        if (chk) {
            if (groupPartData.length == 0) {
                form_errValid(document.add_form.ir_part_no, '*Plase Enter Part No.');
                form_errValid(document.add_form.ir_part_name, '*Plase Enter Part Name');
                form_errValid(document.add_form.ir_model, '*Plase Enter Model');
                return;
            } else {
                form_okValid(document.add_form.ir_note);
                form_okValid(document.add_form.ir_comment);
                form_okValid(document.add_form.ir_duedate);
                if (groupVolumeInfo.length == 0 && is_empty(document.add_form.ir_pro_tim.value)) {
                    form_errValid(document.add_form.ir_pro_tim, '*Please Select Program Timing Info');
                    return;
                } else {
                    form_okValid(document.add_form.ir_pro_tim);
                    groupVolumeInfo = [];
                    const tbody = document.querySelector('#tlbBodyProjectLife');
                    const rowCount = tbody.rows.length;
                    for (let i = 0; i < rowCount; i++) {
                        let volume = document.getElementById('inpVolume' + i);
                        if (is_empty(volume.value)) {
                            form_errValid(volume, "*Please Enter Volume");
                            return false;
                        } else {
                            if (volume.value > 999999) {
                                form_errValid(volume, "*Please Enter Volume 1-999999");
                                return false;
                            } else {
                                form_okValid(volume);
                                groupVolumeInfo.push({
                                    "year": tbody.rows[i].cells[0].innerHTML,
                                    "volume": tbody.rows[i].cells[1].children[0].querySelector('input').value
                                })
                            }
                        }
                    }
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to register RFQ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, register it.!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var add_form = {};
                            let groupCheckBox = [{}];
                            $('#add_form').serializeArray().forEach(function(item) {
                                if ($('input[name="' + item.name + '"]').attr('type') === 'checkbox') {
                                    return;
                                }
                                if (item.name == 'ir_part_no' || item.name == 'ir_part_name' || item.name == 'ir_model' || item.name == 'ir_remark') {
                                    return;
                                }
                                if (item.name == 'ir_import_tran' || item.name == 'ir_mrt' || item.name == 'ir_enclosures' || item.name == 'ir_pro_life') {
                                    item.value = parseInt(item.value)
                                }
                                add_form[item.name] = item.value;
                            });

                            $('#add_form input[type="checkbox"]').each(function() {
                                groupCheckBox[0][$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
                            });

                            if (add_form["ir_mrt"] == 0) {
                                add_form["ir_mrt"] = add_form["ir_other_mrt"];
                            } else {
                                add_form["ir_mrt"] = document.add_form.ir_mrt.options[document.add_form.ir_mrt.selectedIndex].text;
                            }

                            if (add_form["ir_enclosures"] == 0) {
                                add_form["ir_enclosures"] = add_form["ir_other_enclosures"];
                            } else {
                                add_form["ir_enclosures"] = document.add_form.ir_enclosures.options[document.add_form.ir_enclosures.selectedIndex].text;
                            }

                            add_form["ir_ref_fm"] = null;
                            add_form["ir_ref_nbc"] = null;
                            add_form["ir_created_date"] = getTimeNow();
                            add_form["ir_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                            add_form["ir_status"] = 1;

                            add_form["ir_group_part"] = groupPartData;
                            add_form["ir_group_volume"] = groupVolumeInfo;
                            add_form["ir_group_checkbox"] = groupCheckBox;
                            add_form["ir_doc_no"] = chk;
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
                                        clearForm();
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
                            return;
                        }
                    })
                }
            }
        }
    }


    $(document).ready(function() {
        listImportfrom();
        listCustomer();
        listSubject();

    });
</script>