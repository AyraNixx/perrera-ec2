    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVO VOLUNTARIO</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/VoluntarioC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                    <h5 class="mx-1 mt-4">DATOS PERSONALES</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-6">
                                <!-- Contenido de la primera columna -->
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="NIF">NIF</label>
                                <input type="text" name="NIF" id="NIF" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="fech_nac">Fecha de Nacimiento</label>
                                <input type="date" name="fech_nac" id="fech_nac" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="telf">Tlf.</label>
                                <input type="tel" name="telf" id="telf" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="correo">Email</label>
                                <input type="email" name="correo" id="correo" value="">
                            </div>
                        </div>

                        <h5 class="mx-1 mt-4">DATOS RELEVANTES PARA EL VOLUNTARIADO</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-6">
                                <label for="fecha inicio">Fecha de inicio</label>
                                <input type="date" name="fecha inicio" id="fecha inicio" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin">Fecha de finalización</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="disponibilidad" value="0">
                                <label for="disponibilidad" class="d-flex align-self-center">Disponible<input type="checkbox" name="disponibilidad" id="disponibilidad" class="ms-3" style="width: fit-content;" value="0"></label>
                            </div>
                            <div class="col-md-6 align-self-end">
                                <input type="hidden" name="experiencia_previa" value="0">
                                <label for="experiencia_previa" class="d-flex align-self-center">Experiencia previa<input type="checkbox" name="experiencia_previa" id="experiencia_previa" class="ms-3" style="width: fit-content;" value="0"></label>
                            </div>
                        </div>
                        <div class="textarea-container mx-1 mt-3">
                            <h5><label for="informacion_relevante">Otros datos de interés</label></h5>
                            <textarea class="form-textarea" name="informacion_relevante" id="informacion_relevante" cols="30" rows="10" style="resize: none;"></textarea>
                        </div>
                        <div class="textarea-container mx-1 mt-3">
                            <h5><label for="comentarios">Comentarios</label></h5>
                            <textarea class="form-textarea" name="comentarios" id="comentarios" cols="30" rows="10" style="resize: none;"></textarea>
                        </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>