CREATE TABLE productoselectro (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    nombre VARCHAR(255),
    descripcion VARCHAR(255),
    precio DECIMAL(10, 2),
    stock INT
) COMMENT '';

ALTER TABLE productoselectro
ADD COLUMN imagen VARCHAR(255) COMMENT '';