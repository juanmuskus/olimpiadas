<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
    $id_ies = $_SESSION['id_ies'];
    $cant_est = $_SESSION['cant_est'];
} else {
    echo "<title>Error</title>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>";
    echo "<div style='margin: 20px 20px 20px 20px;'><div class='alert alert-danger' role='alert'>";
    echo "Ud no posee acceso al sistema !!!";
    echo "<hr><a href='index.php'><button class='btn btn-danger'><i class='bi bi-box-arrow-in-left'> </i>Login</button></a></div></div>";
    die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Olimpiadas Maths <?php echo date('Y'); ?></title>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include 'menu.php';
        ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" style="border:0.1rem solid black"><i class="bi bi-list"></i></a>
                    </div>
                </div>
                <?php
                include 'conexion.php';
                if ($tipo == 'C') { // listado para cooord
                    include 'aviso.php';
                    // query x Ies
                    $idies = $_SESSION['id_ies'];
                    $sql = "SELECT * FROM estudiantes WHERE (IES_idIES = $idies) ORDER BY grado, apellido1 DESC";
                    echo "<div class='row'><div class='col-lg-9 nav-brad text-primary'><h3><i class='bi bi-people-fill'></i> Estudiantes</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
                    <button class='btn btn-success' id = 'bnuevo'><i class='bi bi-person-plus-fill'></i> Nuevo</button>&nbsp;
                    </div>
                    </div>
                    <hr>";
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tablaest">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Doc. Identidad</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Grado</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Operaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $con->query($sql);
                                $i = 1;
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row['doc'] . "</td>";
                                    echo "<td>" . $row['nombre1'] . " " . $row['nombre2'] . "</td>";
                                    echo "<td>" . $row['apellido1'] . " " . $row['apellido2'] . "</td>";
                                    echo "<td>" . $row['grado'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>
                                    <button class='btn btn-warning btn-sm' onclick=\"update_est('" . $row['doc'] . "','" . $row['nombre1'] . "','" . $row['nombre2'] . "','" . $row['apellido1'] . "','" . $row['apellido2'] . "','" . $row['grado'] . "','" . $row['email'] . "');\"><i class='bi bi-pencil-square'></i> Actualizar</button> 
                                    <button class='btn btn-danger btn-sm' onclick='delete_est(" . $row['doc'] . ")'><i class='bi bi-trash-fill'></i> Eliminar</button></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                $con->close();
                                ?>
                            </tbody>
                        </table>
                    </div>

                <?php
                } else { // listado para admin
                    echo "<div class='col-lg-12 alert alert-danger mt-2'>Bienvenido <b>Admin</b> del sistema</div>";
                    // query all
                    $sqlroot = "SELECT e.*, CONCAT(i.nombre,' de ',i.mpio) AS iesnom FROM estudiantes e, ies i WHERE idIES = IES_idIES ORDER BY IES_idIES, apellido1";
                    echo "<div class='row'><div class='col-lg-9 nav-brad text-primary'><h3><i class='bi bi-people-fill'></i> Estudiantes</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
                    <button class='btn btn-success' id = 'bnuevoroot'><i class='bi bi-person-plus-fill'></i> Nuevo</button>&nbsp;
                    </div>
                    </div>
                    <hr>";
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tablaroot">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Doc. Identidad</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Grado</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">IES</th>
                                    <th scope="col">Operaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $con->query($sqlroot);
                                $i = 1;
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row['doc'] . "</td>";
                                    echo "<td>" . $row['nombre1'] . " " . $row['nombre2'] . "</td>";
                                    echo "<td>" . $row['apellido1'] . " " . $row['apellido2'] . "</td>";
                                    echo "<td>" . $row['grado'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['iesnom'] . "</td>";
                                    echo "<td>
                                    <button class='btn btn-warning btn-sm' onclick=\"update_est('" . $row['doc'] . "','" . $row['nombre1'] . "','" . $row['nombre2'] . "','" . $row['apellido1'] . "','" . $row['apellido2'] . "','" . $row['grado'] . "','" . $row['email'] . "');\"><i class='bi bi-pencil-square'></i> Editar</button> 
                                    <button class='btn btn-danger btn-sm' onclick='delete_est(" . $row['doc'] . ")'><i class='bi bi-trash-fill'></i> Eliminar</button></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                $con->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div> <!-- /#wrapper -->

        </div>
        <!-- /#page-content-wrapper -->

    </div>

    <!-- Modal nuevo -->
    <div class="modal fade" id="new_est" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- formulario -->
                    <form method='post' action='nuevo_est.php'>
                        <fieldset>
                            <!-- Text input Id -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="doci"><i class="bi bi-check text-success"></i> Doc. Identidad</label>
                                <div class="col-md-5">
                                    <input id="doci" name="doci" type="number" placeholder="" class="form-control" min="999999" required>
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="nom1" class="form-label"><i class="bi bi-check text-success"></i> Nombre 1</label>
                                    <input type="text" class="form-control" id="nom1" name="nom1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nom2" class="form-label">Nombre 2</label>
                                    <input type="text" class="form-control" id="nom2" name="nom2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- Apellidos -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="apel1" class="form-label"><i class="bi bi-check text-success"></i> Apellido 1</label>
                                    <input type="text" class="form-control" id="apel1" name="apel1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apel2" class="form-label">Apellido 2</label>
                                    <input type="text" class="form-control" id="apel2" name="apel2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- grado-->
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="grado" class="form-label"><i class="bi bi-check text-success"></i> Grado</label>
                                        <select class="form-select" aria-label="Default select example" name="grado" required>
                                            <option value="6" selected>6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label" for="estmail"><i class="bi bi-check text-success"></i> E-mail</label>
                                            <input id="estmail" name="estmail" type="email" placeholder="" class="form-control" value="@" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id_ies" value="<?php echo $id_ies; ?>">
                                        <?php
                                        include 'conexion.php';
                                        $sqlnomies = "SELECT nombre, mpio FROM ies WHERE idIES = $id_ies";
                                        $result = $con->query($sqlnomies);
                                        foreach ($result as $row)
                                            $nomies = "<b>" . $row['nombre'] . "</b> de <b>" . $row['mpio'] . "</b>";
                                        $con->close();
                                        ?>
                                        <p class="text-primary"><?php echo $nomies; ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <small><i class="bi bi-check text-success"></i> Campos requeridos</small>
                                </div>

                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#new_user" aria-label="Close"><i class="bi bi-x"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-person-plus-fill"></i> Registrar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- Fin Modal Nuevo -->

    <!-- Modal UPDATE -->
    <div class="modal fade" id="update_est" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- formulario -->
                    <form method='post' action='update_est.php'>
                        <fieldset>
                            <!-- Text input Id -->
                            <div class="row">
                                <div class="col-10">
                                    <p id="udoc_ident"></p>
                                </div>
                                <div class="col-2">
                                    <input id="udoci" name="udoci" type="hidden">
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="unom1" class="form-label"><i class="bi bi-check text-success"></i> Nombre 1</label>
                                    <input type="text" class="form-control" id="unom1" name="unom1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="unom2" class="form-label">Nombre 2</label>
                                    <input type="text" class="form-control" id="unom2" name="unom2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- Apellidos -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="uapel1" class="form-label"><i class="bi bi-check text-success"></i> Apellido 1</label>
                                    <input type="text" class="form-control" id="uapel1" name="uapel1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="uapel2" class="form-label">Apellido 2</label>
                                    <input type="text" class="form-control" id="uapel2" name="uapel2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- grado-->
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="ugrado" class="form-label"><i class="bi bi-check text-success"></i> Grado</label>
                                        <select class="form-select" aria-label="Default select example" name="ugrado" required>
                                            <option value="6" selected>6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label" for="uestmail"><i class="bi bi-check text-success"></i> E-mail</label>
                                            <input id="uestmail" name="uestmail" type="email" placeholder="" class="form-control" value="@" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="uid_ies" value="<?php echo $id_ies; ?>">
                                        <?php
                                        include 'conexion.php';
                                        $sqlnomies = "SELECT nombre, mpio FROM ies WHERE idIES = $id_ies";
                                        $result = $con->query($sqlnomies);
                                        foreach ($result as $row)
                                            $nomies = "<b>" . $row['nombre'] . "</b> de <b>" . $row['mpio'] . "</b>";
                                        $con->close();
                                        ?>
                                        <p class="text-primary"><?php echo $nomies; ?></p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <small><i class="bi bi-check text-success"></i> Campos requeridos</small>
                                </div>

                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#new_user" aria-label="Close"><i class="bi bi-x"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-down"></i> Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- Fin Modal UPDATE -->

    <!-- Modal nuevo x ROOT-->
    <div class="modal fade" id="new_estroot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Estudiante - Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- formulario -->
                    <form method='post' action='nuevo_estroot.php'>
                        <fieldset>
                            <!-- Text input Id -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="rdoci"><i class="bi bi-check text-success"></i> Doc. Identidad</label>
                                <div class="col-md-5">
                                    <input id="rdoci" name="rdoci" type="number" placeholder="" class="form-control" min="999999" required>
                                </div>
                            </div>

                            <!-- Nombres -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="rnom1" class="form-label"><i class="bi bi-check text-success"></i> Nombre 1</label>
                                    <input type="text" class="form-control" id="rnom1" name="rnom1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="rnom2" class="form-label">Nombre 2</label>
                                    <input type="text" class="form-control" id="rnom2" name="rnom2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- Apellidos -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="rpel1" class="form-label"><i class="bi bi-check text-success"></i> Apellido 1</label>
                                    <input type="text" class="form-control" id="rapel1" name="rapel1" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="rapel2" class="form-label">Apellido 2</label>
                                    <input type="text" class="form-control" id="rapel2" name="rapel2" style="text-transform:uppercase">
                                </div>
                            </div>

                            <!-- grado-->
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="rgrado" class="form-label"><i class="bi bi-check text-success"></i> Grado</label>
                                        <select class="form-select" aria-label="Default select example" name="rgrado" required>
                                            <option value="6" selected>6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label" for="restmail"><i class="bi bi-check text-success"></i> E-mail</label>
                                            <input id="restmail" name="restmail" type="email" placeholder="" class="form-control" value="@" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                <div class="col-8">
                                    <p class="text-start"><i class="bi bi-check text-success"></i> Municipio:</p>
                                    <select name="rmpio" id="rmpio" class="form-control" required>
                                        <?php
                                        include 'conexion.php';
                                        $sql = "SELECT distinct mpio FROM ies ORDER BY mpio ASC";
                                        $result = $con->query($sql);
                                        while ($mostrar = mysqli_fetch_array($result))
                                            echo '<option value="' . $mostrar['mpio'], 'UTF-8', 'ISO-8859-1' . '">' . $mostrar['mpio'] . '</option>';
                                        // cerrar la conexión
                                        $con->close();
                                        ?>
                                    </select>
                                </div>
                                </div>

                                <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="text-start"><i class="bi bi-check text-success"></i> IE's:</p>
                                    <select name="rlies" id="rlies" class="form-control" required>
                                        // Cargar las IES de acuerdo al municipio seleccionado
                                    </select>
                                </div>
                                </div>

                                <div class="row mt-2">
                                    <small><i class="bi bi-check text-success"></i> Campos requeridos</small>
                                </div>

                        </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#new_user" aria-label="Close"><i class="bi bi-x"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-person-plus-fill"></i> Registrar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- Fin Modal Nuevo x ROOT -->

</body>

</html>
<link href="datatables/datatables.min.css" rel="stylesheet">
<script src="datatables/datatables.min.js"></script>
<link rel="stylesheet" href="datatables/buttons.bootstrap5.min.css">
<script src="datatables/dataTables.buttons.min.js"></script>
<script src="datatables/buttons.bootstrap5.min.js"></script>
<script src="datatables/pdfmake.min.js"></script>
<script src="datatables/jszip.min.js"></script>
<script src="datatables/vfs_fonts.js"></script>
<script src="datatables/buttons.html5.min.js"></script>
<script src="datatables/buttons.print.min.js"></script>
<link rel="stylesheet" href="datatables/buttons.dataTables.css">
<script src="datatables/buttons.dataTables.js"></script>
<link rel="stylesheet" href="datatables/dataTables.bootstrap5.css">
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function() {

        $('#bnuevo').click(function() {
            $('#update_est').modal('hide');
            $('#new_estroot').modal('hide');
            $('#new_est').modal('show');
        });

        $('#bnuevoroot').click(function() {
            $('#update_est').modal('hide');
            $('#new_est').modal('hide');
            $('#new_estroot').modal('show');
        });

        $('#tablaest').DataTable({
            "buttons": [{
                    "extend": 'copy',
                    "text": 'Copiar'
                },
                'csv', 'excel', 'pdf', {
                    "extend": 'print',
                    "text": 'Imprimir'
                }
            ],
            "layout": {
                "topStart": 'buttons',
                "top2Start": 'pageLength'
            },
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $('#tablaroot').DataTable({
            "buttons": [{
                    "extend": 'copy',
                    "text": 'Copiar'
                },
                'csv', 'excel', 'pdf', {
                    "extend": 'print',
                    "text": 'Imprimir'
                }
            ],
            "layout": {
                "topStart": 'buttons',
                "top2Start": 'pageLength'
            },
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

    });

    function update_est(doci, nom1, nom2, ape1, ape2, grado, email) {
        $('#update_est').modal('hide');
        $('#new_estroot').modal('hide');
        $('#udoci').val(doci);
        $('#udoc_ident').html('Documento de Identidad: <b>' + doci + '</b>');
        $('#unom1').val(nom1);
        $('#unom2').val(nom2);
        $('#uapel1').val(ape1);
        $('#uapel2').val(ape2);
        $('#ugrado').val(grado);
        $('#uestmail').val(email);
        $('#update_est').modal('show');
    }

    function delete_est(id) {
        swal("Olimpiadas Maths", "Realmente desea eliminar este estudiante ? ", "warning", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Eliminar",
                        value: "catch",
                    }
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        window.location = 'eliminar_est.php?id=' + id;
                        break;

                    default:
                        window.location = 'main.php';
                }
            });
    }

    $('#rmpio').change(function() {
        var mpiosel = $(this).val();
        $.ajax({
            url: 'lista_ies.php',
            type: 'POST',
            data: {mpio: mpiosel},
            success: function(response){
                $('#rlies').empty(); // Limpiar el select de opciones anteriores
                var data = JSON.parse(response);
                data.forEach(function(ie) {
                    $('#rlies').append('<option value="' + ie.id + '">' + ie.nombre + '</option>');
                });
            }
        });        
    });
</script>