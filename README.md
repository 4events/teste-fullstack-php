# Teste Fullstack PHP

### Ferramentas Utilizadas 
- PHP 8.0.12
- MariaDB 10.4.21
- MySQL Workbench 6.3
- Docker Desktop 4.20.0
- VS Code
- Swoole last version
- Windows 11
- GitHub Desktop 3.2.6
- Postman 10.15.0
- XAMPP 3.3.0


## Instalação e configuração api (BackEnd)
O projeto backend está na pasta "4events".

### Criação do banco de dados
- Execute o XAMPP.
- Crie uma base de dados chamada "4events", com o user "root" e senha "" (vazio).
- Execute no gereciador do MySql de sua escolha o arquivo "4events_veiculos.sql" que está dentro da pasta "migration" do projeto.

### Instalação do código 
- Copie a pasta 4events para qualquer pasta.
- Inicie o Docker.
- Abra o prompt de comando e navegue até a pasta 4events.
- Execute o seguintes comandos na seguinte sequência:
  - `docker build -f ./Dockerfile -t 4events-veiculos .`
  - `docker run -d --name fullstack -p "90:8989" 4events-veiculos`
- Verifique no Docker se um container chamado "fullstack" está em execução.
- Pronto a api está instalada.

## Configuração Front MVC (FrontEnd)
O projeto frontend está na pasta "fullstack-4events-mvc".
### Passos
- Copie a pasta fullstack-4events-mvc para a pasta htdocs do XAMPP.
- Reinicie o XAMPP.
- Acesse no navegador:
   - `http://localhost/fullstack-4events`
- Pronto se estiver tudo ok, abriará a tela de gerenciamento de veículos.

## Configuração Front AJAX (FrontEnd)
O projeto frontend(AJAX) está na pasta "4events-frontend".
### Passos
- Copie a pasta "4events-frontend" para qualquer pasta.
- Execute o arquivo "index.html" no navegador.
- Pronto se estiver tudo ok, abriará a tela de gerenciamento de veículos.

## Observações
- Nunca tinha visto Swoole.
- Nunca precisei criar um MVC, sempre usei o Zend Framework e já fiz alguns projetos de estudos com o Laravel.
- Tive muito problemas para conectar o Swoole no MySql no Docker, tive que usar o MySql do XAMPP.
- Fiz um frontend adicional(AJAX), pois acho mais rápido de fazer.
- Gostaria de ter mais tempo para trabalhar as mensagens de erro e sucesso, não consegui no front MVC, mas no front AJAX consegui fazer algumas.
- Estou sem tempo, pois estou participando de outros processos seletivos. Estou virando noites!!
- Caso não consiga executar os projetos ou qualquer dúvidas, fique a vontade para falar comigo, ficarei feliz em ajudar.
- Uffa fim ;)
