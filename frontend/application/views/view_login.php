<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | Login</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/logos/icon.png" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.min.css" />
</head>


<body>
    <script>
        var API_URL = '<?php echo API_BASE_URL; ?>';
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/form_validation.css" />

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-nowrap logo-img text-center d-block  w-100">
                                    <img src="<?php echo base_url() ?>assets/images/logos/crm_icon.png" height="120" alt="">
                                </div>

                                <p class="text-center" style="font-size: 9px;">© 2024 TBKK (Thailand) Company Limited. All rights reserved.</p>
                                <form id="form_login" name="form_login">
                                    <div class="mb-3">
                                        <label for="InputUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control text-uppercase" id="InputUsername" name="su_username">
                                        <span class="form_error"></span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="InputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="InputPassword1" name="su_password">
                                        <span class="form_error"></span>
                                    </div>
                                    <a onclick="login()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="btnSignIn">Sign In</a>
                                    <!-- <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New to CRM?</p>
                                        <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                                    </div> -->
                                </form>
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <!-- <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                            Remeber this Device
                                        </label>
                                    </div> -->
                                    <a class="text-primary fw-bold" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgotPass">Forgot Password ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="forgotPass" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Forgot Password
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forgot_pass" name="forgot_pass">
                        <div class="mb-3">
                            <label for="emp_code" class="form-label fw-semibold col-sm-3 col-form-label">Code</label>
                            <input type="text" class="form-control" id="emp_code" name="su_username" placeholder="Employee code">
                            <span class="form_error"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn bg-danger-subtle text-danger  waves-effect text-start" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" type="submit" onclick="forgotPass()">
                        Submit
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/forms/form_validation.js"></script>
</body>
<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            document.getElementById('btnSignIn').click();
        }
    });

    document.getElementById('InputUsername').addEventListener('input', function(event) {
        this.value = this.value.replace(/[ก-๙]/g, '');
    });

    document.getElementById('InputUsername').addEventListener('keypress', function(event) {
        const key = event.key;
        if (/[\u0E00-\u0E7F]/.test(key)) {
            event.preventDefault();
        }
    });

    async function login() {
        event.preventDefault();
        var divLoad = `<div class="d-flex justify-content-center align-items-center gap-2">
                            <span>Sign In</span>
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`;
        $('#btnSignIn').html(divLoad);
        let chk = await login_validate();
        if (chk) {
            var login_data = {};
            $('#form_login').serializeArray().map(function(x) {
                login_data[x.name] = x.value.replace(/\s/g, "");
            });
            $.ajax({
                type: 'post',
                dataType: 'json',
                contentType: 'application/json',
                url: API_URL + 'login/login',
                data: JSON.stringify(login_data),
                success: function(result) {
                    // console.log(result);
                    if (typeof result == "string") {
                        Swal.fire({
                            html: result,
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            }
                        })
                        $('#btnSignIn').text('Sign In');
                    } else {
                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: '<?php echo base_url() ?>dashboard/login',
                            data: result,
                            success: function(res) {
                                window.location = "<?php echo base_url('Dashboard'); ?>";
                                $('#btnSignIn').text('Sign In');
                            }
                        })
                    }
                }
            })
        }
    }
    async function forgotPass() {
        event.preventDefault();
        let chk = await forgot_validate();
        if (chk) {
            var forgot_form = {};
            forgot_form["su_username"] = $('#emp_code').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: API_URL + 'email/userdata',
                data: JSON.stringify(forgot_form),
                success: function(result) {
                    if (result != false) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'JSON',
                            url: '<?php echo base_url() ?>dashboard/send_toEmail',
                            data: result,
                            success: function(data) {
                                if (data == true) {
                                    Swal.fire({
                                        html: "Please check your email.",
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
                                        html: data,
                                        icon: 'error',
                                        showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                                        hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                                    })
                                }
                            }
                        })
                    } else {
                        Swal.fire({
                            html: "<p>เกิดข้อผิดพลาดในระบบ !</p><p>Error get user data!</p>",
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
    }
</script>

</html>