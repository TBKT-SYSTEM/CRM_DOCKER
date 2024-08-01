<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/logos/crm_icon_short.png" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/form_validation.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/switch_toggle.css" />
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<style>

    .text-overflow-ellipsis {
        white-space: nowrap;
        width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: left;
    }

    .custom-table {
        border: 1px solid;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .custom-table th,
    .custom-table td {
        padding: 5px;
    }

    .full-border th,
    .full-border td,
    .full-border {
        border: 1px solid;
    }

    .b-bottom {
        border-bottom: 1px dotted #adadad !important;
    }

    .b-top {
        border-top: 1px dotted #adadad !important;
    }

    .border-transparent {
        border: transparent !important;
        appearance: none;
        width: 100%;
    }

    .hoverable:hover {
        cursor: pointer;
    }

    .img_container {
        position: relative;
        width: 100%;
        display: none;
    }

    .text-block {
        width: 100%;
        height: 40px;
        background-color: white;
        color: slategray;
        display: flex;
        justify-content: center;
        align-items: center;
        border: none;
    }
</style>

<body>
    <script>
        var API_URL = '<?php echo API_BASE_URL; ?>';

        function is_cached(src) {
            var image = new Image();
            image.src = src;
            return image.complete;
        }
    </script>
    <script src="<?php echo base_url() ?>assets/js/forms/form_validation.js"></script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        {left_sidebar}
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            {topbar}
            <!--  Header End -->

            <!-- start pagecontent -->
            {page_content}
            {footer}
            <!-- end pagecontent -->
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/theme.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/simplebar/dist/simplebar.js"></script>
    {another_chart_js}

    <!-- <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script> -->
    {another_js}
</body>

</html>