create database Bot_telegram;

use Bot_Telegram;

create table telegram(
update_id double not null primary key,
comando varchar(100) not null,
resposta varchar(100) not null,
data_resposta date not null
);


