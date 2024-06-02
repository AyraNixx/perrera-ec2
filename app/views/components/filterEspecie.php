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
                    <div class="d-flex flex-column">
                        <span style="font-size: .9rem;" data-controller="EspecieC.php">Especies</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5 align-self-end">
            <div class="row">
                <div class="col-lg-10 col-md-12 md-sm-1 mb-1">
                    <div class="btn-group dropdown d-block text-end" style="position:relative">
                        <button type="button" id="add" class="button-dropdown border-1 border-start" data-toggle="modal" data-target="#insert">
                            Añadir
                        </button>
                    </div>
                </div>
            </div>
            <div class="row my-2 mb-1">
                <div class="col-lg-10 col-md-12">
                    <div class="form-group">
                        <label for="search_table" hidden></label>
                        <input type="search" id="search_table" class="form-control shadow-none border border-1 border-primary" placeholder="Buscar en la tabla..." style="font-size: .8rem;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>