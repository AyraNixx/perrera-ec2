    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVA TAREA</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/TareaC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="asunto">Asunto</label>
                                <input type="text" name="asunto" id="asunto" value="">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" name="descripcion" id="descripcion" value="">
                            </div>
                        </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>