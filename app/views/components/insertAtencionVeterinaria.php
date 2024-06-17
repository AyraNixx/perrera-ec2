    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">NUEVA ATENCION VETERINARIA</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/AtencionVeterinariaC.php" method="POST" class="d-flex flex-column w-100">
                        <div class="row border border-1 border-secondary rounded-1 mx-1 p-2 pb-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label for="veterinarios_id">Veterinario</label>
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="veterinarios_id" name="veterinarios_id" title="Seleccionar veterinario"></select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="animales_id">Animal</label>
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="animales_id" name="animales_id" title="Seleccionar animal"></select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="fecha_atencion">Fech. atención</label>
                                <input type="datetime-local" name="fecha_atencion" id="fecha_atencion" value="">
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <label for="coste">Coste</label>
                                <input type="number" name="coste" id="coste" value="0">
                            </div>
                            <div class="textarea-container mx-1 mt-3">
                                <h5 class="p-0"><label for="motivo">Motivo de la visita</label></h5>
                                <textarea class="form-textarea" name="motivo" id="motivo" cols="30" rows="7" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <div class="row border mx-1 p-2">
                            <div class="textarea-container mx-1 mt-3">
                                <h5><label for="procedimientos">PROCEDIMIENTOS REALIZADOS</label></h5>
                                <textarea class="form-textarea" name="procedimientos" id="procedimientos" cols="30" rows="10" style="resize: none;"></textarea>
                            </div>
                            <div class="textarea-container mx-1 mt-3">
                                <h5><label for="diagnostico">DIAGNÓSTICO</label></h5>
                                <textarea class="form-textarea" name="diagnostico" id="diagnostico" cols="30" rows="10" style="resize: none;"></textarea>
                            </div>
                            <div class="textarea-container mx-1 mt-3">
                                <h5><label for="medicamentos">MEDICAMENTOS RECETADOS</label></h5>
                                <textarea class="form-textarea" name="medicamentos" id="medicamentos" cols="30" rows="10" style="resize: none;"></textarea>
                            </div>
                            <div class="textarea-container mx-1 mt-3">
                                <h5><label for="comentarios">OBSERVACIONES</label></h5>
                                <textarea class="form-textarea" name="comentarios" id="comentarios" cols="30" rows="10" style="resize: none;"></textarea>
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