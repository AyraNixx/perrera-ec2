<div class="w-100 border border-1 border-secondary p-3 my-4">
    <div class="row justify-content-between">

        <div class="col-md-6 col-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-3 col-sm-1 md-sm-1 mb-1">
                    <div class="d-flex justify-content-center align-items-center border border-1 border-primary rounded bg-secondary text-primary" style="width:50px; height: 50px; font-size: 1.5rem;">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-11">
                    <div class="d-flex flex-column"><span class="title_name" style=" font-size: .7rem;"></span>
                        <h6 class="h5 text-primary mb-0" style="letter-spacing: 0; text-transform:none !important; font-size:.8rem;" data-controller='VoluntarioC.php'>Listado de filtros para <span class="title_name"></span></h6>
                    </div>
                </div>

            </div>
            <div class="row my-2">
                <div class="text-primary">
                    <label for="filter-select" hidden></label>
                    <select id="filter-select" class="form-control border border-0 border-bottom border-primary rounded-0 text-primary shadow-none ps-0" style="font-size: .85rem;">
                        <option value="">Todos los voluntarios</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5 align-self-end">
            <div class="row">
                <div class="col-lg-10 col-md-12 md-sm-1 mb-1">
                    <div class="btn-group" role="group">
                        <button class="button-dropdown" id="add" data-toggle="modal" data-target="#insert">Añadir</button>
                        <?php
                        if ($user_profile == 'Administrador') {
                            echo '<button type="button" id="see_delete" class="button-dropdown " data-toggle="modal" data-target="#see_delete_modal">Ver eliminados</button>';
                        }
                        ?>
                    </div>
                    <div class="btn-group dropdown" style="position:relative">
                        <button type="button" id="add" class="button-dropdown " data-toggle="modal" data-target="#insert">
                            Añadir
                        </button>
                        <button type="button" onclick="show_btn_options(event)" class="button-dropdown px-1">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <div class="btn-dropdown-options w-100 position-absolute start-0">
                            <ul class="list-unstyled m-0">
                                <?php
                                if ($user_profile == 'Administrador') {
                                    echo '<li id="see_delete" data-toggle="modal" data-target="#see_delete_modal"> Mostrar eliminados </li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2 mb-1">
                <div class="col-lg-10 col-md-12">
                    <div class="form-group" hidden>
                        <label for="search-filter" hidden></label>
                        <input type="text" id="search-filter" class="form-control" placeholder="Buscar filtro...">
                    </div>
                    <div class="form-group">
                        <label for="search_table" hidden></label>
                        <input type="search" id="search_table" class="form-control shadow-none border border-1 border-primary" placeholder="Buscar en la tabla..." style="font-size: .8rem;">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>