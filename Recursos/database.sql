create database tienda_master;

use tienda_master;

create table usuarios(
id int(255) auto_increment not null,
nombre varchar(100) not null,
apellidos varchar(100) not null
email varchar(255) not null,
password varchar(255) not null,
rol varchar(20) not null,
image varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uw_email UNIQUE(email)
)engine=InnoDB;

INSERT INTO usuarios VALUES(null,"Elkin","Murilo","Elkin@admin.com",
"qwe123","admin",null);


create table categorias(
    id      int(255) auto_increment not null,
    nombre  varchar(255) not null,
    CONSTRAINT pk_categoria PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO categorias VALUES(null,'Manga Corta');
INSERT INTO categorias VALUES(null,'Manga Larga');
INSERT INTO categorias VALUES(null,'Tipo Polo');
INSERT INTO categorias VALUES(null,'cuello V');
INSERT INTO categorias VALUES(null,'cuello tortuga');
INSERT INTO categorias VALUES(null,'buso largo');

create table productos(
    id    int(255) auto_increment not null,
    categoria_id id(255) not null,
    nombre varchar(100) not null,
    descripcion text,
    precio  float(100,2)not null,
    stock   int(255) not null,
    oferta  varchar(2) not null,
    fecha   date not null,
    imagen varchar(255) not null,
CONSTRAINT pkcategorias PRIMARY KEY(id);
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) references categoria(id)
)ENGINE=InnoDB;


create table pedidos(
    id  int(255) auto_increment not null,
    usuario_id int(255) not null,
    provincia varchar(100) not null,
    localidad varchar(100) not null,
    direccion varchar(100) not null,
    coste  float(200,2) not null,
    estado  varchar(20) not null,
    fecha date,
    hora time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_producto_usuario FOREIGN KEY(usuario_id) references usuarios(id) on delete cascade
)ENGINE=InnoDB;


create table lineas_pedidos(
    id   int(255) auto_increment not null,
    pedido_id  int(255) not null,
    producto_id int(255) not null,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_usuario FOREIGN KEY(pedido_id) references pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) references productos(id)
)ENGINE=InnoDB;