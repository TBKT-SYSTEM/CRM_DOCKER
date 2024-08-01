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
                                            <th>Part No.</th>
                                            <th>Updated Date</th>
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
                                    <input type="text" class="border-transparent" id="editRef" placeholder="Ref." disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editDate" class="form-label fw-semibold">Date</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="date" class="border-transparent" id="editDate" placeholder="Date" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editCustomer" class="form-label fw-semibold">Customer</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editCustomer" placeholder="Customer" disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editImportFrom" class="form-label fw-semibold">Import From</label></th>
                                <th colspan="8" class="b-bottom">
                                    <select id="editImportFrom" class="border-transparent" disabled></select>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editPartNo" class="form-label fw-semibold">Part No.</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editPartNo" placeholder="Part No." disabled>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editPartName" class="form-label fw-semibold">Part Name</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="text" class="border-transparent" id="editPartName" placeholder="Part Name" disabled>
                                    <span class="form_error"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><label for="editRequirement" class="form-label fw-semibold">Requirement</label></th>
                                <th colspan="8" class="b-bottom">
                                    <select id="editRequirement" class="border-transparent" disabled></select>
                                    <span class="form_error"></span>
                                </th>
                                <th colspan="2"><label for="editDuedate" class="form-label fw-semibold">Due date</label></th>
                                <th colspan="8" class="b-bottom">
                                    <input type="date" class="border-transparent" id="editDuedate" placeholder="Due date" disabled>
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
                            <tr>
                                <td colspan="3">Scoring meaning :</td>
                                <td colspan="17">5 = High potential , 4 = Potential , 3 = Potential with condition.</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="17">2 = Need study for scenarior , 1 = Can't meet requirement</td>
                            </tr>
                            <tr>
                                <td colspan="20" style="font-weight: bold;font-size: 20px">Conclusion</td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: LightGreen;">Green</td>
                                <td class="full-border chk_score text-center" id="chk_green"></td>
                                <td colspan="17">Feasible&No Risk (Score = 90-100) Product can be produced as specified with no revisions.</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: Yellow;">Yellow</td>
                                <td class="full-border chk_score text-center" id="chk_yellow"></td>
                                <td colspan="17">Yellow = Feasible&NoRisk (Score 70-89) Need recommended or Other requirment (see attached).</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="full-border text-center" style="background-color: Red;">Red</td>
                                <td class="full-border chk_score text-center" id="chk_red"></td>
                                <td colspan="17">Red = Not Feasible&Risk (Score < 69) Design revision required to produce product within the specified</td>
                            </tr>
                            <tr height="25px"></tr>
                            <tr>
                                <td colspan="20" style="font-weight: bold;font-size: 20px">Sign-Off</td>
                            </tr>
                            <tr height="25px"></tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Production Engineering</td>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Research and Development</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr height="25px"></tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Sales and Marketing</td>
                                <td colspan="2"></td>
                                <td colspan="7" class="b-top text-center">Purchasing</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr height="25px"></tr>
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
                                <td colspan="5">FM-S&M-015/02/19 JAN 2018</td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" id="if_id" name="if_id">
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="previewPDF()" class="btn bg-info-subtle text-info waves-effect text-start">
                    PDF
                </button> -->
                <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" type="submit" onclick="submitScoring()">
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

    function editComment(mc_id, if_id, element) {
        event.preventDefault();
        console.log(element.value);
        var sending = {};
        sending['mc_id'] = mc_id;
        sending['if_id'] = if_id;
        sending['Ifcp_comment'] = element.value;
        sending["update_date"] = getTimeNow();
        sending["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
        $.ajax({
            type: 'PUT',
            dataType: 'json',
            contentType: 'application/json',
            url: API_URL + 'manage_feasibility/commenting',
            data: JSON.stringify(sending),
            success: function(data) {
                console.log(data);
            },
            error: function(err) {
                console.log(err)
            }
        })
    }

    function editFile(mc_id, if_id, element) {
        var imgcon = "#file_show" + mc_id;
        if (element.files && element.files[0]) {
            var imgType = element.files[0]['type'];
            var chk = imgType.split("/");
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgcon).css("display", "block");
                if (chk[0] != "application") {
                    img1 = '<button class="text-block" onclick="view_img_filenew(\'' + e.target.result + '\')"><span class="material-symbols-outlined">find_in_page</span></button>';
                    $(imgcon).html(img1);
                } else {
                    URL.revokeObjectURL(element.files[0])
                    imgLink1 = '<button class="text-block" onclick="view_pdf_filenew(\'' + URL.createObjectURL(element.files[0]) + '\')"><span class="material-symbols-outlined">find_in_page</span></button>';
                    $(imgcon).html(imgLink1);
                }
            }
            reader.readAsDataURL(element.files[0]);

            var inputId = "#upload_file" + mc_id;
            var file_data = $(inputId).prop('files')[0];
            var form_data = new FormData();
            form_data.append('picture', file_data);
            $.ajax({
                url: '<?php echo base_url(); ?>FeasibilityForm/uploadImage',
                type: "POST",
                dataType: 'json',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data['data']);
                    if (data != false) {
                        let updateFile = {};
                        updateFile['mc_id'] = mc_id;
                        updateFile['if_id'] = if_id;
                        updateFile['ifcp_file_name'] = data['data']['ifcp_file_name'];
                        updateFile['ifcp_file_path'] = data['data']['ifcp_file_path'];
                        updateFile["update_date"] = getTimeNow();
                        updateFile["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";
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
                }
            });
        } else {
            $(imgcon).css("display", "none");
        }
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
        $('#if_id').val(id);
        $.ajax({
            type: 'get',
            url: API_URL + 'feasibility/' + id,
            success: function(result) {
                $('#editRef').val(result.if_ref);
                $('#editDate').val(result.create_date.substring(0, 10));
                $('#editDuedate').val(result.if_duedate.substring(0, 10));
                $('#editCustomer').val(result.if_customer);
                let importText = '<option value="" disabled selected>Import From</option>' +
                    '<option value="1" ' + ((result.if_import_tran == 1) ? 'selected' : '') + '>Oversea</option>' +
                    '<option value="2" ' + ((result.if_import_tran == 2) ? 'selected' : '') + '>Domestic</option>';
                $('#editImportFrom').html(importText);
                $('#editPartNo').val(result.if_part_no);
                $('#editPartName').val(result.if_part_name);
                listRequirement(result.mrt_id);
                viewFeasibility(id);
            }
        })
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
        var arr_scorable = await scorableInput(id);
        var con_arr = [];
        // console.log(id)
        $('.img_container').css("display", "none");
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
            var bg_color = ' style="background-color: lightgray;"'
            var input = ' disabled';
            var hover = '',
                fileLink = "";
            $.each(arr_scorable, function(skey, sval) {
                if (value.data.mc_id == sval.mc_id) {
                    bg_color = '';
                    input = '';
                    hover = ' hoverable';
                }
            })
            if (value.data.ifcp_file_name != null && value.data.ifcp_file_name != "") {
                if (value.data.ifcp_file_name.slice(-4) == ".pdf") {
                    fileLink = '<button class="text-block" onclick="view_pdf_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
                } else {
                    fileLink = '<button class="text-block" onclick="view_img_file(\'' + value.data.ifcp_file_path + '\')"' + input + '><span class="material-symbols-outlined">find_in_page</span></button>';
                }
            }
            table_text += '<tr' + bg_color + '>' +
                '<td colspan="2" class="text-center" id="weight' + value.data.mc_id + '">' + value.data.mc_weight + '</td>' +
                '<td colspan="2" class="text-center"><input type="number" style="width: 100%;" onblur="editScore(' + value.data.mc_id + ',' + id + ',this)" value="' + value.data.ifcp_score + '"' + input + '><span class="form_error"></span></td>' +
                '<td class="text-center inputScore" id="total' + value.data.mc_id + '">' + (value.data.mc_weight * value.data.ifcp_score) + '</td>' +
                '<td colspan="11">' + value.data.mc_title + '</td>' +
                '<td colspan="5"><textarea onblur="editComment(' + value.data.mc_id + ',' + id + ',this)" style="width: 100%;" rows=""' + input + '>' + value.data.ifcp_comment + '</textarea></td>' +
                '<td class="text-center">' +
                '<div class="img_container" id="file_show' + value.data.mc_id + '">' + fileLink + '</div>' +
                '<label for="upload_file' + value.data.mc_id + '"><span class="material-symbols-outlined' + hover + '">note_add</span></label>' +
                '<input type="file" id="upload_file' + value.data.mc_id + '" style="width: 100%;" onchange="editFile(' + value.data.mc_id + ',' + id + ',this)" accept="image/png, image/jpg, image/jpeg, application/pdf"' + input + ' hidden>' +
                '</td>' +
                '<td colspan="2" class="text-center">';
            if (value.incharge.length > 0) {
                var innum = false;
                $.each(value.incharge, function(inkey, inval) {
                    if (innum) {
                        table_text += '/';
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
    async function scorableInput(id) {
        try {
            var result = await $.ajax({
                type: 'GET',
                url: API_URL + "view/scorable/" + id + "/<?php echo $this->session->userdata('sessDeptId') ?>",
            });
            return result;
        } catch (err) {
            console.log(err);
            throw err;
        }
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

    function view_pdf_filenew(link) {
        event.preventDefault();
        $('#view_pdf_file').fadeIn(500).modal('show');
        link_pdf = '<object data="' + link + '" type="application/pdf" width="100%" height="650px">' +
            '<p>Unable to display PDF file. <a href="' + link + '">Download</a> instead.</p>' +
            '</object>';
        $("#view_pdf_content").html(link_pdf);
    }

    function view_img_filenew(link) {
        event.preventDefault();
        $('#view_pdf_file').fadeIn(500).modal('show');
        link_img = '<img src="' + link + '" width="100%">';
        $("#view_pdf_content").html(link_img);
    }

    $(document).ready(function() {
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
                    data: 'if_part_no'
                },
                {
                    className: 'text-center',
                    data: 'update_date'
                },
                {
                    className: 'text-center',
                    data: 'update_by',
                    "render": function(data, type, row) {
                        if (type === 'display') {
                            if (row.update_by != "") {
                                let img_ok = 'http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/' + row.update_by + '.jpg';
                                if (!is_cached(img_ok)) {
                                    img_ok = 'http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';
                                }
                                disp = '<div class="d-flex align-items-center">' +
                                    '<img src="' + img_ok + '" alt="avatar" class="rounded-circle avatar" width="35">' +
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
                            disp = '<button type="button" onclick="editModal(\'' + row.if_id + '\')" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlEdits">' +
                                '<i class="ti ti-pencil me-1"></i> Score </button>';
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
        }, 1000);
    });
</script>