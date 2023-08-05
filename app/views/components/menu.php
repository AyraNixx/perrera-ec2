<section id="menu" class="bg-primary text-white pt-5" style="z-index:999;">
    <div>
        <div class="menu-container">
            <div class="d-flex justify-content-end">
                <button class="border-0 text-uppercase text-primary bg-secondary" type="button" id="close-btn">
                    Cerrar
                </button>
            </div>

            <!-- LOGO DEL MENÚ -->
            <div class="info-user">
                <h3><?= $user_surname ?>, <?= $user_name ?></h3>
                <h6><?= $user_profile ?></h6>
            </div>

            <hr>

            <!-- ENLANCES DEL MENÚ -->
            <div class="menu-items mt-4 over">

                <h5><a href="/app/controllers/C_Home.php" class="text-white">Inicio</a></h5>

                <details>
                    <summary>
                        <h5>Animales</h5>
                    </summary> 
                    <a href="/app/controllers/AnimalC.php">Animales</a><br />
                    <a href="/app/controllers/PruebaC.php">Jaulas</a><br />
                </details>

                <details>
                    <summary>
                        <h5>Usuarios</h5>
                    </summary>
                    <a href="#">Empleados</a><br />
                    <a href="#">Voluntarios</a><br />
                    <a href="#">Perfiles</a>
                </details>

                <details>
                    <summary>
                        <h5>Personas</h5>
                    </summary>
                    <a href="#">Dueños</a>
                    <a href="#">Adoptantes</a>
                    <a href="#">Veterinarios</a>
                </details>

                <details>
                    <summary>
                        <h5>Suministros</h5>
                    </summary>
                    <a href="#">Almacén</a><br />
                    <a href="#">Proveedores</a><br />
                </details>
            </div>

            <hr>

            <div class="settings">
                <h5><a href="#" class="text-white">Ajustes</a></h5>
            </div>

            <hr>

            <div class="logout">
                <h5><a href="/app/controllers/LoginC.php?action=logout" class="text-white">Cerrar sesión</a></h5>
            </div>
        </div>
    </div>
</section>