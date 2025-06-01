## Requisitos

* PHP 8.2 ou superior
* Composer
* Node.js 20 ou superior
* GIT

## Como rodar o projeto

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados<br>

Instalar as dependências do PHP
```
composer install
```

Instalar as dependências do Node.js
```
npm install
```

Gerar a chave
```
php artisan key:generate
```

Executar as migrations
```
php artisan migrate
```

Executar as seed
```
php artisan db:seed
```
Linkar com o armazenamento das imagens
```
php artisan storage:link
```
Iniciar o projeto criado com Laravel
```
php artisan serve
```

Executar as bibliotecas Node.js, Vite, etc
```
npm run dev
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000
```

