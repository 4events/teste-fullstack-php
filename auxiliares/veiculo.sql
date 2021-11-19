create table veiculo (
    id int auto_increment primary key,
    veiculo varchar(100) not null,
    marca text null,
    ano int not null,
    descricao text null,
    vendido tinyint null,
    created datetime null
);

insert into
    veiculo(veiculo, ano, descricao, vendido, created)
    values ('Renault Duster',2020,'Renault Duster Branca',0,CURRENT_TIMESTAMP);
