<title>CRM | Dashboard</title>
<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Sales Overview</h5>
                        </div>
                        <div>
                            <select class="form-select" id="selMonthChart">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="fw-semibold mb-3">$36,358</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-up-left text-success"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2023</span>
                                        </div>
                                        <div>
                                            <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2023</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="breakup"></div>
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
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                                    <h4 class="fw-semibold mb-3">$6,820</h4>
                                    <div class="d-flex align-items-center pb-1">
                                        <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-down-right text-danger"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="earning"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0 col-lg-3">
                            <select class="form-select" id="selRfqChart">
                                <option value="2023">RFQ-2023</option>
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
                                <div class="col-12">
                                    <p class="card-title mb-3 fw-semibold text-center"><u>DETAILS</u></p>
                                </div>
                                <div class="col-12">
                                    <p class="fw-semibold text-center" id="rfqNo"></p>
                                    <p class="fw-semibold text-center" id="sentDate"><strong>Sent Date </strong>05 Jul 24</p>
                                    <p class="fw-semibold text-center" id="dueDate"><strong>Due Date </strong>10 Jul 24</p>
                                </div>
                                <div class="col-12">
                                    <p class="card-title mb-3 fw-semibold text-center"><u>STATUS</u></p>
                                </div>
                                <div class="col-12 d-flex align-items-center justify-content-center" id="dashStatus">
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
    function formatDate(date) {
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var day = date.getDate();
        var month = months[date.getMonth()];
        var year = date.getFullYear().toString().slice(-2);

        return `${day < 10 ? '0' + day : day} ${month} ${year}`;
    }

    $(document).ready(function() {
        // var firstRowData = $('#tblChartBody tr:first-child td:first-child').text();

        $('#tblChart tbody').on('click', 'tr', function() {
            $('#tblChart tbody tr').removeClass('selected-row');
            $(this).addClass('selected-row');

            var rfqNo = $(this).find('td:first').text();
            $('#rfqNo').html('<strong>No. </strong>' + rfqNo);
            $('#sentDate').html('<strong>Sent Date </strong>' + getRandomDate());
            $('#dueDate').html('<strong>Due Date </strong>' + getRandomDate());
        });

    });
</script>