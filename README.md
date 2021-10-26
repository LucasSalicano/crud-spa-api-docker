# API Rest + Docker + SPA + PHP

## Executando a aplicação 🛎️

1. Clonando o repositório em um diretório:
      ```
      git clone git@github.com:LucasSalicano/crud-spa-api-docker.git
      ```
2. Dentro do diretório do projeto executar o comando para inciar os containers 🐳:
   
      ```
      cd crud-spa-api-docker/laradock
      docker-compose up -d mysql nginx phpmyadmin
      ```
3. Rodar as Migrate e instalar os pacotes
      ```
      docker exec -it laradock_workspace_1 composer install
      docker exec -it laradock_workspace_1 php artisan migrate
      ```
4. Instalar as dependencias
      ```
      docker exec -it laradock_workspace_1 npm install
      ```

Pronto, a aplicação deve estar rodando em seu localhost:8000 e a api em localhost:8000/api/developers 😀

## ✔️ Métodos
Requisições para a API possui os seguintes padrões [REST]:

| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |
| `PUT` | Atualiza todos os dados de um registro. |
| `DELETE` | Remove um registro do sistema. |

## ✔️ Respostas

| Código | Descrição |
|---|---|
| `200` | Requisição executada com sucesso.|
| `201` | Recurso criado com sucesso.|
| `204` | Nenhum recurso encontrado.|
| `400` | Parâmetros enviados são divergentes com os disponiveis.|
| `404` | Recurso não existe.|

# Desenvolvedores - API 🛎️

## ➡️ Cadastrar Desenvolvedor /api/developers  [`POST`]

| Parâmetro | Tipo |  Descrição |
|---|---|---|
| `nome` | `string` | nome em formato de texto |
| `cpf`  | `string` | cpf com 11 dígitos |
| `data_nascimento`  | `string` | data no formato Y-m-d |

+ Requisição (application/json)
    + example
      
          {
              "nome": "lucas",
              "sexo": "m",
              "idade": 22,
              "hobby": "treinar",
              "dataNascimento": "1998-01-01"
          }

+ Response 201 (application/json)

## ➡️ Listar todos os Desenvolvedores /api/developers [`GET`]

Lista todos os usuários cadastrados de forma paginada ``10 / per_page`` por padrão.

| Parâmetro da Url | Tipo |  Descrição |
|---|---|---|
| `nome` | `string` | nome em formato de texto |
| `per_page`  | `int` | numero |

+ Response 200 (application/json)
  
    + Url example
    
            http://127.0.0.1:8000/api/developers/?nome=lucas&per_page=50

    + body example
      
                  {
                      "current_page": 1,
                      "data": [
                              {
                                  "id": 1,
                                  "nome": "lucas",
                                  "sexo": "m",
                                  "idade": 22,
                                  "hobby": "treinar",
                                  "dataNascimento": "1998-01-01"
                              }
                      ],
                      "first_page_url": "http://127.0.0.1:8000/api/developers?page=1",
                      "from": 1,
                      "last_page": 1,
                      "last_page_url": "http://127.0.0.1:8000/api/developers?page=1",
                      "links": [
                      {
                          "url": null,
                          "label": "&laquo; Previous",
                          "active": false
                      },
                      {
                          "url": "http://127.0.0.1:8000/api/developers?page=1",
                          "label": "1",
                          "active": true
                      },
                          {
                          "url": null,
                          "label": "Next &raquo;",
                          "active": false
                      }
                      ],
                          "next_page_url": null,
                          "path": "http://127.0.0.1:8000/api/developers",
                          "per_page": 10,
                          "prev_page_url": null,
                          "to": 1,
                          "total": 1
                  }
      
          
## ➡️ Consultar único desenvolvedor /api/developers/{developerId} [`GET`]

+ Response 200 (application/json)

    + body example

          {
              "id": 1,
              "nome": "maria",
              "cpf": "12345678912",
              "data_nascimento": "2021-01-01",
              "created_at": "2021-09-04T19:15:49.000000Z",
              "updated_at": "2021-09-04T19:15:49.000000Z"
          }

## ➡️ Atualizar desenvolvedor /api/developers/{developerId} [`PUT`]


| Parâmetro | Tipo |  Descrição |
|---|---|---|
| `nome` | `string` | nome em formato de texto |
| `sexo`  | `string` | M - Masculino F - Feminino |
| `idade`  | `int` | formato inteiro |
| `hobby`  | `string` | texto |
| `dataNascimento`  | `date` | data no formato Y-m-d |

+ Requisição (application/json)

    + Body

            {
                "nome" : "lucas",
                "sexo" : "M",
                "idade" : "22",
                "hobby" : "treinar",
                "data_nascimento" : "2021-05-05"
            }

+ Response 200 (application/json)

    + Body
      
            {
                "id" : 1,
                "nome" : "lucas",
                "sexo" : "M",
                "idade" : "22",
                "hobby" : "treinar",
                "data_nascimento" : "2021-05-05"
            }

## ➡️ Remover Desenvolvedor /api/developers{developerId} [`DELETE`]

Em caso de sucesso é retornado o ``StatusCode 404 (Not Content)``

## ⚠️  Casos de Erro ️
___

Se o ``developerId`` informado não existir é retornado o ``StatusCode 400`` com o response abaixo:

+ Response 400 (application/json)
    + Body
    
            {
                "Erro": "desenvolvedor não encontrado"
            }

# 🧪 Testes

1. Rodar comando do PHPUnit dentro do diretório

    ```
    docker exec -it laradock_workspace_1 ./vendor/bin/phpunit
     ```
