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
                    <a href='coord.php'><i class='bi bi-person-check-fill'></i> Coordinadores</a>
                </li>
                <li>
                    <a href='ies.php'><i class='bi bi-buildings-fill'></i> IE´s</a>
                </li>
                <li>
                    <a href='listado.php'><i class='bi bi-filetype-xlsx'></i> Listado</a>
                </li>
                <li>
                    <a href='auditoria.php'><i class='bi bi-grid-3x2'></i> Auditoria IEs</a>
                </li>";
                ?>
                <li>
                    <a href="cambiarpass.php"><i class="bi bi-key-fill"></i> Password</a>
                </li>
                <li>
                    <a href="salir.php"><i class="bi bi-power"></i> Salir</a>
                </li>
                <li id='logo' class='text-center'>
                <small style='color:white' id='des'>Desarrollado por:
                <a href="https://cintia.unicordoba.edu.co/" target="_blank" id="llogo"><img class='img-fluid' src="img/CINTIA_LOGO.png"></a>
                </small>
                </li>
            </ul>
        </div>
        <style>
            #logo{
                margin-top: 10rem;
                padding: 0.5rem;
                width: 80%;
                height: 80%;
            }
            #llogo:hover {
                background-color: black;
                border-radius: 10px;
            }
        </style>