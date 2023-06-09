<div class="w-100 border border-1 border-secondary p-3">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="filter-select">Filtrar por lista:</label>
                <select id="filter-select" class="form-control">
                    <option value="">Todos los animales</option>
                    <?php
                    foreach ($data_especies as $show_one) {
                        echo "<option value='" . $show_one["id"] . "'>Mostrar " . $show_one["nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="search-filter">Buscar lista:</label>
                <input type="text" id="search-filter" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="add">Añadir Registro:</label>
                <button id="add" class="btn btn-primary" data-toggle="modal" data-target="#insert">Añadir</button>
            </div>
        </div>
        <div class="col-md-6 d-none">
            <div class="form-group">
                <label for="delete-btn">Eliminar Registro:</label>
                <button id="delete-btn" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="search_table">Buscar por nombre:</label>
                <input type="text" id="search_table" class="form-control" placeholder="Buscar por nombre...">
            </div>
        </div>
    </div>
</div>