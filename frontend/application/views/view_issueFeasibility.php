<title>CRM | Issue Feasibility</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Issue Feasibility Document</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Issue Feasibility</li>
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
                                <div class="col-md-7 d-flex">
                                    <h4 class="fs-5 fw-semibold me-2">Section 1 : General Information</h4>
                                </div>
                                <hr class="mb-4">
                                <div class="row" style="padding: 15px;">
                                    <div class="d-flex col-md-12 mb-3 align-items-center">
                                        <div class="col-md-2">
                                            <h4 class="mb-2 fs-4 fw-semibold">Reference RFQ No. :</h4>
                                        </div>
                                        <div class="d-flex col-md-10 me-3 gap-5">
                                            <div class="col">
                                                <select name="idc_refer_doc" id="inpRefRfq" class="select2 form-select" onchange="checkReferDoc()">
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
                                            <div class="col d-flex">
                                                <button type="button" onclick="referDoc()" class="col-sm-3 btn rounded-pill bg-primary-subtle text-primary shadow-sm mx-2">Apply</button>
                                                <div class="col-auto">
                                                    <label class="fw-semibold fs-1">&nbsp; If apply data from RFQ then show data in all topic.<br> &nbsp; All topic cannot change data.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md-12 mb-3 align-items-center">
                                        <div class="col-md-2">
                                            <h4 class="mb-2 fs-4 fw-semibold">Customer :</h4>
                                        </div>
                                        <div class="d-flex col-md-10 me-3 gap-5">
                                            <div class="col">
                                                <select name="idc_customer_type" id="inpEditImportFrom" class="select2 form-select">
                                                    <option value="1">Domestic</option>
                                                    <option value="2">Overseas</option>
                                                </select>

                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col">
                                                <select name="idc_customer_name" id="inpEditCustomer" class="select2 form-select" onchange="changeEditCustomer()"></select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex col-md-12 mb-3 align-items-center">
                                        <div class="col-md-2">
                                            <h4 class="mb-2 fs-4 fw-semibold">Subject :</h4>
                                        </div>
                                        <div class="d-flex col-md-10 me-3 gap-5">
                                            <div class="col">
                                                <select name="mds_id" id="selRequirementEdit" class="select2 form-select" onchange="changeRequirement()"> </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="idc_subject_note" id="inpOtherSubjectEdit" class="form-control" placeholder="Other Subject ..." disabled>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-7 d-flex">
                                        <h4 class="fs-5 fw-semibold me-2">Section 2 : Item Information</h4>
                                        <label class="fs-3 fw-semibold">( Max 10 Items )</label>
                                    </div>
                                    <hr class="mb-4">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblPartNo">
                                                <thead class="text-dark fs-4 shadow-sm">
                                                    <tr>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"></h6>
                                                        </th>
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
                                                        <th class="col-1">
                                                            <h6 class="fw-semibold mb-0">Action</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="border-top text-wrap bg-white" id="tblEditBodyPartNo">
                                                    <tr>
                                                        <td>

                                                            <div class="col">
                                                                <input class="form-control text-center shadow-sm" type="hidden" id="inpId" value="0">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col">
                                                                <input class="form-control text-center shadow-sm" type="text" id="inpPartNo" maxlength="50" placeholder="Part No">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col">
                                                                <input class="form-control text-center shadow-sm" type="text" id="inpPartName" maxlength="100" placeholder="Part Name">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col">
                                                                <input class="form-control text-center shadow-sm" type="text" id="inpModel" maxlength="50" placeholder="Model">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col">
                                                                <input class="form-control text-center shadow-sm" type="text" id="inpRemark" maxlength="100" placeholder="Remark">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id="">
                                                                <i class="ti ti-plus fs-6"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                        <a href="javascript:void(0);" onclick="clearForm()" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                        <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSaveChange" onclick="saveChange()"><i class="ti ti-download me-2" style="font-size: 20px;"></i>Issue Feasibility</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

