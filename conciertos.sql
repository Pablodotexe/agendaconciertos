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

-- Tabla salas
CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ciudad_id INT,
    aforo INT
);

-- Tabla ciudades
CREATE TABLE ciudades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    id_sala INT,
    FOREIGN KEY (id_sala) REFERENCES salas(id)
);



-- Tabla conciertos
CREATE TABLE conciertos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    banda_id INT,
    sala_id INT,
    ciudad_id INT,
    fecha_concierto DATE NOT NULL,
    hora TIME,
    cartel VARCHAR (255),
    FOREIGN KEY (banda_id) REFERENCES bandas(id),
    FOREIGN KEY (sala_id) REFERENCES salas(id),
    FOREIGN KEY (ciudad_id) REFERENCES ciudades(id)
);

-- Tabla asistencias
CREATE TABLE asistencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    concierto_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (concierto_id) REFERENCES conciertos(id)
);

INSERT INTO usuarios (nombre, pass, correo) VALUES ('admin', 'aaaa', 'pablo@agenda.es');

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

INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (1, 1, 1, '2024-12-15', '19:00:00', 'https://i0.wp.com/metalcry.com/wp-content/uploads/2023/08/372968903_767240832077515_6175755046795487559_n-scaled.jpg?w=566&ssl=1');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (1, 4, 3, '2025-03-26', '20:00:00', 'https://i0.wp.com/metalcry.com/wp-content/uploads/2023/08/372968903_767240832077515_6175755046795487559_n-scaled.jpg?w=566&ssl=1');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (3, 2, 1, '2024-12-15', '19:00:00', 'https://es.concerts-metal.com/images/flyers/202311/1699628170--Megadeth---Tour-2024.webp');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (4, 4, 3, '2025-03-26', '20:00:00', 'https://mariskalrock.com/wp-content/uploads/2021/04/iron-maiden-cartel-barcelona-2022.jpg');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (2, 1, 1, '2024-12-17', '19:00:00', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.mm.bing.net%2Fth%3Fid%3DOIP.2bwprKPLq2Kh4O6npV_o-AHaNK%26pid%3DApi&f=1&ipt=438cda1a8bcb3c63a80b9a5635730051c6b540f8c1e937c7efa1935a8c68cd06&ipo=images');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (5, 3, 2, '2025-02-05', '19:00:00', 'https://es.concerts-metal.com/images/flyers/202302/1677595162.webp');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (6, 1, 1, '2024-12-07', '19:00:00', 'https://i0.wp.com/metalcry.com/wp-content/uploads/2013/10/alter-bridge-bcn.jpg?ssl=1');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (7, 3, 2, '2025-01-10', '19:00:00', 'https://onsevilla.com/imagen_onsevilla/m/gunsnrosessevilla2020.jpg');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (8, 1, 1, '2025-05-09', '19:00:00', 'https://www.diariodeavila.es/media/IMG/2023/30A44085-A0F2-3DD1-D43BE8694788FC27.JPG');
INSERT INTO conciertos (banda_id, sala_id, ciudad_id, fecha_concierto, hora, cartel) VALUES (8, 1, 1, '2024-12-20', '19:00:00', 'https://www.diariodeavila.es/media/IMG/2023/30A44085-A0F2-3DD1-D43BE8694788FC27.JPG');

SELECT * FROM asistencias;