    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVO VETERINARIO</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/VeterinarioC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                        <h5 class="mx-1">DATOS PERSONALES</h5>
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
                            <div class="col-12">
                                <label for="correo">Email</label>

                                <input type="email" name="correo" id="correo" value="">
                            </div>
                            <div class="col-md-3">
                                <label for="telf">Tlf.</label>

                                <input type="tel" name="telf" id="telf" value="">
                            </div>
                            <div class="col-md-9 mb-3">
                                <label for="especialidad">Especialidad</label>
                                <input type="text" name="especialidad" id="especialidad" value="">
                            </div>
                        </div>

                        <h5 class="mx-1 mt-4">DATOS CLÍNICA</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-8">
                                <label for="nombre_clinica">Clínica</label>
                                <input type="text" name="nombre_clinica" id="nombre_clinica" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="telf_clinica">Tlf.</label>
                                <input type="tel" name="telf_clinica" id="telf_clinica" value="">
                            </div>
                            <div class="col-12">
                                <label for="correo_clinica">Email</label>
                                <input type="email" name="correo_clinica" id="correo_clinica" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="hora_apertura">Hora de apertura</label>
                                <input type="time" name="hora_apertura" id="hora_apertura" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="hora_cierre">Hora de cierre</label>
                                <input type="time" name="hora_cierre" id="hora_cierre" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="direccion_clinica">Dirección</label>
                                <input type="text" name="direccion_clinica" id="direccion_clinica" value="">
                            </div>
                        </div>
                        <div class="textarea-container mx-1 mt-3">
                            <h5><label for="otra_informacion">Otros datos de interés</label></h5>
                            <textarea class="form-textarea" name="otra_informacion" id="otra_informacion" cols="30" rows="10" style="resize: none;"></textarea>
                        </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>