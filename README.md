# Teste Fullstack PHP

Leia primeiro todo o projeto, faça sua estimativa de horas para o desenvolvimento e envie um email com o título `[Teste Fullstack PHP] Estimativa` para rh@4.events

Forke este projeto, faça o desenvolvimento e quando finalizar faça um PR aqui. Envie um email com o título `[Teste Fullstack PHP] Finalizado` para rh@4.events com o link do seu PR.

Se você não sabe o que é fazer um "Forke" ou um "PR", pesquise. Valorizamos muito a proatividade.

**Lembre-se: atualize este README informando como instalar e executar seu projeto. O README também deve conter se você conseguiu atingir 100% os objetivos deste projeto. Se a sua missão backend funciona, se a sua missão frontend funciona, dificuldades, etc.**

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

Desenvolver uma **UI (User Interface)** de acordo com o desenho que está na pasta [layout], no formato puro, ou seja, não queremos que você use nenhuma framework pronta (Yii, Laravel, etc), é para você mesmo(a) montar a estrutura do projeto, bem simples. Melhorar este desenho é opcional, mas será um grande diferencial, afinal, este desenho é bem feio, não é mesmo? :) Mas, lembre-se que o código deverá ser seu. Nada de copiar e colar ou perguntar ao Chat GPT para dar o código pronto.

### Especificação

- Cross browser support (IE11+)
- Consumir **API** criada acima
- Pode usar jQuery a vontade!
- Criar uma tela que tenha...
    - Listagem de veículos
    - Busca
    - Formulário de novo veículo

## Dica

Tudo que for feito em adicional, se for somar ao projeto, contará pontos positivos a você.

## Dúvida

Se tiver qualquer dúvida sobre esse teste, envie um email com o título `[Teste Fullstack PHP] O assunto que vc deseja` para rh@4.events


/*-------------------------------------------------------------------------------------------------------------------------------------*/

# Considerações

Olá equipe da 4events,

Em primeiro lugar, gostaria de agradecer pela oportunidade de participar do processo seletivo.

Gostaria de informar que não consegui atingir o objetivo de criar uma API utilizando o framework Open Swoole.

Quando o Vitor me informou sobre o teste, ele mencionou que algumas pessoas conseguiram entregar o projeto no mesmo dia. Com base nessa informação, estimei que seria possível entregar até o dia 24/03, levando em conta que algumas pessoas conseguiram fazer tão rapidamente. No entanto, ao iniciar o desenvolvimento, enfrentei diversos problemas, como erros ao executar a build do Dockerfile fornecido na documentação e outras imagens, o que me levou a tentar executar via WSL no Linux. No entanto, devido à minha falta de familiaridade com o framework e ao prazo apertado devido a projetos em andamento, percebi que não seria possível entregar o projeto no prazo estipulado. Eu poderia ter enviado um e-mail informando um novo prazo, mas não saberia quantificar o tempo necessário para concluir essa tarefa, já que sequer havia ouvido falar desse framework, e teria que estudá-lo primeiro antes de poder trabalhar com ele de forma eficiente. Assim, se informasse um novo prazo, não estaria sendo preciso nessa previsão.

Embora não tenha conseguido realizar o que foi proposto no prazo, achei importante demonstrar meus conhecimentos e, por isso, decidi criar o projeto utilizando o Laravel. Sei que foi explicitamente solicitado o uso do Swoole e que isso pode desqualificar minha candidatura. No entanto, foi a única forma que encontrei para entregar o projeto dentro do prazo informado no e-mail. Consegui concluir todo o desafio proposto com as tecnologias que domino, mas ainda não possuo o conhecimento necessário para fazê-lo rapidamente na tecnologia mencionada, devido à curva de aprendizado da mesma.

Entendo que meu projeto possivelmente será descartado, mas, de qualquer forma, convido vocês a darem uma olhada e, caso ainda haja interesse da empresa em prosseguir com o processo seletivo, coloco-me inteiramente à disposição.

# Como rodar o projeto

1 - Ter algum servidor PHP instalado. No meu caso utilizo o laragon
https://laragon.org/download/index.html

2 - Inicializar o servidor PHP

3 - Instalar o laravel 
composer global require laravel/installer

4 - Configurar o banco de dados no arquivo .env na raiz do projeto (teste-fullstack-php/api/.env)

5 - Importar o banco de dados "db_4events.sql"

6 - Inicializar o servidor com o comando (teste-fullstack-php/api):
php artisan serve

7 - Abrir o arquivo index.html na pasta (teste-fullstack-php/app/index.html)