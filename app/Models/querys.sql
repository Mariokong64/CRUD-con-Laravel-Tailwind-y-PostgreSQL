-- EN ESTE ARCHIVO PUSE LAS QUERYS QUE UTILICÉ EN LA BASE DE DATOS

-- Query para crear la base de datos
CREATE DATABASE vemasmas
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Mexico.utf8'
    LC_CTYPE = 'Spanish_Mexico.utf8'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

COMMENT ON DATABASE vemasmas
    IS 'Se trata de la base de datos para el ejercicio del CRUD.';

-- Query para crear la tabla de estados de la república
CREATE TABLE estados (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50)
);

-- Query para crear la tabla de domicilios
CREATE TABLE domicilios (
    id SERIAL PRIMARY KEY,
    id_estado INT REFERENCES estados(id),
    domicilio TEXT
);

-- Query para crear la tabla de ciudadanos
CREATE TABLE ciudadanos (
    id_ciudadano SERIAL PRIMARY KEY,
    nombre VARCHAR(50),
    apellido_paterno VARCHAR(50),
    apellido_materno VARCHAR(50),
    edad SMALLINT,
    id_domicilio INTEGER REFERENCES domicilios(id)
);

-- Query para insertar los estados de la república Méxicana en la tabla de estados
INSERT INTO estados (nombre) VALUES 
('Aguascalientes'),
('Baja California'),
('Baja California Sur'),
('Campeche'),
('Chiapas'),
('Chihuahua'),
('Coahuila'),
('Colima'),
('Ciudad de México'),
('Durango'),
('Guanajuato'),
('Guerrero'),
('Hidalgo'),
('Jalisco'),
('México'),
('Michoacán'),
('Morelos'),
('Nayarit'),
('Nuevo León'),
('Oaxaca'),
('Puebla'),
('Querétaro'),
('Quintana Roo'),
('San Luis Potosí'),
('Sinaloa'),
('Sonora'),
('Tabasco'),
('Tamaulipas'),
('Tlaxcala'),
('Veracruz'),
('Yucatán'),
('Zacatecas');

--Query para insertar un domicilio en la tabla de domicilios
INSERT INTO domicilios (id_estado, domicilio) VALUES (1, 'Calle Hacienda la gloria #123, Colonia Hacienda de Aguscalientes');

-- Query para insertar un ciudadano en la tabla de ciudadanos
INSERT INTO ciudadanos (nombre, apellido_paterno, apellido_materno, edad, id_domicilio) VALUES ('Mario', 'López', 'García', 30, 1);

-- Query para hacer que al eliminar un ciudadano se elimine su domicilio de la otra tabla
ALTER TABLE ciudadanos
ADD CONSTRAINT fk_ciudadanos_domicilios
FOREIGN KEY (id_domicilio)
REFERENCES domicilios (id)
ON DELETE CASCADE;