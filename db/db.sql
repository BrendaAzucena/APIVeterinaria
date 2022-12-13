drop database if exists Veterinaria ;
create database Veterinaria ;
use Veterinaria ;

create table Cliente (
idCliente int(11) unsigned auto_increment primary key,
nombre varchar(100) not null,
apellidoP varchar (50) not null,
apellidoM varchar (50) not null,
telefono int (35) not null,
sexo varchar (10) not null,
edad varchar (20) not null
);

create table Mascota (
idMascota int(11) unsigned auto_increment,
nombreM varchar(100) not null,
tipoM varchar(20) not null,
sexo varchar(10) not null,
color varchar(25) not null,
fechaN DATE not null,
Cliente_idCliente int(11) unsigned not null,
primary key (idMascota, Cliente_idCliente)
);

create table Vacuna (
idVacuna int(11) unsigned auto_increment primary key,
nombreV varchar(45) not null
);

create table Mascota_has_Vacuna (
  Mascota_idMascota int(11) unsigned auto_increment,
  Vacuna_idVacuna int(11) not null,
  fechaV date not null,
  primary key (Mascota_idMascota, Vacuna_idVacuna));

create table veterinario(
idveterinario int(11) unsigned auto_increment primary key,
nombre varchar(50) not null,
apellidoP varchar(50) not null,
apellidoM varchar(50) not null,
telefono varchar(35) not null
);

create table Consulta (
idconsulta int(11) unsigned auto_increment,
fechaC date not null,
sintomas varchar(50) not null,
peso varchar(10) not null,
veterinario_idveterinario int(20) unsigned not null,
Medicina_idMedicina int(20) unsigned not null,
primary key (idconsulta, veterinario_idveterinario, Medicina_idMedicina)
);


create table Medicina (
idMedicina int(11) unsigned auto_increment primary key,
nombreM varchar(50) not null,
costo varchar(15) not null,
codigoM varchar(40) not null,
presentacion varchar(45) not null,
NGenerico varchar(45) not null
);

insert into Cliente values (null,'Raul', 'Carrera','Gomez','971820937','M',20);
insert into Cliente values (null,'Maria', 'Garcia','Flores','97134573','F',24);

insert into Mascota values (null,'Max','Gato','Macho','Blanco','2019-04-06',1);
insert into Mascota values (null,'Luna','Perro','Hembra','Gris','2019-12-21',2);

insert into Vacuna values (null,'Pentavalente');
insert into Vacuna values (null,'Hexavalente');

insert into Mascota_has_Vacuna values (null,'1','2022-10-06');
insert into Mascota_has_Vacuna values (null,'2','2022-09-06');

insert into veterinario values (null,'Brenda Azucena', 'Mendez','Hernandez','9717626387');
insert into veterinario values (null,'Blanca Azucena', 'Cadena','Lopez','9711246565');
insert into veterinario values (null,'Marcos', 'Garcia','Perea','9711374672');
insert into veterinario values (null,'Maria', 'Gomez','Torres','971488754');

insert into Consulta values (null,'2021-06-03','Gripe','9 kg','1','4');
insert into Consulta values (null,'2021-06-13','Tos','26 kg','2','3');
insert into Consulta values (null,'2021-07-14','Dolor','19 kg','4','2');
insert into Consulta values (null,'2021-07-09','Vomito','6 kg','3','1');

insert into Medicina values (null,'Ampicilina','650','64376464','Caja verde','Antibiotico');
insert into Medicina values (null,'Tusivet','800','637462732','Caja rosa','Dextrometrofano');
insert into Medicina values (null,'Vetoryl','1330','647647674','Caja verde','Antibiotico');
insert into Medicina values (null,' Antiinflamatoria','1200','748573847','Caja blanco','Dextrometrofano');