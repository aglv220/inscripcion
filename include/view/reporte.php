<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reporte Power BI - Escuela Nacional de Salud Pública</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Formulario de Inscripción a los cursos de la Escuela Nacional de Salud Pública - ENSAP" name="description" />
    <meta content="ENSAP" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $CNG->wwwroot; ?>/assets/images/favicon.ico" />

    <!-- Plugins css-->
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/libs/sweetalert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/bootstrap.min.css?v=2" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CNG->wwwroot; ?>/assets/css/app.min.css?v=3" rel="stylesheet" type="text/css" />

    <style>
        .embed-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .embed-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom shadow-lg">
            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.html" class="logo text-center">
                    <span class="logo-lg">
                        <img src="<?php echo $CNG->wwwroot; ?>/assets/images/logo.png" alt="" height="60">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="<?php echo $CNG->wwwroot; ?>/assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>

        </div>
        <!-- end Topbar -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page" style="margin-left: 5px !important;">
            <div class="content">
                <h2 class="text-center text-bold">
                    Actividades académicas 2021
                </h2>
                <div class="embed-container">
                    <iframe src="https://app.powerbi.com/view?r=eyJrIjoiMjQxZTJiZDUtMDQwMi00YjA1LWE0NTgtY2EyM2ZhYWI4OTJhIiwidCI6IjQyOWU3NTNmLWMyYTQtNDUxYy1hYmNjLTI4ZTVhMTRkMDMzYiJ9&pageName=ReportSection" class="img-fluid" frameborder="0" allowFullScreen="true"></iframe>
                </div>

                <!-- Footer Start -->
                <footer class="footer" style="left:0px !important;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2017 - 2021 &copy; Escuela Nacional de Salud Pública <a href="pees.minsa.gob.pe">ENSAP</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="<?php echo $CNG->wwwroot; ?>/assets/js/vendor.min.js"></script>

        <!-- Validation js (Parsleyjs) -->
        <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/parsleyjs/parsley.min.js"></script>

        <!-- App js -->
        <script src="<?php echo $CNG->wwwroot; ?>/assets/js/app.min.js"></script>

        <!-- Plugins Js -->
        <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/select2/select2.min.js?v=2"></script>
        <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/sweetalert/sweetalert2.min.js"></script>
        <script src="<?php echo $CNG->wwwroot; ?>/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>

        <!-- Init js-->
        <script src="<?php echo $CNG->wwwroot; ?>/assets/js/pages/form-pickers.init.js"></script>
        <script src="<?php echo $CNG->wwwroot; ?>/assets/js/pages/form.init.V4.js?v=1"></script>
</body>

</html>