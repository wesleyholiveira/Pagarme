# Projeto Pagar.me
Código para o projeto de teste da Pagar.me

## O que é?
Um projeto que faz interface com o SDK da Pagarme para realizar o checkout das fantasias e dividir o custo em cima de regras pré-definidas.

## Requisitos
* Docker [https://docs.docker.com/docker-for-windows/install/]
* Docker-compose [https://docs.docker.com/compose/install/]
  
## O que tem dentro?
* Nginx
* PHP7 e FPM
* Composer
* MySQL
* Node 

## Configurações
 
 ### Ambiente
 Rodar os seguintes comandos para baixar o projeto:
 ```
 git clone https://github.com/wesleyholiveira/Pagarme \
 && chmod -R 777 storage/logs \
 && chmod -R 777 storage/proxies
 ```
 
 Toda a configuraçao do projeto esta localizada no arquivo **.env.example**, renomeie para **.env**.
 ```
 PAGARME_KEY=<api_key_pagarme>

 APP_NAME=Pagarme
 APP_ENV=production
 APP_KEY=
 APP_DEBUG=true
 APP_LOG_LEVEL=debug

 DB_CONNECTION=mysql
 DB_PORT=3306
 DB_DATABASE=pagarme
 DB_USERNAME=root
 DB_PASSWORD=pagarmeprojeto258456

 #Nao alterar
 DB_HOST=mysql
 DOCTRINE_PROXY_AUTOGENERATE=true

 BROADCAST_DRIVER=log
 CACHE_DRIVER=file
 SESSION_DRIVER=file
 QUEUE_DRIVER=sync

 ```
 
 ### Executando o projeto
 Para rodar o projeto basta executar os seguintes comandos:
 ```
 docker-compose build
 docker-compose up -d
 ```


## API REST
O sistema foi desenvolvimento em cima do REST, logo cada recurso possui seu endpoint.

```
GET http://<uri>/endpoint
POST http://<uri>/endpoint
PUT http://<uri>/endpoint
DELETE http://<uri>/endpoint
``` 

*Trivia: Todo processo descrito para as fantasias se aplica ao restante dos outros recursos.*

## Fantasias
Essas são as possiveis operações que podem ser realizadas com o recurso 'fantasia'.

### GET
As requisições do tipo GET pode se passar um parametro com ID da fantasia que deseja buscar ou não passar que irá retornar todas as fantasias.

**Exemplo de requisição:**
```
curl -sb "http://<uri>/fantasia"
```

### POST
As requisições do tipo POST **devem** ser enviadas em JSON **(RAW)** com *Content-Type: application/json* e  seguindo a seguinte estrutura:

```
{
"descricao"		: "<descricao_fantasia>",
"valor"			: "<valor_fantasia>",
"imagemId"		: "<id_imagem>",
"fornecedorId"	: "<id_fornecedor>"
}
```
*Lembrando que todos estes campos são obrigatórios*

**Exemplo de requisição:**
```
curl -H "Content-Type: application/json" -X POST -d '{"descricao":"Fantasia Darth Vader","valor":"150.00", "imagemId": 1, "fornecedorId": 1}' http://<uri>/fantasia

```

### PUT
As requisições PUT são basicamente iguais as **POST** porém é requirido o campo *id*.
```
{
    "id"            : "<id_fantasia>",
    "descricao"     : "<nova_descricao>",
    "valor"         : "<novo_valor>"
}
```

**Exemplo de requisição:**
```
curl -H "Content-Type: application/json" -X PUT -d '{"id": 1, "descricao": "Nova Fantasia,"valor":"120.00"' http://<uri>/fantasia

```

### DELETE
As requisições DELETE são um pouco diferentes, basta passar o ID da fantasia que deseja deletar, assemelhando-se ao **GET**.

```
curl -X DELETE http://<uri>/fantasia/1
```

## Fornecedor / Imagem
Aplica-se o mesmo conceito do endpoint para fantasias.

 ### Estrutura
   #### Fornecedor
   ```
   {
       "id"            : "<id_fornecedor>",
       "nome"          : "<nome_fornecedor>"
   }
   ```
   #### Imagem
      ```
      {
          "id"            : "<id_imagem>",
          "uri"           : "<uri_imagem>"
      }
      ```

## Considerações finais
O projeto está longe de ser algo bom, tanto é que nem possui teste os unitários por falta de tempo mas segue a lista de possíveis implementações que penso em realizar em um futuro:

* OAUTH2
* JWT
* Migrations
* Middlewares
* Notifications
* Testes unitários
* Testes comportamentais
* Refactoring
* Utilizar tecnologias modernas para a view (React, Angular ou [algum FW JS da vez])
