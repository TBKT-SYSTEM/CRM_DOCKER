<title>CRM | RFQ Form</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">RFQ Form</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Requirement Form</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">RFQ Form</li>
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
                                        <h4 class="mb-1 fs-4 fw-semibold">RFQ List</h4>
                                        <p class="fs-3 mb-0">Table for show</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <button type="button" class="btn bg-primary-subtle text-primary" data-bs-toggle="modal" data-bs-target="" style="cursor:not-allowed">
                                    <i class=""></i> Add RFQ
                                </button>
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblFeasibility" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>No.</th>
                                            <th class="text-center">Topic</th>
                                            <!-- <th>Part No.</th>
                                            <th>Updated Date</th>
                                            <th>Updated By</th>
                                            <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center col-1">1</td>
                                            <td class="text-center" style="font-weight: bold;">Tutorial RFQ Form</td>
                                            <td class="text-center col-2"><button type="button" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits"><i class="ti ti-pencil me-1"></i> View </button></td>
                                        </tr>
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
                    Add RFQ
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form" name="add_form">
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
                            <label for="inpPartNo" class="form-label fw-semibold">Part No.</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inpPartNo" name="if_part_no" placeholder="Part No.">
                                <span class="form_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inpPartName" class="form-label fw-semibold">Part Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inpPartName" name="if_part_name" placeholder="Part Name">
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
                    Edits RFQ
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" name="edit_form">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th colspan="10" class=""><img src="<?php echo base_url(); ?>assets/images/logos/tbkk logo form.png" alt="tbkk logo" width="100px" style=" float: right;"></th>
                                <th colspan="10" class="" style="font-size: 26px;font-weight: bold">査定依頼書<br>
                                    <p style="font-size: 15px">IN-HOUSE RFQ</p>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="editRef" class="form-label fw-semibold">Ref. No.</label></th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="" name="if_ref" placeholder="NB/SM/NB/043/23" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="editRef" class="form-label fw-semibold">Doc. No.</label></th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editRef" name="if_ref" placeholder="RFQ/SM/23/094" disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="8"></th>
                                <th colspan="2"><label for="editDate" class="form-label fw-semibold">Issued Date</label></th>
                                <th colspan="4" class="b-bottom">
                                    <input type="date" class="border-transparent" id="editDate" name="create_date" placeholder="Date" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Attn.</label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">PU Dept.</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">CE/GDC Dept.</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">PE Dept.</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">PC&L Dept.</label>
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="editCustomer" class="form-label fw-semibold">Customer</label></th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editCustomer" name="if_customer" placeholder="Customer">
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="4"></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Overseas</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Domestic</label>
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Require </label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">New Model</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">ECR</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">DCR</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="reqCheck" name="">
                                </th>
                                <th colspan="1" class="form-label">
                                    <label class="" for="">Other</label>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="inpReqOther" name="" placeholder="">
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Subject </label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">New Project</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Localization</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Re-sourcing</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="reqCheck" name="">
                                </th>
                                <th colspan="1" class="form-label">
                                    <label class="" for="">Other</label>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="inpReqOther" name="" placeholder="">
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Enclosures </label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Drawing</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">CATIA/CAD</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">CD</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="reqCheck" name="">
                                </th>
                                <th colspan="1" class="form-label">
                                    <label class="" for="">Other</label>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="4" class="b-bottom">
                                    <input type="text" class="border-transparent" id="inpReqOther" name="" placeholder="">
                                    <span class="form_error"></span>
                                </th>
                            </tr>



                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Project Life </label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editCustomer" name="if_customer" placeholder="Customer">
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="4"><label for="" class="form-label fw-semibold mt-2">Program Timing info. (SOP) </label></th>
                                <th colspan="6" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editCustomer" name="if_customer" placeholder="Customer">
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr height="10px"></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="20">
                                    <table class="custom-table full-border">
                                        <tbody style="text-align: center;">
                                            <tr style="font-weight: bold;text-align: center">
                                                <th rowspan="2" colspan="1">No</th>
                                                <th rowspan="2" colspan="3">PART NUMBER</th>
                                                <th rowspan="2" colspan="4">PART NAME</th>
                                                <th rowspan="2" colspan="2">MODEL</th>
                                                <th colspan="4">VOLUME</th>
                                                <th rowspan="2" colspan="7">Remark</th>
                                            </tr>
                                            <tr style="font-weight: bold;text-align: center">
                                                <th colspan="2">Yearly</th>
                                                <th colspan="2">Monthly</th>
                                            </tr>
                                            <tr>
                                                <td colspan="1">1</td>
                                                <td colspan="3">SB03S400004</td>
                                                <td colspan="4">Bearing Housing Sub Assy</td>
                                                <td colspan="2">RHS4</td>
                                                <td colspan="2">50</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">2</td>
                                                <td colspan="3">SB03S400005</td>
                                                <td colspan="4">Bearing Housing Sub Assy</td>
                                                <td colspan="2">RHS4C</td>
                                                <td colspan="2">50</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">-</td>
                                                <td colspan="3">-</td>
                                                <td colspan="4">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7">-</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">-</td>
                                                <td colspan="3">-</td>
                                                <td colspan="4">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7">-</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">-</td>
                                                <td colspan="3">-</td>
                                                <td colspan="4">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7">-</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">-</td>
                                                <td colspan="3">-</td>
                                                <td colspan="4">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7">-</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">-</td>
                                                <td colspan="3">-</td>
                                                <td colspan="4">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="2">-</td>
                                                <td colspan="7">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="mt-2">
                                <td colspan="20">Please be required to study the cost according above detail and be arranged necessary info upon below conditions</td>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Purchase Cost</label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Raw material</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Mold/Die</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Manufacturing</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="reqCheck" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Transportation</label>
                                    <span class="form_error"></span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2"><label for="" class="form-label fw-semibold mt-2">Process Cost</label></th>
                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Casting</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Machining</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Assembly (sub-assy)</label>
                                    <span class="form_error"></span>
                                </th>

                                <th>
                                    <input type="checkbox" class="d-flex alian-self-center bg-dark" style="width:20px;height:20px; float: right;" id="reqCheck" name="">
                                </th>
                                <th colspan="3" class="form-label">
                                    <label class="" for="">Packaging and Delivery</label>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="2" class="mt-2">Note </th>
                                <td colspan="18">1. Each cost should provide with breakdown.</th>
                            </tr>
                            <tr>
                                <td colspan="2" class="mt-2"></td>
                                <td colspan="18">2.Tooling development schedule (timelines) is required.</th>
                            </tr>

                            <tr height="25px"></tr>

                            <tr>
                                <td colspan="1"></td>
                                <td colspan="18">
                                    <table class="custom-table text-center" style="border-style: dotted;">
                                        <tr class="b-top">
                                            <th colspan="18">Comment/Additional info By S&M :</th>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">This RFQ for study cost only not concern ECN of current model.</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">ITT requested to study cost for new model refer current model but change dimension of machining model.</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">PU : Please restudy cost with supplier.</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">PE : Please study machinig cost with chainging point on drawing And tooling fee separately cost.</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">PCL : Please restudy packaging cost (TBC)</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18"> ** TBC package "Returnable" or "Export"</td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="1"></td>
                            </tr>

                            <tr height="25px"></tr>

                            <tr>
                                <td colspan="1"></td>
                                <td colspan="18">
                                    <table class="custom-table text-center" style="border-style: dotted;">
                                        <tr class="b-top">
                                            <th colspan="18">Comment/Additional info by PE/PU/PC&L :</th>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                        <tr class="b-top">
                                            <td colspan="18">-</td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="1"></td>
                            </tr>

                            <tr height="25px"></tr>

                            <tr>
                                <td colspan="4"></td>
                                <td colspan="12">
                                    <table class="custom-table text-center border-2 border-danger" style="font-size: 25px; font-weight: bold">
                                        <tr>
                                            <th colspan="16">査定期限</th>
                                        </tr>
                                        <tr>
                                            <th colspan="16">Closing Date</th>
                                        </tr>
                                        <tr>
                                            <th colspan="16">04-01-2024</th>
                                        </tr>
                                    </table>
                                <td colspan="4"></td>
                            </tr>

                            <tr height="50px"></tr>


                            <tr class="text-center">
                                <td colspan="2"></td>
                                <td class="b-top" colspan="3">Ms. Pimnapat</td>
                                <td colspan="1"></td>
                                <td class="b-top" colspan="3">Ms. Kyoko</td>
                                <td colspan="2"></td>
                                <td class="b-top" colspan="3">Mr.Sirote</td>
                                <td colspan="1"></td>
                                <td class="b-top" colspan="3">Mr. Horikoshi</td>
                                <td colspan="2"></td>
                            </tr>

                            <tr class="text-center">
                                <td colspan="2"></td>
                                <td colspan="3">Engineer</td>
                                <td colspan="1"></td>
                                <td colspan="3">Senior Coordinator</td>
                                <td colspan="2"></td>
                                <td colspan="3">Department Manager</td>
                                <td colspan="1"></td>
                                <td colspan="3">General Manager</td>
                                <td colspan="2"></td>
                            </tr>

                            <tr class="text-center">
                                <th colspan="2"></th>
                                <th colspan="3">Issued</th>
                                <th colspan="1"></th>
                                <th colspan="3">Checked</th>
                                <th colspan="2"></th>
                                <th colspan="3">Approved</th>
                                <th colspan="1"></th>
                                <th colspan="3">Authorized</th>
                                <th colspan="2"></th>
                            </tr>

                            <tr class="text-end border-1 border-top" style="border-color: #5a6a85 !important;">
                                <th colspan="20">FM-S&amp;M-001/04/08-Jun-22</th>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" id="if_id" name="if_id">
            </div>
            <div class="modal-footer">
                <button type="button" onclick="previewPDF()" class="btn bg-info-subtle text-info waves-effect text-start">
                    PDF
                </button>
                <button type="reset" onclick="return false;" class="btn bg-danger-subtle text-danger waves-effect text-start" data-bs-dismiss="modal" style="cursor:not-allowed">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" onclick="return false;" style="cursor:not-allowed">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
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
            window.open(url);;
        });
    }



    // async function addFeasibility() {
    //     event.preventDefault();
    //     let chk = await Feasibility_validate("add");
    //     // console.log(chk);
    //     if (chk) {
    //         Swal.fire({
    //             title: 'Are you sure?',
    //             text: "You won't be able to revert this!",
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 var add_form = {};
    //                 $('#add_form').serializeArray().forEach(function(item) {
    //                     if (item.name == 'if_import_tran' || item.name == 'mrt_id') {
    //                         item.value = parseInt(item.value)
    //                     }
    //                     add_form[item.name] = item.value;
    //                 })
    //                 add_form["create_date"] = getTimeNow();
    //                 add_form["if_duedate"] = getTimeNow().substring(0, 10) + " 11:59:59";
    //                 add_form["create_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

    //                 $.ajax({
    //                     type: 'POST',
    //                     dataType: 'json',
    //                     contentType: 'application/json',
    //                     url: API_URL + 'feasibility/insert',
    //                     data: JSON.stringify(add_form),
    //                     success: function(data) {
    //                         if (data.Error != "null" || data.Error != "") {
    //                             Swal.fire({
    //                                 html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Add Feasibility success!</p>",
    //                                 icon: 'success',
    //                                 showClass: {
    //                                     popup: 'animate__animated animate__fadeInDown'
    //                                 },
    //                                 hideClass: {
    //                                     popup: 'animate__animated animate__fadeOutUp'
    //                                 }
    //                             })
    //                         } else {
    //                             Swal.fire({
    //                                 html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error add Feasibility!</p>",
    //                                 icon: 'error',
    //                                 showClass: {
    //                                     popup: 'animate__animated animate__fadeInDown'
    //                                 },
    //                                 hideClass: {
    //                                     popup: 'animate__animated animate__fadeOutUp'
    //                                 }
    //                             })
    //                         }
    //                     },
    //                     error: function(err) {
    //                         console.log(err);
    //                     }
    //                 })
    //             }
    //         })
    //     }
    // }

    // async function editFeasibility() {
    //     event.preventDefault();
    //     let chk = await Feasibility_validate("edit");
    //     if (chk) {
    //         Swal.fire({
    //             title: 'Are you sure?',
    //             text: "You won't be able to revert this!",
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 var edit_form = {};
    //                 $('#edit_form').serializeArray().forEach(function(item) {
    //                     if (item.name == 'if_import_tran' || item.name == 'mrt_id' || item.name == 'if_id') {
    //                         item.value = parseInt(item.value)
    //                     }
    //                     edit_form[item.name] = item.value;
    //                 })
    //                 edit_form["if_duedate"] += " 11:59:59";
    //                 edit_form["update_date"] = getTimeNow();
    //                 edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

    //                 $.ajax({
    //                     type: 'PUT',
    //                     dataType: 'json',
    //                     contentType: 'application/json',
    //                     url: API_URL + 'feasibility/update',
    //                     data: JSON.stringify(edit_form),
    //                     success: function(data) {
    //                         if (data != false) {
    //                             Swal.fire({
    //                                 html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit Feasibility success!</p>",
    //                                 icon: 'success',
    //                                 showClass: {
    //                                     popup: 'animate__animated animate__fadeInDown'
    //                                 }
    //                             })
    //                         } else {
    //                             Swal.fire({
    //                                 html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit Feasibility!</p>",
    //                                 icon: 'error',
    //                                 showClass: {
    //                                     popup: 'animate__animated animate__fadeInDown'
    //                                 }
    //                             })
    //                         }
    //                     },
    //                     error: function(err) {
    //                         console.log(err)
    //                     }
    //                 })
    //             }
    //         })
    //     }
    // }

    // function change_status(id, status) {
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             var status_form = {};
    //             status_form["if_id"] = id;
    //             status_form["if_status"] = status;
    //             $.ajax({
    //                 type: 'PUT',
    //                 dataType: 'json',
    //                 contentType: 'application/json',
    //                 url: API_URL + 'feasibility/change_status',
    //                 data: JSON.stringify(status_form),
    //                 success: function(data) {
    //                     // console.log(data);
    //                     if (data != false) {
    //                         Swal.fire({
    //                             html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Update status Feasibility success!</p>",
    //                             icon: 'success',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                     } else {
    //                         Swal.fire({
    //                             html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error Update status Feasibility!</p>",
    //                             icon: 'error',
    //                             showClass: {
    //                                 popup: 'animate__animated animate__fadeInDown'
    //                             },
    //                             hideClass: {
    //                                 popup: 'animate__animated animate__fadeOutUp'
    //                             }
    //                         })
    //                     }
    //                 },
    //                 error: function(err) {
    //                     console.log(err);
    //                 }
    //             })
    //         }
    //     })
    // }

    // function checkConclusion(score) {
    //     $('.chk_score').html("");
    //     if (score < 70) {
    //         $("#chk_red").html('<span class="material-symbols-outlined">check</span>');
    //     } else if (score < 90) {
    //         $("#chk_yellow").html('<span class="material-symbols-outlined">check</span>');
    //     } else {
    //         $("#chk_green").html('<span class="material-symbols-outlined">check</span>');
    //     }
    // }

    // // modal --------------------------------------
    // function editModal(id) {
    //     event.preventDefault();
    //     $('#if_id').val(id);
    //     $.ajax({
    //         type: 'get',
    //         url: API_URL + 'feasibility/' + id,
    //         success: function(result) {
    //             $('#editRef').val(result.if_ref);
    //             $('#editDate').val(result.create_date.substring(0, 10));
    //             $('#editDuedate').val(result.if_duedate.substring(0, 10));
    //             $('#editCustomer').val(result.if_customer);
    //             let importText = '<option value="" disabled selected>Import From</option>' +
    //                 '<option value="1" ' + ((result.if_import_tran == 1) ? 'selected' : '') + '>Oversea</option>' +
    //                 '<option value="2" ' + ((result.if_import_tran == 2) ? 'selected' : '') + '>Domestic</option>';
    //             $('#editImportFrom').html(importText);
    //             $('#editPartNo').val(result.if_part_no);
    //             $('#editPartName').val(result.if_part_name);
    //             listRequirement(result.mrt_id);
    //             viewFeasibility(id);
    //         }
    //     })
    // }

    // function listRequirement(id) {
    //     $.ajax({
    //         type: 'get',
    //         url: API_URL + 'option/list_mrt',
    //         success: function(result) {
    //             var option_text = '<option value="" disabled selected>Choose Requirement</option>';
    //             $.each(result, function(key, value) {
    //                 let sel = "";
    //                 if (value.mrt_id == id) {
    //                     sel = "selected";
    //                 }
    //                 option_text += '<option value="' + value.mrt_id + '" ' + sel + '>' + value.mrt_name + '</option>';
    //             })
    //             $('#editRequirement').html(option_text);
    //         }
    //     })
    // }

    // async function viewFeasibility(id) {
    //     var table_text = '<table class="custom-table full-border"><tr style="font-weight: bold;text-align: center">' +
    //         '<th colspan="2">Weight</th>' +
    //         '<th colspan="2">Score</th>' +
    //         '<th>Total</th>' +
    //         '<th colspan="11">CONSIDERATION</th>' +
    //         '<th colspan="5">Comment</th>' +
    //         '<th>File</th>' +
    //         '<th colspan="2">P.I.C</th>' +
    //         '</tr>';
    //     var arr_consider = await list_considerScore(id);
    //     var arr_inDept = await list_inchargeDepartment();
    //     var con_arr = [];
    //     $.each(arr_consider, function(key, value) {
    //         var subincharge = [];
    //         $.each(arr_inDept, function(inkey, inval) {
    //             if (value.mc_id == inval.mc_id) {
    //                 subincharge.push(inval);
    //             }
    //         })
    //         con_arr.push({
    //             'data': value,
    //             'incharge': subincharge
    //         });
    //     })
    //     var fLastTotal = 0;
    //     $.each(con_arr, function(key, value) {
    //         var bg_color = "",
    //             fileLink = "",
    //             input = '';
    //         if (value.data.ifcp_submit == 0) {
    //             bg_color = ' style="background-color: lightgray;"';
    //             input = ' disabled';
    //         }
    //         if (value.data.ifcp_file_name != null && value.data.ifcp_file_name != "") {
    //             if (value.data.ifcp_file_name.slice(-4) == ".pdf") {
    //                 fileLink = '<button class="text-block" onclick="view_pdf_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
    //             } else {
    //                 fileLink = '<button class="text-block" onclick="view_img_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
    //             }
    //         }
    //         table_text += '<tr' + bg_color + '>' +
    //             '<td colspan="2" class="text-center">' + value.data.mc_weight + '</td>' +
    //             '<td colspan="2" class="text-center">' + value.data.ifcp_score + '</td>' +
    //             '<td class="text-center inputScore" id="total' + value.data.mc_id + '">' + (value.data.mc_weight * value.data.ifcp_score) + '</td>' +
    //             '<td colspan="11">' + value.data.mc_title + '</td>' +
    //             '<td colspan="5">' + value.data.ifcp_comment + '</td>' +
    //             '<td class="text-center"><div class="img_container" id="file_show' + value.data.mc_id + '">' + fileLink + '</div></td>' +
    //             '<td colspan="2" class="text-center">';
    //         if (value.incharge.length > 0) {
    //             var innum = false;
    //             $.each(value.incharge, function(inkey, inval) {
    //                 if (innum) {
    //                     table_text += '/';
    //                 };
    //                 table_text += inval.sd_name;
    //                 innum = true;
    //             })
    //         } else {
    //             table_text += ' - ';
    //         }
    //         table_text += '</td></tr>';
    //         fLastTotal += (value.data.mc_weight * value.data.ifcp_score);
    //     })
    //     checkConclusion(fLastTotal);
    //     table_text += '<tr class="text-center">' +
    //         '<td colspan="2"></td>' +
    //         '<td colspan="2" style="background-color: Yellow;">Total</td>' +
    //         '<td style="background-color: Yellow;" id="lastTotal">' + fLastTotal + '</td></tr></table>';
    //     $("#table_inner").html(table_text)
    //     $.each(arr_inDept, function(inkey, inval) {
    //         let fileContainer = "#file_show" + inval.mc_id;
    //         $(fileContainer).css("display", "block");
    //     })
    // }

    // async function list_considerScore(id) {
    //     try {
    //         var result = await $.ajax({
    //             type: 'GET',
    //             url: API_URL + "view/feas_score/" + id,
    //         });
    //         return result;
    //     } catch (err) {
    //         console.log(err);
    //         throw err;
    //     }
    // }

    // async function list_inchargeDepartment() {
    //     try {
    //         var result = await $.ajax({
    //             type: 'GET',
    //             url: API_URL + "view/in_dept",
    //         });
    //         return result;
    //     } catch (err) {
    //         console.log(err);
    //         throw err;
    //     }
    // }

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

    // $(document).ready(function() {
    //     if ($.fn.DataTable.isDataTable('#tblFeasibility')) {
    //         $('#tblFeasibility').DataTable().destroy();
    //     }
    //     var dataTable = $('#tblFeasibility').DataTable({
    //         ajax: {
    //             url: API_URL + 'feasibility/table'
    //         },
    //         columnDefs: [{
    //             searchable: true,
    //             orderable: false,
    //             targets: 0,
    //         }, ],
    //         bSort: false,
    //         order: [
    //             [1, 'asc']
    //         ],
    //         columns: [{
    //                 className: 'text-center',
    //                 data: 'if_id'
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'if_customer',
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'if_part_no'
    //             },
    //             // {
    //             //     className: 'text-center',
    //             //     data:'if_import_tran',
    //             //     "render": function (data, type, row){
    //             //         if (type === 'display'){
    //             //             if(row.if_import_tran == 1){
    //             //                 disp = 'Oversea';
    //             //             }else{
    //             //                 disp = 'Domestic';
    //             //             }
    //             //         }
    //             //         return disp;
    //             //     }
    //             // },
    //             {
    //                 className: 'text-center',
    //                 data: 'update_date'
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'update_by',
    //                 "render": function(data, type, row) {
    //                     if (type === 'display') {
    //                         if (row.update_by != "") {
    //                             let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + row.update_by + '.jpg';
    //                             if (!is_cached(img_ok)) {
    //                                 img_ok = 'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';
    //                             }
    //                             disp = '<div class="d-flex align-items-center">' +
    //                                 '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
    //                                 '<div class="ms-3">' +
    //                                 '<div class="user-meta-info">' +
    //                                 '<h6 class="user-name mb-0" data-name="' + row.su_fname + ' ' + row.su_lname + '">' + row.su_fname + '</h6>' +
    //                                 '<span class="user-work fs-3" data-occupation="' + row.update_by + '">' + row.update_by + '</span>' +
    //                                 '</div></div></div>';
    //                         } else {
    //                             disp = "";
    //                         }
    //                     }
    //                     return disp;
    //                 },
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'if_id',
    //                 "render": function(data, type, row) {
    //                     if (type === 'display') {
    //                         if (row.if_status) {
    //                             disp = '<a onclick="change_status(' + row.if_id + ',0)"><label class="switch"><input type="checkbox" checked disabled><span class="slider round"></span></label></a>';
    //                         } else {
    //                             disp = '<a onclick="change_status(' + row.if_id + ',1)"><label class="switch"><input type="checkbox" disabled><span class="slider round"></span></label></a>';
    //                         }
    //                     }
    //                     return disp;
    //                 }
    //             },
    //             {
    //                 className: 'text-center',
    //                 data: 'if_id',
    //                 "render": function(data, type, row) {
    //                     if (type === 'display') {
    //                         disp = '<button type="button" onclick="editModal(\'' + row.if_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits">' +
    //                             '<i class="ti ti-pencil me-1"></i> Edit </button>';
    //                     }
    //                     return disp;
    //                 }
    //             }
    //         ]
    //     });
    //     dataTable.on('order.dt search.dt', function() {
    //         let i = 1;
    //         dataTable.cells(null, 0, {
    //             search: 'applied',
    //             order: 'applied'
    //         }).every(function(cell) {
    //             this.data(i++);
    //         });
    //     }).draw();
    //     setInterval(function() {
    //         dataTable.ajax.reload(null, false);
    //     }, 600000);

    //     // $('#reqCheck').on('change', function() {
    //     //     if ($(this).is(':checked')) {
    //     //         $('#editRequirement').val('');
    //     //         $('#editRequirement').attr('disabled', true);
    //     //     } else {
    //     //         $('#editRequirement').attr('disabled', false);
    //     //     }
    //     // });


    // });
</script>