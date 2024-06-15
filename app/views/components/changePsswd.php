<div class="modal fade" id="change_psswd" tabindex="-1" aria-labelledby="change_psswd" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title px-2">Cambiar contraseña</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                <form class="d-flex flex-column w-100 change-psswd" action="../controllers/SettingsC.php" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <div class="error-label bg-danger text-white text-center p-2 mb-3 <?= ($alert != null) ? "d-block" : "d-none" ?>">
                                <?= ($alert != null) ?? $alert; ?>
                            </div>
                            <label class="h5 pb-1 text-capitalize text-primary mt-3 mb-1" style="font-size: .85rem;" for="old_psswd">Contraseña antigua</label>
                            <input class="hide-str form-control px-3 mt-1 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" type="password" name="old_psswd" id="old_psswd">

                            <label class="h5 pb-1 text-capitalize text-primary mt-3 mb-1" style="font-size: .85rem;" for="new_psswd">Nueva contraseña</label>
                            <input class="hide-str form-control px-3 mt-1 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" type="password" name="new_psswd" id="new_psswd">

                            <label class="h5 pb-1 text-capitalize text-primary mt-3 mb-1" style="font-size: .85rem;" for="new_psswd2">Confirmar contraseña</label>
                            <input class="hide-str form-control px-3 mt-1 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" type="password" name="new_psswd2" id="new_psswd2">
                        </div>
                    </div>
                    <div class="modal-footer align-items-center justify-content-center">
                        <button class="py-1 w-50 bg-secondary text-white border-0 me-2" name="action" value="CHANGE_PSSWD" type="submit" disabled>Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>