CREATE TABLE empleados (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  correo VARCHAR(150) NOT NULL UNIQUE,
  apellido VARCHAR(100),
  nombre VARCHAR(100),
  edad INT UNSIGNED,
  puesto ENUM('usuario', 'empleado', 'administrativo', 'contable', 'dependiente', 'gerente', 'repartidor') NOT NULL DEFAULT 'usuario',
  creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('javier', 'usuario@1','javier@gmail.com', 'Coloma', 'Javier', 25, 'contable');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('carmen', 'usuario@1','carmen@gmail.com', 'Oviedo', 'Carmen', 34, 'administrativo');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('pascual', 'usuario@1','pascual@gmail.com', 'Vargas', 'Pascual', 19, 'dependiente');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('maria', 'usuario@1','maria@gmail.com', 'Donoso', 'Maria', 45, 'gerente');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('manuel', 'usuario@1','manuel@gmail.com', 'Celis', 'Manuel', 56, 'dependiente');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('jana', 'usuario@1','jana@gmail.com','Palencia', 'Jana', 31, 'dependiente');
INSERT INTO empleados (nombre_usuario, contrasena, correo, apellido, nombre, edad, puesto) VALUES('pedro', 'usuario@1','pedro@gmail.com', 'Zamanillo', 'Pedro', 63,'repartidor');