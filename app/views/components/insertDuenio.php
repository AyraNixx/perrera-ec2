    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR NUEVO DUEÑO</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/DuenioC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
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
                            <div class="col-8">
                                <label for="correo">Email</label>
                                <input type="email" name="correo" id="correo" value="">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="ocupacion">Ocupación</label>
                                <select name="ocupacion" id="ocupacion" style="max-height: 200px; overflow-y:auto;"></select>
                            </div>
                        </div>

                        <h5 class="mx-1 mt-4">DIRECCIÓN</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-12">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" value="">
                            </div>
                            <div class="col-md-3">
                                <label for="codigo_postal">Código postal</label>
                                <input type="text" name="codigo_postal" id="codigo_postal" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad" value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="pais">País</label>
                                <select name="pais" id="pais"></select>
                            </div>
                        </div>

                        <h5 class="mx-1 mt-4">INFORMACIÓN ADICIONAL</h5>
                        <div class="row border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-12 mb-3">
                                <label for="animals_selected">Animales</label>
                                <input type="hidden" name="animales_id" id="animales_id" value="">
                                <input type="text" value="" id="animals_selected">
                            </div>
                            <div class="col-md-4 d-flex align-self-end mb-3">
                                <input type="hidden" name="permiso_visita" value="0">
                                <label for="permiso_visita_chk" class="d-flex align-self-center">Permiso de visita<input type="checkbox" name="permiso_visita_chk" id="permiso_visita_chk" class="ms-3" style="width: fit-content;" value="0"></label>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="fecha_ultima_visita">Última visita realizada</label>
                                <input type="datetime-local" name="fecha_ultima_visita" id="fecha_ultima_visita" value="">
                            </div>
                        </div>
                        <div class="textarea-container mx-1 mt-3">
                            <h5><label for="observaciones">Otros datos de interés</label></h5>
                            <textarea class="form-textarea" name="observaciones" id="observaciones" cols="30" rows="10" style="resize: none;"></textarea>
                        </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>