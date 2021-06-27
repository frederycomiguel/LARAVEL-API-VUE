## Laravel API CRUD
by: Frederyco Miguel
## Instalação

``` Bash
    
- create base mysql "laravel"
    
- Copy ".env.example" to ".env"

- composer install
    
- php artisan migrate

- php artisan db:seed
    
- npm install
    
- npm run watch

- php artisan serve

- php artisan key:generate
```

## Endpoints

<h4>Pegar todos Cadastros</h4>

``` Bash
GET api/cadastros
```

<h4>Pegar unico Cadastro</h4>

``` Bash
GET api/cadastro/{id}
```

<h4>Deletar Cadastro</h4>

``` Bash
delete api/cadastro/{id}
```

<h4>Adicionar Cadastro</h4>

``` Bash
POST api/cadastro
```

<h4>Atualizar Cadastro</h4>

``` Bash
PUT api/cadastro
```

