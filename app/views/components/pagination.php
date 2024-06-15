<div class="row show-pages w-100 align-items-center justify-content-between" style="height:fit-content; font-size:.8em;" id="pagination">
    <span class="register-amount w-auto text-uppercase p-0" style="letter-spacing: .1em; ">
        Filas por página:
        <select name="amount" id="amount" class="amount px-1 border-0 cursos-pointer" style="outline: none;" data-page="10">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </span>

    <div class="select-page h-100 w-auto d-flex align-items-center p-0" style="gap:5px;">
        <?php if ($page != 1): ?>
            <button class="previous bg-transparent border-0" value="<?= ($page - 1) ?>" style="outline: none; box-shadow:none;" id="previous">
                <i class="fa-solid fa-chevron-left" style="font-size: .7em;"></i>
            </button>
        <?php else: ?>
            <button class="previous bg-transparent border-0" value="<?= $page ?>" style="outline: none; box-shadow:none;" id="previous" disabled>
                <i class="fa-solid fa-chevron-left" style="font-size: .7em;"></i>
            </button>
        <?php endif; ?>

        <select name="page" id="page" class="amount px-1 border-0 cursos-pointer" style="outline: none;">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <option value="<?= $i ?>" <?= ($i == $page) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
        of <span class="me-1" id="total_pages"><?= $total_pages ?></span>

        <?php if ($page != $total_pages): ?>
            <button class="next bg-transparent border-0" value="<?= ($page + 1) ?>" style="outline: none; box-shadow:none;" id="next">
                <i class="fa-solid fa-chevron-right" style="font-size: .7em;"></i>
            </button>
        <?php else: ?>
            <button class="next bg-transparent border-0" value="<?= $page ?>" style="outline: none; box-shadow:none;" id="next" disabled>
                <i class="fa-solid fa-chevron-right" style="font-size: .7em;"></i>
            </button>
        <?php endif; ?>
    </div>
</div>
