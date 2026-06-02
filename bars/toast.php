<?php

echo '
<!-- Toast Container (Centered) -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3" stylestyle="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 99999;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
">
    <!-- Success Toast -->
    <div id="successToast" class="toast hide bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" >
        <div class="toast-header bg-success text-white">
            <strong class="me-auto"><i class="fas fa-check-circle"></i> Success</strong>
        </div>
        <div class="toast-body text-center">
            ✅ Your operation was successful!
        </div>
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="toast hide bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto"><i class="fas fa-times-circle"></i> Error</strong>
           
        </div>
        <div class="toast-body text-center">
            ❌ Something went wrong! Please try again.
        </div>
    </div>

    <!-- Warning Toast -->
    <div id="warningToast" class="toast hide bg-warning text-dark" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-warning text-dark">
            <strong class="me-auto"><i class="fas fa-exclamation-triangle"></i> Warning</strong>
           
        </div>
        <div class="toast-body text-center">
            ⚠️ Be careful! There might be an issue.
        </div>
    </div>

    <!-- Info Toast -->
    <div id="infoToast" class="toast hide bg-info text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-info text-white">
            <strong class="me-auto"><i class="fas fa-info-circle"></i> Info</strong>
         
        </div>
        <div class="toast-body text-center">
            ℹ️ Here is some important information.
        </div>
    </div>
</div>


';

?>