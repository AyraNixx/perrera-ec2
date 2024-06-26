    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">AÑADIR ANIMAL</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/AnimalC.php" method="POST" class="d-flex flex-column w-100" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Contenido de la primera columna -->
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="">

                                <label for="fech_nac">Fecha de nacimiento</label>
                                <input type="date" name="fech_nac" id="fech_nac" value="">

                                <label for="genero">Género</label>
                                <select name="genero" id="genero">
                                    <option selected>Seleccionar género</option>
                                    <option value="M">M</option>
                                    <option value="H">H</option>
                                </select>

                                <label for="especies_id">Especie</label>
                                <select name="especies_id" id="especies_id">
                                    <option selected>Seleccionar especie</option>
                                    <?php
                                    foreach ($data_especies as $especie) {
                                        echo "<option value='" . $especie["id"] . "'" . (($action == 2 && $update["especies_id"] == $especie["id"]) ? "selected" : "") . ">" . $especie["nombre"] . "</option>";
                                    }
                                    ?>
                                    <!-- Opciones del select -->
                                </select>

                                <label for="jaulas_id">Jaulas disponibles</label>
                                <select name="jaulas_id" id="jaulas_id">
                                    <option>Seleccionar jaula</option>
                                </select>

                                <label for="raza">Raza</label>
                                <input type="text" name="raza" id="raza" value="">

                                <div class="input-group my-4 mb-1" style="position: relative; margin-top:1.7rem !important">
                                    <div class="custom-file flex-grow-1 border border-1 border-primary" style="padding: .3em;border-end-start-radius: 4px;border-start-start-radius: 4px;">
                                        <input type="file" class="custom-file-input d-none" id="imgs" name="imgs[]" multiple>
                                        <label class="custom-file-label" for="imgs" style="padding: 0;padding-left:.25em;">Subir imagen...</label>
                                    </div>
                                    <div class="input-group-prepend" id="upload-span">
                                        <span class="input-group-text bg-primary text-white border-0" style="border-end-start-radius: 0;border-start-start-radius: 0;">Upload</span>
                                    </div>
                                </div>

                                <label for="necesidades_especiales" style="padding-top:.699rem">Necesidades especiales</label>
                                <select name="necesidades_especiales" id="necesidades_especiales">
                                    <option>¿Requiere necesidades especiales?</option>
                                    <option value="S">Si</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <!-- Contenido de la segunda columna -->

                                <label for="tamanio">Tamaño</label>
                                <select name="tamanio" id="tamanio">
                                    <option disabled>Seleccionar tamaño</option>
                                    <option value="Cachorro">Cachorro</option>
                                    <option value="Pequenio">Pequeño</option>
                                    <option value="Mediano">Mediano</option>
                                    <option value="Grande">Grande</option>
                                </select>

                                <label for="peso">Peso</label>
                                <input type="text" name="peso" id="peso" value="">

                                <label for="colores">Colores</label>
                                <select name="colores[]" id="colores" multiple>
                                    <option disabled>Seleccionar color</option>
                                </select>

                                <label for="personalidad">Personalidad</label>
                                <select name="personalidad[]" id="personalidad" multiple></select>

                                <label for="estado_salud">Estado salud</label>
                                <select name="estado_salud" id="estado_salud">
                                    <option disabled>Seleccionar estado</option>
                                </select>
                            </div>
                        </div>
                        <h5 class="mx-1 mt-4">INFORMACIÓN RELEVANTE</h5>
                        <div class="row border border border-1 border-secondary mx-1 p-2">
                            <div class="col-md-6">
                                <label for="estado_adopcion">Estado adopción</label>
                                <select name="estado_adopcion" id="estado_adopcion">
                                    <option value="">Seleccionar estado</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="adoptante_id">Adoptante</label>
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="adoptante_id" name="adoptante_id" title="Seleccionar adoptante"></select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duenios_id">Dueño</label>
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="duenios_id" name="duenios_id" title="Seleccionar adoptante"></select>                                
                            </div>
                        </div>
                        <div class="textarea-container">
                            <label for="otras_observaciones">Otras observaciones</label>
                            <textarea class="form-textarea" name="otras_observaciones" id="otras_observaciones" cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="action" value="add">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>