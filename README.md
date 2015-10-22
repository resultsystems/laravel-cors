#Laravel Cors

## Instalação

### 1. Dependência

Usando o <a href="https://getcomposer.org/" target="_blank">composer</a>, execute o comando a seguir para instalar automaticamente `composer.json`:

```shell
composer require resultsystems/laravel-cors
```

ou manualmente no seu arquivo `composer.json`

```json
{
    "require": {
        "resultsystems/laravel-cors": "^1.0"
    }
}
```

### 2. Middlewares
Para utilizá-los é necessário registrá-los no seu arquivo app/Http/Kernel.php.

```php
 protected $middleware = [
        // other middleware ommited
    	\ResultSystems\Cors\CorsMiddleware::class,
 ];
```

### 3. Provider (opcional)

Selecionar os domínios permitidos no Laraver-Cors em sua aplicação Laravel, é necessário registrar o package no seu arquivo `config/app.php`. Adicione o seguinte código no fim da seção `providers`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        \ResultSystems\Cors\CorsServiceProvider::class,
    ],
// file END ommited
```

#### 3.1 Publicando o arquivo de configuração (somente se tiver feito o passo 3)

Para publicar o arquivo de configuração padrão que acompanham o package, execute o seguinte comando:

```shell
php artisan vendor:publish
```


#### 4 Configurações (somente se tiver feito o passo 3, e 3.1)

configure o arquivo com os domínios que dejeja liberar

`config/cors.php`

Inspirado no artigo: http://en.vedovelli.com.br/2015/web-development/Laravel-5-1-enable-CORS/
Obrigado @vedovelli
