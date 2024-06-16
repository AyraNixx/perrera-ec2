<section id="menu" class="bg-primary text-white pt-5" style="z-index:400;">
    <div>
        <div class="menu-container overflow-hidden">
            <div class="d-flex justify-content-end">
                <button class="border-0 text-uppercase text-primary bg-secondary" type="button" id="close-btn">
                    Cerrar
                </button>
            </div>

            <!-- LOGO DEL MENÚ -->
            <div class="info-user">
                <h3><?= $_SESSION["apellidos"]; ?>, <?= $_SESSION["nombre"]; ?></h3>
                <h6><?= $_SESSION["rol"]; ?></h6>
            </div>

            <hr>

            <!-- ENLANCES DEL MENÚ -->
            <div class="menu-items mt-4">

                <h5><a href="/app/controllers/C_Home.php" class="text-white">Inicio</a></h5>

                <details>
                    <summary>
                        <h5>Animales</h5>
                    </summary> 
                    <a href="../../app/controllers/AnimalC.php">Animales</a><br />
                    <a href="../../app/controllers/AtencionVeterinariaC.php">Asistencia veterinaria</a><br />
                    <a href="../../app/controllers/JaulaC.php">Jaulas</a><br />
                </details>

                <details>
                    <summary>
                        <h5>Usuarios</h5>
                    </summary>
                    <a href="../../app/controllers/EmpleadoC.php">Empleados</a><br />
                    <a href="../../app/controllers/RolC.php">Perfiles</a>
                </details>

                <details>
                    <summary>
                        <h5>Tareas</h5>
                    </summary>
                    <a href="../../app/controllers/AsignarTareasC.php?action=show_my_tasks">Mis Tareas asignadas</a><br />
                    <a href="../../app/controllers/AsignarTareasC.php">Asignar Tareas</a><br />
                    <a href="../../app/controllers/TareaC.php">Tareas</a><br />
                </details>

                <details>
                    <summary>
                        <h5>Personas</h5>
                    </summary>
                    <a href="../../app/controllers/VeterinarioC.php">Veterinarios</a>
                    <a href="../../app/controllers/VoluntarioC.php">Voluntarios</a><br />
                    <a href="../../app/controllers/AdoptanteC.php">Adoptantes</a>
                    <a href="../../app/controllers/DuenioC.php">Dueños</a>
                </details>
            </div>

            <hr>

            <div class="settings">
                <h5><a href="../../app/controllers/SettingsC.php" class="text-white">Ajustes</a></h5>
            </div>

            <hr>

            <div class="logout">
                <h5><a href="../../../perrera-ec2/app/controllers/LoginC.php?action=logout" class="text-white">Cerrar sesión</a></h5>
            </div>
        </div>
    </div>
</section>