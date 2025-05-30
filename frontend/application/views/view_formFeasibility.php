<title>CRM | Feasibility Form</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Feasibility Form</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Requirement Form</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Feasibility Form</li>
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
                                        <h4 class="mb-1 fs-4 fw-semibold">Feasibility List</h4>
                                        <p class="fs-3 mb-0">Table for show</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <!-- <button type="button" class="btn bg-primary-subtle text-primary" data-bs-toggle="modal" data-bs-target="#mdlRegister">
                                    <i class="ti ti-Feasibility-plus me-2"></i> Add Feasibility
                                </button> -->
                                <a href="<?php echo base_url() ?>FeasibilityForm/addFeasibility" class="btn bg-primary-subtle text-primary">
                                    <i class="ti ti-Feasibility-plus me-2"></i> Add Feasibility
                                </a>
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblFeasibility" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer</th>
                                            <th>Part No.</th>
                                            <th>Issue Date</th>
                                            <th>Issue By</th>
                                            <!-- <th>Status</th> -->
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
<!-- Modal for register Feasibility -->
<div class="modal fade" id="mdlRegister" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Add Feasibility
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form" name="add_form">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#navpill-111" role="tab" aria-selected="true">
                                        <span>Feasibility Detail</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#navpill-222" role="tab" aria-selected="false" tabindex="-1">
                                        <span>Part No</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="tab-content mt-2">
                                    <div class="tab-pane p-3 active show" id="navpill-111" role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="mb-3 row align-items-center">
                                                <label for="inpDate" class="form-label fw-semibold">Date</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inpDate" name="create_date" placeholder="Date" value="<?php echo date('Y/m/d'); ?>" disabled>
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 row align-items-center">
                                                <label for="inpCustomer" class="form-label fw-semibold">Customer</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inpCustomer" name="if_customer" placeholder="Customer">
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 row align-items-center">
                                                <label for="inpImportFrom" class="form-label fw-semibold">Import From</label>
                                                <div class="col-sm-9">
                                                    <select name="if_import_tran" id="selImport" class="form-control">
                                                        <option value="" disabled selected>Import From</option>
                                                        <option value="1">Oversea</option>
                                                        <option value="2">Domestic</option>
                                                    </select>
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 row align-items-center">
                                                <label for="selRequirement" class="form-label fw-semibold">Requirement</label>
                                                <div class="col-sm-9">
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
                                            <input type="hidden" id="add_if_ref" name="if_ref">
                                            <span class="form_error"></span>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="navpill-222" role="tabpanel">
                                        <div id="tab-2" style="display: block;">
                                            <div class="row border" style="padding: 15px;">
                                                <div class="container-fluid">
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="inpQtyPartNo" class="form-label fw-semibold">Select Quantity</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" onchange="changePartNo()" id="inpQtyPartNo" name="if_qty_part_no" max="20" min="1" placeholder="Part No."></input>
                                                            <span class="form_error"></span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div id="form_part_no" name="form_part_no">

                                                    </div>
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="btnSubmitRegister" type="submit" onclick="addFeasibility()">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for edit Feasibility -->
<div class="modal fade" id="mdlEdits" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edits Feasibility
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" name="edit_form">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th colspan="2"><img src="<?php echo base_url(); ?>assets/images/logos/tbkk logo form.png" alt="tbkk logo" width="60px"></th>
                                <th colspan="18" class="text-center" style="font-size: 26px;font-weight: bold">TEAM FEASIBILITY&RISK ANALYSIS</th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editRef" class="form-label fw-semibold">Ref.</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editRef" name="if_ref" placeholder="Ref." disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editDate" class="form-label fw-semibold">Date</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="date" class="border-transparent" id="editDate" name="create_date" placeholder="Date" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editCustomer" class="form-label fw-semibold">Customer</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editCustomer" name="if_customer" placeholder="Customer">
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editImportFrom" class="form-label fw-semibold">Import From</label></th>
                                <th colspan="8" class="b-bottom">
                                    <select name="if_import_tran" id="editImportFrom" class="border-transparent"></select>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editPartNo" class="form-label fw-semibold">Part No.</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editPartNo" name="if_part_no" placeholder="Part No." disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editPartName" class="form-label fw-semibold">Part Name</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editPartName" name="if_part_name" placeholder="Part Name" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editRequirement" class="form-label fw-semibold">Requirement</label></th>
                                <th colspan="8" class="b-bottom">
                                    <select name="mrt_id" id="editRequirement" class="border-transparent"></select>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editDuedate" class="form-label fw-semibold">Due date</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="date" class="border-transparent" id="editDuedate" name="if_duedate" placeholder="Due date">
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="20">Feasibility Cosiderations :</th>
                            </tr>
                            <tr>
                                <td style="text-indent: 50px;" colspan="20">Our product quality planning team has considered the following questions, The drawing and/or specifications <br>provided have been used as a basis for analyzing the ability to meet all specified requirements. All "no" answers are <br>supported with attached comments identifying our concerns and/or proposed changes to enable us to meet the specified requirements.</td>
                            </tr>
                            <tr height="10px"></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="table_inner" colspan="20"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <!------------------------ Scoring meaning ------------------------>
                            <tr>
                                <td colspan="3">Scoring meaning :</td>
                                <td colspan="17">5 = High potential , 4 = Potential , 3 = Potential with condition.</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="17">2 = Need study for scenarior , 1 = Can't meet requirement</td>
                            </tr>
                            <!------------------------ Conclusion ------------------------>
                            <tr>
                                <td colspan="20" style="font-weight: bold;font-size: 20px">Conclusion</td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: LightGreen;">Green</td>
                                <td class="full-border text-center chk_score" id="chk_green"></td>
                                <td colspan="17">Feasible&No Risk (Score = 90-100) Product can be produced as specified with no revisions.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: Yellow;">Yellow</td>
                                <td class="full-border text-center chk_score" id="chk_yellow"></td>
                                <td colspan="17">Yellow = Feasible&NoRisk (Score 70-89) Need recommended or Other requirment (see attached).</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: Red;">Red</td>
                                <td class="full-border text-center chk_score" id="chk_red"></td>
                                <td colspan="17">Red = Not Feasible&Risk (Score < 69) Design revision required to produce product within the specified</td>
                            </tr>
                            <tr height="25px"></tr>
                            <!---------------------- Sign-Off ---------------------->
                            <tr>
                                <td colspan="20" style="font-weight: bold;font-size: 20px">Sign-Off</td>
                            </tr>
                            <!-- Sign Group1 -->
                            <tr class="text-center">
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Production Engineering</td>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Research and Development</td>
                                <td colspan="2"></td>
                            </tr>
                            <!-- Sign Group2 -->
                            <tr class="text-center">
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Sales and Marketing</td>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Purchasing</td>
                                <td colspan="2"></td>
                            </tr>
                            <!-- Sign Group3 -->
                            <tr class="text-center">
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                                <td class="" colspan="7"><img src="\assets\images\uploaded\signature\51SST60_signature.png" alt="" width="160px" height="80px"></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Production Control</td>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Project Control</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr height="20px"></tr>
                            <tr>
                                <td colspan="15"></td>
                                <td class="text-end" colspan="5">FM-S&M-015/02/19 JAN 2018</td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" id="if_id" name="if_id">
            </div>
            <div class="modal-footer">
                <button type="button" onclick="previewPDF()" class="btn bg-info-subtle text-info waves-effect text-start">
                    PDF
                </button>
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" onclick="editFeasibility()">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for View Feasibility Group Part No-->
<div class="modal fade" id="mdlPartNo" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    <i class="ti ti-layout-list me-1"></i> Part No.
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_part" name="edit_part">
                    <table class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;" id="tblPartNo">
                        <thead class="fw-semibold">
                            <tr>
                                <th>No.</th>
                                <th>Part No.</th>
                                <th>Part Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bodyPartNo">

                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for View Feasibility -->
