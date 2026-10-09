# Manual del sistema

## 1. Ingreso

1. Abre la página principal del sistema.
2. Escribe el correo registrado y la contraseña.
3. Selecciona **Ingresar**.
4. Para salir de la cuenta, usa **Salir** en el menú lateral.

Las cuentas y sus permisos deben estar registrados en la base de datos. El menú presenta opciones diferentes según el tipo de cuenta.

## 2. Coordinadores de instituciones educativas

### Solicitar una cuenta

1. Desde la página de ingreso, selecciona **Inscripción coord. IE's**.
2. Completa los datos solicitados, incluidos los datos de contacto y de la institución educativa.
3. Envía el formulario.
4. La solicitud queda pendiente de habilitación administrativa.

La notificación de la solicitud y los mensajes de habilitación se envían por correo. Para que este paso funcione, la configuración SMTP debe estar completa.

### Iniciar sesión y administrar estudiantes

Una vez habilitada la cuenta, inicia sesión con el correo y la contraseña recibidos. En la opción **Estudiantes** puedes consultar los estudiantes asociados a la institución, registrar estudiantes y editar o eliminar sus registros según las opciones disponibles.

El cupo asignado por la administración limita las inscripciones de la institución. Verifica los datos antes de guardar cambios.

### Cambiar o recuperar la contraseña

- Con una sesión iniciada, selecciona **Password** y completa el formulario de cambio.
- Si no puedes iniciar sesión, selecciona **Recuperar contraseña** en la página principal e ingresa el correo asociado a la cuenta.

## 3. Administración

Las cuentas administrativas tienen acceso a las opciones adicionales del menú:

- **Coordinadores**: revisar solicitudes, modificar datos, habilitar cuentas y asignar el cupo de estudiantes.
- **IE's**: consultar y mantener el registro de instituciones educativas.
- **Listado**: descargar una hoja de cálculo con los datos de estudiantes para su procesamiento.
- **Auditoría IEs**: consultar el resumen de estudiantes registrados por institución.
- **Estudiantes**: revisar y mantener los registros de participación.

Al habilitar una cuenta de coordinador, verifica el correo, la institución y el cupo asignado: la notificación de habilitación incluye esos datos.

## 4. Certificados

Desde las opciones de consulta de estudiantes, busca el registro correspondiente y usa el enlace de certificado de la ronda disponible. El sistema genera el documento en PDF usando los datos del estudiante, el grado y la institución.

Si un certificado no se genera, comprueba que el estudiante tenga los datos requeridos y que los recursos de `fpdf/` e `img/` estén disponibles en el despliegue.

## 5. Instalación y configuración

1. Instala dependencias con `composer install`.
2. Configura `.env` con los datos de conexión a MySQL/MariaDB y, para funciones de correo, las variables `APP_URL` y `MAIL_*` descritas en [readme.md](./readme.md).
3. Importa `DB/db_maths.sql` en una base vacía.
4. Publica el proyecto con la raíz web apuntando al directorio que contiene `index.php`.
5. Inicia sesión con una cuenta válida de la base de datos.

No sustituyas un `.env` existente sin guardar sus valores y no compartas las credenciales de producción. `index.php` es el único archivo PHP en la raíz; el resto de los endpoints de la aplicación están organizados bajo `modules/`.

## 6. Solución de problemas

- **No conecta con la base de datos**: verifica `HOST`, `USER`, `PASS` y `DB`, que MySQL/MariaDB esté activo y que `mysqli` esté habilitado.
- **No se envían correos**: comprueba `APP_URL`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_ENCRYPTION`, `MAIL_USERNAME`, `MAIL_PASSWORD` y `MAIL_FROM_ADDRESS`; revisa también la conectividad con el servidor SMTP.
- **No carga una página o un recurso visual**: verifica que la raíz web apunte al directorio del proyecto y que existan los directorios `modules/`, `css/`, `js/`, `bootstrap/`, `datatables/`, `img/` y `fpdf/`.
- **No aparece una opción administrativa**: confirma que la sesión corresponda a una cuenta administrativa.
