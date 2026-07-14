-Crear la base de datos hospital.

create database hospital10

-- Tabla de doctores
CREATE TABLE doctor (
    pk_doctor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    estado TINYINT DEFAULT 1   
);

create table consultorio (
pk_consultorio INT AUTO_INCREMENT PRIMARY KEY,
fk_doctor INT,
numero varchar(50) not null,
ubicacion varchar(50) not null,
estado TINYINT DEFAULT 1   
FOREIGN KEY(fk_doctor) REFERENCES doctor (pk_doctor)
);


--Saber de quien es el consultorio

select c.numero, c.ubicacion, d.nombre, d.especialidad
from consultorio c
inner join doctor d on c.fk_doctor = d.pk_doctor


