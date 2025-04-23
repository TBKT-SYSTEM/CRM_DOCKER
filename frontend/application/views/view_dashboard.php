<title>CRM | Dashboard</title>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0 col-lg-3">
                            <select class="form-select" id="selRfqChart">
                                <option value="2025">RFQ-2025</option>
                                <option value="2024">RFQ-2024</option>
                            </select>
                        </div>
                        <div>
                            <select class="form-select" id="selTypeChart">
                                <option value="1">Month</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart-test"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                <div class="mb-2 mb-sm-0 col-lg-12" id="month_click">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="tblChart" class="dataTable table table-bordered text-nowrap align-middle table-hover" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblChartBody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="item-detail">
                                    <div class="col-12">
                                        <p class="card-title mb-3 fw-semibold text-center"><u>DETAILS</u></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fw-semibold text-center" id="rfqNo"></p>
                                        <p class="fw-semibold text-center" id="sentDate"><strong>Sent Date </strong>05 Jul 24</p>
                                        <p class="fw-semibold text-center" id="dueDate"><strong>Due Date </strong>10 Jul 24</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="card-title mb-3 fw-semibold text-center item-detail"><u>STATUS</u></p>
                                </div>
                                <div class="col-12 d-flex align-items-center justify-content-around" id="dashStatus">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const BASE_URL = "<?php echo base_url(); ?>";
</script>