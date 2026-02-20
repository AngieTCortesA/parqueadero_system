-- Elimina la base de datos si existe
DROP DATABASE IF EXISTS parqueadero_system;

-- Crea la base de datos
CREATE DATABASE parqueadero_system;
USE parqueadero_system;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    p_nombre VARCHAR(20) NOT NULL,
    s_nombre VARCHAR(20),
    p_apellido VARCHAR(20) NOT NULL,
    s_apellido VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    bloqueado TINYINT(1) NOT NULL DEFAULT 0,
    telefono VARCHAR(20) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de configuración del parqueadero
CREATE TABLE configuracion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_cupos INT NOT NULL DEFAULT 10,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de reservas (sin restricción UNIQUE)
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    numero_espacio INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    placa_vehiculo VARCHAR(10) NOT NULL,
    estado ENUM('activa', 'completada', 'cancelada') DEFAULT 'activa',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar configuración inicial
INSERT INTO configuracion (total_cupos) VALUES (10);

-- Insertar usuario administrador
INSERT INTO usuarios (p_nombre, email, password, rol)
VALUES (
    'Administrador',
    'admin@3shape.com',
    'Ta10120620!',
    'admin'
);

ALTER TABLE reservas ADD COLUMN tipo_vehiculo ENUM('moto', 'carro') NOT NULL DEFAULT 'carro';

