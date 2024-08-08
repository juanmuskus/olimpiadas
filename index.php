<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/index.js"></script>
    <title>Unicordoba - Olimpiadas Math</title>
  </head>
<body class="text-center">
<main class="form-signin">
  <form action="login.php" method="post">
    <h1 class="h3 mb-3 fw-normal"><img src="img/unicor.png" width="10%" height="10%"> <b>Universidad de Córdoba</b></h1>
    <p class="text-center"><img src="img/math.png" width="5%" height="5%"> Olimpiadas de Matemáticas</p>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" name="mail" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Ingresar</button>
  </form>
    <div class="form-floating mt-4">
    <button class="btn btn-danger" id="bcoord"><i class="bi bi-person-plus"></i> Incripción para coord. IE's</button>
    </div>
    <div class="form-floating mt-2">
      <button class="btn btn-secondary" id="bmail"><i class="bi bi-bell"></i> Olvidaste tu contraseña ?</button><hr>
    </div>
    <p class="mt-5 mb-3 text-dark"><img src="img/cintia.ico" width="15%" height="15%"> &copy; Desarrollado por CINTIA - 2024</p>
  
</main>

<!-- Modal: recuperar x correo -->
<div class="modal fade" id="rmail" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-start">Ingresa tu e-mail registrado para recuperar tu contraseña:</p>
          <div class="mb-3">
          <form action="recovery_mail.php" method="POST">
          <input type="mail" name="mail" id="mail" class="form-control" placeholder="ejemplo@correo.com" aria-describedby="helpId" required/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
        <button type="submit" class="btn btn-success"><i class="bi bi-envelope-at-fill"></i> Recuperar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- FIN recuperar x correo -->


<!-- Modal: Coord -->
<div class="modal fade" id="coord" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-start"><b>Inscripción de Coordinadores de IE's</b></p>
        <form action="">
          <div class="col-6 mb-2">
            <p class="text-start">Doc. identidad</p>
            <input type="number" name="doci" id="doci" class="form-control" required>
          </div>
          <div class="col-8 mb-2">
            <p class="text-start">Nombres</p>
            <input type="text" name="nom" id="nom" class="form-control" required>
          </div>
          <div class="col-8 mb-2">
            <p class="text-start">Apellidos</p>
            <input type="text" name="apel" id="apel" class="form-control" required>
          </div>
          <div class="col-10 mb-2">
            <p class="text-start">E-mail</p>
            <input type="mail" name="cmail" id="cmail" class="form-control" required>
          </div>
          <div class="col-6 mb-2">
            <p class="text-start">Municipio:</p>
            <select name="mpio" id="mpio" class="form-control" required>
            <?php
              include 'conexion.php';
              $sql = "SELECT distinct mpio FROM ies ORDER BY mpio ASC";
              $result = $con->query($sql);
              while ($mostrar = mysqli_fetch_array($result))
                echo '<option value="'.mb_convert_encoding($mostrar['mpio'],'UTF-8','ISO-8859-1').'">'.mb_convert_encoding($mostrar['mpio'],'UTF-8','ISO-8859-1').'</option>';
              // cerrar la conexión
              $con->close();
              ?>
            </select>
          </div>

          <div class="col-12 mb-2">
            <p class="text-start">IE's:</p>
            <select name="lies" id="lies" class="form-control" required>
            // Cargar las IES de acuerdo al municipio seleccionado
            </select>
          </div>
                              
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
        <button type="button" class="btn btn-success"><i class="bi bi-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN Coord -->
</body>
</html>
