
# API Agenda - Exemplo
A aplicação é uma API REST com as operações CRUD.

A API foi feita para ver como funciona o framework Laravel, sendo este o meu primeiro contato com a ferramenta.

### Teste das apis (PHPUnit)
    php artisan test

## Aceso rápido

 - [Auth - Register](https://github.com/DNMaroni/API_Desafio#registrar-token-jwt-para-acessar-a-api)
 - [Auth - Refresh](https://github.com/DNMaroni/API_Desafio#gerar-outro-token-no-mesmo-usuário)
 - [Auth - Login](https://github.com/DNMaroni/API_Desafio#fazer-login-com-usuário)
 - [Auth - Logout](https://github.com/DNMaroni/API_Desafio#fazer-logout)
 
 - [Atividades - Selecionar todas as atividades](https://github.com/DNMaroni/API_Desafio#selecionar-todas-as-atividades)
 - [Atividades - Selecionar atividade por id](https://github.com/DNMaroni/API_Desafio#selecionar-atividade-na-agenda-por-id)
 - [Atividades - Selecionar atividades por range](https://github.com/DNMaroni/API_Desafio#selecionar-atividades-por-range)
 - [Atividades - Criar nova atividade](https://github.com/DNMaroni/API_Desafio#criar-nova-atividade)
 - [Atividades - Atualizar atividade](https://github.com/DNMaroni/API_Desafio#atualizar-atividade-por-id)
 - [Atividades - Deletar atividade](https://github.com/DNMaroni/API_Desafio#deletar-atividade-por-id)


## Autenticação (Auth) - JWT

### Registrar token JWT para acessar a API

#### Request

    POST /api/register


#### Multipart formdata
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `name` | `string` | **Obrigatório**. max:255 |
| `email` | `string` | **Obrigatório**. max:255 |
| `password` | `string` | **Obrigatório**. min:6 |

#### Curl
    curl --request POST
    --url http://127.0.0.1:8000/api/register
    --header 'Accept: application/json'
    --header 'Content-Type: multipart/form-data'
    --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
    --form name=daniel
    --form email=daniel@gmail.com
    --form password=qwerty1

#### Response
```http
{
   "status":"success",
   "message":"User created successfully",
   "user":{
      "name":"daniel",
      "email":"daniel@gmail.com",
      "updated_at":"2022-05-30T01:04:37.000000Z",
      "created_at":"2022-05-30T01:04:37.000000Z",
      "id":3
   },
   "authorisation":{
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNjUzODcyNjc3LCJleHAiOjE2NTM4NzYyNzcsIm5iZiI6MTY1Mzg3MjY3NywianRpIjoiY000U1p0eEdmZDZkU0txdiIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.l90yW6WDtyxo7Hc1GbBvKP9DEqPNq8bpO4oxMWKUBGw",
      "type":"bearer"
   }
}
```
___

### Gerar outro token no mesmo usuário

#### Request

    POST /api/refresh

#### Curl

```curl
    curl --request POST
  --url http://127.0.0.1:8000/api/refresh
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNjUzODcyNjc3LCJleHAiOjE2NTM4NzYyNzcsIm5iZiI6MTY1Mzg3MjY3NywianRpIjoiY000U1p0eEdmZDZkU0txdiIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.l90yW6WDtyxo7Hc1GbBvKP9DEqPNq8bpO4oxMWKUBGw'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
```

#### Response
```http
{
   "status":"success",
   "user":{
      "id":3,
      "name":"daniel",
      "email":"daniel@gmail.com",
      "email_verified_at":null,
      "created_at":"2022-05-30T01:04:37.000000Z",
      "updated_at":"2022-05-30T01:04:37.000000Z"
   },
   "authorisation":{
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE2NTM4NzI2NzcsImV4cCI6MTY1Mzg3NjU1OCwibmJmIjoxNjUzODcyOTU4LCJqdGkiOiJzOUtaczFnbVJuR2NhdmdkIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.DrknnXqOAu0yka_ODhcx2_m9jutYmVY0vSwyevQESac",
      "type":"bearer"
   }
}
```
___

### Fazer login com usuário

#### Request

    POST /api/login

#### Multipart formdata
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `string` | **Obrigatório**. max:255 |
| `password` | `string` | **Obrigatório**. min:6 |

#### Curl

```curl
    curl --request POST
  --url http://127.0.0.1:8000/api/login
  --header 'Accept: application/json'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
  --form email=daniel@gmail.com
  --form password=qwerty1
```

#### Response
```http
{
   "status":"success",
   "user":{
      "id":3,
      "name":"daniel",
      "email":"daniel@gmail.com",
      "email_verified_at":null,
      "created_at":"2022-05-30T01:04:37.000000Z",
      "updated_at":"2022-05-30T01:04:37.000000Z"
   },
   "authorisation":{
      "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczMTMxLCJleHAiOjE2NTM4NzY3MzEsIm5iZiI6MTY1Mzg3MzEzMSwianRpIjoiYXNGeHhOQzBHbkpFa0VSYyIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.lJLpX0AhNes69e5QUy7CCIq0Qe0X1XIE-CZVg352VRc",
      "type":"bearer"
   }
}
```
___

### Fazer logout

#### Request

    POST /api/logout
    
#### Curl

```curl
    curl --request POST
  --url http://127.0.0.1:8000/api/logout
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczMTMxLCJleHAiOjE2NTM4NzY3MzEsIm5iZiI6MTY1Mzg3MzEzMSwianRpIjoiYXNGeHhOQzBHbkpFa0VSYyIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.lJLpX0AhNes69e5QUy7CCIq0Qe0X1XIE-CZVg352VRc'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
```

#### Response
```http
{
   "status":"success",
   "message":"Successfully logged out"
}
```
___

## Atividades da agenda (/api/atividades)

### Selecionar todas as atividades

#### Request

    GET /api/atividades


#### Curl
```curl
    curl --request GET
  --url http://127.0.0.1:8000/api/atividades
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
```

#### Response
```http
{
    "id": 1,
    "data_inicio": "2022-06-02 23:55:38",
    "data_prazo": "2022-06-07 19:34:01",
    "data_conclusao": "2022-06-04 11:11:49",
    "status": 1,
    "titulo": "Aut minus omnis doloribus.",
    "descricao": "Magni ut accusantium alias assumenda deleniti eaque. Quia facere pariatur sit nulla quia temporibus temporibus. Veritatis quis cumque in et optio ullam. Eaque in et et voluptas eveniet omnis.",
    "responsavel_id": 1,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 1,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Barbara Rosenbaum PhD",
        "telefone": "38923716672",
        "email": "camille88@gmail.com"
    }
},
{
    "id": 2,
    "data_inicio": "2022-06-03 20:32:22",
    "data_prazo": "2022-06-07 19:05:45",
    "data_conclusao": "2022-06-08 06:15:36",
    "status": 1,
    "titulo": "Tempore cumque nisi ut eius ut deleniti.",
    "descricao": "At itaque ipsa voluptas non ullam adipisci. Cumque esse unde blanditiis sit debitis. Soluta consequatur pariatur vel debitis. Ex earum voluptate deleniti adipisci.",
    "responsavel_id": 9,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 9,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Coty Hand",
        "telefone": "90848669424",
        "email": "lillie.wehner@yahoo.com"
    }
},
{
    "id": 3,
    "data_inicio": "2022-05-31 03:46:10",
    "data_prazo": "2022-06-05 18:50:00",
    "data_conclusao": "2022-06-08 02:06:59",
    "status": 1,
    "titulo": "Velit architecto incidunt temporibus dignissimos officiis ex et.",
    "descricao": "Reiciendis sed id excepturi. Nihil vero dolorem accusamus occaecati cumque cumque velit.",
    "responsavel_id": 6,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 6,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Dr. Lexi Torp DDS",
        "telefone": "07440481572",
        "email": "lauretta90@schmitt.biz"
    }
},
{
    "id": 4,
    "data_inicio": "2022-05-31 04:09:35",
    "data_prazo": "2022-06-05 09:45:01",
    "data_conclusao": "2022-06-04 12:47:42",
    "status": 1,
    "titulo": "Sint quibusdam dolorum nostrum minima officia.",
    "descricao": "Nemo praesentium odit ut doloribus voluptates ad. Sed quis dolores necessitatibus omnis voluptatem. Molestiae est non sit harum occaecati. Vero velit aspernatur voluptatem qui.",
    "responsavel_id": 9,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 9,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Coty Hand",
        "telefone": "90848669424",
        "email": "lillie.wehner@yahoo.com"
    }
},
{
    "id": 5,
    "data_inicio": "2022-05-31 00:27:57",
    "data_prazo": "2022-06-08 05:29:11",
    "data_conclusao": "2022-06-06 02:38:22",
    "status": 1,
    "titulo": "Et repudiandae soluta vero voluptate.",
    "descricao": "Ut explicabo totam nihil neque. Sed itaque doloremque et sed sint molestias incidunt non. Consequatur esse exercitationem id.",
    "responsavel_id": 9,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 9,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Coty Hand",
        "telefone": "90848669424",
        "email": "lillie.wehner@yahoo.com"
    }
},
{
    "id": 6,
    "data_inicio": "2022-05-31 07:53:37",
    "data_prazo": "2022-06-08 21:02:22",
    "data_conclusao": "2022-06-06 06:33:13",
    "status": 1,
    "titulo": "Iure ut rerum natus et fuga sed aut.",
    "descricao": "Labore odio fuga libero unde veritatis illum. Porro dignissimos molestiae vitae excepturi reiciendis. Labore est voluptatibus ea et odio est quo et.",
    "responsavel_id": 1,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 1,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Barbara Rosenbaum PhD",
        "telefone": "38923716672",
        "email": "camille88@gmail.com"
    }
},
{
    "id": 7,
    "data_inicio": "2022-06-01 19:16:12",
    "data_prazo": "2022-06-04 08:38:02",
    "data_conclusao": "2022-06-05 05:50:15",
    "status": 1,
    "titulo": "Totam ducimus sunt et.",
    "descricao": "Sint molestiae id aut asperiores aut mollitia. Fugit laudantium deleniti necessitatibus id eligendi. Ratione quo non officia molestias.",
    "responsavel_id": 6,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 6,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Dr. Lexi Torp DDS",
        "telefone": "07440481572",
        "email": "lauretta90@schmitt.biz"
    }
},
{
    "id": 8,
    "data_inicio": "2022-05-31 08:32:17",
    "data_prazo": "2022-06-05 14:49:47",
    "data_conclusao": "2022-06-08 02:10:22",
    "status": 1,
    "titulo": "Fuga laboriosam omnis exercitationem nobis eos.",
    "descricao": "Quos est atque modi sed dicta. At natus quaerat sequi itaque quisquam. Eum quas perspiciatis dicta rerum. Dolores alias ipsum voluptates vel earum dolores quisquam.",
    "responsavel_id": 2,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 2,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Kiara Crist",
        "telefone": "70353113670",
        "email": "lrodriguez@haley.org"
    }
},
{
    "id": 9,
    "data_inicio": "2022-05-30 00:39:56",
    "data_prazo": "2022-06-04 22:48:32",
    "data_conclusao": "2022-06-07 07:41:46",
    "status": 1,
    "titulo": "Maiores ullam in ullam incidunt ut.",
    "descricao": "Incidunt quo ut et rerum similique enim sit tempore. Quibusdam id quia natus asperiores dolorum. Delectus minima pariatur distinctio blanditiis id esse. Voluptatem facilis dolorem rerum ut sapiente.",
    "responsavel_id": 2,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 2,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Kiara Crist",
        "telefone": "70353113670",
        "email": "lrodriguez@haley.org"
    }
},
{
    "id": 10,
    "data_inicio": "2022-05-31 01:19:26",
    "data_prazo": "2022-06-04 00:07:48",
    "data_conclusao": "2022-06-06 13:48:45",
    "status": 1,
    "titulo": "Quis et dignissimos nostrum qui beatae aspernatur minus.",
    "descricao": "Doloribus sed autem magnam eos et aliquam. Blanditiis unde et qui. Soluta quos laboriosam ut laborum corporis qui nisi consequatur. Est ut et sequi perspiciatis.",
    "responsavel_id": 8,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 8,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Isaiah Hamill DDS",
        "telefone": "24747225165",
        "email": "joan66@hackett.org"
    }
}
```
___

### Selecionar atividade na agenda por id

#### Request

    GET /api/atividades/{{id}}


#### Curl
```curl
    curl --request GET
  --url http://127.0.0.1:8000/api/atividades/1
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
```

#### Response
```http
{
	"id": 1,
	"data_inicio": "2022-06-02 23:55:38",
	"data_prazo": "2022-06-07 19:34:01",
	"data_conclusao": "2022-06-04 11:11:49",
	"status": 1,
	"titulo": "Aut minus omnis doloribus.",
	"descricao": "Magni ut accusantium alias assumenda deleniti eaque. Quia facere pariatur sit nulla quia temporibus temporibus. Veritatis quis cumque in et optio ullam. Eaque in et et voluptas eveniet omnis.",
	"responsavel_id": 1,
	"created_at": "2022-05-29T23:03:20.000000Z",
	"updated_at": "2022-05-29T23:03:20.000000Z",
	"pessoas": {
		"id": 1,
		"created_at": "2022-05-29T23:03:20.000000Z",
		"updated_at": "2022-05-29T23:03:20.000000Z",
		"nome": "Barbara Rosenbaum PhD",
		"telefone": "38923716672",
		"email": "camille88@gmail.com"
	}
}
```
___

### Selecionar atividades por range

ex: buscar atividades que iniciam de 01/06/2022 a 04/06/2022.

#### Request

    GET /api/atividades/byrange

#### Multipart formdata
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `data_inicio` | `timestamp` | **Obrigatório**. |
| `data_fim` | `timestamp` | **Obrigatório**. > data_inicio |

#### Curl
```shell
    curl --request POST
  --url http://127.0.0.1:8000/api/atividades/byrange
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
  --form 'data_inicio=2022-06-01 01:21:53'
  --form 'data_fim=2022-06-04 23:21:53'
```

#### Response
```http
{
    "id": 1,
    "data_inicio": "2022-06-02 23:55:38",
    "data_prazo": "2022-06-07 19:34:01",
    "data_conclusao": "2022-06-04 11:11:49",
    "status": 1,
    "titulo": "Aut minus omnis doloribus.",
    "descricao": "Magni ut accusantium alias assumenda deleniti eaque. Quia facere pariatur sit nulla quia temporibus temporibus. Veritatis quis cumque in et optio ullam. Eaque in et et voluptas eveniet omnis.",
    "responsavel_id": 1,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 1,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Barbara Rosenbaum PhD",
        "telefone": "38923716672",
        "email": "camille88@gmail.com"
    }
},
{
    "id": 2,
    "data_inicio": "2022-06-03 20:32:22",
    "data_prazo": "2022-06-07 19:05:45",
    "data_conclusao": "2022-06-08 06:15:36",
    "status": 1,
    "titulo": "Tempore cumque nisi ut eius ut deleniti.",
    "descricao": "At itaque ipsa voluptas non ullam adipisci. Cumque esse unde blanditiis sit debitis. Soluta consequatur pariatur vel debitis. Ex earum voluptate deleniti adipisci.",
    "responsavel_id": 9,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 9,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Coty Hand",
        "telefone": "90848669424",
        "email": "lillie.wehner@yahoo.com"
    }
},
{
    "id": 7,
    "data_inicio": "2022-06-01 19:16:12",
    "data_prazo": "2022-06-04 08:38:02",
    "data_conclusao": "2022-06-05 05:50:15",
    "status": 1,
    "titulo": "Totam ducimus sunt et.",
    "descricao": "Sint molestiae id aut asperiores aut mollitia. Fugit laudantium deleniti necessitatibus id eligendi. Ratione quo non officia molestias.",
    "responsavel_id": 6,
    "created_at": "2022-05-29T23:03:20.000000Z",
    "updated_at": "2022-05-29T23:03:20.000000Z",
    "pessoas": {
        "id": 6,
        "created_at": "2022-05-29T23:03:20.000000Z",
        "updated_at": "2022-05-29T23:03:20.000000Z",
        "nome": "Dr. Lexi Torp DDS",
        "telefone": "07440481572",
        "email": "lauretta90@schmitt.biz"
    }
}
```
___

### Criar nova atividade

#### Request

    POST /api/atividades

### Status da atividade
    1: Aguardando
    2: Realizada
    3: Não realizada
 
#### Multipart formdata
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `data_inicio` | `timestamp` | **Obrigatório**. > hoje |
| `data_prazo` | `timestamp` | **Obrigatório**. > data_inicio, > hoje |
| `data_conclusao` | `timestamp` | **Obrigatório**. > data_inicio, > hoje |
| `status` | `smallint` | **Obrigatório**. <= 3 |
| `titulo` | `string` | **Obrigatório**. max:100 |
| `descricao` | `string` | max:300 |
| `responsavel_id` | `bigint` | **Obrigatório**. id precisa existir |

* As datas não podem ser em fim de semana e não é possível criar uma atividade que conflita com as datas de outras atividades do mesmo responsável.

#### Curl
```curl
    curl --request POST
  --url http://127.0.0.1:8000/api/atividades
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
  --form 'data_inicio=2022-06-22 18:21:53'
  --form 'data_prazo=2022-06-23 18:21:52'
  --form 'data_conclusao=2022-06-23 18:21:54'
  --form status=1
  --form 'titulo=titulo qualquer'
  --form responsavel_id=5
  --form 'descricao=descricao qualquer'
```

#### Response
```http
{
	"data_inicio": "2022-06-22 18:21:53",
	"data_prazo": "2022-06-23 18:21:52",
	"data_conclusao": "2022-06-23 18:21:54",
	"status": "1",
	"titulo": "titulo qualquer",
	"responsavel_id": "5",
	"descricao": "descricao qualquer",
	"updated_at": "2022-05-30T01:51:21.000000Z",
	"created_at": "2022-05-30T01:51:21.000000Z",
	"id": 11
}
```
___

### Atualizar atividade por id

#### Request

    PUT /api/atividades/{{id}}

 
#### Multipart formdata
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `data_inicio` | `timestamp` | **Obrigatório**. > hoje |
| `data_prazo` | `timestamp` | **Obrigatório**. > data_inicio, > hoje |
| `data_conclusao` | `timestamp` | **Obrigatório**. > data_inicio, > hoje |
| `status` | `smallint` | **Obrigatório**. <= 3 |
| `titulo` | `string` | **Obrigatório**. max:100 |
| `descricao` | `string` | max:300 |
| `responsavel_id` | `bigint` | **Obrigatório**. id precisa existir |

* As datas não podem ser em fim de semana e não é possível criar uma atividade que conflita com as datas de outras atividades do mesmo responsável.

#### Curl
```curl
    curl --request PUT
  --url http://127.0.0.1:8000/api/atividades/1
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
  --header 'Content-Type: application/x-www-form-urlencoded'
  --data 'data_inicio=2022-07-07 17:21:53'
  --data 'data_prazo=2022-07-08 17:21:54'
  --data 'data_conclusao=2022-07-08 17:21:54'
  --data status=1
  --data 'titulo=titulo qualqueratualizado'
  --data responsavel_id=5
  --data 'descricao=descricao atualizada'
```

#### Response
```http
{
	"id": 1,
	"data_inicio": "2022-07-07 17:21:53",
	"data_prazo": "2022-07-08 17:21:54",
	"data_conclusao": "2022-07-08 17:21:54",
	"status": "1",
	"titulo": "titulo qualqueratualizado",
	"descricao": "descricao atualizada",
	"responsavel_id": "5",
	"created_at": "2022-05-29T23:03:20.000000Z",
	"updated_at": "2022-05-30T01:55:42.000000Z",
	"pessoas": {
		"id": 1,
		"created_at": "2022-05-29T23:03:20.000000Z",
		"updated_at": "2022-05-29T23:03:20.000000Z",
		"nome": "Barbara Rosenbaum PhD",
		"telefone": "38923716672",
		"email": "camille88@gmail.com"
	}
}
```
___

### Deletar atividade por id

#### Request

    DELETE /api/atividades/{{id}}

#### Curl
```curl
    curl --request DELETE
  --url http://127.0.0.1:8000/api/atividades/1
  --header 'Accept: application/json'
  --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjUzODczNjI5LCJleHAiOjE2NTM4NzcyMjksIm5iZiI6MTY1Mzg3MzYyOSwianRpIjoiaDM1N0dzT1BWWTZxaGd5cCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.DXG27QBv_cjDwVpvIPV-GGzWTsbp9NjA0SxWOs2Eg0o'
```

#### Response
```http
{
	"message": "Removido com sucesso"
}
```
___

