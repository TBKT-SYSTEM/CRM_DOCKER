<title>CRM | Manage Feasibility</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Manage Feasibility</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Manage Feasibility</li>
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
                                <!-- <button type="button" class="btn bg-primary-subtle text-primary">
                                    To do <span class="badge bg-primary">4</span>
                                </button>
                                <button type="button" class="btn bg-danger-subtle text-danger">
                                    Over due <span class="badge bg-warning">4</span>
                                </button>
                                <button type="button" class="btn bg-success-subtle text-success">
                                    Complete <span class="badge bg-success">4</span>
                                </button> -->
                            </div>
                        </div>
                        <div class="row border" style="padding: 15px;">
                            <div class="table-responsive">
                                <table id="tblFeasibility" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            <th>No.</th>
                                            <th>Costomer</th>
                                            <th>Issue Date</th>
                                            <th>Updated By</th>
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

<!-- Modal for edit Feasibility -->
<div class="modal fade" id="mdlEditScore" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Manage Score
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <!-- start Zero Configuration -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row border" style="padding: 15px;">
                                    <div class="col-md-7">
                                        <div class="hstack pb-1">
                                            <div class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                                <i class="text-primary ti ti-numbers fs-6"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1 fs-4 fw-semibold">Cosiderations List</h4>
                                                <p class="fs-3 mb-0">Table for show</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-end">

                                    </div>
                                </div>
                                <div class="row border" style="padding: 15px;">
                                    <div class="table-responsive">
                                        <table id="tblConList" class="dataTable table  table-bordered text-nowrap align-middle" style="width: 100%;">
                                            <thead>
                                                <!-- start row -->
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Consideration</th>
                                                    <th>Weight</th>
                                                    <th>Score</th>
                                                    <th>Comment</th>
                                                    <th>File</th>
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
    </div>
</div>

