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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Olimpiadas Maths <?php echo date('Y'); ?></title>
</head>

<body>
<?php
            if (isset($_POST["bcam"])){
            $pas1 = $_POST["pass1"];
            $pas2 = $_POST["pass2"];
            $usu = $_SESSION['usuario'];
                if ((strlen($pas1) >= 5) && (strlen($pas2) >= 5)){
                    if ($pas1 == $pas2){
                        include('conexion.php');
                        $sql = "UPDATE users_coord SET pass = '$pas1' WHERE email = '$mail'";
                        $result = $con->query($sql);
                        if ($result)
                        echo "<script>   
                        swal({text: 'Password modificado con éxito..!', title: 'Cambiar password',}).then((value) => {
                        window.location= 'cambiarpass.php';
                        });
                        </script>";    
                        $con->close();
                        }
                        else
                        echo "<script>   
                        swal({text: 'No coinciden los password ingresados..!', title: 'Cambiar password',}).then((value) => {
                        window.location= 'cambiarpass.php';
                        });
                        </script>";    
        
                }
                else
                echo "<script>   
                swal({text: 'La extensión mínima del password es de 5 caracteres..!', title: 'Cambiar password',}).then((value) => {
                window.location= 'password.php';
                });
                </script>";    
            }
        ?>
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
                <div class="row mt-2">
                    <div class="alert alert-primary" role="alert">
                        <strong><i class="bi bi-shield-lock-fill"></i> Cambiar password</strong>
                    </div>
                    <form action="#" method="post">
                        <div class="col-3">
                        <div class="mb-2">
                            <label for="pass1" class="form-label">Nuevo password</label>
                            <input type="password" class="form-control" id="pass1" name='pass1' required>
                        </div>
                        <div class="mb-2">
                            <label for="pass2" class="form-label">Reingrese password</label>
                            <input type="password" class="form-control" id="pass2" name='pass2' required><hr>
                            <button name="bcam" type="submit" class='btn btn-primary'><i class="bi bi-arrow-bar-up"></i> Cambiar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>

</html>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>