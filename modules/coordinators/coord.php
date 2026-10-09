<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
} else {
    echo "<title>Error</title>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>";
    echo "<div style='margin: 20px 20px 20px 20px;'><div class='alert alert-danger' role='alert'>";
    echo "Ud no posee acceso al sistema !!!";
    echo "<hr><a href='../../index.php'><button class='btn btn-danger'><i class='bi bi-box-arrow-in-left'> </i>Login</button></a></div></div>";
    die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <base href="../../">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/coord.js"></script>
    <title>Olimpiadas Maths <?php echo date('Y'); ?></title>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include dirname(__DIR__, 2) . '/modules/shared/menu.php';
        ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle" style="border:0.1rem solid black"><i class="bi bi-list"></i></a>
                    </div>
                    <!-- /#page-content-wrapper -->
                    <div class="row">
                        <?php
                        include dirname(__DIR__, 2) . '/modules/shared/conexion.php';
                        echo "<div class='col-lg-12 alert alert-danger mt-2'>Bienvenido <b>Admin</b> del sistema</div>";
                        // query all
                        $sqlcoord = "SELECT docidentidad, CONCAT(u.apellidos,' ',u.nombres) AS nomcoord, u.email, u.pass, u.estado, u.cant_est, CONCAT(i.nombre,' de ',i.mpio) AS iesnom, lugar, nit FROM users_coord u, ies i WHERE (u.tipo = 'C') AND (idIES = IES_idIES) ORDER BY nomcoord, iesnom";
                        echo "<div class='row mb-3'><div class='col-lg-9 nav-brad text-success'><h3><i class='bi bi-person-video3'></i> Coordinadores</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
                        <button class='btn btn-success' id='bnuevocoord'><i class='bi bi-person-plus-fill'></i> Nuevo</button>&nbsp;
                        </div>
                        </div>
                        <hr>";
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablacoord">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Doc. Identidad</th>
                                        <th scope="col">Coord.</th>
                                        <th scope="col">E-Mail</th>
                                        <th scope="col">Contraseña</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Cant. Estudiantes</th>
                                        <th scope="col">Modalidad/Lugar</th>
                                        <th scope="col">IE's</th>
                                        <th scope="col">Nit.</th>
                                        <th scope="col">Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $con->query($sqlcoord);
                                    $i = 1;
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $i . "</td>";
                                        echo "<td id='idcoord'>" . $row['docidentidad'] . "</td>";
                                        echo "<td>" . $row['nomcoord'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['pass'] . "</td>";
                                        echo "<td>" . $row['estado'] . "</td>";
                                        echo "<td>" . $row['cant_est'] . "</td>";
                                        echo "<td>" . $row['lugar'] . "</td>";
                                        echo "<td>" . $row['iesnom'] . "</td>";
                                        echo "<td>" . $row['nit'] . "</td>";
                                        echo "<td>
                                    <button class='btn btn-primary btn-sm' onclick=\"habilitar_coord('" . $row['docidentidad'] . "','" . $row['nomcoord'] . "');\"><i class='bi bi-eye'></i> Habilitar</button>
                                    <button class='btn btn-warning btn-sm' onclick=\"update_coord('" . $row['docidentidad'] . "','" . $row['iesnom'] . "');\"><i class='bi bi-pencil-fill'></i> Editar</button>
                                    <button class='btn btn-danger btn-sm' onclick='delete_coord(" . $row['docidentidad'] . ")'><i class='bi bi-trash-fill'></i> Borrar</button>";
                                        echo "</td></tr>";
                                        $i++;
                                    }
                                    $con->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <!-- Modal Nuevo Coordinador -->
        <div class="modal fade" id="nuevocoord" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-start"><b>Nuevo Coordinador de IE's</b></p>
                        <form action="modules/coordinators/nregistrar_coord.php" method="post">
                            <div class="col-5 mb-2">
                                <p class="text-start">Doc. identidad</p>
                                <input type="number" name="doci" id="doci" class="form-control" required>
                            </div>

                            <div class="row mt-3">
                                <div class="col-6 mb-2">
                                    <p class="text-start">Nombres</p>
                                    <input type="text" name="nom" id="nom" class="form-control" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-6 mb-2">
                                    <p class="text-start">Apellidos</p>
                                    <input type="text" name="apel" id="apel" class="form-control" style="text-transform:uppercase" required>
                                </div>
                            </div>

                            <div class="col-10 mb-2">
                                <p class="text-start">E-mail</p>
                                <input type="mail" name="cmail" id="cmail" class="form-control" required>
                            </div>

                            <div class="row mt-3">
                                <div class="col-4 mb-2">
                                    <p class="text-start">Municipio:</p>
                                    <select name="mpio" id="mpio" class="form-control" required>
                                        <?php
                                        include dirname(__DIR__, 2) . '/modules/shared/conexion.php';
                                        $sql = "SELECT distinct mpio FROM ies ORDER BY mpio ASC";
                                        $result = $con->query($sql);
                                        while ($mostrar = mysqli_fetch_array($result))
                                            echo '<option value="' . $mostrar['mpio'] . '">' . $mostrar['mpio'] . '</option>';
                                        // cerrar la conexión
                                        $con->close();
                                        ?>
                                    </select>
                                </div>

                                <div class="col-8 mb-2">
                                    <p class="text-start">IE's:</p>
                                    <select name="lies" id="lies" class="form-control" required>
                                        // Cargar las IES de acuerdo al municipio seleccionado
                                    </select>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6 mb-2">
                                        <p class="text-start">Nit. - Ins. Educativa:</p>
                                        <input type="number" name="nit" id="nit" class="form-control" pattern="\d*" required>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <p class="text-start">Modalidad y lugar de Presentación - Fase 1:</p>
                                        <select name="lugar" id="lugar" class='form-control' required disabled>
                                            <option value="Virtual" selected>Virtual</option>
                                            <option value="Montelíbano">Montelíbano</option>
                                            <option value="Berástegui">Berástegui</option>
                                            <option value="Lorica">Lorica</option>
                                            <option value="Sahagún">Sahagún</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Editar Nuevo Coordinador -->
        <div class="modal fade" id="editarcoord" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-start"><b>Editar Coordinador de IE's</b></p>
                        <form action="modules/coordinators/update_coord.php" method="post">
                            <input type="hidden" name="udocicoord">
                            <div class="row mb-2">
                                <p class="text-start" id="eidcoord">Doc. identidad:</p>
                                <hr>
                            </div>

                            <div class="row mt-3">
                            <div class="col-6 mb-2">
                                <p class="text-start">Nombres:</p>
                                <input type="text" name="enom" id="enom" class="form-control" style="text-transform:uppercase" required>
                            </div>
                            <div class="col-6 mb-2">
                                <p class="text-start">Apellidos:</p>
                                <input type="text" name="eapel" id="eapel" class="form-control" style="text-transform:uppercase" required>
                            </div>
                            </div>

                            <div class="col-8 mb-2">
                                <p class="text-start">E-mail:</p>
                                <input type="mail" name="edmail" id="edmail" class="form-control" required>
                            </div>

                            <div class="row mt-3">
                            <div class="col-3 mb-2">
                                <p class="text-start">Cant. Estudiantes:</p>
                                <input type="number" name="ucant" id="ucant" class="form-control" required>
                            </div>

                            <div class="col-3 mb-2">
                                <p class="text-start">Nit. - Ins. Educativa:</p>
                                <input type="number" name="enit" id="enit" class="form-control" pattern="\d*" required>
                            </div>

                            <div class="col-6">
                            <p class="text-start">Modalidad y lugar de Presentación - Fase 1:</p>
                                        <select name="elugar" id="elugar" class='form-control' required disabled>
                                            <option value="Virtual" selected>Virtual</option>
                                            <option value="Montelíbano">Montelíbano</option>
                                            <option value="Berástegui">Berástegui</option>
                                            <option value="Lorica">Lorica</option>
                                            <option value="Sahagún">Sahagún</option>
                                        </select>
                            </div>
                            </div>

                            <div class="col-12 mb-2">
                                <p class="text-start">IE's:</p>
                                <p class="text-primary" id="col"></p>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


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
        $('#tablacoord').DataTable({
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

    function delete_coord(id) {
        swal("Olimpiadas Maths", "Se elimarán el coord. y los estudiantes de la Inst. Educativa...! ", "warning", {
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
                        window.location = 'modules/coordinators/eliminar_coord.php?id=' + id;
                        break;

                    default:
                        window.location = 'modules/coordinators/coord.php';
                }
            });
    }

    function habilitar_coord(id, nom) {
        swal({
                title: "Olimpiadas Maths",
                text: "Se habilitará la cuenta del coord. " + nom + ". Por favor, ingrese la cantidad de estudiantes:",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Cantidad de estudiantes",
                        type: "number",
                        min: "1",
                    },
                },
                buttons: {
                    cancel: "Cancelar",
                    confirm: {
                        text: "Habilitar",
                        value: true,
                    },
                },
            })
            .then((value) => {
                if (value) {
                    let cantidadEstudiantes = document.querySelector('.swal-content__input').value;
                    if (cantidadEstudiantes) {
                        window.location = 'modules/coordinators/habilitar_coord.php?id=' + id + '&estudiantes=' + cantidadEstudiantes;
                    } else {
                        swal("Error", "Debe ingresar una cantidad de estudiantes válida.", "error");
                    }
                } else {
                    window.location = 'modules/coordinators/coord.php';
                }
            });
    }

    function update_coord(id, col) {
        $('#nuevocoord').modal('hide');
        $.ajax({
            url: 'modules/coordinators/get_coord.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                const coord = JSON.parse(response);
                $('#eidcoord').html("Doc. identidad: <b class='text-primary'>" + coord.docidentidad + "</b>");
                $('input[name="udocicoord"]').val(coord.docidentidad);
                $('#enom').val(coord.nombres);
                $('#eapel').val(coord.apellidos);
                $('#edmail').val(coord.email);
                $('#col').text(col);
                $('#ucant').val(coord.cant_est);
                $('#enit').val(coord.nit);
                $('#elugar').val(coord.lugar);
                $('#editarcoord').modal('show');
            }
        });
    }
</script>