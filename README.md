# API Rest Liberfly

Essa API tem como objetivo criar e listar produtos após a autenticação do usuário e geração de um JWT.

## Requerimentos

- PHP >= 7.4
- Composer >= 2.3.7
- MySQL Server ou Maria DB

## Instalação e inicialização

1. Crie um banco de dados no MySQL ou MariaDB

2. Clone o repositório
   ```shell
    git clone git@github.com:CaiqueDaniel/api-rest-liberfly.git
   ```
   
3. Acesse a pasta do repositório 
    ```shell
    cd api-rest-liberfly
    ```
   
4. Instale as dependencias com o Composer
    ```shell
    composer install
    ```

5. Copie o arquivo .env.example como .env
    ```shell
    cp .env.example .env
    ```
   
6. Configure a conexão com banco de dados no arquivo .env
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE={{nome_do_banco_de_dados}}
    DB_USERNAME={{usuario_do_servidor_mysql}}
    DB_PASSWORD={{senha_do_servidor_mysql}}
    ```

7. Gere uma nova chave da aplicação
    ```shell
    php artisan key:generate
    ```

8. Atribua uma nova chave de geração do JWT (opcional para desenvolvimento)
    ```dotenv
    JWT_KEY={{meu_segredo}}
    ```
    Importante: A aplicação possui um valor padrão para essa variável, no entanto o seu uso **NÃO É RECOMENDADO PARA PRODUÇÃO.**
    Crie um novo valor para essa variavel, quanto maior e mais aleatório for, melhor.


9. Execute as migrações do banco de dados (**Configure a conexão com o banco de dados antes de executar as migrações**)
    ```shell
    php artisan migrate --seed
    ```

10. Inicie o servidor de desenvolvimento
    ```shell
    php artisan serve
    ```

O servidor estará disponível em http://localhost:8000.  
A documentação do Swagger estará disponível em http://localhost:8000/api/documentation.
