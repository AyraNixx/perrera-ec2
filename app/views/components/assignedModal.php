<div class="modal fade" id="assigned_modal" tabindex="-1" aria-labelledby="assigned_modal" aria-hidden="true" style="z-index: 20000; background: rgba(0, 0, 0, 0.22);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title px-2">Dueños</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4" style="max-height: 550px; overflow: auto;">
                <div class="container mt-3">
                    <div id="sel_assigned" class="d-flex align-items-center">
                        <select class="selectpicker" id="icon-select">
                            <option data-icon="fa-solid fa-user" value="empleado" selected></option>
                            <option data-icon="fa-solid fa-handshake-angle" value="voluntario"></option>
                        </select>
                        <select class="selectpicker flex-grow-1 border border-1 border-primary rounded-1" data-live-search="true" id="assigned_sel" name="assigned_sel" title="Seleccionar encargado de la tarea"></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer align-items-center justify-content-center">
                <button type="button" class="btn btn-primary" id="send_rows">Enviar</button>
            </div>
        </div>
    </div>
</div>
