📝 Rasgos de Project Zomboid - Aplicación CRUD PHP
Esta es una aplicación web dinámica desarrollada en PHP que permite gestionar un sistema de usuarios (Registro/Login) y realizar operaciones CRUD (Create, Read, Update, Delete) sobre una base de datos MariaDB. El proyecto está completamente containerizado con Docker, lo que facilita su despliegue en cualquier entorno, incluyendo AWS.

🚀 Funcionalidades Principales
Sistema de Autenticación Seguro: Registro de usuarios y login funcional con cifrado de contraseñas mediante password_hash y verificación con password_verify.

Gestión CRUD: Interfaz para añadir, listar, editar y eliminar rasgos o datos específicos.

Sesiones de Usuario: Control de acceso mediante sesiones de PHP para proteger rutas privadas (como home.php).

Contenedores Docker: Separación de servicios (Servidor Web Apache/PHP y Base de Datos MariaDB).

📁 Estructura del Proyecto
Basado en la arquitectura del repositorio:
```
.
├── sql/
│   └── database.sql          # Esquema de la base de datos y datos iniciales
├── src/                      # Código fuente de la aplicación
│   ├── html/                 # Archivos HTML estáticos
│   ├── img/                  # Recursos visuales y assets
│   ├── config.php            # Conexión centralizada a la base de datos
│   ├── login.php             # Interfaz de inicio de sesión
│   ├── login_action.php      # Lógica de validación de credenciales
│   ├── registro.php          # Formulario de creación de cuenta
│   ├── registro_action.php   # Lógica para nuevos usuarios (Hash)
│   ├── home.php              # Panel principal (Dashboard)
│   ├── add.php / add_action.php    # Gestión de inserción de datos
│   ├── edit.php / edit_action.php  # Gestión de edición de datos
│   ├── delete.php            # Lógica para eliminar registros
│   ├── logout.php            # Cierre seguro de sesión
│   ├── test.php              # Scripts de prueba de conexión
│   └── index.php             # Punto de entrada principal
├── .env                      # Variables de entorno
├── docker-compose.yml        # Orquestación de contenedores
├── Dockerfile                # Configuración de imagen PHP personalizada
└── README.md                 # Documentación del proyecto
```
🛠️ Tecnologías Utilizadas
Backend: PHP 8.x

Base de Datos: MariaDB (MySQL)

Servidor: Apache (vía Docker)

Seguridad: Bcrypt para hashing de contraseñas.

Despliegue: Docker & Docker Compose.

📦 Instalación y Despliegue
Para poner en marcha el proyecto localmente o en un servidor AWS, sigue estos pasos:

Clonar el repositorio:

Bash
git clone https://github.com/TU_USUARIO/TU_REPOSITORIO.git
cd TU_REPOSITORIO
Levantar los servicios con Docker:

Bash
docker-compose up -d --build
Acceso:
Abre tu navegador en http://localhost:8080 (o la IP de tu instancia de AWS).

🔒 Notas sobre Seguridad
El proyecto implementa las mejores prácticas aprendidas:

Uso de ob_start() para manejo limpio de cabeceras y redirecciones.

Validación de datos de entrada para prevenir errores de ejecución.

Almacenamiento de contraseñas no legibles en la base de datos.
