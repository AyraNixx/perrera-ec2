<div class="row show-pages w-100 align-items-center justify-content-between" style="height:fit-content; font-size:.8em;">
    <span class="register-amount w-auto text-uppercase p-0" style="letter-spacing: .1em; ">
        Filas por página:
        <select name="amount" id="amount" class="amount px-1 border-0 cursos-pointer" style="outline: none;">
            <option value="10" selected>10</option>
        </select>
    </span>

    <div class="select-page h-100 w-auto d-flex align-items-center p-0" style="gap:5px;">
        <button class="previous bg-transparent border-0" value="1" style="outline: none; box-shadow:none;">
            <i class="fa-solid fa-chevron-left" style="font-size: .7em;"></i>
        </button>
        <select name="page" id="page" class="amount px-1 border-0 cursos-pointer" style="outline: none;">
            <option value="1" selected>1</option>
            <option value="2">2</option>
        </select>
        <span class="me-1">of 100</span>
        <button class="next bg-transparent border-0" value="2">
            <i class="fa-solid fa-chevron-right" style="font-size: .7em;"></i>
        </button>
    </div>
</div>