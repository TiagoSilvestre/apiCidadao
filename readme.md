### Api para cadastro de pessoas em Laravel

Foi desenvolvida uma api para cadastro de pessoas, onde o model Person possui relacionamento 
com Address e Contact do tipo hasOne(um para um). <br/>
A api possui um Crud e algumas opções de filtros. Foi utilizado o swagger para prover a documentação da Api.<br/> 
Também foram criados os testes unitários com o phpUnit. A api está rodando em um servidor que eu possuo, você pode conferir aqui:
http://www.tiagosilvestre.com.br/api/documentation


## Instalação

```bash
# vá para a pasta do projeto
cd /apiCidadao

# crie o arquivo .env
cp .env.example .env

# instale as dependencias do composer
composer install

# gere uma chave para a aplicação
php artisan key:generate

# crie um banco de dados local
mysql -u root

> create database seu-banco-de-dados;
> exit;

# coloque a configuração do seu banco de dados no arquivo .env
DB_CONNECTION=mysql
DB_DATABASE=seu-banco-de-dados
DB_USERNAME=root
DB_PASSWORD=

# execute o comando migrate para gerar o schema, ou importe o sql manualmente
php artisan migrate

# crie um virtualhost para a aplicação na pasta /cadastroDeProdutos/public
Caso esteja rodando no xamp, adicione um entrada em httpd-vhost.conf e no arquivo hosts,
roteando para pasta /apiCidadao/public do projeto

# altere o host do servidor da api-doc em: /storage/api-docs/api-docs.json, no começo do
# arquivo em server->url, colocando o nome do virtual host
"servers": [
    {
        "url": "http://hostDoServidor"
    }
```
Você poderá consultar a documentação do swagger nessa url: http://seuVirtualHost/api/documentation

Para rodar os testes digite no terminal: ./vendor/bin/phpunit tests/Feature/Http/Controllers/Api/PersonControllerTest.php

Isso é tudo :)
