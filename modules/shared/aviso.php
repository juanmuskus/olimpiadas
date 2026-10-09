<div class="row">
                    <div class="col-lg-12 alert alert-success mt-2">
                        <p>Bienvenido(a) <b><?php echo $us;?></b> al sistema de inscripción para las Olimpiadas de Matemáticas <?php echo date('Y');?>.</p>
                        <?php
                        require __DIR__ . '/conexion.php';
                        $idies = $_SESSION['id_ies'];
                        $sql = "SELECT nombre, mpio FROM ies, users_coord WHERE (IES_idIES = idIES) AND (idIES = $idies)";
                        $result = $con->query($sql);
                        foreach ($result as $row){
                            $nomies = $row['nombre'];
                            $mpio = $row['mpio'];
                        }
                        ?>
                        <small>La IE <b><?php echo $nomies.'</b> de <b>'.$mpio; ?></b>
                        posee un cupo de inscripción de <b><?php echo $_SESSION['cant_est'];?></b> estudiantes.</small>
                    </div>
                </div>
                