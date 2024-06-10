    <div class="modal fade" id="search_animal" tabindex="-1" aria-labelledby="search_animal" aria-hidden="true" style="z-index: 20000; background: rgba(0, 0, 0, 0.22);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-2">ANIMALES</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4" style="max-height:550px; overflow:auto;">
                    <div class="container my-4">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text d-inline-block rounded-0 rounded-left" id="basic-addon1"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" id="search_animal_val" class="form-control" placeholder="Buscar en la tabla..." aria-label="Buscar" aria-describedby="basic-addon1" style="outline: none; box-shadow: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3" style="max-height: 300px;overflow: auto;">
                        <table class="table table-bordered table-hover w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th class="" style="position: relative;"></th>
                                    <th style="position: relative;">Nombre</th>
                                    <th style="position: relative;">Especie</th>
                                    <th style="position: relative;">Jaula</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <button type="button" class="btn btn-primary" id="send_rows">Enviar</button>
                </div>
            </div>
        </div>
    </div>