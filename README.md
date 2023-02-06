# 4.events processo seletivo

Este projeto necessita do `docker` e `docker compose` instalados para funcionar.

### Instalação docker e docker compose:
Instalação do docker no Ubuntu (referência):

https://docs.docker.com/engine/install/ubuntu/


### Subir o projeto
Na raíz do projeto digite:
```sh
sudo docker-compose up
```
aguardar até o pull dos containers e o projeto fique up!


### Restaurar o projeto
Se for necessário restaurar o projeto para o estado inicial então remova todas as imagens docker usando o seguinte comando:
```sh
sudo docker-compose rm
```
e depois repita o comando `sudo docker-compose up`


### Acessar o site do projeto
Se tudo estiver certo você pode digitar no seu navegador:
```
localhost:9090
```
e já verá a página de listagem de veículos.

### Acessar a API (Swoole)
A API em Swoole está rodando em um container separado:
```
localhost:9501
```

#### Endpoints da API

##### GET

`GET localhost:9501/veiculos/`:
Listar todos os veículos cadastrados

`GET localhost:9501/veiculos/find?q=string`:
Procurar pelo veículo pelo `string`

##### POST

`POST localhost:9501/veiculos`:
Cadastrar um veículo passando um objeto JSON:
```
{
    marca    : integer,
    veiculo     : string,
    ano         : number,
    descricao   : string,
    vendido     : boolean,
}
```

### Acessar o phpmyadmin 
No navegador digitar:
```
localhost:8081

Server: mysql
Username: username
Password: password
```

### Possíveis melhorias

- organização do código da api swoole e gerar log das requisicoes
- adicionar ícone de loading no carregamento da lista de veículos
- implementar validacao dos campos no frontend e no backend
- UX e UI precisa ser melhorada
