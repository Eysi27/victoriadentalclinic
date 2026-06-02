<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smiles & More</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once('bars/sidebar.php'); ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include_once('bars/topbar.php'); ?>


                <!-- Begin Page Content -->
                <div class="container-fluid" id="content-table">
                    <canvas id="canvas" width="500px" height="700px" style="display:none;"></canvas>
                    <!-- Page Heading -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo $cards; ?>">
                            Attachment List
                            <button id="divPrinter" class="btn btn-success btn-sm btn-circle float-right"
                                onclick="openCameraModal()" title="Print E-SOA"><i class="fas fa-camera"></i></button>

                        </div>

                        <input type="hidden" id="soaid" value="<?php echo $_GET["soaid"]; ?>">
                        <div class="card-body">
                            <div class="container mt-4">
                                <div class="row" id="bodyResult">
                                    <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                                </div>
                                <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Fullscreen Photo Modal -->
            <!-- Image Modal -->
            <!-- Zoomable Image Modal -->
            <!-- Zoomable Image Modal -->
            <!-- Zoomable Image Modal -->
            <!-- Zoomable Image Modal -->
            <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="card bg-dark text-white m-0">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Photo Preview</h5>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body p-2 text-center">
                                <input type="hidden" id="attachmentid">
                                <!-- Zoom Container -->
                                <div id="zoomContainer" class="mx-auto mb-3 border"
                                    style="max-width: 100%; max-height: 70vh; overflow: hidden; background-color: #111; display: inline-block;">
                                    <img id="modalImage" src="" alt="Zoomable"
                                        style="transform: scale(1); transform-origin: center center; transition: transform 0.3s ease;" />
                                </div>

                                <!-- Zoom Controls -->
                                <div class="mt-3">
                                    <button class="btn btn-danger btn-sm mr-2" onclick="deletePhoto();">Delete</button>
                                    <button class="btn btn-sm btn-success mr-2" onclick="zoomImage(1.2)">Zoom
                                        In</button>
                                    <button class="btn btn-sm btn-success" onclick="zoomImage(0.8)">Zoom Out</button>
                                    <button class="btn btn-sm btn-secondary ml-2" onclick="resetZoom()">Reset</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <?php include_once('bars/footer.php'); ?>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/attachmentViewingController.js"></script>
            <script src="js/custom-v2.js"></script>
            <script src="js/attachment.js"></script>




</body>

</html>