🧟 Project Zomboid - Sistema de Gestión (DB)
Este repositorio contiene la configuración de la base de datos MariaDB para una aplicación web CRUD en Vanilla PHP dockerizada. La temática principal es la gestión de supervivientes y sus rasgos (traits) dentro del universo de Project Zomboid.

📊 Estructura de la Base de Datos
La base de datos se llama pz_yeray y consta de dos tablas independientes.

1. Tabla: usuarios
Gestiona el acceso de los usuarios al sistema.

usuario_id: Clave primaria autoincremental.

nombre_usuario: Identificador único del usuario.

contrasena: Almacena la contraseña hasheada mediante password_hash() (VARCHAR 255).

correo: Correo electrónico único.

creacion: Marca de tiempo automática de registro.

2. Tabla Principal: rasgos
Almacena los rasgos oficiales del juego.

rasgos_id: Clave primaria (formato nombreTabla_id).

nombre_rasgo: Nombre oficial en español.

codigo_rasgo: Campo UNIQUE para evitar duplicados internos.

puntos_coste: Valor numérico del rasgo (positivo o negativo).

descripcion_efecto: Cadena con la explicación del rasgo.

es_positivo: Campo numérico (booleano) para clasificar el rasgo.

🔐 Seguridad y Credenciales
Siguiendo las instrucciones obligatorias, el acceso se configura de la siguiente manera:

Usuario Root: Acceso habilitado para cualquier host ('root'@'%').

Contraseña Root/Usuario: Formato NombreApellido@Año (Sin tildes ni ñ).

Usuario de Aplicación: Formato usuario_inicialNombre_inicialesApellidos (ej: usuarioYCa).

Hashing: Las contraseñas se gestionan en PHP con password_hash() y password_verify(). Nunca se guarda texto plano.

🚀 Requisitos de la Aplicación (CRUD)
La aplicación conectada a esta base de datos debe cumplir con:

Mantenimiento completo: Listado, altas, bajas y modificaciones de la tabla rasgos.

Formularios: Deben incluir campos de texto, numéricos y combos de opciones (select).

Validación: Control de duplicados en el campo UNIQUE antes de insertar.

Estilos: Uso obligatorio de Bootstrap y logotipos relacionados con Project Zomboid.