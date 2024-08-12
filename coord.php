<?php
session_start();
if (isset($_SESSION['usuario'])){
    $us = $_SESSION['usuario'];
    $tipo = $_SESSION['tipo'];
    $mail = $_SESSION['mail'];
}
else
{
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Olimpiadas Maths <?php echo date('Y');?></title>
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
        $sqlcoord = "SELECT docidentidad, CONCAT(u.apellidos,' ',u.nombres) AS nomcoord, u.email, u.pass, u.estado, u.cant_est, CONCAT(i.nombre,' de ',i.mpio) AS iesnom  FROM users_coord u, ies i WHERE (u.tipo = 'C') AND (idIES = IES_idIES) ORDER BY nomcoord, iesnom";
        echo "<div class='row mb-3'><div class='col-lg-9 nav-brad text-success'><h3><i class='bi bi-person-video3'></i> Coordinadores</h3></div><div class='col-lg-3 d-flex justify-content-center align-items-center'>
        <button class='btn btn-success' id = 'bnuevocoord'><i class='bi bi-person-plus-fill'></i> Nuevo</button>&nbsp;
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
                                    <th scope="col">IE's</th>
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
                                    echo "<td>" . $row['docidentidad'] . "</td>";
                                    echo "<td>" . $row['nomcoord']."</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['pass'] . "</td>";
                                    echo "<td>" . $row['estado'] . "</td>";
                                    echo "<td>" . $row['cant_est'] . "</td>";
                                    echo "<td>" . mb_convert_encoding($row['iesnom'], 'UTF-8', 'ISO-8859-1') . "</td>";
                                    echo "<td>
                                    <button class='btn btn-primary btn-sm' onclick=\"habilitar_coord('" . $row['docidentidad'] . "','" . $row['nomcoord'] . "');\"><i class='bi bi-person-fill-check'></i> Habilitar</button>
                                    <button class='btn btn-danger btn-sm' onclick='delete_coord(" . $row['docidentidad'] . ")'><i class='bi bi-trash-fill'></i> Eliminar</button>";
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
    
    <!-- /#wrapper --></body>
</html>
<link href="dataTables/datatables.min.css" rel="stylesheet">
<script src="dataTables/datatables.min.js"></script>
<link rel="stylesheet" href="datatables/buttons.bootstrap5.min.css">
<script src="dataTables/dataTables.buttons.min.js"></script>
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
                        window.location = 'eliminar_coord.php?id=' + id;
                        break;

                    default:
                        window.location = 'coord.php';
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

