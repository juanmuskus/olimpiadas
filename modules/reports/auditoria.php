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
                        $con->set_charset("utf8");
                        $sqlcoord = "SELECT COUNT(e.doc) AS cante, us.nit, CONCAT(i.nombre, ' de ', i.mpio) AS col, us.email AS cmail FROM estudiantes e JOIN ies i ON e.ies_IDIES = i.idIES JOIN users_coord us ON us.IES_idIES = e.ies_IDIES GROUP BY i.idIES, i.nombre, i.mpio, us.email, us.nit;";
                        echo "<div class='row mb-3'><div class='col-lg-9 nav-brad text-success'><h3><i class='bi bi-person-video3'></i> Cant. de Estudiantes x IE's</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
                        &nbsp;
                        </div>
                        </div>
                        <hr>";
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablaies">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nit IE's</th>
                                        <th scope="col">Email Coord.</th>
                                        <th scope="col">IE's</th>
                                        <th scope="col">Cant. Estudiantes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $con->query($sqlcoord);
                                    $i = 1;
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $i . "</td>";
                                        echo "<td>" . $row['nit'] . "</td>";
                                        echo "<td>" . $row['cmail'] . "</td>";
                                        echo "<td>" . $row['col'] . "</td>";
                                        echo "<td>" . $row['cante'] . "</td>";
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
</script>