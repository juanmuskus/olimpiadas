# Sistema de Olimpiadas de Matemáticas

Aplicación web en PHP para administrar la inscripción de instituciones educativas, coordinadores y estudiantes, consultar resultados y generar certificados.

## Requisitos

- PHP 8.2 o posterior.
- MySQL o MariaDB, con la extensión `mysqli` habilitada.
- Extensiones PHP `curl`, `iconv`, `json`, `mbstring`, `mysqli` y `openssl`.
- Composer 2.
- Servidor web con la raíz del sitio apuntando a este directorio.

## Instalación

1. Instala las dependencias:

   ```sh
   composer install
   ```

2. Configura las variables de entorno en `.env`. Si todavía no existe un archivo local, puedes usar `.env.example` como plantilla. Si ya tienes uno, conserva los valores de la base de datos y añade las variables de correo que faltan.
3. Crea una base de datos MySQL/MariaDB e importa `DB/db_maths.sql` en una base vacía.
4. Configura el servidor web para servir el directorio del proyecto. `index.php` es el único archivo PHP en la raíz; los endpoints de la aplicación están en sus respectivos directorios dentro de `modules/`.
5. Abre el sitio e inicia sesión con una cuenta autorizada que exista en la base de datos.

Para una prueba local con el servidor integrado de PHP:

```sh
php -S 127.0.0.1:8000
```

No reemplaces un `.env` existente sin conservar sus valores. No publiques ese archivo ni guardes contraseñas o credenciales reales en el repositorio.

## Variables de entorno

| Variable | Uso |
| --- | --- |
| `HOST`, `USER`, `PASS`, `DB` | Conexión MySQL/MariaDB. |
| `APP_URL` | URL pública del sistema, usada en enlaces de correo. |
| `MAIL_HOST`, `MAIL_PORT`, `MAIL_ENCRYPTION` | Servidor SMTP y transporte (`ssl` o `tls`). |
| `MAIL_USERNAME`, `MAIL_PASSWORD` | Credenciales SMTP. |
| `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` | Remitente mostrado en los correos. |
| `MAIL_REPLY_TO` | Dirección opcional para respuestas. |

Las funciones de correo requieren los valores de SMTP y `APP_URL`. Si falta alguno, el sistema informa explícitamente qué configuración falta.

## Módulos

- `modules/auth`: inicio y cierre de sesión, cambio y recuperación de contraseña.
- `modules/students`: consulta, inscripción, edición y eliminación de estudiantes.
- `modules/coordinators`: administración, registro y habilitación de coordinadores.
- `modules/institutions`: gestión de instituciones educativas.
- `modules/reports`: auditoría y exportación de listados.
- `modules/certificates`: consulta y generación de certificados PDF.
- `modules/shared`: conexión, navegación, avisos, utilidades y notificaciones por correo.

Los formularios, enlaces y solicitudes AJAX apuntan directamente a los endpoints de sus módulos. La etiqueta `base` de las páginas de los módulos resuelve las rutas compartidas a partir de la raíz de la aplicación.

## Datos y archivos

- `DB/db_maths.sql`: esquema y datos de ejemplo/exportados para la base de datos.
- `fpdf/`: biblioteca utilizada para generar certificados.
- `img/`, `css/`, `js/`, `bootstrap/`, `datatables/`: recursos de interfaz.
- `docs/`: documentos auxiliares del proyecto.

Consulta [manual.md](./manual.md) para las instrucciones de uso por rol.