<script>
    function submitScoring() {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            var sending = {};
            sending['sd_id'] = <?php echo $this->session->userdata('sessDeptId') ?>;
            sending['if_id'] = parseInt($("#if_id").val());
            sending['Ifcp_submit'] = 1;
            sending["update_date"] = getTimeNow();
            sending["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                contentType: 'application/json',
                url: API_URL + 'manage_feasibility/submit',
                data: JSON.stringify(sending),
                success: function(data) {
                    if (data != false) {
                        Swal.fire({
                            html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>submit form success!</p>",
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
                            html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error submit form!</p>",
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
                    console.log(err)
                }
            })
        })
    }
    async function editScore(mc_id, if_id, element) {
        event.preventDefault();
        let chk = await scoring_validate(element);
        if (chk) {
            var sending = {};
            sending['mc_id'] = mc_id;
            sending['if_id'] = if_id;
            sending['ifcp_score'] = parseFloat(element.value);
            sending["update_date"] = getTimeNow();
            sending["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                contentType: 'application/json',
                url: API_URL + 'manage_feasibility/scoring',
                data: JSON.stringify(sending),
                success: function(data) {
                    var weight = $("#weight" + mc_id).text();
                    $("#total" + mc_id).text(parseFloat(weight) * parseFloat(element.value));

                    var fLastTotal = 0;
                    var slides = document.getElementsByClassName("inputScore");
                    for (let i = 0; i < slides.length; i++) {
                        fLastTotal += parseFloat(slides[i].innerHTML);
                    }
                    checkConclusion(fLastTotal);
                    $("#lastTotal").text(fLastTotal);
                },
                error: function(err) {
                    console.log(err)
                }
            })
        }
    }

    // function editComment(mc_id, if_id, element) {
    //     event.preventDefault();
    //     console.log(element.value);
    //     var sending = {};
    //     sending['mc_id'] = mc_id;
    //     sending['if_id'] = if_id;
    //     sending['Ifcp_comment'] = element.value;
    //     sending["update_date"] = getTimeNow();
    //     sending["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
    //     $.ajax({
    //         type: 'PUT',
    //         dataType: 'json',
    //         contentType: 'application/json',
    //         url: API_URL + 'manage_feasibility/commenting',
    //         data: JSON.stringify(sending),
    //         success: function(data) {
    //             console.log(data);
    //         },
    //         error: function(err) {
    //             console.log(err)
    //         }
    //     })
    // }

    // function editFile(mc_id, if_id, element) {
    //     var imgcon = "#file_show" + mc_id;
    //     if (element.files && element.files[0]) {
    //         var imgType = element.files[0]['type'];
    //         var chk = imgType.split("/");
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $(imgcon).css("display", "block");
    //             if (chk[0] != "application") {
    //                 img1 = '<button class="text-block" onclick="view_img_filenew(\'' + e.target.result + '\')"><span class="material-symbols-outlined">find_in_page</span></button>';
    //                 $(imgcon).html(img1);
    //             } else {
    //                 URL.revokeObjectURL(element.files[0])
    //                 imgLink1 = '<button class="text-block" onclick="view_pdf_filenew(\'' + URL.createObjectURL(element.files[0]) + '\')"><span class="material-symbols-outlined">find_in_page</span></button>';
    //                 $(imgcon).html(imgLink1);
    //             }
    //         }
    //         reader.readAsDataURL(element.files[0]);

    //         var inputId = "#upload_file" + mc_id;
    //         var file_data = $(inputId).prop('files')[0];
    //         var form_data = new FormData();
    //         form_data.append('picture', file_data);
    //         $.ajax({
    //             url: '<?php echo base_url(); ?>FeasibilityForm/uploadImage',
    //             type: "POST",
    //             dataType: 'json',
    //             data: form_data,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             success: function(data) {
    //                 // console.log(data['data']);
    //                 if (data != false) {
    //                     let updateFile = {};
    //                     updateFile['mc_id'] = mc_id;
    //                     updateFile['if_id'] = if_id;
    //                     updateFile['ifcp_file_name'] = data['data']['ifcp_file_name'];
    //                     updateFile['ifcp_file_path'] = data['data']['ifcp_file_path'];
    //                     updateFile["update_date"] = getTimeNow();
    //                     updateFile["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
    //                     $.ajax({
    //                         type: 'PUT',
    //                         dataType: 'json',
    //                         contentType: 'application/json',
    //                         url: API_URL + 'manage_feasibility/file',
    //                         data: JSON.stringify(updateFile),
    //                         success: function(data) {
    //                             console.log(data);
    //                         },
    //                         error: function(err) {
    //                             console.log(err)
    //                         }
    //                     })
    //                 } else {
    //                     Swal.fire({
    //                         html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error update file!</p>",
    //                         icon: 'error',
    //                         showClass: {
    //                             popup: 'animate__animated animate__fadeInDown'
    //                         }
    //                     })
    //                 }
    //             }
    //         });
    //     } else {
    //         $(imgcon).css("display", "none");
    //     }
    // }

    async function alertData(ifcp_id) {
        var row = $(event.target).closest('tr');

        var table = $('#tblConList').DataTable();
        var rowData = table.row(row).data();

        var score = row.find('input[type="number"]').val();
        var comment = row.find('textarea').val();

        var fileInput = row.find('input[type="file"]')[0];
        var file = fileInput.files[0];

        alert('ID: ' + ifcp_id +
            '\nif_id: ' + rowData['if_id'] +
            '\nScore: ' + score +
            '\nComment: ' + comment +
            '\nFile: ' + file);

        let chk = await scoring_validate(row.find('input[type="number"]'));
        if (chk) {

            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                var form_data = new FormData();
                form_data.append('picture', file);
                $.ajax({
                    url: '<?php echo base_url(); ?>FeasibilityForm/uploadImage',
                    type: "POST",
                    dataType: 'json',
                    data: form_data, // ส่ง FormData ที่มีไฟล์
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data != false) {
                            console.log("has file");
                            let updateFile = {};
                            updateFile['ifcp_id'] = ifcp_id;
                            updateFile['if_id'] = rowData['if_id'];
                            updateFile['ifcp_file_name'] = data['data']['ifcp_file_name'];
                            updateFile['ifcp_file_path'] = data['data']['ifcp_file_path'];
                            updateFile["update_date"] = getTimeNow();
                            updateFile["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                            if (score !== null && score !== undefined && score !== "") {
                                updateFile['ifcp_score'] = score;
                            }

                            if (comment !== null && comment !== undefined && comment !== "") {
                                updateFile['ifcp_comment'] = comment;
                            } else {
                                updateFile['ifcp_comment'] = "";
                            }
                            console.log(updateFile);
                            return;
                            $.ajax({
                                type: 'PUT',
                                dataType: 'json',
                                contentType: 'application/json',
                                url: API_URL + 'manage_feasibility/file',
                                data: JSON.stringify(updateFile),
                                success: function(data) {
                                    console.log(data);
                                },
                                error: function(err) {
                                    console.log(err)
                                }
                            })
                        } else {
                            Swal.fire({
                                html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error update file!</p>",
                                icon: 'error',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                }
                            })
                        }
                    },
                    error: function(err) {
                        console.log("Upload error:", err);
                    }
                });
            } else {
                console.log("no file");

                let updateFile = {};
                updateFile['ifcp_id'] = ifcp_id;
                updateFile['if_id'] = rowData['if_id'];
                updateFile["update_date"] = getTimeNow();
                updateFile["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                if (score !== null && score !== undefined && score !== "") {
                    updateFile['ifcp_score'] = score;
                }

                if (comment !== null && comment !== undefined && comment !== "") {
                    updateFile['ifcp_comment'] = comment;
                } else {
                    updateFile['ifcp_comment'] = "";
                }

                console.log(updateFile);
                return;
                $.ajax({
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: API_URL + 'manage_feasibility/noFile',
                    data: JSON.stringify(updateFile),
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }
        }
    }


    // modal --------------------------------------
    function editModal(id) {
        event.preventDefault();
        if ($.fn.DataTable.isDataTable('#tblConList')) {
            $('#tblConList').DataTable().destroy();
        }
        var dataTable = $('#tblConList').DataTable({
            ajax: {
                url: API_URL + 'manage_feasibility/table_consern/' + id + '/<?php echo $this->session->userdata('sessDeptId') ?>'
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
                    className: 'text-center col-1',
                    data: 'ifcp_id'
                },
                {
                    className: 'text-center text-wrap col-4',
                    data: 'mc_title',
                },
                {
                    className: 'text-center col-1',
                    data: 'mc_weight',
                },
                {
                    className: 'text-center col-1',
                    data: 'if_id',
                    "render": function(data, type, row) {
                        var score = '';
                        if (type === 'display') {
                            score = '<input type="number" name="ifcp_score_edit" min="1" max="5" class="form-control" value="' + row.ifcp_score + '" >' +
                                '<span class="form_error text-wrap"></span>';
                        }
                        return score;
                    }
                },
                {
                    className: 'text-center col-2',
                    data: 'ifcp_comment',
                    "render": function(data, type, row) {
                        var score = '';
                        if (type === 'display') {
                            score = '<textarea class="form-control" name="ifcp_comment_edit" rows="2">' + row.ifcp_comment + '</textarea>';
                        }
                        return score;
                    }
                },
                {
                    className: 'text-center',
                    data: 'ifcp_file_name',
                    "render": function(data, type, row) {
                        var score = '';
                        if (type === 'display') {
                            score = '<input type="file" name="ifcp_file_name_edit" class="form-control form-control-sm" value="' + row.ifcp_file_name + '" >';
                        }
                        return score;
                    }
                },
                {
                    className: 'text-center col-1',
                    data: 'if_id',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            disp = '<button type="button" onclick="alertData(' + row.ifcp_id + ')" class="btn bg-success-subtle text-success">' +
                                '<i class="ti ti-device-floppy fs-6"></i></button>';
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
    }

    $(document).ready(function() {
        testApi();
        if ($.fn.DataTable.isDataTable('#tblFeasibility')) {
            $('#tblFeasibility').DataTable().destroy();
        }
        var dataTable = $('#tblFeasibility').DataTable({
            ajax: {
                url: API_URL + 'manage_feasibility/table/<?php echo $this->session->userdata('sessDeptId') ?>'
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
                    data: 'ifcp_id'
                },
                {
                    className: 'text-center',
                    data: 'if_customer',
                },
                {
                    className: 'text-center',
                    data: 'create_date'
                },
                {
                    className: 'text-center d-flex justify-content-center',
                    data: 'update_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            let emp_code = row.update_by.substring(2, 7);
                            if (row.update_by != "") {
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + emp_code + '.jpg';
                                disp = '<div class="d-flex align-items-center">' +
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
                            disp = '<button type="button" onclick="editModal(\'' + row.if_id + '\')" class="btn btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#mdlEditScore">' +
                                '<i class="ti ti-edit fs-5"></i></button>';
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