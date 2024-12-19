<title>CRM | Meeting Control</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Meeting Control</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Meeting Control</li>
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
                                    <span>Manage Meeting</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                    <span>Register Meeting</span>
                                </a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="tab-content mt-2">
                                <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                    <div id="tab-1" style="display: block;">
                                        <div class="row border" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;" for="inpImportFrom">Customer Type :</label>
                                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpImportFrom" name="ir_import_tran" onchange="filterData()"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;" for="inpCustomer">Customer Name :</label>
                                                        <select type="text" class="form-select form-select-sm shadow-sm" id="inpCustomer" name="irq_customer" onchange="filterData()"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Issue Date :</label>
                                                        <input type="date" class="form-control form-control-sm shadow-sm" id="inpIssueDate" onchange="filterData()"></input>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="col-auto fs-3 text-dark fw-semibold me-2" style="width: 120px;">Document No :</label>
                                                        <input type="text" class="form-control form-control-sm shadow-sm" id="inpSearchDocNo" placeholder="Input RFQ No." onkeyup="filterData()"></input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center flex-nowrap">
                                                        <label class="text-dark fw-semibold fs-3 me-3">Status :</label>
                                                        <button class="btn btn-sm bg-secondary text-white card-hover me-2 shadow-sm" onclick="btnTable('open')">Open</button>
                                                        <button class="btn btn-sm text-white card-hover me-2 shadow-sm" style="background-color: #6f6f6fde !important;" onclick="btnTable('Close')">Close</button>
                                                        <button class="btn btn-sm bg-danger text-white card-hover shadow-sm" onclick="btnTable('cancel')">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex align-items-center flex-nowrap justify-content-end">
                                                        <button class="btn btn-outline-secondary btn-sm px-3 py-2 shadow-sm" onclick="ViewAll()">View All</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border" style="padding: 15px;">
                                            <div class="table-responsive">
                                                <table id="tblNBC" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                                    <thead>
                                                        <!-- start row -->
                                                        <tr>
                                                            <th class="text-center">No.</th>
                                                            <th class="text-center">Topic</th>
                                                            <th class="text-center">Document No.</th>
                                                            <th class="text-center">Customer</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Meeting Date</th>
                                                            <th class="text-center">Reported By</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                        <!-- end row -->
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td class="text-center">
                                                                RFQ
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-001</span>
                                                            </td>
                                                            <td class="text-center">ISUZU Co., Ltd.</td>
                                                            <td class="text-center">
                                                                <span class="badge bg-danger-subtle text-danger fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-x fs-4"></i>Cancel</span>
                                                            </td>
                                                            <td class="text-center">30/11/2024</td>
                                                            <td class="text-center">Kyoko</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-evenly gap-1">
                                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                    <button type="button" class="btn bg-info-subtle text-info rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Reverse">
                                                                        <i class="ti ti-arrow-back-up" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">2</td>
                                                            <td class="text-center">
                                                                RFQ
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-002</span>
                                                            </td>
                                                            <td class="text-center">MAHLE Co., Ltd..</td>
                                                            <td class="text-center">
                                                                <span class="badge bg-info-subtle text-info fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-send fs-4"></i>Open</span>
                                                            </td>
                                                            <td class="text-center">18/12/2024</td>
                                                            <td class="text-center">Kantamanee</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-evenly gap-1">
                                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See/Edit">
                                                                        <i class="ti ti-pencil-minus" data-bs-target="#mdlEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                    <button type="button" class="btn bg-success-subtle text-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                                                                        <i class="ti ti-check" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                    <button type="button" class="btn bg-danger-subtle text-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                                                                        <i class="ti ti-x" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">3</td>
                                                            <td class="text-center">
                                                                RFQ
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-003</span>
                                                            </td>
                                                            <td class="text-center">Kubota Co., Ltd.</td>
                                                            <td class="text-center">
                                                                <span class="badge bg-warning-subtle text-warning fw-semibold fs-2 gap-1 d-inline-flex align-items-center shadow-sm"><i class="ti ti-clock-hour-4 fs-4"></i>Wait Approve</span>
                                                            </td>
                                                            <td class="text-center">20/11/2024</td>
                                                            <td class="text-center">Kantamanee</td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-evenly gap-1">
                                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="See">
                                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                                    <div id="tab-2" style="display: block;">
                                        <div class="row" style="padding: 15px;">
                                            <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                <div class="d-flex col-md-5 align-items-center">
                                                    <label for="" class="col-md-3 form-label fw-semibold me-3">Meeting Topic :</label>
                                                    <div class="col">
                                                        <select type="text" class="form-select shadow-sm" id="" name="">
                                                            <option value="" disabled selected>Select Meeting Topic ( Document )</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex col-md-6 align-items-center">
                                                    <label for="" class="col-md-3 form-label fw-semibold me-3">Refer Document No. :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control col-md-6 shadow-sm" id="" name="" placeholder="Input for search Document No. ...">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                <div class="d-flex col-md-5 align-items-center">
                                                    <label for="" class="col-md-3 form-label fw-semibold me-3">Meeting Date :</label>
                                                    <div class="col">
                                                        <input type="date" class="form-control shadow-sm" id="" name="">
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex col-md-12 mb-3 align-items-center gap-5">
                                                <div class="d-flex col-md-5 align-items-center">
                                                    <label for="" class="col-md-3 form-label fw-semibold me-3">Member :</label>
                                                    <div class="col">
                                                        <select type="text" class="form-select shadow-sm" id="" name="">
                                                            <option value="" disabled selected>Select Department</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex col-md-6 align-items-center">
                                                    <div class="col me-2">
                                                        <select type="text" class="form-select shadow-sm" id="" name="">
                                                            <option value="" disabled selected>Select Person or Fill Name</option>
                                                        </select>
                                                        <span class="invalid-feedback"></span>
                                                    </div>
                                                    <button type="button" onclick="" class="col-md-2 btn rounded-pill bg-primary-subtle text-primary shadow-sm me-2"><i class="ti ti-user-plus fs-6"></i></button>
                                                    <label for="" class="col-md-auto fw-semibold fs-1">( Max 20 Items )</label>
                                                </div>
                                            </div>

                                            <div class="d-flex col mb-3 gap-5">
                                                <label for="" class="col-md-auto form-label fw-semibold me-3">Design Concern Point :</label>
                                                <div class="w-100">
                                                    <textarea class="form-control" rows="3"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <!----------- Table Part No.  ------------>
                                            <div class="table-responsive mb-5">
                                                <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblViewPartNo">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
                                                            <th class="col-1">
                                                                <h6 class="fw-semibold mb-0">No.</h6>
                                                            </th>
                                                            <th class="">
                                                                <h6 class="fw-semibold mb-0">Topic</h6>
                                                            </th>
                                                            <th class="col-2">
                                                                <h6 class="fw-semibold mb-0">P.I.C. Dept.</h6>
                                                            </th>
                                                            <th class="col-2">
                                                                <h6 class="fw-semibold mb-0">Action Plan & Duedate</h6>
                                                            </th>
                                                            <th class="col-1">
                                                                <h6 class="fw-semibold mb-0">Action</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border-top text-wrap bg-white" id="tblViewBodyPartNo">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                    <a href="javascript:void(0);" onclick="clearForm()" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                                    <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="addRfq()"><i class="ti ti-download me-2" style="font-size: 20px;"></i>Save</button>
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

