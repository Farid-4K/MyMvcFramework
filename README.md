# MyMvcFramework
### Быстрый старт
#### Требования к ПО
1. PHP => 7.0
1. MySQL => 5.7
1. Composer
1. Apache или Nginx

#### Настройка NGINX
```
server {
server_name Название_сайта;
root Директория_с_сайтом;
index index.html index.php;

  location / {
    try_files $uri $uri/ /index.php?$args;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_index index.php;
    # php порт
    fastcgi_pass 127.0.0.1:9000;
    # Либо сокет, который указан в php-fpm
    # fastcgi_pass unix:/var/run/
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $request_filename;
  }
}
```

#### Настройка .htaccess для apache
```
addDefaultCharset utf-8
php_flag session.use_only_cookies on
php_value session.gc_maxlifetime 3600
RewriteEngine on
RewriteBase /
rewritecond %(REQUEST_FILENAME) !-f
rewritecond %(REQUEST_FILENAME) !-d
RewriteRule ^(.*)$ index.php
```
#### Первоначальная настройка
2. Для начала перейдите в `/app`, откройте консоль и напишите `composer update`.
2. Далее перейдите в `/app/config` и откройте файл `config.php`, найдите запись вида: `const DB` и измените настройки подключения к вашей БД MySQL.
2. **Не стирайте комментарии вида: `//do_not_erase`.**
2. По желанию измените логин и пароль администратора.



