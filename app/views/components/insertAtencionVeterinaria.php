    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insertAtencionVeterinaria" tabindex="-1" aria-labelledby="insertAtencionVeterinaria" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVO VETERINARIO</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/VeterinarioC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                        <h5 class="mx-1">INFORMACIÓN DE LA CONSULTA</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-12 col-md-6 mb-6">
                                <input type="hidden" name="veterinarios_id" id="veterinarios_id" value="" />
                                <label for="veterinarios_id_text">Veterinario</label>
                                <input type="text" name="veterinarios_id_text" id="veterinarios_id_text" />
                            </div>
                            <div class="col-12 col-md-6 mb-6">
                                <input type="hidden" name="animales_id" id="animales_id" value="" />
                                <label for="animales_id_text">Animal</label>
                                <input type="text" name="animales_id_text" id="animales_id_text" />
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="fecha_asistencia">Fecha asistencia</label>
                                <input type="datetime-local" name="fecha_asistencia" id="fecha_asistencia">
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <label for="coste">Coste</label>
                                <input type="number" name="coste" id="coste">
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