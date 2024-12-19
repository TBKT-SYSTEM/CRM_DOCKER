<title>CRM | Issue Quotation</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Issue Quotation</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Document Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Issue Quotation</li>
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
                            <ul class="nav nav-pills nav-fill" role="tablist" id="navTabs">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true" style="cursor: no-drop !important;" disabled>
                                        <span>Section 1</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1" style="cursor: no-drop !important;" disabled>
                                        <span>Section 2</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-333" role="tab" aria-selected="false" tabindex="-1" style="cursor: no-drop !important;" disabled>
                                        <span>Section 3</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-444" role="tab" aria-selected="false" tabindex="-1" style="cursor: no-drop !important;" disabled>
                                        <span>Section 4/ Section 5</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="row">
                                <div class="tab-content mt-2">
                                    <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 1 : Quotation Detail</h4>
                                                <label class="fs-3 fw-semibold">( Customer Attention )</label>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Customer Name :</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Customer Name">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Customer Tel No. :</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Customer Tel No.">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Customer Address :</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control shadow-sm" rows="4" name="" id="" placeholder="Fill Customer Address"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-4 col-form-label">Customer Position/Dept. :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Customer Position/Dept.">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="exampleInputSelect5" class="form-label col-sm-4 col-form-label">Customer Fax No. :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Customer Fax No.">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-4 col-form-label">Customer RFQ No. :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Customer RFQ No.">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-4 col-form-label">Refer Document :</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control shadow-sm" id="" placeholder="Fill Refer Document">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Reference RFQ No. :</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group border rounded-1">
                                                            <input type="text" class="form-control border-0 ps-2" id="" placeholder="Input for search Internal RFQ No.">
                                                            <span class="input-group-text bg-transparent px-6 border-0" id="">
                                                                <i class="ti ti-search fs-6"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Quote Date :</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control shadow-sm" id="">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Quotation For :</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control shadow-sm" rows="4" name="" id="" placeholder="Fill Quotation For"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-4 row align-items-center">
                                                    <button type="button" onclick="" class="col-sm-2 btn rounded-pill bg-primary-subtle text-primary shadow-sm mx-2">Apply</button>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-4 col-form-label">Valid Date :</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control shadow-sm" id="">
                                                    </div>
                                                </div>
                                                <div class="mb-4 row">
                                                    <label for="" class="form-label col-sm-4 col-form-label">Price period / Event :</label>
                                                    <div class="col-sm-8">
                                                        <textarea type="text" class="form-control shadow-sm" rows="4" id="" placeholder="Fill Price period / Event"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row" style="padding: 15px;">
                                            <label class="form-label fw-semibold col-form-label">&nbsp; &#8226; RFQ Volume</label>
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Model Life :</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control shadow-sm" id="" placeholder="Fill Model Life">
                                                    </div>
                                                    <label for="" class="form-label col-sm-3 col-form-label">Years</label>
                                                    <label for="" class="fs-1 fw-semibold">( Project Life )</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-4 col-form-label">SOP Timing :</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control shadow-sm" id="">
                                                    </div>
                                                    <label for="" class="fs-1 fw-semibold">( Program Timing Info )</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="mb-4 row align-items-center px-3">
                                                    <div class="table-responsive col-sm-10">
                                                        <table class="table table-bordered text-wrap mb-0 align-middle text-center shadow-sm" id="tblProjectLife">
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
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="row align-items-center">
                                                    <label class="form-label fw-semibold col-form-label text-info fs-1">&nbsp; &#8226; If apply data from RFQ then show detail same that RFQ but can revise as you need.<br> &nbsp; &#8226; If not apply from RFQ then auto generate volume table from project life and program timing info. </label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" id="btnNext" onclick="nextTab(event)" type="button">Next</button>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="navpill-222" role="tabpanel">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 2 : Selling Price</h4>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="mb-4 row align-items-center">
                                                    <label for="" class="form-label col-sm-3 col-form-label">Currency :</label>
                                                    <div class="col-sm-9">
                                                        <select type="number" class="form-select shadow-sm" id="" placeholder="Fill Model Life">
                                                            <option value="" disabled selected>Select Currency</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label fw-semibold col-form-label text-info fs-1">If select THB must be fill unit price exclude vat.</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblViewPartNo">
                                                        <thead class="text-dark fs-4">
                                                            <tr>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">No.</h6>
                                                                </th>
                                                                <th class="">
                                                                    <h6 class="fw-semibold mb-0">Model</h6>
                                                                </th>
                                                                <th class="col-2">
                                                                    <h6 class="fw-semibold mb-0">Part Name</h6>
                                                                </th>
                                                                <th class="col-2">
                                                                    <h6 class="fw-semibold mb-0">Part No.</h6>
                                                                </th>
                                                                <th class="col-2">
                                                                    <h6 class="fw-semibold mb-0">Units/Month</h6>
                                                                </th>
                                                                <th class="col-2">
                                                                    <h6 class="fw-semibold mb-0">Unit Price</h6>
                                                                </th>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white" id="tblViewBodyPartNo">
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Model ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Part No. ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Part Name ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Unit/Month ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Unit Price ...">
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
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-secondary me-2" onclick="prevTab(event)" type="button">Prev</button>
                                            <button class="btn btn-primary" id="btnNext" onclick="nextTab(event)" type="button">Next</button>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="navpill-333" role="tabpanel">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 3 : Quote Condition</h4>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblViewPartNo">
                                                        <thead class="text-dark fs-4">
                                                            <tr>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">No.</h6>
                                                                </th>
                                                                <th class="col-4">
                                                                    <h6 class="fw-semibold mb-0">Condition</h6>
                                                                </th>
                                                                <th class="col-3">
                                                                    <h6 class="fw-semibold mb-0">Criteria</h6>
                                                                </th>
                                                                <th class="col-3">
                                                                    <h6 class="fw-semibold mb-0">Remark</h6>
                                                                </th>
                                                                <th class="col-1">
                                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white" id="tblViewBodyPartNo">
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Condition ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Criteria ...">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Remark ...">
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
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-secondary me-2" onclick="prevTab(event)" type="button">Prev</button>
                                            <button class="btn btn-primary" id="btnNext" onclick="nextTab(event)" type="button">Next</button>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="navpill-444" role="tabpanel">
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 4 : LTA</h4>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover text-wrap mb-0 align-middle table-b text-center border rounded shadow-sm" id="tblViewPartNo">
                                                        <thead class="text-dark fs-4">
                                                            <tr>
                                                                <th class="col">
                                                                    <h6 class="fw-semibold mb-0">1st Year</h6>
                                                                </th>
                                                                <th class="col">
                                                                    <h6 class="fw-semibold mb-0">2nd Year</h6>
                                                                </th>
                                                                <th class="col">
                                                                    <h6 class="fw-semibold mb-0">3rd Year</h6>
                                                                </th>
                                                                <th class="col">
                                                                    <h6 class="fw-semibold mb-0">4th Year</h6>
                                                                </th>
                                                                <th class="col">
                                                                    <h6 class="fw-semibold mb-0">5th Year</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="border-top text-wrap bg-white" id="tblViewBodyPartNo">
                                                            <tr>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <input class="form-control text-center shadow-sm" type="text" id="inpTopic">
                                                                        <span class="invalid-feedback"></span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 15px;">
                                            <div class="col-md-7 d-flex">
                                                <h4 class="fs-5 fw-semibold me-2">Section 5 : Other </h4>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="col-lg-8">
                                                <textarea class="form-control shadow-sm" name="" id="" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-secondary me-2" onclick="prevTab(event)" type="button">Prev</button>
                                            <button class="btn btn-success" id="btnSubmit" onclick="submitForm(event)" type="button" style="display: none;">Submit</button>
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
    function nextTab(event) {
        event.preventDefault();
        const activeTab = document.querySelector('.nav-link.active');
        const nextTab = activeTab.parentElement.nextElementSibling?.querySelector('.nav-link');

        if (nextTab) {
            const nextTabInstance = new bootstrap.Tab(nextTab);
            nextTabInstance.show();

            updateButtons();
        }
    }

    function prevTab(event) {
        event.preventDefault();
        const activeTab = document.querySelector('.nav-link.active');
        const prevTab = activeTab.parentElement.previousElementSibling?.querySelector('.nav-link');

        if (prevTab) {
            const prevTabInstance = new bootstrap.Tab(prevTab);
            prevTabInstance.show();

            updateButtons();
        }
    }

    function updateButtons() {
        const activeTab = document.querySelector('.nav-link.active');
        const isLastTab = !activeTab.parentElement.nextElementSibling;
        const isFirstTab = !activeTab.parentElement.previousElementSibling;

        document.querySelectorAll('#btnNext').forEach(btn => {
            btn.style.display = isLastTab ? 'none' : 'inline-block';
        });

        const btnSubmit = document.getElementById('btnSubmit');
        btnSubmit.style.display = isLastTab ? 'inline-block' : 'none';
    }

    function submitForm() {
        alert('Form submitted!');
    }

    // Initialize button visibility on page load
    document.addEventListener('DOMContentLoaded', updateButtons);
</script>