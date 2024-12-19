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
                                        <label for="" class="form-label col-sm-3 col-form-label">Customer :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select shadow-sm" id=""></select>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="" class="form-label col-sm-3 col-form-label">Requirement :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select shadow-sm" id=""></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-4 row align-items-center">
                                        <button type="button" onclick="" class="col-sm-2 btn rounded-pill bg-primary-subtle text-primary shadow-sm mx-2">Apply</button>
                                        <div class="col-auto">
                                            <label class="fw-semibold fs-1">&nbsp; If apply data from RFQ then show data in all topic.<br> &nbsp; All topic cannot change data.</label>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label for="" class="form-label col-sm-1 col-form-label"></label>
                                        <div class="col-sm-11">
                                            <select class="form-select shadow-sm" id=""></select>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label for="" class="form-label col-sm-1 col-form-label"></label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control shadow-sm" id="" placeholder="Required fill when select Requirement: Other">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="padding: 15px;">
                                <div class="col-md-7 d-flex">
                                    <h4 class="fs-5 fw-semibold me-2">Section 2 : Item Information</h4>
                                    <label class="fs-3 fw-semibold">( Max 20 Items )</label>
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
                                                    <th class="col">
                                                        <h6 class="fw-semibold mb-0">Part No.</h6>
                                                    </th>
                                                    <th class="col">
                                                        <h6 class="fw-semibold mb-0">Part Name</h6>
                                                    </th>
                                                    <th class="col">
                                                        <h6 class="fw-semibold mb-0">Model</h6>
                                                    </th>
                                                    <th class="col">
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
                                                            <input class="form-control text-center shadow-sm" type="text" id="inpTopic" placeholder="Model ...">
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
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                    <a href="javascript:void(0);" onclick="" class="btn bg-danger-subtle text-danger card-hover a"><i class="ti ti-trash me-2" style="font-size: 20px;"></i>Clear</a>
                                    <button type="button" class="btn bg-info-subtle text-info card-hover" id="btnSubmit" onclick="javascript:void(0);"><i class="ti ti-download me-2" style="font-size: 20px;"></i></i>Issue Feasibility</button>
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