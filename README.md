# Teste fullstack PHP

Leia primeiro todo o projeto, faça sua estimativa de horas para o desenvolvimento e envie um email com o título `[Teste Fullstack PHP] Estimativa` para rh@4.events

Forke este projeto, faça o desenvolvimento e quando finalizar faça um PR aqui. Envie um email com o título `[Teste Fullstack PHP] Finalizado` para rh@4.events com o link do seu PR.

Se você não sabe o que é fazer um "Forke" ou um "PR", pesquise. Valorizamos muito a proatividade.

**Lembre-se: atualize este README informando como instalar e executar seu projeto.**

## Missão backend

Desenvolver uma **API JSON RESTful** em **Swoole PHP ( https://www.swoole.co.uk/ )**, que utilize os métodos `GET` e `POST`.

**Curiosidade:** você sabia que uma API construída em Swoole PHP é mais rápida que Node, Go, Python e qualquer outra stack backend? Se não, descobriu agora :)

### Especificação

Monte uma base de veículo com a seguinte estrutura:

```
veiculo:   string
ano:       integer
descricao: text
vendido:   bool
created:   datetime
```

Utilize **MySQL** para armazenar os dados que a **API** irá consumir. Deixe o export (.sql) do banco de dados junto dos arquivos.

### API endpoints

`GET /veiculos`

Retorna todos os veículos

---

`GET /veiculos/find`

Retorna os veículos de acordo com o termo passado parâmetro `q`

---

`POST /veiculos`

Adiciona um novo veículo


## Missão frontend

Desenvolver uma **UI (User Interface)** de acordo com o desenho que está na pasta [layout], no formato MVC puro, ou seja, não queremos que você use nenhuma framework pronta (Yii, Laravel, etc), é para você mesmo(a) montar o MVC, bem simples.

### Especificação

- Cross browser support (IE11+)
- Consumir **API** criada acima
- Pode usar jQuery a vontade!
- Criar uma tela que tenha...
    - Listagem de veículos
    - Busca
    - Formulário de novo veículo

## Dica

Tudo que for feito em adicional, se for somar ao projeto, contará pontos positivos a você. Agora, cuidado: se você ultrapassar MUITO as horas que estipulou inicialmente, contará muitos pontos NEGATIVOS.

## Dúvida

Se tiver qualquer dúvida sobre esse teste, envie um email com o título `[Teste Fullstack PHP] O assunto que vc deseja` para rh@4.events

<hr>

## Vamos fazer a aplicação funcionar!!

#### Fique atento(a) as versões necessárias

* PHP ^7.4
* Swoole ^4.7
* Composer ^2.1
* Yarn ^1.22 ou NPM ^8.0
* MySQL Database ^8.X

Efetue o clone dessa aplicação e execute o arquivo em 
<code>~/scripts/database.sql</code> no seu banco de dados MySQL para criar a tabela.

Configure seu banco em <code>~/app/Config/Database.php</code> alterando os valores abaixo para os correspondentes:

```
10|    const DB_HOST = "127.0.0.1"; //Database Address
11|    const DB_NAME = "testephp"; //Database Name
12|    const DB_USER = "testephp"; //Database User
13|    const DB_PASS = "Px2FCx_JRmvs6tMg"; //Database password
```

### Na pasta raiz do projeto rode os seguintes comandos para colocar no ar a API:

Para instalar as dependências PHP do projeto, rode...
```
  composer install
```

Para inicializar a API, rode...
```
  php public/index.php
```

### Vamos preparar e inicializar o Front-End

Vá para a pasta <code>cd frontend</code> e execute os seguintes comandos:

Para instalar as dependências front-end, rode...
```
  yarn i
```

Para compilar os arquivos de estilo de javascript, rode...
```
  yarn build
```

Para acessar o front, basta abrir o arquivo <code>index.html</code> na pasta <code>frontend</code>!

### Até mais, dev!