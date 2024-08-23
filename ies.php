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
                    <!-- /#page-content-wrapper -->
                    <div class="row">
                        <?php
                        include 'conexion.php';
                        echo "<div class='col-lg-12 alert alert-danger mt-2'>Bienvenido <b>Admin</b> del sistema</div>";
                        // query all
                        $sqlcoord = "SELECT idIES, nombre, mpio, CASE tipo WHEN 'U' THEN 'Urbano' WHEN 'R' THEN 'Rural' END AS tipo FROM ies order by mpio, nombre";
                        echo "<div class='row mb-3'><div class='col-lg-9 nav-brad text-primary'><h3><i class='bi bi-person-video3'></i> Instituciones Educativas</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
                        <button class='btn btn-success' id = 'bnuevocoord'><i class='bi bi-person-plus-fill'></i> Nuevo</button>&nbsp;
                        </div>
                        </div>
                        <hr>";
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablaies">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Id IE's</th>
                                        <th scope="col">Nombre IE</th>
                                        <th scope="col">Municpio</th>
                                        <th scope="col">Tipo</th>
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
                                        echo "<td>" . $row['idIES'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['mpio'] . "</td>";
                                        echo "<td>" . $row['tipo'] . "</td>";
                                        echo "<td>
                                        <button class='btn btn-danger btn-sm' onclick='delete_coord(" . $row['idIES'] . ")'><i class='bi bi-trash-fill'></i> Eliminar</button>";
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
        <div class="modal fade" id="nuevocoord" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-start"><b>Nueva Inst. Educativa</b></p>
                        <form action="registrar_ie.php" method="post">
                            <div class="col-6 mb-2">
                                <p class="text-start">Codigo</p>
                                <input type="number" name="cod" id="cod" class="form-control" required>
                            </div>
                            <div class="col-10 mb-2">
                                <p class="text-start">Municipio</p>
                                <input type="text" name="mpio" id="mpio" class="form-control" style="text-transform:uppercase" required>
                            </div>
                            <div class="col-12 mb-2">
                                <p class="text-start">Nombre IE</p>
                                <input type="text" name="nomie" id="nomie" class="form-control" style="text-transform:uppercase" required>
                            </div>
                            <div class="col-6 mb-2">
                                <p class="text-start">IE's:</p>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="U" selected>Urbano</option>
                                    <option value="R">Rural</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Registrar</button>
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
        $('#tablaies').DataTable({
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
        swal("Olimpiadas Maths", "Se elimarán la Inst. Educativa y sus estudiantes...! ", "warning", {
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
                        window.location = 'eliminar_ie.php?id=' + id;
                        break;
                    default:
                        window.location = 'ies.php';
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
                        window.location = 'habilitar_coord.php?id=' + id + '&estudiantes=' + cantidadEstudiantes;
                    } else {
                        swal("Error", "Debe ingresar una cantidad de estudiantes válida.", "error");
                    }
                } else {
                    window.location = 'coord.php';
                }
            });
    }
</script>