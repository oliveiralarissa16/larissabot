create database Bot_telegram;

use Bot_Telegram;

create table comando(
idComando int primary key AUTO_INCREMENT,
texto varchar(20) not null
);

insert into comando
 (texto)
 values
  ('/megaSena'),
  ('/photo');


create table tbbotresponse(
id int auto_increment primary key,
update_id float not null unique key,
comando int,
resposta varchar(100) not null,
data_resposta timestamp not null default current_timestamp,
foreign key(comando) references comando(idComando)
);


SELECT idComando, id, texto FROM comando AS c LEFT JOIN tbbotresponse AS t on c.idComando = t.id;