<script>
    let isProcessing = false;
    var groupPart, mdt_id;

    function addPartNoByItem(event) {
        const button = event.target.closest('button');
        const currentRow = button.closest('tr');

        const partNo = currentRow.querySelector('input[id="inpPartNo"]');
        const partName = currentRow.querySelector('input[id="inpPartName"]');
        const model = currentRow.querySelector('input[id="inpModel"]');
        const remark = currentRow.querySelector('input[id="inpRemark"]');

        if ($('#tblEditBodyPartNo tr').length > 10) {
            Swal.fire({
                html: "<h4>Cannot add more than 10 items.</h4>",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            partNo.value = "";
            partName.value = "";
            model.value = "";
            remark.value = "";
            return;
        }

        if (is_empty(partNo.value.trim())) {
            form_errValid(partNo, '*Plase Enter Part No.');
            return;
        } else {
            form_okValid(partNo);
            if (is_empty(partName.value.trim())) {
                form_errValid(partName, '*Plase Enter Part Name');
                return;
            } else {
                form_okValid(partName);
                if (is_empty(model.value.trim())) {
                    form_errValid(model, '*Plase Enter Model');
                    return;
                } else {
                    form_okValid(model);
                }
            }
        }

        form_defaultValid(partNo);
        form_defaultValid(partName);
        form_defaultValid(model);

        const tbody = document.getElementById('tblEditBodyPartNo');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td><div class="col"><input class="form-control text-center" type="hidden" name="idi_id" value="0"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_no" value="${partNo.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_item_name" value="${partName.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_model" value="${model.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td><div class="col"><input class="form-control text-center" type="text" name="idi_remark" value="${remark.value.trim()}"><span class="invalid-feedback"></span></div></td>
        <td>
            <button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm">
                <i class="ti ti-trash-x fs-6"></i>
            </button>
        </td>`;
        tbody.insertBefore(newRow, currentRow);

        currentRow.querySelector('input[placeholder="Part No"]').value = '';
        currentRow.querySelector('input[placeholder="Part Name"]').value = '';
        currentRow.querySelector('input[placeholder="Model"]').value = '';
        currentRow.querySelector('input[placeholder="Remark"]').value = '';

        tbody.appendChild(currentRow);
    }

    function deletePartNoByItem(event) {
        const button = event.target.closest('button');
        const row = button.closest('tr');
        row.remove();
    }
    async function changeRequirement() {
        let data = $('#selRequirementEdit option:selected').text();
        if (data == 'Other') {
            $('#inpOtherSubjectEdit').prop('disabled', false);
            $('#inpOtherSubjectEdit').focus();
        } else {
            $('#inpOtherSubjectEdit').prop('disabled', true);
        }
    }
    async function changeEditCustomer() {
        const customerInput = $('#inpEditCustomer').val();

        if (customerInput === 'Other') {
            $('#customCustomerModal').modal('show');
            $('#newCustomerName').focus();
            $('#saveCustomerName').off('click').on('click', function() {
                const text = $('#newCustomerName').val();

                if (text) {
                    const select = $('select#inpEditCustomer');
                    if (!select.find(`option[value="${text}"]`).length) {
                        select.append(new Option(text, text));
                    }
                    select.val(text);
                }
                $('#newCustomerName').val('')
                $('#customCustomerModal').modal('hide');
            });
        }
        $('#customCustomerModal').on('hidden.bs.modal', function() {
            $('#newCustomerName').val('');
        })
    }
    async function referDoc() {
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
                    await referRFQ(data, 'view');
                    await listTablePartNo(data.ir_group_part, 'edit');
                    groupPart = data.ir_group_part;
                    mdt_id = data.mdt_id;
                    $('#add_form input, #add_form button, #add_form select').not('#btnSaveChange').prop('disabled', true);
                    Swal.close();
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

    async function listTablePartNo(data, type) {
        let html = '';
        if (type == 'view') {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td>' + data[i].idi_item_no + '</td>';
                html += '<td>' + data[i].idi_item_name + '</td>';
                html += '<td>' + data[i].idi_model + '</td>';
                html += '<td>' + data[i].idi_remark + '</td>';
                html += '</tr>';
            }
            document.getElementById('tblViewBodyPartNo').innerHTML = html;
        } else {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="hidden" name="idi_id" value="' + data[i].idi_id + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_no" value="' + data[i].idi_item_no + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_item_name" value="' + data[i].idi_item_name + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_model" value="' + data[i].idi_model + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="idi_remark" value="' + data[i].idi_remark + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div><button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnDeletePartNo" name="btnDeletePartNo" data-id="' + data[i].idi_id + '"><i class="ti ti-trash-x fs-6"></i></button></td>';
                html += '</tr>';
            }
            html += '<tr>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="hidden" id="inpId" value="0"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartNo" placeholder="Part No"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartName" placeholder="Part Name"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpModel" placeholder="Model"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpRemark" placeholder="Remark"><span class="invalid-feedback"></span></div></td>';
            html += '<td><button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id=""><i class="ti ti-plus fs-6"></i></button></td>';
            html += '</tr>';
            document.getElementById('tblEditBodyPartNo').innerHTML = html;
        }
    }

    async function referRFQ(data, type) {
        const selectCus = document.querySelectorAll('select[name="idc_customer_type"]');
        selectCus.forEach(select => {
            select.value = data.idc_customer_type;
        });
        document.querySelector('#select2-inpEditImportFrom-container').textContent = $('#inpEditImportFrom option:selected').text();
        document.querySelector('#select2-inpEditImportFrom-container').setAttribute = ('title', $('#inpEditImportFrom option:selected').text());

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
        document.querySelector('#select2-inpEditCustomer-container').textContent = $('#inpEditCustomer option:selected').text();
        document.querySelector('#select2-inpEditCustomer-container').setAttribute = ('title', $('#inpEditCustomer option:selected').text());

        const selectSubject = document.querySelectorAll('select[name="mds_id"]');
        selectSubject.forEach(select => {
            select.value = data.mds_id;
        });
        $('select[name="mds_id"]').val(data.mds_id).trigger('change');

        const isOtherSelected = $('#selRequirementEdit option:selected').text() === 'Other';
        $('#inpOtherSubjectEdit').prop('disabled', !isOtherSelected);
        $('#inpOtherSubjectEdit').val(isOtherSelected ? data.idc_subject_note : '');
    }

    async function listCustomer() {
        $.ajax({
            type: 'get',
            url: 'http://192.168.161.106/etax_invoice_system/api/customers',
            success: function(result) {
                var option_text = '<option value="" disabled selected>Choose Customer Name</option>';
                $.each(result, function(key, value) {
                    option_text += '<option value="' + value.MC_CUST_ANAME + '">' + value.MC_CUST_ANAME + '&nbsp( ' + value.MC_CUST_CD + ' )' + '</option>';
                })
                option_text += '<option value="Other">Other</option>';
                $('#inpEditCustomer').html(option_text);
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
                $('#selRequirementEdit').html(option_text);
            }
        })
    }

    async function clearForm() {
        $('#add_form')[0].reset();
        $('#tblEditBodyPartNo tr:not(:last-child)').remove();
        const formElements = document.add_form.querySelectorAll('input, select');
        formElements.forEach(element => {
            form_defaultValid(element);
        });
        $('#add_form .select2').select2();
        $('#add_form input, #add_form button, #add_form select').not('#inpOtherSubjectEdit').prop('disabled', false);
    }

    async function checkReferDoc() {
        if ($('#inpRefRfq').val() == 0) {
            clearForm();
            return;
        }
    }

    async function saveChange() {
        if (isProcessing) return;
        isProcessing = true;

        let urlDocNo = API_URL + "rfq/doc_no/Feasibility";
        let ir_doc_no = await getDocNo(urlDocNo);

        let chk = await Fs_valid("add");
        if (!chk) {
            isProcessing = false;
            return;
        }
        let groupPartData = [];
        let hasError = false;

        $('#tblEditBodyPartNo tr:not(:last)').each(function() {
            if (hasError) return false;
            let rowData = {};
            let isValid = true;
            $(this).find('td').each(function() {
                const input = $(this).find('input');

                if (input.length > 0) {
                    if (input.attr('name') !== 'idi_remark') {
                        if (is_empty(input.val())) {
                            form_errValid(input[0], "*Please Enter Value");
                            hasError = true;
                            return false;
                        } else {
                            form_okValid(input[0]);
                        }
                    } else {
                        form_okValid(input[0]);
                    }

                    const inputName = input.attr('name');
                    rowData[inputName] = input.val().trim();
                }
            });
            if (!isValid || hasError) {
                return false;
            }
            if (Object.keys(rowData).length > 0) {
                groupPartData.push(rowData);
            }
        });

        const partNo = document.querySelector('input[id="inpPartNo"]');
        const partName = document.querySelector('input[id="inpPartName"]');
        const model = document.querySelector('input[id="inpModel"]');

        const fields = [{
                element: partNo,
                message: '*Please Enter Part No.'
            },
            {
                element: partName,
                message: '*Please Enter Part Name'
            },
            {
                element: model,
                message: '*Please Enter Model'
            }
        ];

        const allEmpty = fields.every(field => is_empty(field.element.value.trim()));

        if (!allEmpty) {
            fields.forEach(field => {
                if (is_empty(field.element.value.trim())) {
                    form_errValid(field.element, field.message);
                    hasError = true;
                } else {
                    form_okValid(field.element);
                }
            });
        } else {
            fields.forEach(field => {
                form_defaultValid(field.element);
            });
        }

        if (hasError) {
            isProcessing = false;
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Add Feasibility?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Add it.!'
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
                $('#add_form input, #add_form button, #add_form select').not('#inpOtherSubjectEdit').prop('disabled', false);
                var add_form = {};
                $('#add_form').serializeArray().forEach(function(item) {
                    if (item.name == 'idi_item_name' || item.name == 'idi_item_no' || item.name == 'idi_model' || item.name == 'idi_remark') {
                        return;
                    }
                    if (item.name == 'idc_customer_type' || item.name == 'mds_id' || item.name == 'mde_id' || item.name == 'idc_project_life' || item.name == 'idc_refer_doc' || item.name == 'idc_plant_cd') {
                        item.value = parseInt(item.value)
                    }
                    add_form[item.name] = item.value;
                });

                groupPartData.forEach(item => {
                    if (item.hasOwnProperty('idi_id')) {
                        item.idi_id = parseInt(item.idi_id, 10);
                    }
                });

                if (is_empty(add_form['idc_subject_note'])) {
                    add_form['idc_subject_note'] = '';
                }

                add_form["idc_issue_seq_no"] = String(ir_doc_no['doc_cur_no_po2'] + 1);
                add_form["mdt_id"] = ir_doc_no['mdt_id'];

                add_form["idc_created_date"] = getTimeNow();
                add_form["idc_created_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                add_form["idc_result_confirm"] = 0;
                add_form["idc_status"] = 1;
                add_form["idc_issue_year"] = "<?php echo date('Y') ?>";
                add_form["idc_issue_month"] = "<?php echo date('m') ?>";

                add_form["ir_group_part"] = groupPartData;
                add_form["idc_running_no"] = chk;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'feasibility/insert',
                    data: JSON.stringify(add_form),
                    success: function(data) {
                        Swal.close();
                        if (data.Error != "null" || data.Error != "") {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Feasibility success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Add Feasibility!</p>",
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
                console.log('Cancel');
            }
        });
        isProcessing = false;
    }

    $(document).ready(function() {
        $('.select2').select2();
        listCustomer();
        listSubject();
    });
</script>