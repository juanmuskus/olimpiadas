<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/signin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/index.js"></script>
  <title>Olimpiadas de Matemáticas <?php echo date('Y'); ?></title>
</head>

<body class="text-center">
  <main class="form-signin">
    <div class="text-center mb-3">
      <div class="hero-badge mb-3">
        <i class="bi bi-calculator-fill"></i>
        <span>Competencia académica</span>
      </div>
      <p class="brand-subtitle fw-semibold mb-1 text-primary">Sistema de Administración de Inscripciones</p>
      <h1 class="h3 mb-2 fw-bold brand-title">Olimpiadas de Matemáticas</h1><hr>
      <p class="brand-subtitle mb-3 text-muted">Accede al sistema y gestiona tu participación en <?php echo date('Y'); ?></p>
    </div>

    <form action="modules/auth/login.php" method="post">
      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" name="mail" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="pass" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary mt-3" type="submit"><i class="bi bi-box-arrow-in-right"></i> Ingresar</button>
    </form>

    <div class="auth-actions">
      <button class="btn btn-danger" id="bcoord"><i class="bi bi-person-plus"></i> Inscripción coord. IE's</button>
      <button class="btn btn-secondary" id="bmail"><i class="bi bi-bell"></i> Recuperar contraseña</button>
    </div>

    <hr class="my-3">
    <small class="text-secondary">&copy; <?php echo date('Y'); ?> Olimpiadas de Matemáticas</small>
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
            <form action="modules/auth/recovery_mail.php" method="POST">
              <input type="mail" name="mail" id="mail" class="form-control" placeholder="ejemplo@correo.com" aria-describedby="helpId" required />
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Olimpiadas - Math</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-start"><b>Inscripción de Coordinadores de IE's</b></p>
          <form action="modules/coordinators/registrar_coord.php" method="post">
            <div class="col-6 mb-2">
              <p class="text-start">Doc. identidad</p>
              <input type="number" name="doci" id="doci" class="form-control" required>
            </div>
            <div class="row">
              <div class="col-6 mb-2">
                <p class="text-start">Nombres</p>
                <input type="text" name="nom" id="nom" class="form-control" style="text-transform:uppercase" required>
              </div>
              <div class="col-6 mb-2">
                <p class="text-start">Apellidos</p>
                <input type="text" name="apel" id="apel" class="form-control" style="text-transform:uppercase" required>
              </div>
            </div>
            <div class="col-8 mb-2">
              <p class="text-start">E-mail</p>
              <input type="email" name="cmail" id="cmail" class="form-control" required>
            </div>

            <div class="row mt-3">
              <div class="col-4 mb-2">
                <p class="text-start">Municipio:</p>
                <select name="mpio" id="mpio" class="form-control" required>
                  <?php
                  require __DIR__ . '/modules/shared/conexion.php';
                  $con->set_charset("utf8");
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
                  <!-- Cargar las IES de acuerdo al municipio seleccionado -->
                </select>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-6 mb-2">
                <p class="text-start">Modalidad y lugar Presentación - Fase 1:</p>
                <select name="lugar" id="lugar" class='form-control' required>
                  <option value="Virtual" selected>Virtual</option>
                  <option value="Montelíbano">Montelíbano</option>
                  <option value="Berástegui">Berástegui</option>
                  <option value="Lorica">Lorica</option>
                  <option value="Sahagún">Sahagún</option>
                </select>
              </div>

              <div class="col-6 mb-2">
                <p class="text-start">Nit. - Ins. Educativa:</p>
                <input type="number" name="nit" id="nit" class="form-control" pattern="\d*" required>
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
  <!-- FIN Coord -->

  <!-- WHATSAPP -->
  <a target="_blank" href="https://wa.me/573003337788?text=Hola,%20Estoy%20intresado%20en%20las%20Olimpiadas%20de%20Matemáticas"
    class="whatsapp-button"><i class="bi bi-whatsapp"></i></a>
  <!-- FIN WHATSAPP -->

  <!-- AYUDA -->
      <button class="corner-button2" id="botoncert"><i class="bi bi-filetype-pdf"></i> Certificados</button>
  <!-- -->

  <!-- Certificados -->
  <div class="modal fade" id="mcert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-filetype-pdf"></i> Certificados</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-start">Ingrese el doc. de identidad del estudiante: </p>
          <div class="row">
            <div class="col-4">
              <input type="number" name="busdoci" id="busdoci" class="form-control" required>
              <small id="busaviso" class="text-danger"></small>
            </div>
            <div class="col-4 text-start">
              <button type="button" class="btn btn-danger" id="bbuscar"><i class="bi bi-search"></i> Buscar</button>
            </div>
          </div>
          <div class="row mt-4">
            <div id="info">

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
<script>
  $(document).ready(function() {
    $('#mcert').modal('hide'); //activar para ver certificados
    $('#rmail').modal('hide');
    $('#coord').modal('hide');
  });

  $('#botoncert').click(function() {
    $('#mcert').modal('show');
  });
</script>
<style>
  .whatsapp-button {
    position: fixed;
    bottom: 30px;
    right: 15px;
    z-index: 99;
    background-color: #25d366;
    border-radius: 50px;
    color: #ffffff;
    text-decoration: none;
    width: 50px;
    height: 50px;
    font-size: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    -webkit-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    animation: effect 5s infinite ease-in;
  }

  @keyframes effect {

    20%,
    100% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }

    0%,
    10% {
      width: 55px;
      height: 55px;
      font-size: 35px;
    }

    5% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }
  }

  .corner-button2 {
    font-family: inherit;
    letter-spacing: 0.02rem;
    cursor: pointer;
    background: transparent;
    border: 0.2rem solid currentColor;
    padding: 0.5rem 0.6rem;
    font-size: 1em;
    color: green;
    position: fixed;
    transition: color 0.3s;
    z-index: 2;
    top: 1em;
    left: 1em;
    border-radius: 5px;
    /* zoom: .4; */
  }

  .corner-button2:hover {
    color: red;
    background: #f8f9fa;
  }
</style>
