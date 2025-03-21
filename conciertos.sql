-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS conciertos;

-- Crear la base de datos
CREATE DATABASE conciertos;
USE conciertos;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    pass VARCHAR(60) NOT NULL,  -- Aumentado para soportar hashes de contraseñas
    correo VARCHAR(255) NOT NULL
);

-- Tabla bandas
CREATE TABLE bandas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL
);

-- Tabla ciudades (opcional)
CREATE TABLE ciudades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Tabla salas
CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ciudad_id INT,
    aforo INT,
    FOREIGN KEY (ciudad_id) REFERENCES ciudades(id)
);

-- Tabla conciertos
CREATE TABLE conciertos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    banda_id INT,
    sala_id INT,
    fecha_concierto DATE NOT NULL,
    imagen BLOB,
    hora TIME,
    FOREIGN KEY (banda_id) REFERENCES bandas(id),
    FOREIGN KEY (sala_id) REFERENCES salas(id)
);

INSERT INTO usuarios (nombre, pass, correo) VALUES ('pablo', 'aaaa', 'pablo@agenda.es');

INSERT INTO bandas (nombre, genero) VALUES ('SOLDIER', 'metal');
INSERT INTO bandas (nombre, genero) VALUES ('METALLICA', 'metal');
INSERT INTO bandas (nombre, genero) VALUES ('MEGADETH', 'metal');
INSERT INTO bandas (nombre, genero) VALUES ('IRON MAIDEN', 'metal');
INSERT INTO bandas (nombre, genero) VALUES ('PANTERA', 'metal');
INSERT INTO bandas (nombre, genero) VALUES ('ALTER BRIDGE', 'rock');
INSERT INTO bandas (nombre, genero) VALUES ('GUNS N ROSES', 'rock');
INSERT INTO bandas (nombre, genero) VALUES ('BRUCE SPRINGSTEEN', 'rock');
INSERT INTO bandas (nombre, genero) VALUES ('SHAKIRA', 'pop');
INSERT INTO bandas (nombre, genero) VALUES ('LADY GAGA', 'pop');
INSERT INTO bandas (nombre, genero) VALUES ('NACH SCRATCH', 'rap');
INSERT INTO bandas (nombre, genero) VALUES ('EL CHOJIN', 'rap');
INSERT INTO bandas (nombre, genero) VALUES ('VIOLADORES DEL VERSO', 'rap');
INSERT INTO bandas (nombre, genero) VALUES ('PORTA', 'rap');

INSERT INTO ciudades (nombre) VALUES('OVIEDO');
INSERT INTO ciudades (nombre) VALUES('GIJON');
INSERT INTO ciudades (nombre) VALUES('AVILES');

INSERT INTO salas (nombre, ciudad_id, aforo) VALUES ('GONG', '1', '500');
INSERT INTO salas (nombre, ciudad_id, aforo) VALUES ('LATA DE ZINC', '1', '250');
INSERT INTO salas (nombre, ciudad_id, aforo) VALUES ('CASINO', '2', '800');
INSERT INTO salas (nombre, ciudad_id, aforo) VALUES ('MALECON', '3', '200');


SELECT * FROM SALAS;
