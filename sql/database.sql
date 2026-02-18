CREATE DATABASE IF NOT EXISTS pz_yeray
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;;

USE pz_yeray;

CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE, 
    contrasena VARCHAR(255) NOT NULL, 
    correo VARCHAR(100) NOT NULL UNIQUE, 
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rasgos (
    rasgos_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rasgo VARCHAR(100) NOT NULL, 
    codigo_rasgo VARCHAR(20) NOT NULL UNIQUE,
    puntos_coste INT NOT NULL, 
    descripcion_efecto TEXT, 
    es_positivo TINYINT(1) NOT NULL
);

INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES 
('yeray', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'ygutierrezm05@educantabria.es'),
('usuario1', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario1@usuario1.com'),
('usuario2', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario2@usuario2.com'),
('usuario3', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario3@usuario3.com'),
('usuario4', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario4@usuario4.com'),
('usuario5', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario5@usuario5.com'),
('usuario6', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario6@usuario6.com'),
('usuario7', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario7@usuario7.com'),
('usuario8', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario8@usuario8.com'),
('usuario9', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario9@usuario9.com'),
('usuario10', '$2y$10$4BhxI1XlVbzV0lcr5mlF5e8tzgL2YSue6r4BUHa6.RQHvIDiqaffi', 'usuario10@usuario10.com');

INSERT INTO rasgos (nombre_rasgo, codigo_rasgo, puntos_coste, descripcion_efecto, es_positivo)
VALUES ('Ojos de gato', 'CatEyes', 2, 'Mejor vision en la oscuridad.', 1),
       ('Agil', 'Dexterous', 2, 'Transfiere objetos del inventario mas rapido.', 1),
       ('Lector rapido', 'FastReader', 2, 'Lee libros en menos tiempo.', 1),('Despierto', 'Wakeful', 2, 'Necesita dormir menos.', 1),
       ('Organizado', 'Organized', 2, 'Aumenta la capacidad de los contenedores.', 1),
       ('Gimnasta', 'Gymnast', 5, 'Niveles adicionales en Pies ligeros y Agilidad.', 1),
       ('Valiente', 'Brave', 4, 'Menos propenso a entrar en panico.', 1),
       ('Luchador de hachas', 'Axeman', 0, 'Corta madera y ataca mas rapido con hachas (Especial).', 1),
       ('Fuerte', 'Strong', 10, 'Mas fuerza y capacidad de carga.', 1),
       ('Resistente', 'Stout', 6, 'Fuerza y capacidad de carga extra.', 1),
       ('Gran bebedor', 'HighThirst', -6, 'Necesita beber mas agua para sobrevivir.', 0),
       ('Fumador', 'Smoker', -4, 'Necesita fumar para reducir el estres y la ansiedad.', 0),
       ('Sordo', 'Deaf', -12, 'Radio de percepcion reducido y no oye nada.', 0),
       ('Miope', 'ShortSighted', -2, 'Menor radio de vision y degradacion de la vista.', 0),
       ('Lento leyendo', 'SlowReader', -2, 'Tarda mas tiempo en leer libros.', 0),
       ('Miedoso', 'Cowardly', -2, 'Mas propenso a entrar en panico.', 0),
       ('Estomago debil', 'WeakStomach', -3, 'Mayor probabilidad de enfermedad por comida.', 0),
       ('Hemofobico', 'Hemophobic', -5, 'Panico al curar heridas y estres al estar ensangrentado.', 0),
       ('Agorafobico', 'Agoraphobic', -4, 'Entra en panico cuando esta en exteriores.', 0),
       ('Asmatico', 'Asthmatic', -5, 'La resistencia se agota mas rapido.', 0);