<div class="modal" id="view_pdf_file">
    <div class="modal-dialog modal-xl mt-3 mb-0">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <span class="exit float-right"><i class="fa fa-times"></i></span>
                <div id="view_pdf_content"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPDF() {

        $('#table_inner tr').each(function() {
            $(this).css('background-color', 'white');
        });

        const {
            jsPDF
        } = window.jspdf;
        const pdfjs = document.querySelector('#edit_form');
        // Use html2canvas to convert HTML to canvas
        html2canvas(pdfjs, {
            scrollY: -window.scrollY
        }).then(canvas => {
            const pdfMargin = 2; // Adjust as needed
            const imgData = canvas.toDataURL('image/png');
            const pdfWidth = 210; // Width of A4 in mm (portrait)
            const pdfHeight = 297; // Height of A4 in mm (portrait)
            const imgWidth = canvas.width;
            const imgHeight = canvas.height;

            // Calculate the ratio to fit the content within the PDF
            const ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);
            const scaledWidth = imgWidth * ratio;
            const scaledHeight = imgHeight * ratio;

            // Create PDF with A4 size in portrait
            const doc = new jsPDF('p', 'mm', 'a4');

            doc.addImage(imgData, 'PNG', pdfMargin, pdfMargin, pdfWidth - 2 * pdfMargin, pdfHeight - 2 * pdfMargin);


            // Create a Blob from the PDF and open it in a new tab
            const pdfBlob = doc.output('blob');
            const url = URL.createObjectURL(pdfBlob);
            window.open(url);
            $('#mdlEdits').modal('hide');
        });
    }

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
                    add_form["if_duedate"] = getTimeNow().substring(0, 10) + " 11:59:59";
                    add_form["create_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    add_form["update_date"] = getTimeNow();
                    add_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
                    add_form["if_group_part"] = chk;
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'feasibility/insert',
                        data: JSON.stringify(add_form),
                        success: function(data) {
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
                                $('#mdlRegister').close();
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

    async function editFeasibility() {
        event.preventDefault();
        let chk = await Feasibility_validate("edit");
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
                        if (item.name == 'if_import_tran' || item.name == 'mrt_id' || item.name == 'if_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["if_duedate"] += " 11:59:59";
                    edit_form["update_date"] = getTimeNow();
                    edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'feasibility/update',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Feasibility success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Feasibility!</p>",
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
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
                status_form["if_id"] = id;
                status_form["if_status"] = status;
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'feasibility/change_status',
                    data: JSON.stringify(status_form),
                    success: function(data) {
                        // console.log(data);
                        if (data != false) {
                            Swal.fire({
                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Feasibility success!</p>",
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
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Feasibility!</p>",
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

    function checkConclusion(score) {
        $('.chk_score').html("");
        if (score < 70) {
            $("#chk_red").html('<span class="material-symbols-outlined">check</span>');
        } else if (score < 90) {
            $("#chk_yellow").html('<span class="material-symbols-outlined">check</span>');
        } else {
            $("#chk_green").html('<span class="material-symbols-outlined">check</span>');
        }
    }

    // modal --------------------------------------
    function editModal(id) {
        event.preventDefault();
        var partNo = "";
        var partName = "";
        $('#if_id').val(id);
        $.ajax({
            type: 'get',
            url: API_URL + 'feasibility/' + id,
            success: async function(result) {
                await $.ajax({
                    type: 'GET',
                    url: API_URL + 'view/partno/' + id,
                    success: function(result) {
                        // console.log(result);
                        let data = result.data;
                        if (data.length > 0) {
                            for (let i = 0; i < data.length; i++) {
                                partNo += data[i].partNo;
                                partName += data[i].partName;

                                // Add a comma if it's not the last item
                                if (i < data.length - 1) {
                                    partNo += ", ";
                                    partName += ", ";
                                }
                            }
                        } else {
                            partNo = "";
                            partName = "";
                        }
                    }
                });
                $('#editRef').val(result.if_ref);
                $('#editDate').val(result.create_date.substring(0, 10));
                $('#editDuedate').val(result.if_duedate.substring(0, 10));
                $('#editCustomer').val(result.if_customer);
                let importText = '<option value="" disabled selected>Import From</option>' +
                    '<option value="1" ' + ((result.if_import_tran == 1) ? 'selected' : '') + '>Oversea</option>' +
                    '<option value="2" ' + ((result.if_import_tran == 2) ? 'selected' : '') + '>Domestic</option>';
                $('#editImportFrom').html(importText);
                $('#editPartNo').val(partNo);
                $('#editPartName').val(partName);
                listRequirement(result.mrt_id);
                viewFeasibility(id);
            }
        })
    }

    async function editPartNo(id) {
        event.preventDefault();
        var partNo = $('#' + id).val();
        var partName = $('#' + id).closest('tr').find('input').last().val();
        var partNoInput = $('#' + id).closest('tr').find('input[name="partNo"]');
        var partNameInput = $('#' + id).closest('tr').find('input[name="partName"]');

        let partData = []
        partData.push({
            "ifpn_id": id
        });
        partData.push({
            "partNo": partNo
        });
        partData.push({
            "partName": partName
        });
        partData.push({
            "update_date": getTimeNow()
        });
        partData.push({
            "update_by": "<?php echo $this->session->userdata('sessUsr') ?>"
        });

        var chk = await edit_partno(partData);
        if (chk) {
            if (chk == "err_prtNo") {
                form_err(partNoInput.get(0), "*Please Enter Part No.");
            } else {
                form_ok(partNoInput.get(0));
                if (chk == "err_prtName") {
                    form_err(partNameInput.get(0), "*Please Enter Part Name.");
                } else {
                    if (chk == "ok") {
                        form_ok(partNameInput.get(0));
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
                                $.ajax({
                                    type: 'PUT',
                                    dataType: 'json',
                                    contentType: 'application/json',
                                    url: API_URL + 'feasibility/update_partno',
                                    data: JSON.stringify(partData),
                                    success: function(data) {
                                        console.log(data);
                                        if (data != false) {
                                            Swal.fire({
                                                html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Part No. success!</p>",
                                                icon: 'success',
                                                showClass: {
                                                    popup: 'animate__animated animate__fadeInDown'
                                                }
                                            })
                                        } else {
                                            Swal.fire({
                                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Part No.!</p>",
                                                icon: 'error',
                                                showClass: {
                                                    popup: 'animate__animated animate__fadeInDown'
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
            }
        }
    }

    function modalPartno(id) {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblPartNo')) {
            $('#tblPartNo').DataTable().destroy();
        }
        var dataTable = $('#tblPartNo').DataTable({
            ajax: {
                url: API_URL + 'view/partno/' + id,
            },
            autoWidth: false,
            columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                },
                {

                    targets: 0,
                    width: "10%",
                },
                {
                    targets: 3,
                    width: "15%",
                }
            ],
            bSort: false,
            order: [
                [1, 'asc']
            ],
            columns: [{
                    className: 'text-center',
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    className: 'text-center',
                    data: 'partNo',
                    "render": function(data, type, row) {
                        return "<div>" +
                            "<input type='text' class='form-control' id='" + row.ifpn_id + "' value='" + data + "' name='partNo'>" +
                            '<span class="form_error"></span>' +
                            "</div>"
                    }
                },
                {
                    className: 'text-center',
                    data: 'partName',
                    "render": function(data, type, row) {
                        return "<div>" +
                            "<input type='text' class='form-control' id='" + row.ifpn_id + "' value='" + data + "' name='partName'>" +
                            '<span class="form_error"></span>' +
                            "</div>"
                    }
                },
                {
                    className: 'text-center',
                    data: 'ifpn_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="editPartNo(\'' + row.ifpn_id + '\')" class="btn btn btn-outline-warning">' +
                                '<i class="ti ti-pencil fw-semibold"></i></button>';
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

    async function viewFeasibility(id) {
        var table_text = '<table class="custom-table full-border"><tr style="font-weight: bold;text-align: center">' +
            '<th colspan="2">Weight</th>' +
            '<th colspan="2">Score</th>' +
            '<th>Total</th>' +
            '<th colspan="11">CONSIDERATION</th>' +
            '<th colspan="5">Comment</th>' +
            '<th>File</th>' +
            '<th colspan="2">P.I.C</th>' +
            '</tr>';
        var arr_consider = await list_considerScore(id);
        var arr_inDept = await list_inchargeDepartment();
        var con_arr = [];
        $.each(arr_consider, function(key, value) {
            var subincharge = [];
            $.each(arr_inDept, function(inkey, inval) {
                if (value.mc_id == inval.mc_id) {
                    subincharge.push(inval);
                }
            })
            con_arr.push({
                'data': value,
                'incharge': subincharge
            });
        })
        var fLastTotal = 0;
        $.each(con_arr, function(key, value) {
            var bg_color = "",
                fileLink = "",
                input = '';
            if (value.data.ifcp_submit == 0) {
                bg_color = ' style="background-color: lightgray;"';
                input = ' disabled';
            }
            if (value.data.ifcp_file_name != null && value.data.ifcp_file_name != "") {
                if (value.data.ifcp_file_name.slice(-4) == ".pdf") {
                    fileLink = '<button class="text-block" onclick="view_pdf_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
                } else {
                    fileLink = '<button class="text-block" onclick="view_img_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
                }
            }
            table_text += '<tr' + bg_color + '>' +
                '<td colspan="2" class="text-center">' + value.data.mc_weight + '</td>' +
                '<td colspan="2" class="text-center">' + value.data.ifcp_score + '</td>' +
                '<td class="text-center inputScore" id="total' + value.data.mc_id + '">' + (value.data.mc_weight * value.data.ifcp_score) + '</td>' +
                '<td colspan="11">' + value.data.mc_title + '</td>' +
                '<td colspan="5">' + value.data.ifcp_comment + '</td>' +
                '<td class="text-center"><div class="img_container" id="file_show' + value.data.mc_id + '">' + fileLink + '</div></td>' +
                '<td colspan="2" class="text-center" style="font-size: 12px">';
            if (value.incharge.length > 0) {
                var innum = false;
                $.each(value.incharge, function(inkey, inval) {
                    if (innum) {
                        table_text += ', ';
                    };
                    table_text += inval.sd_name;
                    innum = true;
                })
            } else {
                table_text += ' - ';
            }
            table_text += '</td></tr>';
            fLastTotal += (value.data.mc_weight * value.data.ifcp_score);
        })
        checkConclusion(fLastTotal);
        table_text += '<tr class="text-center">' +
            '<td colspan="2"></td>' +
            '<td colspan="2" style="background-color: Yellow;">Total</td>' +
            '<td style="background-color: Yellow;" id="lastTotal">' + fLastTotal + '</td></tr></table>';
        $("#table_inner").html(table_text)
        $.each(arr_inDept, function(inkey, inval) {
            let fileContainer = "#file_show" + inval.mc_id;
            $(fileContainer).css("display", "block");
        })
    }

    async function list_considerScore(id) {
        try {
            var result = await $.ajax({
                type: 'GET',
                url: API_URL + "view/feas_score/" + id,
            });
            return result;
        } catch (err) {
            console.log(err);
            throw err;
        }
    }

    async function list_inchargeDepartment() {
        try {
            var result = await $.ajax({
                type: 'GET',
                url: API_URL + "view/in_dept",
            });
            return result;
        } catch (err) {
            console.log(err);
            throw err;
        }
    }

    async function get_partById(id) {
        try {
            var result = await $.ajax({
                type: 'GET',
                url: API_URL + "view/partno/" + id,
            });
            return result;
        } catch (err) {
            console.log(err);
            throw err;
        }
    }

    function view_pdf_file(link) {
        event.preventDefault();
        $('#view_pdf_file').fadeIn(500).modal('show');
        link_pdf = '<object data="' + <?php echo "'" . base_url() . "'" ?> + link + '" type="application/pdf" width="100%" height="650px">' +
            '<p>Unable to display PDF file. <a href="' + <?php echo "'" . base_url() . "'" ?> + link + '">Download</a> instead.</p>' +
            '</object>';
        $("#view_pdf_content").html(link_pdf);
    }

    function view_img_file(link) {
        event.preventDefault();
        $('#view_pdf_file').fadeIn(500).modal('show');
        link_img = '<img src="' + <?php echo "'" . base_url() . "'" ?> + link + '" width="100%">';
        $("#view_pdf_content").html(link_img);
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
            html += '<div class="mb-3 row align-items-center">' +
                '<label for="inpPartNo' + i + '" class="form-label fw-semibold">Part No (' + i_plus_1 + ')</label>' +
                '<div class="col-sm-9">' +
                '<input type="text" class="form-control" id="inpPartNo' + i + '" name="if_part_no[]" placeholder="Part No.">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '<div class="mb-3 row align-items-center">' +
                '<label for="inpPartName' + i + '" class="form-label fw-semibold">Part Name (' + i_plus_1 + ')</label>' +
                '<div class="col-sm-9">' +
                '<input type="text" class="form-control" id="inpPartName' + i + '" name="if_part_name[]" placeholder="Part Name">' +
                '<span class="form_error"></span>' +
                '</div>' +
                '</div>' +
                '<hr>';
        }
        $('#form_part_no').html(html);
    }

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tblFeasibility')) {
            $('#tblFeasibility').DataTable().destroy();
        }
        var dataTable = $('#tblFeasibility').DataTable({
            ajax: {
                url: API_URL + 'feasibility/table'
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
                    data: 'if_id'
                },
                {
                    className: 'text-center',
                    data: 'if_customer',
                },
                {
                    className: 'text-center',
                    data: 'if_id',
                    "render": function(data, type, row) {
                        return '<button type="button" onclick="modalPartno(\'' + row.if_id + '\')" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#mdlPartNo">' +
                            '<i class="ti ti-search fw-semibold fs-5"></i></button>';
                    }
                },
                {
                    className: 'text-center',
                    data: 'create_date'
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
                                    '<h6 class="user-name mb-0" data-name="' + row.su_fname + ' ' + row.su_lname + '">' + row.su_fname + '</h6>' +
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
                    data: 'if_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            // disp = '<button type="button" onclick="editModal(\'' + row.if_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits">' +
                            //     '<i class="ti ti-pencil me-1"></i> Edit </button>';
                            disp = '<a href="FeasibilityForm/editFeasibility?if_id=' + row.if_id + '" class="btn btn btn-primary" ><i class="ti ti-edit fs-5"></i></a>'
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
        }, 600000);
    });
</script>