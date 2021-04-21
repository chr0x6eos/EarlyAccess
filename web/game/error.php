<?php
    if (isset($_SESSION['error']))
    {
        echo '<div id="toast-alert-container" class="toast-top-center example">
            <div id="alert" class="toast-alert alert-danger hide" role="alert" data-delay="5000" data-autohide="true" aria-live="assertive" aria-atomic="true">
                <div class="toast-header-alert">
                    <i class="fas fa-2x fa-exclamation-circle mr-2"></i>
                    <strong class="mr-auto">Error</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    ' . $_SESSION['error'] . '
                </div>
            </div>
        </div>
        ';
        unset($_SESSION['error']);
    }
?>