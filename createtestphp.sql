start transaction;

create database TestPHP;

use TestPHP;

create table usuarios (
id int not null primary key auto_increment,
user varchar(30) not null,
nome varchar(45) not null, 
email varchar(90) not null,
senha varchar(45) not null,
data_nasc date not null,
cidade varchar(45) not null,
uf varchar(2) not null,
observacao text,
ativo bool not null
);

commit;