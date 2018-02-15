# Laravel Cors

## Instalação

[Vídeo Tutorial](https://youtu.be/6vBSI4Dz63c)

### 1. Dependência

Usando o <a href="https://getcomposer.org/" target="_blank">composer</a>, execute o comando a seguir para instalar automaticamente `composer.json`:

```shell
composer require resultsystems/laravel-cors
```

ou manualmente no seu arquivo `composer.json`

```json
{
    "require": {
        "resultsystems/laravel-cors": "^2.0"
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
php artisan vendor:publish  --provider="ResultSystems\Cors\CorsServiceProvider"
```


#### 4 Configurações (somente se tiver feito o passo 3, e 3.1)

configure o arquivo com os domínios que dejeja liberar

`config/cors.php`

Inspirado no artigo: http://en.vedovelli.com.br/2015/web-development/Laravel-5-1-enable-CORS/
Obrigado @vedovelli

#### 5 Bônus

Caso você utilize `nginx`

Adicione estas configurações no arquivo de configurações do site:
```
	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
		try_files $uri $uri/ /$is_args$args;
	     if ($request_method = 'OPTIONS') {
	        add_header 'Access-Control-Allow-Origin' '*';
	        #
	        # Om nom nom cookies
	        #
	        add_header 'Access-Control-Allow-Credentials' 'true';
	        add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
	        #
	        # Custom headers and headers various browsers *should* be OK with but aren't
	        #
	        add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Authorization,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type';
	        #
	        # Tell client that this pre-flight info is valid for 20 days
	        #
	        add_header 'Access-Control-Max-Age' 1728000;
	        add_header 'Content-Type' 'text/plain charset=UTF-8';
	        add_header 'Content-Length' 0;
	        return 204;
	     }
	}
```

Caso seja apache, talvez seja necessário adicionar estas linhas abaixo ao .htaccess
```
    <IfModule mod_rewrite.c>
        <IfModule mod_negotiation.c>
            Options -MultiViews
        </IfModule>
    </IfModule>
```
