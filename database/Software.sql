

create table proyecto (
    codigo VARCHAR(50) PRIMARY KEY,
    telefono varchar(20) not null,
    domicilio varchar(100) not null,
    razon_social varchar(100) not null,
    foreign key (cliente) references cliente (cliente)

);


create table cliente (
    codigo VARCHAR(50) PRIMARY KEY,
    descripcion varchar(100) not null,
    fecha_inicio date not null,
    fecha_fin date not null
);

create table colaborador (
    nif VARCHAR(50) PRIMARY KEY,
    nombre varchar(100) not null,
    domicilio varchar(100) not null,
    telefono varchar(20) not null,
    banco varchar(20) not null,
    numero_cuenta numeric(50) not null
);

create table colaborador_proyecto (
    colaborador varchar(50) not null,
    proyecto varchar(50) not null,
    primary key (colaborador, proyecto),
    foreign key (colaborador) references colaborador (nif),
    foreign key (proyecto) references proyecto (codigo)
);



create table pago (
    numero_pago numeric(50) PRIMARY KEY,
    concepto varchar(100) not null,
    cantidad numeric(50) not null,
    fecha_pago date not null,
    foreign key (colaborador) references colaborador (nif)
);


create table tipo (
    codigo varchar(50) PRIMARY KEY,
    descripcion varchar(100) not null,PRIMARY KEY,
     foreign key (pago) references pago (numero_pago)
);


