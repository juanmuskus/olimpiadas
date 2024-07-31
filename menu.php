<div id="sidebar-wrapper">
        <h4 id="uni">Universidad de Córdoba</h4><hr style="color:aliceblue; height: 2rem;">
        <p id="oli">Olimpiadas de Matemáticas <?php echo date('Y');?></p>    
            <ul class="sidebar-nav" style="margin-top: 5rem;">
                <li class="sidebar-brand">
                </li>
                <li style='margin-top:5rem;'>
                    <a href="main.php"><i class="bi bi-people-fill"></i> Estudiantes</a>
                </li>
                <?php
                if ($tipo=='A')
                echo "<li>
                    <a href='#'><i class='bi bi-person-check-fill'></i> Coordinadores</a>
                </li>
                <li>
                    <a href='ies.php'><i class='bi bi-buildings-fill'></i> IE´s</a>
                </li>
                <li>
                    <a href='#'><i class='bi bi-card-checklist'></i> Listados</a>
                </li>
                <li>
                        <a href='#'><i class='bi bi-gear-fill'></i> Admin Users</a>
                    </li>";
                ?>
                <li>
                    <a href="#"><i class="bi bi-key-fill"></i> Password</a>
                </li>
                <li>
                    <a href="salir.php"><i class="bi bi-power"></i> Salir</a>
                </li>
            </ul>
        </div>
