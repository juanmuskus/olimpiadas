<div id="sidebar-wrapper">
        <h4 id="uni">Olimpiadas de Matemáticas</h4><hr style="color:aliceblue; height: 2rem;">
        <p id="oli">Olimpiadas de Matemáticas <?php echo date('Y');?></p>
            <ul class="sidebar-nav" style="margin-top: 5rem;">
                <li class="sidebar-brand">
                </li>
                <li style='margin-top:5rem;'>
                    <a href="modules/students/main.php"><i class="bi bi-people-fill"></i> Estudiantes</a>
                </li>
                <?php
                if ($tipo=='A')
                echo "<li>
                    <a href='modules/coordinators/coord.php'><i class='bi bi-person-check-fill'></i> Coordinadores</a>
                </li>
                <li>
                    <a href='modules/institutions/ies.php'><i class='bi bi-buildings-fill'></i> IE´s</a>
                </li>
                <li>
                    <a href='modules/reports/listado.php'><i class='bi bi-filetype-xlsx'></i> Listado</a>
                </li>
                <li>
                    <a href='modules/reports/auditoria.php'><i class='bi bi-grid-3x2'></i> Auditoria IEs</a>
                </li>";
                ?>
                <li>
                    <a href="modules/auth/cambiarpass.php"><i class="bi bi-key-fill"></i> Password</a>
                </li>
                <li>
                    <a href="modules/auth/salir.php"><i class="bi bi-power"></i> Salir</a>
                </li>
            </ul>
        </div>