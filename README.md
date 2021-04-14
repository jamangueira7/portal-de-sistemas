<p align="center">
  <img alt="Logo Tokio Marine" src=".github/logo-login.png">
</p>

<p align="center">
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
  <a href="#-como-rodar">Como rodar</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-como-contribuir">Como contribuir</a>&nbsp;&nbsp;&nbsp;
 </p>

<br>

# Portal de sistemas

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP](https://www.php.net/) - 7.2
- [Composer](https://getcomposer.org/) - v1.8.4
- [Postgres](https://www.postgresql.org/) - 10.15-alpine
- [CSS3](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
- [HTML5](https://developer.mozilla.org/pt-BR/docs/Web/HTML/HTML5)
- [JavaScript](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript)
- [Docker](https://www.docker.com/) - 19.03.8
- [Apache](https://www.apache.org/) 2.4.35

## 💻 Projeto


## 🚀 Como Rodar

- Clone o projeto.
- Rodar o camando "composer install".
- Rodar o Postgres com docker:
```
docker run --name postgres -e POSTGRES_PASSWORD=docker -p 5432:5432 -d postgres

.env ficaria assim:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=portal-de-sistemas
DB_USERNAME=postgres
DB_PASSWORD=docker

```
- Criar um banco com o nome portal-de-sistemas.
- Rodar as migrations com o comando "php artisan migrate:fresh".
- Caso queria criar dados mocados rodar as seeds"php artisan db:seed".
- Rodar comando "composer server".
- acesse http://localhost:8080/



## Licença

O framework Laravel e esse projeto usam a linceça [MIT license](https://opensource.org/licenses/MIT).
