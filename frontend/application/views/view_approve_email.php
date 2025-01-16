<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | Login</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/logos/crm_icon_short.png" />
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
                                    <a onclick="login(event)" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="btnSignIn">Sign In for Approval</a>
                                </form>
                            </div>
                        </div>
                    </div>
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

    async function login(event) {
        event.preventDefault();
        const urlParams = new URLSearchParams(window.location.search);
        const documentParam = urlParams.get('document');
        let chk = await login_validate();
        if (chk) {
            var login_data = {};
            $('#form_login').serializeArray().map(function(x) {
                login_data[x.name] = x.value;
            });
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we load the data and initialize the form.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: API_URL + 'login/approve_email/' + documentParam,
                data: JSON.stringify(login_data),
                success: function(result) {
                    console.log(result);
                    if (typeof result == "string") {
                        Swal.fire({
                            html: result,
                            icon: 'error',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            }
                        });
                        $('#btnSignIn').text('Sign In for Approval');
                    } else {
                        Swal.fire({
                            html: '<p>Approve เอกสาร สำเร็จ</p>',
                            icon: 'success',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            showConfirmButton: true,
                            timer: 5000
                        }).then((result) => {
                            window.close();
                        })
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        html: `<p>เกิดข้อผิดพลาด: ${error}</p>`,
                        icon: 'error',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    });
                    $('#btnSignIn').text('Sign In for Approval');
                }
            });
        }
    }
</script>

</html>