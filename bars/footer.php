<?php
echo '
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
             
        <img src="img/white_logo_final.jpg" class="img-fluid" style="max-height: 30px;">
   
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" onclick="logOut()">Logout</a>
    </div>
</div>
</div>
</div>


<!-- Camera Modal -->
<div id="cameraModal" style="display: none;">
    <div id="modalContent">
        <video id="video" autoplay playsinline></video>
        <div>
            <button onclick="capturePhoto()">Capture</button>
            
            <button onclick="switchCamera()">Switch Camera</button>
             <button onclick="mirror()">Mirror</button>
            <button onclick="closeCameraModal()">Cancel</button>
        </div>
    </div>
</div>

           
  <script src="controllers/backupController.js"></script>
';

?>