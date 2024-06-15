<!-- MODAL -->
<div id="aviso" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="background: rgba(0, 0, 0, 0.22);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aviso</h5>
                <button type="button" class="btn-close" id="cerrarModalBtn" aria-label="Close" data-bs-dismiss="modal" onclick="close_modal();"></button>
            </div>
            <div class="modal-body">
                <p><?= base64_decode($new_msg) ?></p>
            </div>
        </div>
    </div>
</div>