<script>
    const data = [];

    async function listTablePartNo(data, type) {
        let html = '';
        if (type == 'view') {
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += '<td>' + data[i].irpn_part_no + '</td>';
                    html += '<td>' + data[i].irpn_part_name + '</td>';
                    html += '<td>' + data[i].irpn_model + '</td>';
                    html += '<td>' + data[i].irpn_remark + '</td>';
                    html += '<td>' + data[i].irpn_remark + '</td>';
                    html += '</tr>';
                }
            }
            html += '<tr>';
            html += '<td></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Please enter topic ..."><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><select class="form-select shadow-sm" id="selPicDept"><option value="" disabled selected>Select Dept.</option></select><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="date" id="inpPlanDate" value=""><span class="invalid-feedback"></span></div></td>';
            html += '<td><button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id=""><i class="ti ti-plus fs-6"></i></button></td>';
            html += '</tr>';
            document.getElementById('tblViewBodyPartNo').innerHTML = html;
        } else {
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_part_no" value="' + data[i].irpn_part_no + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_part_name" value="' + data[i].irpn_part_name + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_model" value="' + data[i].irpn_model + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" name="irpn_remark" value="' + data[i].irpn_remark + '"><span class="invalid-feedback"></span></div></td>';
                html += '<td><div><button type="button" onclick="deletePartNoByItem(event)" class="btn mb-1 btn-danger rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnDeletePartNo" name="btnDeletePartNo" data-id="' + data[i].irpn_id + '"><i class="ti ti-trash-x fs-6"></i></button></td>';
                html += '</tr>';
            }
            html += '<tr>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartNo" placeholder="Part No"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpPartName" placeholder="Part Name"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpModel" placeholder="Model"><span class="invalid-feedback"></span></div></td>';
            html += '<td><div class="col"><input class="form-control text-center shadow-sm" type="text" id="inpRemark" placeholder="Remark"><span class="invalid-feedback"></span></div></td>';
            html += '<td><button type="button" onclick="addPartNoByItem(event)" class="btn mb-1 btn-success rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center card-hover shadow-sm" id="btnAddPartNo" name="btnAddPartNo" data-id=""><i class="ti ti-plus fs-6"></i></button></td>';
            html += '</tr>';
            document.getElementById('tblEditBodyPartNo').innerHTML = html;
        }
    }

    $(document).ready(function() {
        listTablePartNo(data, 'view');
    });
</script>