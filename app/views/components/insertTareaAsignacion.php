    <!-- MODAL PARA INSERTAR UN NUEVO REGISTRO-->
    <div class="modal fade" id="add_tarea_asignada" tabindex="-1" aria-labelledby="add_tarea_asignada" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">ASIGNAR NUEVA TAREA</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height:550px; overflow:auto;">
                    <form action="../controllers/AsignarTareasC.php" method="POST" class="d-flex flex-column w-100">
                        <div class="row border border-1 border-secondary rounded-1 mx-1 p-2 pb-3 mb-3">
                            <div class="col-md-7">
                                <label for="tareas_id1">Tarea</label>
                                <input type="hidden" id="asunto" name="asunto" value="">
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="tareas_id1" name="tareas_id1" title="Seleccionar adoptante"></select>
                            </div>
                            <div class="col-md-5">
                                <label for="assigned_to">Asignar tarea</label> <!-- TO DO !! MODAL PARA SELECCIONAR ENTRE VOLUNTARIO O EMPLEADO -->
                                <input type="hidden" name="empleados_id" id="empleados_id">
                                <input type="hidden" name="voluntarios_id" id="voluntarios_id">
                                <input class="w-100 border border-1 border-primary rounded-1 px-1" type="text" name="assigned_to" id="assigned_to" style="padding: .38em 0;">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="fecha_asignacion">Fech. asignación</label>
                                <input class="p-1 w-100 border border-1 border-primary rounded-1" type="datetime-local" name="fecha_asignacion" id="fecha_asignacion" value="">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="fecha_finalizacion">Fech. finalización</label>
                                <input class="p-1 w-100 border border-1 border-primary rounded-1" type="datetime-local" name="fecha_finalizacion" id="fecha_finalizacion" value="">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="prioridad">Prioridad</label>
                                <select class="p-1 w-100 border border-1 border-primary rounded-1" name="prioridad" id="prioridad"></select>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="estado_asignacion">Estado</label>
                                <select class="p-1 w-100 border border-1 border-primary rounded-1" name="estado_asignacion" id="estado_asignacion"></select>
                            </div>
                            <div class="col-12 mb-3 mt-3">
                                <label for="jaulas_id">Jaula</label>
                                <select class="selectpicker w-100 border border-1 border-primary rounded-1" data-live-search="true" id="jaulas_id" name="jaulas_id" title="Seleccionar jaula"></select>
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