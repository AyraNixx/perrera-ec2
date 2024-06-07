    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVA JAULA</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/JaulaC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 px-4">
                                <h5>ubicación</h5>
                                <div class="row border border-1 border-secondary p-2 pb-4">
                                    <div class="col-4">
                                        <label for="especies_id">Especies</label>
                                        <select name="especies_id" id="especies_id"></select>
                                    </div>
                                    <div class="col-8" id="size_dog_div" style="display: none;">
                                        <label for="size_dog">Tamaño del perro</label>
                                        <select id="size_dog" class="ps-0"></select>
                                    </div>
                                    <div class="col-3">
                                        <label for="letter_cage">Área</label>
                                        <input type="text" id="letter_cage" class="bg-info bg-opacity-10" value="" readonly>
                                    </div>
                                    <div class="col-9 ps-0">
                                        <label for="area_num" class="col-6">Número</label>
                                        <input type="text" class="bg-info bg-opacity-10" id="area_num" value="" readonly>
                                    </div>
                                    <input type="hidden" name="ubicacion" id="ubicacion">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tamanio">Tamaño</label>
                                <input type="number" name="tamanio" id="tamanio" min="1" max="6">
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" name="descripcion" id="descripcion">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="estado_comida" value="0">
                                <label for="estado_comida" class="d-flex align-self-center">¿Jaula equipada con comida?<input type="checkbox" name="estado_comida" id="estado_comida" class="ms-3" style="width: fit-content;" value="0"></label>
                            </div>
                            <div class="col-md-6 align-self-end">
                                <input type="hidden" name="estado_limpieza" value="0">
                                <label for="estado_limpieza" class="d-flex align-self-center">¿Jaula limpia?<input type="checkbox" name="estado_limpieza" id="estado_limpieza" class="ms-3" style="width: fit-content;" value="0"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="descripcion">Otros Comentarios</label>
                                <textarea class="form-control" name="otros_comentarios" id="otros_comentarios" cols="30" rows="10" style="resize: none; box-shadow:none;"></textarea>
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