<title>CRM | Remaining Task</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Task Control</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Task Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Remaining Task</li>
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
                        <h4 class="mb-3">Document Information</h4>
                        <div class="alert alert-light-danger bg-danger-subtle text-danger" role="alert">
                            <div class="d-flex align-items-center mb-2">
                                <i class="ti ti-alert-triangle text-danger me-2" style="font-size: 3rem !important;"></i>
                                <label class="alert-heading fw-semibold" style="font-size: 1.5rem !important;"> Alert!</label>
                            </div>
                            <hr>
                            <p>You have 3 tasks left waiting to be approved.</p>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblNBC" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Document No.</th>
                                            <th class="text-center">Refer Doc No.</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Workflow Detail</th>
                                            <th class="text-center">Issued Date</th>
                                            <th class="text-center">Issued By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">RFQ</td>
                                            <td class="text-center">
                                                NBC-SM-2024-001
                                            </td>
                                            <td class="text-center">
                                                <span>-</span>
                                            </td>
                                            <td class="text-center">ISUZU Co., Ltd.</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <label>KK 1</label>
                                                    <i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>
                                                    <label>KK 2</label>
                                                    <i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>
                                                    <label>KK 3</label>
                                                </div>
                                            </td>
                                            <td class="text-center">30/11/2024</td>
                                            <td class="text-center">Kyoko</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-center">NBC</td>
                                            <td class="text-center">
                                                NBC-SM-2024-002
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-002</span>
                                            </td>
                                            <td class="text-center">MAHLE Co., Ltd..</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <label>Tripoom</label>
                                                    <i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>
                                                    <label>Chawalit</label>
                                                </div>
                                            </td>
                                            <td class="text-center">18/12/2024</td>
                                            <td class="text-center">Kantamanee</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                                                        <i class="ti ti-file-search" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-center">Feasibility</td>
                                            <td class="text-center">
                                                FM-SM-2024-003
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-white fw-semibold fs-3 gap-1 d-inline-flex align-items-center shadow-sm" style="background-color: #a345efe6 !important;">RFQ-SM-2024-003</span>
                                            </td>
                                            <td class="text-center">Kubota Co., Ltd.</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <label>Kyoko</label>
                                                    <i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>
                                                    <label>Sirote</label>
                                                    <i class="ti ti-chevrons-right text-success fw-semibold" style="font-size: 1.5rem !important;"></i>
                                                    <label>Horikoshi</label>
                                                </div>
                                            </td>
                                            <td class="text-center">20/11/2024</td>
                                            <td class="text-center">Kantamanee</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-evenly gap-1">
                                                    <button type="button" class="btn bg-warning-subtle text-warning rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="ti ti-zoom-exclamation" data-bs-target="#mdlViewEdit" data-bs-toggle="modal" style="font-size: 1.5rem !important;"></i>
                                                    </button>
                                                    <button id="btnPDF" class="btn bg-secondary-subtle text-secondary rounded-circle round-40 btn-sm d-inline-flex align-items-center justify-content-center shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
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
                <!-- end Zero Configuration -->
            </div>
        </div>
    </div>
</div>