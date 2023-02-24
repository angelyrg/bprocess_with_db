<div class="position-fixed bottom-0 end-0 p-3 " style="z-index: 20">
    <!-- Success toast -->
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-white bg-success">
            <strong class="me-auto">Success!</strong>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <p id="toastSuccessMessage"></p>
        </div>
    </div>
    <!-- Error toast -->
    <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-white bg-danger">
            <strong class="me-auto">Error!</strong>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <p id="toastErrorMessage"></p>
        </div>
    </div>
</div>