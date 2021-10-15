/**
	Criado por - Douglas Menezes Evangelista da Silva
    12 de outubro de 2021
*/
#drop schema if exists testephp;

create schema if not exists testephp;

use testephp;

drop table if exists cars;

create table if not exists cars (
	`id` int not null auto_increment,
	`manufacturer` varchar(90) not null,
    `vehicle` varchar(90) not null,
    `description` text not null,
    `year` int not null,
    `is_sold` boolean not null default false,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp,
    `deleted_at` datetime,
    primary key (`id`)
);