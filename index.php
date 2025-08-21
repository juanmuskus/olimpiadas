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
  <title>Unicordoba - Olimpiadas Maths <?php echo date('Y'); ?></title>
</head>

<body class="text-center">
  <main class="form-signin">
    <form action="login.php" method="post">
      <img src="img/logo_unicor.png" class="mb-4" alt="Unicordoba" width="100%" height="100%">
      <h1 class="h3 mb-3 fw-normal"><b>Universidad de Córdoba</b></h1>
      <p class="text-center"><img src="img/math.png" width="5%" height="5%"> Olimpiadas de Matemáticas <?php echo date('Y'); ?></p>
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
      <button class="btn btn-secondary" id="bmail"><i class="bi bi-bell"></i> Olvidaste tu contraseña ?</button>
      <hr>
      <a href="#" data-bs-toggle="modal" data-bs-target="#anuncio"><i class="bi bi-info-circle-fill"></i> Ver Anuncio</a>
    </div>
    <small class="mt-2 text-secondary">Desarrollado por:</small><br>
    <small class="mt-1 mb-3 text-dark"><img src="img/cintia.ico" width="10%" height="10%"> Centro de Innovación en TIC para apoyo a la Academia <b>CINTIA</b></small>
    <small class="mt-2">&copy <?php echo date('Y'); ?></small>
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
          <form action="registrar_coord.php" method="post">
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
                  include 'conexion.php';
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

              <div class="col-3 mb-2">
                <p class="text-start">Nit. - Ins. Educativa:</p>
                <input type="number" name="nit" id="nit" class="form-control" pattern="\d*" required>
              </div>

              <div class="col-3 mb-2">
                <p class="text-start">Tipo Ins. Educ.:</p>
                <select name="tipo" id="tipo" class='form-control' required>
                  <option value="PUB" selected>Pública</option>
                  <option value="PRI">Privada</option>
                </select>
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

  <!-- Modal Anuncio -->
  <div class="modal fade modal-xl" id="anuncio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-1 text-primary" id="exampleModalLabel">Información Importante !</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
          $y = date('Y');
          $valor = 10000 + (((int)$y - 2023) * 1000);
          include 'fun_texto.php';
          $valor_texto = num2Text($valor);
          ?>
          <p class="text-start">La inscripción a las Olimpiadas Matemáticas Unicórdoba <?php echo date('Y'); ?> tiene como fecha límite el día <b>20 de septiembre de <?php echo date('Y'); ?></b>. Este proceso se hace a través de este formulario y tiene una inversión de $<?php echo number_format($valor); ?> (<?php echo $valor_texto; ?> mil pesos) por estudiante participante. Cada colegio debe hacer una única consignación por el valor total de los inscritos, el recibo de pago se generará en el siguiente link <a href="https://educacioncontinuada.appsprod.unicordoba.edu.co/inscripcursos/576" target="_blank"><button class="btn btn-primary btn-sm"><i class="bi bi-currency-dollar"></i> Pago</button></a>, debe diligenciar bien la información para que la factura electrónica salga correctamente. El recibo de pago aparece por $ <?php echo number_format($valor); ?> pesos, pero una vez nos informe el número de estudiantes que participarán se ajustará el valor a pagar.</p>
          <p class="text-start">El evento se desarrollará en dos etapas.</p>
          <table class="table table-hover">
            <tbody>
              <tr>
                <th scope="row" class="align-middle text-danger">Primera Etapa</th>
                <td>
                  <p class="text-start">Clasificatoria: se llevará a cabo de manera virtual</p>
                  <p class="text-start">De forma virtual del <b>29 de septiembre al 3 de octubre de <?php echo date('Y'); ?></b>, de 8:00 am a 6:00 pm, a través de la plataforma <a href="https://maraton.unicordoba.edu.co/login/index.php" target="_blank">Maratón</a> de la Universidad de Córdoba. Se detalla a continuación por grados:</p>
                  <p class="text-start">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item text-primary text-start">Grado 6 el día 29 de septiembre</li>
                    <li class="list-group-item text-primary text-start">Grado 7 el día 30 de septiembre</li>
                    <li class="list-group-item text-primary text-start">Grado 8 el día 1 de octubre</li>
                    <li class="list-group-item text-primary text-start">Grado 9 el día 2 de octubre</li>
                    <li class="list-group-item text-primary text-start">Grado 10 y 11 el día 3 de octubre</li>
                  </ul>
                  </p>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle text-danger">Segunda Etapa</th>
                <td>
                  <p class="text-start"><b>Final:</b> se realizará el día <b>31 de septiembre del <?php echo date('Y'); ?></b>, de 7:30 am a 1:00 pm, en las instalaciones de la Universidad de Córdoba (Departamento de Matemáticas y Estadística, Bloque 38). Carrera 6 No. 77- 305 Montería - Córdoba, Colombia, Nit: 891080031-3.</p>
                  <p class="text-start bg-danger-subtle">Cada colegio puede inscribir <b>hasta 36 estudiantes</b>, los cuales puede distribuir a su conveniencia. Además, después de haber realizado el respectivo pago por derecho a inscripción, por favor, enviar comprobante de pago al número de WhatsApp del coordinador del evento<a href="https://wa.me/573015920775" class="btn btn-success" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp (+57) 301 5920775</a></p>
                  <p class="text-start">Cualquier inquietud ponte en contacto con nosotros a través del <a href="https://wa.me/573015920775" class="btn btn-success" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp (+57) 301 5920775</a> o escribe al coordinador de las olimpiadas, Carlos Banquet Brango <b><i>cbanquet@correo.unicordoba.edu.co</i></b></p>
                </td>
              </tr>
            </tbody>

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- WHATSAPP -->
  <a target="_blank" href="https://wa.me/+573015920775?text=Hola,%20Estoy%20intresado%20en%20las%20Olimpiadas%20de%20Matemáticas"
    class="whatsapp-button"><i class="bi bi-whatsapp"></i></a>
  <!-- FIN WHATSAPP -->

  <!-- AYUDA -->
  <button class="corner-button" id="botonayuda"><i class="bi bi-question-square-fill"></i> Ayuda</button>
  <button class="corner-button2" id="botoncert"><i class="bi bi-filetype-pdf"></i> Certificados</button>
  <button class="corner-button3" id="botonorg"><i class="bi bi-people-fill"></i> Comite Organizador</button>

  <!-- -->

  <!-- AYUDA - Videos -->
  <div class="modal fade" id="ayuda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ayuda - Video Tutoriales</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12" style="height: 250px;">
              <p class="text-primary fs-5">Inscripción de Coordinadores IE's</p>
              <video src="video/Inscripcion_Coord_IEs.mp4" style="width: 100%; height: 100%; object-fit: cover;" controls></video>
            </div>
          </div>
          <div class="row" style="margin-top:5rem;">
            <div class="col-12" style="height: 250px;">
              <p class="text-primary fs-5">Registro de Estudiantes</p>
              <iframe width="100%" height="100%" src="https://www.youtube.com/embed/imwxIgu-2HI?si=VHZjWoJri6qQiR_m" title="Ayuda" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style=''></iframe>
            </div>
          </div>
        </div>
        <div class="modal-footer mt-5">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>

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

  <!-- Modal Comite Organizador-->
  <div class="modal fade" id="morg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-people-fill"></i> Comite Organizador</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row p-2">
            <div class="card mt-2 p-1">
              <div class="row">
                <div class="col-md-2">
                  <img src="img/cbanquet.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-10">
                  <div class="card-body text-start">
                    <h5 class="card-title text-primary">Coordinador / 7°</h5>
                    <p class="card-text"><b>Phd. Carlos Banquet Brango</b></p>
                    <small>Licenciatura en Matemáticas y Física, Universidad De Córdoba, Colombia. Maestría en Matemáticas, Universidad Nacional de Colombia, Sede Medellín, Colombia. Doctor En Matemáticas, Universidad Estatal De Campinas, Campinas, Brasil.</small>
                    <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> cbanquet@correo.unicordoba.edu.co</small></p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/jborja.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Sexto grado</h5>
                    <p class="card-text"><b>Phd. Jerson Mnauel Borja Soto</b></p>                      
                      <small class="card-text">Matemático, Universidad de Córdoba, Colombia. Magister en Matemáticas- Universidad De Los Andes, Colombia. Doctorado En Matemáticas - Universidad De Los Andes, Colombia.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> yersonborjas@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>

                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/jlloreda.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Octavo grado</h5>
                    <p class="card-text"><b>Msc. Jimmy Herlin Lloreda Zuñiga</b></p>                      
                      <small class="card-text">Matemático, Universidad de Córdoba, Colombia. Maestría en Matemáticas, Universidad Nacional de Colombia, Sede Medellín, Colombia.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> jhlloreda@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>

                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/eperez.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Noveno grado</h5>
                    <p class="card-text"><b>Phd. Edgardo Enrique Pérez Reyes</b></p>                      
                      <small class="card-text">Matemático, Universidad de Córdoba, Colombia. Magister en Matemáticas Aplicadas - Recinto Universitario de Mayaguez Universidad de Puerto Rico, Doctor en Ciencias-Matemática Aplicada, Universidade de São Paulo - Brazil.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> edgardoperezr@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>
                
                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/jreyes.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Decimo grado</h5>
                    <p class="card-text"><b>Msc. Jorge Armando Reyes Vasquez</b></p>                      
                      <small class="card-text">Matemático, Universidad de Córdoba, Colombia. Maestría En Matemáticas, Universidad Nacional De Colombia, Sede Medellín, Colombia.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> jorgereyesv@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row mt-2">
                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/lbenites.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Once grado</h5>
                    <p class="card-text"><b>Phd. Luis Enrique Benitez Babilonia</b></p>                      
                      <small class="card-text">Matemático, Universidad De Córdoba, Colombia. Magíster en Matemáticas, Universidad de Antioquia, Colombia. Doctor en Ciencias, con Orientación en Matemáticas Aplicadas, Centro de Investigación en Matemáticas, Guanajuato, México.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> luisbenitez@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>

                <div class="col-3">
                  <div class="card" style="height: 100%;">
                    <img src="img/jmuskus.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Soporte TIC´s - CINTIA</h5>
                    <p class="card-text"><b>Msc. Juan Manuel Muskus</b></p>                      
                      <small class="card-text">Magister en Software Libre UNAB - UOC, Ing. Sistemas, Lic. en Informatica Educ. Universidad de Córdoba - Colombia. Prof. Universitario CINTIA.</small>
                      <p class="card-text"><small class="text-body-secondary"><i class="bi bi-envelope"></i> jmuskus@correo.unicordoba.edu.co</small></p>
                    </div>
                  </div>
                </div>

              </div>
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
    $('#anuncio').modal('hide');
    $('#ayuda').modal('hide');
    //$('#mcert').modal('show'); activar para ver certificados
    $('#rmail').modal('hide');
    $('#coord').modal('hide');
  });

  $('#botonayuda').click(function() {
    $('#ayuda').modal('show');
  });

  $('#botoncert').click(function() {
    $('#mcert').modal('show');
  });
  $('#botonorg').click(function() {
    $('#morg').modal('show');
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

  .corner-button {
    font-family: inherit;
    letter-spacing: 0.02rem;
    cursor: pointer;
    background: transparent;
    border: 0.2rem solid currentColor;
    padding: 0.5rem 0.6rem;
    font-size: 1em;
    color: olive;
    position: fixed;
    transition: color 0.3s;
    z-index: 1;
    top: 1em;
    left: 1em;
    border-radius: 5px;
    /* zoom: .4; */
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
    left: 7em;
    border-radius: 5px;
    /* zoom: .4; */
  }

  .corner-button3 {
    font-family: inherit;
    letter-spacing: 0.02rem;
    cursor: pointer;
    background: transparent;
    border: 0.2rem solid currentColor;
    padding: 0.5rem 0.6rem;
    font-size: 1em;
    color: navy;
    position: fixed;
    transition: color 0.3s;
    z-index: 2;
    top: 1em;
    left: 15.6em;
    border-radius: 5px;
    /* zoom: .4; */
  }

  .corner-button:hover {
    color: #00c509;
    background: #f8f9fa;
  }

  .corner-button2:hover {
    color: red;
    background: #f8f9fa;
  }

  .corner-button3:hover {
    color: blue;
    background: #f8f9fa;
  }
</style>