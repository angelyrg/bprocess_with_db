<!-- Modal Delete-->
<div class="modal fade" id="modal_logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-sm rounded-pill">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_logout" method="POST">
        <div class="modal-body p-0">
          <div class="text-center pt-0 px-5">
            <img src="assets/imgs/icon_warning.svg" alt="Check success icon" class="img-fluid mb-2 mt-0 pt-0" draggable="false">
            <p class="">Are you sure you want logout?</p>
          </div>

          <div class="mx-5 mt-4 mb-3 text-center">
            <button type="button" class="btn btn-outline-secondary rounded-pill fw-bolder " data-bs-dismiss="modal"> Cancel</button>
            <button type="submit" class="btn btn-info rounded-pill fw-bolder" id="btn_logout">Yes, Logout</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
