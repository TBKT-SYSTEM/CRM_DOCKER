<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | E-Mail / Approve</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/logos/crm_icon_short.png" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.min.css" />
</head>


<body>
    <script>
        var API_URL = '<?php echo API_BASE_URL; ?>';
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/form_validation.css" />

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/forms/form_validation.js"></script>
</body>
<script>
    function formatDate(inputDate) {
        let dateParts = inputDate.split('-');
        let year = dateParts[0];
        let month = dateParts[1];
        let day = dateParts[2];

        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let monthName = months[parseInt(month) - 1];

        return `${day}-${monthName}-${year.substring(2)}`;
    }

    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const documentParam = urlParams.get('documentId');
        const idaParam = urlParams.get('idaId');
        const typeParam = urlParams.get('type');
    
        let dataType = window.atob(typeParam);
        let url_api = '';

        if (dataType == 'waiting') {
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            url_api = API_URL + 'email/approve_email/' + atob(documentParam) + '/' + atob(idaParam) + '/email';
        } else if (dataType == 'reject') {
            Swal.fire({
                title: 'Enter reject message',
                input: 'text',
                inputPlaceholder: 'Enter your reject reason here...',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter reject message!';
                    }
                    if (value.length > 100) {
                        return 'Reject message must not exceed 100 characters!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let userInput = result.value;
                    url_api = API_URL + 'email/reject_email/' + atob(documentParam) + '/' + atob(idaParam) + '/' + userInput + '/email';
                    $.ajax({
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        url: url_api,
                        success: function(result) {
                            if (typeof result == "string") {
                                Swal.fire({
                                    html: '<h5>' + result + '</h5>\n <p>It cannot be re-rejected.</p>',
                                    icon: 'error',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                }).then((result) => {
                                    window.close();
                                })
                            } else {
                                Swal.fire({
                                    html: '<p>Reject message submitted successfully</p>',
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    },
                                    showConfirmButton: true,
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
                        }
                    });
                }
            });
            return;
        } else if (dataType == 'preview') {
            $.ajax({
                type: 'GET',
                url: API_URL + 'rfq/' + atob(documentParam),
                success: async function(result) {
                    if (result.idc_running_no.substring(0, 3) == 'RFQ') {
                        if (result && result.idc_created_date && result.idc_closing_date) {
                            let param = {
                                ...result
                            };
                            let IssueDate = param.idc_created_date.split(" ")[0];
                            param.idc_created_date = formatDate(IssueDate);

                            let Duedate = param.idc_closing_date.split(" ")[0];
                            param.idc_closing_date = formatDate(Duedate);

                            let pdfUrl = '<?php echo base_url(); ?>ViewPDF/RfqPDF?' + $.param(param);
                            if (pdfUrl) {
                                window.open(pdfUrl, '_blank');
                                window.close();
                            } else {
                                console.error('Failed to create valid PDF URL');
                            }
                        } else if (result.idc_running_no.substring(0, 3) == 'NBC') {
                            return;
                        } else if (result.idc_running_no.substring(0, 2) == 'FS') {
                            return;
                        } else if (result.idc_running_no.substring(0, 2) == 'QT') {
                            return;
                        } else {
                            console.error('Invalid response data from API');
                        }
                    } else if (result.idc_running_no.substring(0, 3) == 'NBC') {
                        console.log('test');
                        $.ajax({
                            type: 'get',
                            url: API_URL + 'nbc/' + atob(documentParam),
                            success: async function(result) {
                                let param = {
                                    ...result.data[0]
                                };

                                let IssueDate = param.idc_created_date.split(" ")[0];
                                param.idc_created_date = formatDate(IssueDate);

                                let Duedate = param.idc_closing_date.split(" ")[0];
                                param.idc_closing_date = formatDate(Duedate);

                                let pdfUrl = '<?php echo base_url(); ?>ViewPDF/createNbcPDF?' + $.param(param);
                                window.open(pdfUrl, '_blank');
                                window.close();
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', error);
                }
            });
            return;
        }

        $.ajax({
            type: 'PUT',
            dataType: 'json',
            contentType: 'application/json',
            url: url_api,
            success: function(result) {
                if (typeof result == "string") {
                    Swal.fire({
                        html: '<h5>' + result + '</h5>\n <p>It cannot be re-approved.</p>',
                        icon: 'error',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    }).then((result) => {
                        window.close();
                    })
                } else {
                    Swal.fire({
                        html: '<p>Approve เอกสารสำเร็จ</p>',
                        icon: 'success',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        showConfirmButton: true,
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
            }
        });

    });
</script>

</html>