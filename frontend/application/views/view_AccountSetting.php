<title>8D | Account Setting</title>
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Account Setting</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="<?php echo base_url() ?>">Admin Control</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Account Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                    <i class="ti ti-user-circle me-2 fs-6"></i>
                    <span class="d-none d-md-block">Account</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false" tabindex="-1">
                    <i class="ti ti-lock me-2 fs-6"></i>
                    <span class="d-none d-md-block">Security</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-signature-tab" data-bs-toggle="pill" data-bs-target="#pills-signature" type="button" role="tab" aria-controls="pills-signature" aria-selected="false" tabindex="-1">
                    <i class="ti ti-signature me-2 fs-6"></i>
                    <span class="d-none d-md-block">Signature</span>
                </button>
            </li>
        </ul>
        <?php
        $userId = $this->session->userdata('sessUsrId');
        $userData = $this->ManageBackend->menu_array($userId, "user/");
        ?>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12">
                            <div class=" w-100 position-relative overflow-hidden mb-0">
                                <div class="card-body p-4">
                                    <div class="row mb-3">
                                        <div class="col-lg-1">
                                            <?php
                                            $sessUsr = $this->session->userdata('sessUsr');
                                            $firstPart = substr($sessUsr, 2, 7);
                                            ?>
                                            <img src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/<?php echo $firstPart; ?>.jpg" alt="Avatar" class="img-fluid rounded-circle " width="100" height="100" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png';">
                                        </div>
                                        <div class="col-lg-6 text-align-middle">
                                            <h5 class="card-title fw-semibold">Personal Details</h5>
                                            <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                                        </div>
                                    </div>
                                    <form id="frmEditProfile" name="frmEditProfile">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="inpEmpCode" class="form-label">Code</label>
                                                    <input type="text" name="su_emp_code" value="<?php echo $userData['su_emp_code']; ?>" class="form-control" id="inpEmpCode" placeholder="xxxxx" disabled>
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inpFirstName" class="form-label">First Name</label>
                                                    <input type="text" name="su_fname" value="<?php echo $userData['su_fname']; ?>" class="form-control" id="inpFirstName" placeholder="Mathew">
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inpEmail" class="form-label">Email</label>
                                                    <input type="email" name="su_email" value="<?php echo $userData['su_email']; ?>" class="form-control" id="inpEmail" placeholder="info@modernize.com">
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="selPlant" class="form-label">Plant</label>
                                                    <select class="form-select" name="spc_id" aria-label="Default select example" id="selPlant">
                                                        <option value="" disabled selected>Choose plant</option>
                                                        <?php
                                                        $option_plant = $this->ManageBackend->list_option("option/list_plant");
                                                        foreach ($option_plant as $plant) {
                                                            $sel = "";
                                                            if ($plant['spc_id'] == $userData['spc_id']) {
                                                                $sel = "selected";
                                                            }
                                                            echo '<option value="' . $plant['spc_id'] . '" ' . $sel . '>' . $plant['spc_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="selPermissionGroup" class="form-label">Permission Group</label>
                                                    <select class="form-select" name="spg_id" aria-label="Default select example" id="selPermissionGroup" disabled>
                                                        <option value="" disabled selected>Choose permission group</option>
                                                        <?php
                                                        $option_spg = $this->ManageBackend->list_option("option/list_spg");
                                                        foreach ($option_spg as $op_spg) {
                                                            $sel = "";
                                                            if ($op_spg['spg_id'] == $userData['spg_id']) {
                                                                $sel = "selected";
                                                            }
                                                            echo '<option value="' . $op_spg['spg_id'] . '" ' . $sel . '>' . $op_spg['spg_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inpLastName" class="form-label">Last Name</label>
                                                    <input type="text" name="su_lname" value="<?php echo $userData['su_lname']; ?>" class="form-control" id="inpLastName" placeholder="Anderson">
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inpTel" class="form-label">Phone number</label>
                                                    <input type="text" name="su_tel" value="<?php echo $userData['su_tel']; ?>" class="form-control" id="inpTel" placeholder="092xxxxxxx">
                                                    <span class="form_error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="selDept" class="form-label">Department</label>
                                                    <select class="form-select" name="sd_id" aria-label="Default select example" id="selDept">
                                                        <option value="" disabled selected>Choose Department</option>
                                                        <?php
                                                        $option_dept = $this->ManageBackend->list_option("option/list_department");
                                                        foreach ($option_dept as $dept) {
                                                            $sel = "";
                                                            if ($dept['sd_id'] == $userData['sd_id']) {
                                                                $sel = "selected";
                                                            }
                                                            echo '<option value="' . $dept['sd_id'] . '" ' . $sel . '>' . $dept['sd_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="form_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                    <input type="hidden" value="<?php echo $userData['su_id']; ?>" name="su_id">
                                                    <button type="button" class="btn btn-primary" id="btnUpdateAccount" onclick="updateUser()">Save</button>
                                                    <button type="reset" class="btn bg-danger-subtle text-danger">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                    <div class="row">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold">Change Password</h5>
                            <p class="card-subtitle mb-4">To change your password please confirm here</p>
                            <form id="frmChangePassword" name="frmChangePassword">
                                <div class="mb-3 col-12">
                                    <label for="inpPassword" class="form-label">Change Password</label>
                                    <input type="password" class="form-control" name="su_password" id="inpPassword" placeholder="Enter new password">
                                    <span class="form_error"></span>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="inpConfirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="chk_password" id="inpConfirmPassword" placeholder="Enter confirm password">
                                    <span class="form_error"></span>
                                </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-6">
                                <input type="hidden" value="<?php echo $userData['su_id']; ?>" name="su_id" id="su_id">
                                <button type="button" class="btn btn-primary" id="btnUpdatePassword" onclick="updatePassword()">Save</button>
                                <button type="reset" class="btn bg-danger-subtle text-danger">Cancel</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-signature" role="tabpanel" aria-labelledby="pills-signature-tab" tabindex="0">
                    <div class="row">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold">Signature</h5>
                            <p class="card-subtitle mb-4">To change your signature please confirm here</p>
                            <form id="frmSignature" name="frmSignature" enctype="multipart/form-data">
                                <input type="file" id="imageUpload" onchange="imageUploads()" class="form-control" accept="image/*">
                                <div class="image-preview form-control mt-3 mx-auto" id="imagePreview">
                                    <span id="imagePreviewText">No picture has been selected.</span>
                                    <?php $sessUsr = $this->session->userdata('sessUsr'); ?>
                                    <img src="assets/images/uploaded/signature/<?php echo $sessUsr ?>_signature.png" id="imagePreviewImg" class="" onload="document.getElementById('imagePreviewText').style.display='none';" onerror="this.style.display='none';">
                                </div>

                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-6">
                                <input type="hidden" value="<?php echo $userData['su_id']; ?>" name="su_id" id="su_id">
                                <button type="button" class="btn btn-primary" id="downloadBtn" onclick="saveSignature()" style="display:none;">Save</button>
                                <button type="reset" class="btn bg-danger-subtle text-danger">Cancel</button>
                                <canvas id="canvas" style="display:none;"></canvas>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function imageUploads() {
        const imageUpload = document.getElementById('imageUpload');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImg = document.getElementById('imagePreviewImg');
        const imagePreviewText = imagePreview.querySelector('span');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const downloadBtn = document.getElementById('downloadBtn');
        const file = imageUpload.files[0];

        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                const img = new Image();
                img.src = this.result;

                img.onload = function() {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);

                    // การตัดพื้นหลัง (เบื้องต้น)
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const data = imageData.data;

                    for (let i = 0; i < data.length; i += 4) {
                        const r = data[i];
                        const g = data[i + 1];
                        const b = data[i + 2];

                        // หากเป็นสีขาว (หรือใกล้เคียง) ทำให้โปร่งใส
                        if (r > 200 && g > 200 && b > 200) {
                            data[i + 3] = 0; // ตั้งค่า alpha เป็น 0 (โปร่งใส)
                        }
                    }

                    ctx.putImageData(imageData, 0, 0);
                    const pngUrl = canvas.toDataURL('image/png');

                    imagePreviewText.style.display = "none";
                    imagePreviewImg.style.display = "block";
                    imagePreviewImg.src = pngUrl;

                    downloadBtn.style.display = "block";
                    downloadBtn.href = pngUrl;
                };
            });

            reader.readAsDataURL(file);
        }
    }
    async function saveSignature() {
        var data = {};
        data['su_id'] = $('#su_id').val();
        data['image'] = canvas.toDataURL('image/png');
        data['update_date'] = getTimeNow();
        data['update_by'] = "<?php echo $this->session->userdata('sessUsr') ?>";
        const link = document.createElement('a');
        // console.log(data);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>AccountSetting/saveSignature",
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: async function(resData) {
                        var newData = JSON.parse(resData);
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            contentType: 'application/json',
                            url: API_URL + 'update/signature',
                            data: JSON.stringify(newData),
                            success: await
                            function(resData) {
                                if (resData != false) {
                                    Swal.fire({
                                        html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit personal detail success!</p>",
                                        icon: 'success',
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit personal detail!</p>",
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
                });
            }
        })

    }
    async function updateUser() {
        event.preventDefault();
        let chk = await settingUser_validate();
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
                    $('#frmEditProfile').serializeArray().forEach(function(item) {
                        if (item.name == 'spc_id' || item.name == 'spg_id' || item.name == 'su_id' || item.name == 'sd_id') {
                            item.value = parseInt(item.value)
                        }
                        edit_form[item.name] = item.value;
                    })
                    edit_form["update_date"] = getTimeNow();
                    edit_form["update_by"] = "<?php echo $this->session->userdata('sessUsr') ?>";

                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'setting/user',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit personal detail success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit personal detail!</p>",
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
    async function updatePassword() {
        event.preventDefault();
        let chk = await settingPsw_validate();
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
                    var edit_form = {
                        "su_id": parseInt($('#su_id').val()),
                        "su_password": $('#inpPassword').val(),
                        "update_date": getTimeNow(),
                        "update_by": "<?php echo $this->session->userdata('sessUsr') ?>"
                    };
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: API_URL + 'setting/password',
                        data: JSON.stringify(edit_form),
                        success: function(data) {
                            if (data != false) {
                                Swal.fire({
                                    html: "<p>บันทึกข้อมูลเสร็จสิ้น !</p><p>Edit password success!</p>",
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                })
                            } else {
                                Swal.fire({
                                    html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error edit password!</p>",
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
    $(document).ready(function() {

    });
</script>