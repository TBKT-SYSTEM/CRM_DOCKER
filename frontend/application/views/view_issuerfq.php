<title>CRM | Issue RFQ Document</title>
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
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Reference RFQ No. :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <div class="col">
                                            <select name="idc_refer_doc" id="inpRefRfq" class="select2 form-select">
                                                <?php
                                                $option_topic = $this->ManageBackend->list_option("option/list_doc_rfq");
                                                echo '<option value="0">Choose Reference RFQ ...</option>';
                                                foreach ($option_topic as $topic) {
                                                    echo '<option value="' . $topic['idc_id'] . '">' . $topic['idc_running_no'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <button type="button" onclick="getRfq()" class="col-sm-3 btn rounded-pill bg-primary-subtle text-primary shadow-sm mx-2">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                <!-------------------------- Attn. ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center" name="attn_group">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Attn. :</h4>
                                    </div>
                                    <!-- <input type="hidden" class="form-check-input me-2" name="ir_doc_no" id="inpDocNo"> -->
                                    <?php
                                    $option_topic = $this->ManageBackend->list_option("option/list_attn");
                                    foreach ($option_topic as $topic) {
                                        echo '<div class="col-md-2">';
                                        echo '<input type="checkbox" class="form-check-input me-2" name="ir_attn[]" id="' . $topic['mda_id'] . '" required>';
                                        echo '<label class="form-check-label fw-semibold" for="inpAttn' . $topic['mda_id'] . '">' . $topic['mda_name'] . ' Dept</label>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                <span class="invalid-feedback"></span>

                                <!-------------------------- Customer ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <div class="col">
                                            <select name="idc_customer_type" id="inpImportFrom" class="select2 form-select">
                                                <option value="1">Domestic</option>
                                                <option value="2">Overseas</option>
                                            </select>

                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <select name="idc_customer_name" id="inpCustomer" class="select2 form-select" onchange="changeCustomer()"></select>
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
                                            <select name="mds_id" id="selRequirement" class="select2 form-select" onchange="changeRequirement()"> </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="idc_subject_note" id="inpOtherSubject" class="form-control" placeholder="Other Subject ..." disabled>
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
                                            <select name="mde_id" id="inpEnclosures" onchange="changeEnclosures()" class="select2 form-select">
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="idc_enclosures_note" id="inpOtherEnclosures" class="form-control" placeholder="Other Enclosures ..." disabled>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-------------------------- Note ---------------------------->
                                <div class="d-flex col-md-12 mb-3">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Note :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <textarea name="idc_note1" class="form-control" rows="4" id="inpNote" maxlength="200"></textarea>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <!-------------------------- Comment / Additional  ---------------------------->
                                <div class="d-flex col-md-12 mb-3">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Comment / Additional :</h4>
                                    </div>
                                    <div class="d-flex col-md-10 me-3 gap-5">
                                        <textarea name="idc_note2" class="form-control" rows="4" id="inpComment" maxlength="200"></textarea>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <!-------------------------- Closeing Date  ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Closeing Date :</h4>
                                    </div>
                                    <div class="d-flex col-md-3 me-5 gap-5">
                                        <input type="date" class="form-control" id="inpDuedate" name="idc_closing_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                        <span class="col-auto invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="d-flex col-md-12 mb-3 align-items-center">
                                    <div class="col-md-2">
                                        <h4 class="mb-2 fs-4 fw-semibold">Phase :</h4>
                                    </div>
                                    <div class="d-flex col-md-3 me-5 gap-5">
                                        <select class="form-select" id="inpPlantCd" name="idc_plant_cd">
                                            <option value="51">Phase 10 (HO)</option>
                                            <option value="52">Phase 8 (Branch No. 1)</option>
                                        </select>
                                        <span class="col-auto invalid-feedback"></span>
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
                                    <span>( Max 10 Items )</span>
                                </div>
                                <hr>
                            </div>
                            <div class="row" style="padding: 15px;">
                                <!-------------------------- Group Part NO ---------------------------->
                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                    <div class="d-flex col-md-5 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Part No. :</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="inpPartNo" name="idi_item_no" placeholder="Enter Part No ..." maxlength="50">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Part Name :</label>
                                        <div class="col">
                                            <input type="text" class="form-control col-md-6" id="inpPartName" name="idi_item_name" placeholder="Enter Part Name ..." maxlength="100">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                    <div class="d-flex col-md-5 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Model :</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="inpModel" name="idi_model" placeholder="Enter Model ..." maxlength="50">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex col-md-6 align-items-center">
                                        <label for="" class="col-md-2 form-label fw-semibold me-3">Remark :</label>
                                        <div class="col me-3">
                                            <input type="text" class="form-control col-md-6" id="inpRemark" name="idi_remark" placeholder="Enter Remark ..." maxlength="100">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <button type="button" onclick="addPart()" class="btn bg-primary-subtle text-primary">Add</button>
                                    </div>
                                </div>

                                <!----------- Table Part No.  ------------>
                                <div class="table-responsive mb-5">
                                    <table class="table table-hover table-bordered text-wrap mb-0 align-middle table-b text-center rounded shadow-sm" id="tblPartNo">
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
                                                <input type="number" min="1" max="10" class="form-control" id="inpProjectLife" name="idc_project_life" onchange="changeProLife()" placeholder="Enter Number ..." value="1">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <label for="" class="col form-label fw-semibold">Years</label>
                                        </div>

                                        <div class="d-flex col-md-4 align-items-center">
                                            <label for="" class="col-md-auto form-label fw-semibold me-3">Program Timing Info :</label>
                                            <div class="col">
                                                <select class="select2 form-select" name="idc_project_start" id="inpProTim" onchange="changeProLife()">
                                                    <?php
                                                    echo '<option value="">Choose Year ...</option>';
                                                    $year_cur = (int)date('Y');
                                                    $year_end = $year_cur + 20;
                                                    for ($i = $year_cur; $i <= $year_end; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!----------- Table Project Life  ------------>
                                        <div class="table-responsive border rounded mb-5 shadow-sm" style="overflow-x: auto;">
                                            <table class="table table-bordered text-wrap mb-0 align-middle text-center" id="tblProjectLife">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">No.</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Part No.</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" id="tlbHeadProjectLife">
                                                            <h6 class="fw-semibold mb-0">Year/Volume</h6>
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

    function deleteRow(event) {
        const table = document.getElementById('tblPartNo').querySelector('tbody');
        const row = event.target.closest('tr');
        const rowIndex = Array.from(table.rows).indexOf(row);

        if (rowIndex !== -1) {
            table.deleteRow(rowIndex);
            if (rowIndex < groupPartData.length) {
                groupPartData.splice(rowIndex, 1);
                document.querySelector('#tlbBodyProjectLife').innerHTML = '';
                let htmlBody = '';
                for (let i = 0; i < groupPartData.length; i++) {
                    htmlBody += `<tr>`;
                    htmlBody += `<td>${i+1}</td>`
                    htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`
                    for (let q = 0; q < groupPartData[i].ir_group_volume.length; q++) {
                        htmlBody += `<td>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                        min="0" max="999999" 
                                        data-year="${groupPartData[i].ir_group_volume[q].idv_year}" 
                                        placeholder="Please input volume ${groupPartData[i].ir_group_volume[q].idv_year}"
                                        value="${groupPartData[i].ir_group_volume[q].idv_qty}">
                                    <span class="invalid-feedback"></span>
                                </td>`;
                    }
                    htmlBody += `</tr>`
                }
                document.querySelector('#tlbBodyProjectLife').innerHTML = htmlBody;
            } else {
                console.error('Row index out of bounds for groupPartData');
            }
        } else {
            console.error('Invalid row index');
        }
    }
    async function getRfq() {
        groupPartData = [];
        let idc_id = $('#inpRefRfq').val();
        if (idc_id == 0) {
            form_errValid(document.getElementById('inpRefRfq'), "*Please Choose RFQ Document !!");
        } else {
            form_okValid(document.getElementById('inpRefRfq'));
            $.ajax({
                method: "GET",
                url: API_URL + 'rfq/ref_rfq/' + idc_id,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading data ...',
                        text: 'Please wait a moment',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: async function(data) {
                    await referRFQ(data);
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred.',
                        text: 'Unable to load data: ' + error
                    });
                }
            });
        }
    }
    async function referRFQ(data) {
        const checkboxesAttn = document.querySelectorAll('input[name="ir_attn[]"]');
        checkboxesAttn.forEach(checkbox => {
            checkbox.checked = false;
        });
        data.idat_item.forEach(id => {
            checkboxesAttn.forEach(checkbox => {
                if (checkbox.id === id) {
                    checkbox.checked = true;
                }
            });
        });
        /////////////////// Customer Type
        const selectCus = document.querySelectorAll('select[name="idc_customer_type"]');
        selectCus.forEach(select => {
            select.value = data.idc_customer_type;
        });
        document.querySelector('#select2-inpImportFrom-container').textContent = $('#inpImportFrom option:selected').text();
        document.querySelector('#select2-inpImportFrom-container').setAttribute = ('title', $('#inpImportFrom option:selected').text());

        /////////////////// Customer Name
        const selectCusName = document.querySelectorAll('select[name="idc_customer_name"]');
        let foundCusName = false;
        selectCusName.forEach(select => {
            select.value = data.idc_customer_name;
            if (select.value == data.idc_customer_name) {
                foundCusName = true;
            }
        });
        if (!foundCusName && data.idc_customer_name) {
            const newOption = document.createElement('option');
            newOption.value = data.idc_customer_name;
            newOption.textContent = data.idc_customer_name;
            selectCusName.forEach(select => {
                select.appendChild(newOption);
                select.value = data.idc_customer_name;
            });
        }
        document.querySelector('#select2-inpCustomer-container').textContent = $('#inpCustomer option:selected').text();
        document.querySelector('#select2-inpCustomer-container').setAttribute = ('title', $('#inpCustomer option:selected').text());

        /////////////////// Subject
        const selectSubject = document.querySelectorAll('select[name="mds_id"]');
        selectSubject.forEach(select => {
            select.value = data.mds_id;
        });
        document.querySelector('#select2-selRequirement-container').textContent = $('#selRequirement option:selected').text();
        document.querySelector('#select2-selRequirement-container').setAttribute = ('title', $('#selRequirement option:selected').text());

        const isOtherSelected = $('#selRequirement option:selected').text() === 'Other';
        $('#inpOtherSubject').prop('disabled', !isOtherSelected);
        $('#inpOtherSubject').val(isOtherSelected ? data.idc_subject_note : '');

        const selectEnclosures = document.querySelectorAll('select[name="mde_id"]');
        selectEnclosures.forEach(select => {
            select.value = data.mde_id;
        });
        document.querySelector('#select2-inpEnclosures-container').textContent = $('#inpEnclosures option:selected').text();
        document.querySelector('#select2-inpEnclosures-container').setAttribute = ('title', $('#inpEnclosures option:selected').text());

        const isOtherEnclosures = $('#inpEnclosures option:selected').text() === 'Other';
        $('#inpOtherEnclosures').prop('disabled', !isOtherEnclosures);
        $('#inpOtherEnclosures').val(isOtherEnclosures ? data.idc_enclosures_note : '');

        $('#inpNote').val(data.idc_note1);
        $('#inpComment').val(data.idc_note2);
        $('#inpDuedate').val(data.idc_closing_date);

        const selectPlant = document.querySelectorAll('select[name="idc_plant_cd"]');
        selectPlant.forEach(select => {
            select.value = data.idc_plant_cd;
        });

        const tableItem = document.getElementById('tblPartNo').querySelector('tbody');
        let htmlItem = '';
        for (i = 0; i < data.ir_group_part.length; i++) {
            htmlItem += '<tr>';
            htmlItem += '<td>' + data.ir_group_part[i].idi_item_no + '</td>';
            htmlItem += '<td>' + data.ir_group_part[i].idi_item_name + '</td>';
            htmlItem += '<td>' + data.ir_group_part[i].idi_model + '</td>';
            htmlItem += '<td>' + data.ir_group_part[i].idi_remark + '</td>';
            htmlItem += '<td><button class="btn btn-danger btn-sm ti ti-trash fs-5 rounded-circle card-hover" onclick="deleteRow(event)"></button></td>';
            htmlItem += '</tr>';

            groupPartData.push({
                idi_item_no: data.ir_group_part[i].idi_item_no,
                idi_item_name: data.ir_group_part[i].idi_item_name,
                idi_model: data.ir_group_part[i].idi_model,
                idi_remark: data.ir_group_part[i].idi_remark,
                ir_group_volume: data.ir_group_part[i].ir_group_volume
            });

        }
        tableItem.innerHTML = htmlItem;

        $('#inpProjectLife').val(data.idc_project_life);
        const selectProgramStart = document.querySelectorAll('select[name="idc_project_start"]');
        selectProgramStart.forEach(select => {
            select.value = data.idc_project_start;
        });
        document.querySelector('#select2-inpProTim-container').textContent = $('#inpProTim option:selected').text();
        document.querySelector('#select2-inpProTim-container').setAttribute = ('title', $('#inpProTim option:selected').text());

        $('#tblProjectLife thead tr:not(:first-child)').remove();
        $('#tlbHeadProjectLife').attr('colspan', 0);
        document.querySelector('#tlbBodyProjectLife').innerHTML = '';

        if (!is_empty(document.getElementById('inpProjectLife').value) && !is_empty(document.getElementById('inpProTim').value)) {
            $('#tlbHeadProjectLife').attr('colspan', document.getElementById('inpProjectLife').value + 1);
            let html = '<tr>';
            let year = parseInt(document.getElementById('inpProTim').value, 10);
            for (let i = 0; i <= document.getElementById('inpProjectLife').value; i++) {
                html += `<th class="border-bottom-0 align-middle">
                    <h6 class="fw-semibold mb-0">${year + i}</h6>
                </th>`;
            }
            html += '</tr>';
            document.querySelector('#tblProjectLife thead').insertAdjacentHTML('beforeend', html);
            let htmlBody = '';
            for (let i = 0; i < groupPartData.length; i++) {
                htmlBody += `<tr>`;
                htmlBody += `<td>${i+1}</td>`
                htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`
                for (let q = 0; q < groupPartData[i].ir_group_volume.length; q++) {
                    htmlBody += `<td>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                        min="0" max="999999" 
                                        data-year="${groupPartData[i].ir_group_volume[q].idv_year}" 
                                        placeholder="Please input volume ${groupPartData[i].ir_group_volume[q].idv_year}"
                                        value="${groupPartData[i].ir_group_volume[q].idv_qty}">
                                    <span class="invalid-feedback"></span>
                                </td>`;
                }
                htmlBody += `</tr>`
            }
            document.querySelector('#tlbBodyProjectLife').innerHTML = htmlBody;
        }

        $('.select2').select2();
        Swal.close();
    }
    async function addPart() {
        const partNo = document.add_form.idi_item_no.value;
        const partName = document.add_form.idi_item_name.value;
        const model = document.add_form.idi_model.value;
        const remark = document.add_form.idi_remark.value;

        let proLife = document.getElementById('inpProjectLife');
        let proTim = document.getElementById('inpProTim');

        if (groupPartData.length > 10) {
            Swal.fire({
                html: "<h3>Cannot add more than 10 items. !</h3>",
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

        let chkPart = await checkPartGroup(document.add_form.idi_item_no, document.add_form.idi_item_name, document.add_form.idi_model);
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
                idi_item_no: partNo,
                idi_item_name: partName,
                idi_model: model,
                idi_remark: remark
            });

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className = 'btn btn-danger btn-sm ti ti-trash fs-5 rounded-circle card-hover';

            deleteBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const table = document.getElementById('tblPartNo').querySelector('tbody');
                const row = deleteBtn.closest('tr');
                const rowIndex = Array.from(table.rows).indexOf(row);

                if (rowIndex !== -1) {
                    table.deleteRow(rowIndex);
                    if (rowIndex >= 0 && rowIndex < groupPartData.length) {
                        groupPartData.splice(rowIndex, 1);
                        if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
                            changeProLife();
                        }
                    } else {
                        console.error('Row index out of bounds for groupPartData');
                    }
                } else {
                    console.error('Invalid row index');
                }
            });

            cell5.appendChild(deleteBtn);

            document.add_form.idi_item_no.value = '';
            document.add_form.idi_item_name.value = '';
            document.add_form.idi_model.value = '';
            document.add_form.idi_remark.value = '';
            form_defaultValid(document.add_form.idi_item_no);
            form_defaultValid(document.add_form.idi_item_name);
            form_defaultValid(document.add_form.idi_model);

            if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
                changeProLife();
            }
        } else {
            return false;
        }

    }
    async function checkGroupAttn() {
        const checkboxContainers = document.querySelectorAll('[name="attn_group"] input[type="checkbox"]');
        const labelContainers = document.querySelectorAll('[name="attn_group"] label, [name="attn_group"]  h4');
        let isChecked = false;

        labelContainers.forEach(label => label.classList.remove('text-danger'));
        checkboxContainers.forEach(checkbox => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            labelContainers.forEach(label => label.classList.add('text-danger'));
            if (checkboxContainers.length > 0) {
                checkboxContainers[0].focus();
            }
            return false;
        }
        return true;
    }
    async function changeProLife() {
        let proLife = document.getElementById('inpProjectLife');
        let proTim = document.getElementById('inpProTim');

        $('#tblProjectLife thead tr:not(:first-child)').remove();
        $('#tlbHeadProjectLife').attr('colspan', 0);
        document.querySelector('#tlbBodyProjectLife').innerHTML = '';
        if (groupPartData.length == 0) {
            Swal.fire({
                html: "<h3>Please Insert Item Information</h3>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            form_errValid(document.add_form.idi_item_no, '*Plase Enter Part No.');
            form_errValid(document.add_form.idi_item_name, '*Plase Enter Part Name');
            form_errValid(document.add_form.idi_model, '*Plase Enter Model');
            return;
        }

        if (proLife.value <= 0 || proLife.value > 10) {
            form_errValid(document.getElementById('inpProjectLife'), "*Please Enter Number 1-10");
            return;
        } else {
            form_okValid(document.getElementById('inpProjectLife'));
        }

        if (proLife.value > 4) {
            $('#tblProjectLife').css('min-width', '1800px');
        }else {
            $('#tblProjectLife').css('min-width', 'auto');
        }

        if (!is_empty(proLife.value) && !is_empty(proTim.value)) {
            $('#tlbHeadProjectLife').attr('colspan', proLife.value + 1);
            let groupVolume = [];
            let html = '<tr>';
            let year = parseInt(proTim.value, 10);
            for (let i = 0; i <= proLife.value; i++) {
                groupVolume.push({
                    year: year + i
                });
                html += `<th class="border-bottom-0 align-middle">
                    <h6 class="fw-semibold mb-0">${year + i}</h6>
                </th>`;
            }
            html += '</tr>';
            document.querySelector('#tblProjectLife thead').insertAdjacentHTML('beforeend', html);
            let htmlBody = '';
            for (let i = 0; i < groupPartData.length; i++) {
                htmlBody += `<tr>`;
                htmlBody += `<td>${i+1}</td>`
                htmlBody += `<td name="part_no">${groupPartData[i].idi_item_no}</td>`
                for (let q = 0; q < groupVolume.length; q++) {
                    htmlBody += `<td>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                        min="0" max="999999" 
                                        data-year="${groupVolume[q % groupVolume.length].year}" 
                                        placeholder="Please input volume ${groupVolume[q % groupVolume.length].year}">
                                    <span class="invalid-feedback"></span>
                                </td>`;
                }
                htmlBody += `</tr>`
            }
            document.querySelector('#tlbBodyProjectLife').innerHTML = htmlBody;
        }

    }

    function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Costomer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="Other">Other</option>';
                $('#inpCustomer').html(option_text);
            }
        })
    }

    function listSubject() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mds',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Select Subject</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.mds_id + '">' + value.mds_name + '</option>';
                })
                $('#selRequirement').html(option_text);
            }
        })
    }

    function listEnclosures() {
        $.ajax({
            type: 'get',
            url: API_URL + 'option/list_mde',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Select Enclosures</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.mde_id + '">' + value.mde_name + '</option>';
                })
                $('#inpEnclosures').html(option_text);
            }
        })
    }
    async function changeCustomer() {
        let data = $('#inpCustomer').val();
        if (data == 'Other') {
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
        let data = $('#selRequirement option:selected').text();
        if (data == 'Other') {
            $('#inpOtherSubject').prop('disabled', false);
        } else {
            $('#inpOtherSubject').prop('disabled', true);
        }
    }
    async function changeEnclosures() {
        let data = $('#inpEnclosures option:selected').text();
        if (data == 'Other') {
            $('#inpOtherEnclosures').prop('disabled', false);
        } else {
            $('#inpOtherEnclosures').prop('disabled', true);
        }
    }
    async function clearForm() {
        groupPartData = [];
        $('#add_form')[0].reset();
        $('#tblPartNo tbody').html('');
        $('#tlbBodyProjectLife').html('');
        const formElements = document.add_form.querySelectorAll('input, select, textarea');
        formElements.forEach(element => {
            form_defaultValid(element);
        });
        $('.select2').select2();
    }

    async function addRfq() {
        event.preventDefault();
        let urlDocNo = API_URL + "rfq/doc_no/RFQ";
        let ir_doc_no = await getDocNo(urlDocNo);

        let chkAttn = await checkGroupAttn();
        if (!chkAttn) return;
        let chk = await Rfq_valid("add");
        if (chk) {
            if (groupPartData.length == 0) {
                form_errValid(document.add_form.idi_item_no, '*Plase Enter Part No.');
                form_errValid(document.add_form.idi_item_name, '*Plase Enter Part Name');
                form_errValid(document.add_form.idi_model, '*Plase Enter Model');
                return;
            } else {
                form_okValid(document.add_form.idc_note1);
                form_okValid(document.add_form.idc_note2);

                if (document.add_form.idc_project_life.value < 1 || document.add_form.idc_project_life.value > 10) {
                    form_errValid(document.add_form.idc_project_life, '*Please Enter Project Life 1-10');
                    return;
                } else {
                    form_okValid(document.add_form.idc_project_life);
                }

                if (is_empty(document.add_form.idc_project_start.value)) {
                    form_errValid(document.add_form.idc_project_start, '*Please Select Program Timing Info');
                    return;
                } else {
                    form_okValid(document.add_form.idc_project_start);
                    let isValid = true;
                    $('#tlbBodyProjectLife input[type="number"]').each(function() {
                        if ($(this).val().trim() === "" || $(this).val().trim() < 1 || $(this).val().trim() > 999999) {
                            form_errValid(this, "*Please Enter Volume 1-999999");
                            isValid = false;
                            return false;
                        } else {
                            form_okValid(this);
                        }
                    });
                    if (!isValid) return;
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
                            Swal.fire({
                                title: 'Loading...',
                                text: 'Please wait while we submit the data...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            })
                            var add_form = {};
                            let groupCheckBoxAttn = [];
                            $('#add_form').serializeArray().forEach(function(item) {
                                if ($('input[name="' + item.name + '"]').attr('type') === 'checkbox') {
                                    return;
                                }
                                if (item.name == 'idi_item_name' || item.name == 'idi_item_no' || item.name == 'idi_model' || item.name == 'idi_remark') {
                                    return;
                                }

                                if (item.name == 'idc_customer_type' || item.name == 'mds_id' || item.name == 'mde_id' || item.name == 'idc_project_life' || item.name == 'idc_refer_doc' || item.name == 'idc_plant_cd') {
                                    item.value = parseInt(item.value)
                                }
                                add_form[item.name] = item.value;
                            });

                            if (is_empty(add_form['idc_subject_note'])) {
                                add_form['idc_subject_note'] = '';
                            }

                            if (is_empty(add_form['idc_enclosures_note'])) {
                                add_form['idc_enclosures_note'] = '';
                            }

                            const checkboxesAttn = document.querySelectorAll('input[name="ir_attn[]"]:checked');
                            const checkedIdsAttn = Array.from(checkboxesAttn).map(checkbox => checkbox.id);

                            groupPartData.forEach(item => {
                                document.querySelectorAll('#tlbBodyProjectLife td[name="part_no"]').forEach(td => {
                                    if (td.innerText.trim() === item.idi_item_no) {
                                        let tr = td.closest('tr');
                                        let inputValues = Array.from(tr.querySelectorAll('input[type="number"]'))
                                            .map(input => ({
                                                idv_year: input.getAttribute('data-year'),
                                                idv_qty: input.value.trim()
                                            }));
                                        item.ir_group_volume = inputValues;
                                    }
                                });
                            });

                            add_form["idc_created_date"] = getTimeNow();
                            add_form["idc_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                            add_form["idc_result_confirm"] = 0;
                            add_form["idc_status"] = 1;
                            add_form["idc_issue_year"] = "<?php echo date('Y') ?>";
                            add_form["idc_issue_month"] = "<?php echo date('m') ?>";
                            add_form["idc_issue_seq_no"] = String(ir_doc_no['doc_cur_no_po2'] + 1);
                            add_form["mdt_id"] = ir_doc_no['mdt_id'];

                            add_form["idc_issue_date"] = '';
                            add_form["idc_reply_date"] = '';
                            add_form["idc_file_path"] = '';
                            add_form["idc_physical_path"] = '';
                            add_form["idc_cancel_reason"] = '';

                            add_form["ir_group_part"] = groupPartData;
                            add_form["idat_item"] = checkedIdsAttn;
                            add_form["idc_running_no"] = chk;
                            $.ajax({
                                type: 'POST',
                                dataType: 'json',
                                contentType: 'application/json',
                                url: API_URL + 'rfq/insert',
                                data: JSON.stringify(add_form),
                                success: function(data) {
                                    Swal.close();
                                    if (data.Error) {
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
                                            html: "<h4>เกิดข้อผิดพลาดในระบบ !</h4>\n<p>" + data.False + "</p>",
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
        } else {
            return;
        }
    }


    $(document).ready(function() {
        $('.select2').select2();
        listCustomer();
        listSubject();
        listEnclosures();
    });
</script>