<!-- Modal Login-->
<div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="modal_login" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content rounded-3">
            <div class="modal-header border-0">
                <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form_login">
                <div class="modal-body">
                    <div class="mb-5 text-center">
                        <img src="assets/imgs/bitel.svg" alt="Bitel logo"> Login
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="usernameInput" placeholder="username" autofocus autocomplete="off" required>
                        <label for="usernameInput">Username</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="passwordInput" placeholder="password" required>
                        <label for="passwordInput">Password</label>
                    </div>

                    <div class="text-center">
                        <small id="login_message"></small>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-info rounded-pill px-5 fw-bolder" id="btn_login"><i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i> Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>